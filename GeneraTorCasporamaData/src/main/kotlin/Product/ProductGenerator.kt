package Product

import java.io.File
import java.nio.file.Files
import java.nio.file.Paths

class ProductGenerator {

    private val listId = mutableListOf<Int>()
    private val listName = mutableListOf<String>()

    fun generate(sport : Int, type : Int, Nbr : Int = 1) : List<Product> {

        if (Nbr < 1) throw Exception("Nbr must be greater than 0")

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

        for (i in 1..Nbr) {

            val id = this.generateId(5000, 5500)
            val brand = generateBrand(nameSport)
            val name = generateName(nameSport, nameType)
            val gender = generateGender()
            val price = generatePrice()
            val description = generateDescription()
            val image = generateImage(nameSport, nameType)

            listProduct.add(
                Product(
                    id,
                    nameType,
                    sport,
                    brand,
                    name,
                    gender,
                    price,
                    description,
                    image,
                    1,
                    "2020-12-01"
                )
            )

        }

        return listProduct.toList()

    }

    fun generateId(
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

    fun generateBrand(nameSport: String): String = recoverWords("src/main/resources/$nameSport/brand.txt").random()

    fun generateName(nameSport: String, nameType: String): String {

        val prefix = recoverWords("src/main/resources/$nameSport/$nameType/prefix.txt").random()
        val suffix = recoverWords("src/main/resources/$nameSport/$nameType/suffix.txt").random()

        val res = "$prefix de $suffix".firstLetterToUpperCase()

        while (listName.contains(res)) {

            return generateName(nameSport, nameType)

        }

        listName.add(res)
        return res
    }

    fun generateGender(): String = listOf("Homme", "Femme", "Mixte").random()

    fun generatePrice(
        min: Int = 5,
        max: Int = 100
    ): Double {


        val entier = (min.toInt()..max.toInt()).random()
        val decimal = (0..99).random()

        return "$entier.$decimal".toDouble()

    }

    fun generateDescription(
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

    fun generateImage(nameSport: String, nameType: String): String {

        val listImages = recoverImages(nameSport, nameType)

        val defaultPath = "/upload/image/$nameSport/$nameType/"

        val listUsedImages = mutableListOf<String>()

        var image = listImages.random()

        listUsedImages.add(image)

        for (i in 0..(3..5).random()) {

            while (listUsedImages.contains(image)) {

                image = listImages.random()

            }

            listUsedImages.add(image)

        }

        var imagesPath = ""

        for (image in listUsedImages) {

            imagesPath += "$defaultPath$image;"

        }

        return imagesPath

    }

    fun recoverImages(nameSport: String, typeSport: String): List<String> {

        val listImages = mutableListOf<String>()

        Files.walk(Paths.get("src/main/resources/$nameSport/$typeSport/images")).filter { Files.isRegularFile(it) }.forEach { listImages.add(
            it.toString()
        ) }

        for (i in 0 until listImages.size) {

            listImages[i] = listImages[i].split("/").last()

        }

        return listImages.toList()

    }

    private fun recoverWords(path: String): List<String> = File(path).readText().split(",").map { it.trim() }
}

private fun String.firstLetterToUpperCase(): String = this.replaceFirstChar { it.uppercase() }

