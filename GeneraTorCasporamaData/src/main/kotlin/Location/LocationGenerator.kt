package Location

import Catalog.Color
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.decodeFromStream
import kotlinx.serialization.json.encodeToStream
import java.io.File

class LocationGenerator {

    private val listId = mutableListOf<Int>()
    private val listName = recoverNames()

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

        val fileSource = File("src/main/resources/Input/Location/addresses-nantes-metropole-GeoApi.json")
        val fileDestination = File("src/main/resources/Input/Location/addresses-nantes-metropole.json")

        val jsonSource = Json.decodeFromStream<List<AddresseGeoApi>>(fileSource.inputStream())

        val jsonExport = mutableListOf<Addresse>()
        
        jsonSource.forEach {

            if (it.fields.numero != -1) {

                val addresse = Addresse(
                    it.fields.commune,
                    it.fields.code_postal,
                    it.fields.numero,
                    it.fields.adresse,
                    it.fields.geo_shape.coordinates[0],
                    it.fields.geo_shape.coordinates[1]
                )

                jsonExport.add(addresse)

            } else {

                val addresse = Addresse(
                    it.fields.commune,
                    it.fields.code_postal,
                    0,
                    it.fields.adresse,
                    it.fields.geo_shape.coordinates[0],
                    it.fields.geo_shape.coordinates[1]
                )

                jsonExport.add(addresse)

            }
        }

        Json.encodeToStream(jsonExport, fileDestination.outputStream())

    }
    private fun recoverNames () : List<String> = recoverWords("src/main/resources/Input/Location/names.txt")
    private fun recoverWords(path: String): List<String> = File(path).readText().split(",").map { it.trim() }

}