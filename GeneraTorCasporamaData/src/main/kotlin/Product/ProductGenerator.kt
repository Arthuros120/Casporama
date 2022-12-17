package Product

import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File
import java.nio.file.Files
import java.nio.file.Paths

class ProductGenerator {

    private val listId = mutableListOf<Int>()
    private val listName = mutableListOf<String>()

    fun generate(sport : Int, type : Int, Nbr : Int = 1) : List<Product> {

        if (Nbr < 1) throw Exception("Nbr must be greater than 0")
        if (Nbr > 200) throw Exception("Nbr must be less than 100")

        val nameSport = when (sport) {
            1 -> "Football"
            2 -> "Volleyball"
            3 -> "Badminton"
            4 -> "Arts-martiaux"
            else -> throw Exception("Sport must be between 1 and 4")
        }

        val nameType = when (type) {
            1 -> "Vêtement"
            2 -> "Chaussure"
            3 -> "Equipement"
            else -> throw Exception("Type must be between 1 and 3")
        }

        val listProduct = mutableListOf<Product>()

        val range = generateRange(sport, type)

        for (i in 1..Nbr) {

            val id = this.generateId(range.first, range.second)
            val brand = generateBrand(nameSport)
            val name = generateName(nameSport, nameType)
            val gender = generateGender()
            val price = generatePrice()
            val description = generateDescription()
            val image = generateImage(nameSport, nameType, name.second)

            listProduct.add(
                Product(
                    id,
                    nameType,
                    sport,
                    brand,
                    name.first,
                    gender,
                    price,
                    description,
                    image,
                    1,
                    "2020-12-01"
                )
            )

        }

        val date = java.time.LocalDate.now().toString()
        val time = java.time.LocalTime.now().toString().split(".")[0]

        val file = File("src/main/resources/Output/", "Product_${date}_${time}.json").outputStream()

        Json.encodeToStream<List<Product>>(listProduct, file)

        file.close()

        return listProduct.toList()

    }

    private fun generateRange(sport: Int, type: Int): Pair<Int, Int> {

        val rangeSport = sport * 1000
        val rangeType = type * 100

        val minRange = rangeSport + rangeType  - 100
        val maxRange = rangeSport + rangeType * 3

        return Pair(minRange, maxRange)

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

    private fun generateBrand(nameSport: String): String = recoverWords("src/main/resources/$nameSport/brand.txt").random()

    private fun generateName(nameSport: String, nameType: String): Pair<String, String> {

        val prefix = getForlderName(nameSport, nameType).random()
        val suffix = recoverWords("src/main/resources/$nameSport/$nameType/suffix.txt").random()

        val res = "$prefix de $suffix".firstLetterToUpperCase()

        while (listName.contains(res)) {

            return generateName(nameSport, nameType)

        }

        listName.add(res)

        return Pair(res, prefix)
    }

    private fun generateGender(): String = listOf("Homme", "Femme", "Mixte").random()

    private fun generatePrice(
        min: Int = 5,
        max: Int = 100
    ): Double {


        val entier = (min.toInt()..max.toInt()).random()
        val decimal = (0..99).random()

        return "$entier.$decimal".toDouble()

    }

    private fun generateDescription(
        min : Int = 15,
        max : Int = 100
    ): String {

        val words = recoverWords("src/main/resources/description.txt").map { it.lowercase().trim() }

        var description = ""

        var countLineBreak = (10..20).random()

        for (i in 0..(min..max).random()) {

            description += words.random() + " "

            if (i == countLineBreak) {

                description += "\n"
                countLineBreak += (10..20).random()

            }
        }

        return description.trim().firstLetterToUpperCase()

    }

    private fun generateImage(nameSport: String, nameType: String, nameSubClass : String): String {

        val listImages = recoverImages(nameSport, nameType, nameSubClass)

        val defaultPath = "/upload/image/$nameSport/$nameType/$nameSubClass/"

        val listUsedImages = mutableListOf<String>()

        var image = listImages.random()

        listUsedImages.add(image)

        for (i in 0..(3..5).random()) {

            var count = 0

            while (listUsedImages.contains(image) && count < 100) {

                image = listImages.random()

                count++

            }

            listUsedImages.add(image)

        }

        var imagesPath = ""

        for (image in listUsedImages) {

            imagesPath += "$defaultPath$image;"

        }

        return imagesPath

    }

    fun recoverImages(nameSport: String, typeSport: String, nameSubClass : String): List<String> {

        val listImages = mutableListOf<String>()

        Files.walk(Paths.get("../Casporama/upload/image/$nameSport/$typeSport/$nameSubClass")).filter { Files.isRegularFile(it) }.forEach { listImages.add(
            it.toString()
        ) }

        for (i in 0 until listImages.size) {

            listImages[i] = listImages[i].split("/").last()

        }

        return listImages.toList()

    }

    private fun recoverWords(path: String): List<String> = File(path).readText().split(",").map { it.trim() }

    public fun getForlderName(nameSport: String, typeSport: String) : List<String> {

        val listFolder = mutableListOf<String>()
        val delIndex = mutableListOf<Int>()

        Files.walk(Paths.get("../Casporama/upload/image/$nameSport/$typeSport")).filter { Files.isDirectory(it) }.forEach { listFolder.add(
            it.toString().split("/").last()
        ) }

        listFolder.remove(typeSport)

        for (i in 0 until listFolder.size) {

            var count = 0

            Files.walk(Paths.get("../Casporama/upload/image/$nameSport/$typeSport/${listFolder[i]}")).filter { Files.isRegularFile(it) }.forEach {
                count++
            }

            if (count < 3) {

                delIndex.add(i)

            }

        }

        for (i in delIndex) {

            listFolder.removeAt(i)

        }

        return listFolder.toList()

    }
}

private fun String.firstLetterToUpperCase(): String = this.replaceFirstChar { it.uppercase() }

