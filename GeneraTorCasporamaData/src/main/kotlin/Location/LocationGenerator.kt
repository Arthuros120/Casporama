package Location

import User.User
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.decodeFromStream
import kotlinx.serialization.json.encodeToStream
import java.io.File

class LocationGenerator {

    private val listId = mutableListOf<Int>()
    private val listName = recoverNames()
    private val nameUsed = mapOf<Int, MutableList<String>>()
    private val listAddresse = recoverAddresse()

    fun generateLocations(user: User, date: String, nbrMaxLocation: Int): List<Location> {

        val listLocation = mutableListOf<Location>()

        val nbrLocation = (0..nbrMaxLocation).random()

        for (i in 0..nbrLocation) {

            val location = generate(user.id, date)

            listLocation.add(location)

        }

        return listLocation

    }

    private fun generate(id: Int, date: String): Location {

        val idLocation = generateId(100, 100000)
        val name = generateName(id)
        val addresse = getAddresse()

        val voie = removeNumber(addresse.addresse).trim()
        val numero = addresse.numero

        val locAddr = "$numero;$voie"

        return Location(

            idLocation,
            id,
            name,
            locAddr,
            addresse.codePostal,
            addresse.commune,
            "Loire-Atlantique",
            "France",
            addresse.latitude,
            addresse.longitude,
            0,
            1,
            date

        )
    }

    private fun getAddresse(): Addresse {

        val address = listAddresse.random()

        listAddresse.remove(address)

        return address

    }

    private fun generateName(idLocation: Int): String {

        val name = listName.random()

        if (nameUsed[idLocation] == null) {

            nameUsed.plus(Pair(idLocation, mutableListOf(name)))

        } else {

            if (nameUsed[idLocation]!!.contains(name)) {

                generateName(idLocation)

            } else {

                nameUsed[idLocation]!!.add(name)

            }
        }

        return name
    }

    private fun generateId(
        min: Int = 1,
        max: Int = 100
    ): Int {

        var id = (min..max).random()

        while (listId.contains(id)) {

            id = (min..max).random()

        }

        listId.add(id)

        return id
    }

    @OptIn(ExperimentalSerializationApi::class)
    public fun convertGeopApiToAddresse() {

        println("Début de la filtration du fichier GeoApi")

        val fileSource = File("src/main/resources/Input/Location/addresses-nantes-metropole-GeoApi.json")
        val fileDestination = File("src/main/resources/Input/Location/addresses-nantes-metropole.json")

        val jsonSource = Json.decodeFromStream<List<AddresseGeoApi>>(fileSource.inputStream())

        val jsonExport = mutableListOf<Addresse>()

        println("Filtrage du fichier GeoApi")

        jsonSource.forEach {

            if (it.fields.numero != -1) {

                val addresse = Addresse(
                    it.fields.commune,
                    it.fields.code_postal,
                    it.fields.numero,
                    it.fields.adresse,
                    latitude = it.fields.geo_shape.coordinates[1],
                    longitude = it.fields.geo_shape.coordinates[0]
                )

                jsonExport.add(addresse)

            } else {

                val addresse = Addresse(
                    it.fields.commune,
                    it.fields.code_postal,
                    0,
                    it.fields.adresse,
                    latitude = it.fields.geo_shape.coordinates[1],
                    longitude = it.fields.geo_shape.coordinates[0]
                )

                jsonExport.add(addresse)

            }
        }

        println("Filtrage terminé")
        println("Début de l'export du fichier GeoApi")

        Json.encodeToStream(jsonExport, fileDestination.outputStream())

        println("Export terminé")
        println("Fichier GeoApi exporté dans le dossier Input/Location")
        println("Fichier GeoApi exporté sous le nom addresses-nantes-metropole.json")
        println("Fichier GeoApi exporté sous le format JSON")
        println("Fichier GeoApi exporté avec ${jsonExport.size} lignes")
        println("Fichier GeoApi exporté avec ${jsonExport.size} adresses")
    }

    @OptIn(ExperimentalSerializationApi::class)
    private fun recoverAddresse(): MutableList<Addresse> {

        val file = File("src/main/resources/Input/Location/addresses-nantes-metropole.json").inputStream()
        return Json.decodeFromStream<MutableList<Addresse>>(file)

    }

    private fun recoverNames(): List<String> = recoverWords("src/main/resources/Input/Location/names.txt")
    private fun recoverWords(path: String): List<String> = File(path).readText().split(",").map { it.trim() }

    private fun removeNumber(str: String): String = str.replace(Regex("[0-9]"), "")

}