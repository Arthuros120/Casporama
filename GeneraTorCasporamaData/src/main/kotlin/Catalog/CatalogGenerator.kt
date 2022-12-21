package Catalog

import Product.Product
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.decodeFromStream
import java.io.File
import kotlin.math.pow

class CatalogGenerator {

    private val listId = mutableListOf<Int>()
    private val listReference = mutableListOf<Long>()
    private val tabSize = recoverSize("src/main/resources/Input/Catalog/size.txt")

    fun generate(listProduct : List<Product>, nbrCatMax : Int, date : String) : List<Catalog> {

        val nbrCat = (1..nbrCatMax).random()

        val listCatalog = mutableListOf<Catalog>()

        for (i in listProduct.indices) {

            val listCat = generateCat(listProduct[i], nbrCat, date)
            listCatalog.addAll(listCat)

        }

        return listCatalog.toList()

    }
    fun generateCat(product : Product, nbr : Int, dateTime : String) : List<Catalog> {

        var count = nbr
        val listCatalog : MutableList<Catalog> = mutableListOf()
        var tabColor = recoverColors("src/main/resources/Input/Catalog/colors.json")

        val typeId = when (product.type) {
            "Vêtement" -> 1
            "Chaussure" -> 2
            "Equipement" -> 3
            else -> throw Exception("Type must be between 1 and 3")
        }

        val maxSizeByColor = tabSize[typeId - 1].size

        while (count > 0) {

            var nbrVariante = (0..maxSizeByColor).random()

            if (nbrVariante > count){

               nbrVariante = (0..count).random()

            }

            val pairColor = generateColors(tabColor)
            val color = pairColor.second
            tabColor = pairColor.first

           var tabSizeEffect = tabSize[typeId - 1]

            for (i in 0..nbrVariante){

                if (tabSizeEffect.isEmpty()) {

                    break

                }

                val range = generateRange(product.idproduct)
                val id = generateId(range.first, range.second)
                val pairSize = generateSize(tabSizeEffect)
                val size = pairSize.second
                tabSizeEffect = pairSize.first

                listCatalog.add(Catalog(

                    id,
                    product.idproduct,
                    generateReference(),
                    color,
                    size,
                    generateQuantity(0, 100),
                    1,
                    dateTime


                ))

                count--

            }
        }

        return listCatalog

    }

    fun generateRange(id: Int): Pair<Int, Int> {

        return Pair(id * 100, id * 100 + 100)

    }

    private fun generateId(
        min: Int,
        max: Int
    ): Int {

        var id = (min..max).random()

        while (listId.contains(id)) {

            id = (min..max).random()

        }

        listId.add(id)

        return id
    }

    fun generateReference(): Long {

        val min = (10.0.pow(12.0)).toLong()
        val max = (9 * (10.0.pow(12.0))).toLong()

        var reference = (min..max).random()

        while (listReference.contains(reference)) {

            reference = (min..max).random()

        }

        listReference.add(reference)
        return reference

    }

    fun generateColors(tabColor : MutableList<String>): Pair<MutableList<String>, String> {

        val color = tabColor.random()

        tabColor.remove(color)

        return Pair(tabColor, color)

    }

    fun generateSize(list : List<String>) : Pair<List<String>, String> {

        val size = list.random()

        val tabList = list.toMutableList()
        tabList.remove(size)

        return Pair<List<String>, String>(tabList.toList(), size)

    }

    fun generateQuantity(min : Int, max : Int) = (min..max).random()

    @OptIn(ExperimentalSerializationApi::class)
    fun recoverColors(path: String): MutableList<String> {

        val tabColor = Json.decodeFromStream<List<Color>>(File(path).inputStream())
        val finalTabColor = mutableListOf<String>()

        for (color in tabColor) {

            if (color.name.length <= 10) {

                finalTabColor.add(color.name)

            }
        }

        return finalTabColor

    }

    fun recoverSize(path : String) : List<List<String>> {

        val typeList : MutableList<List<String>> = mutableListOf( listOfNotNull(""), listOfNotNull(""), listOfNotNull(""))

        val sizeType = File(path).readText().split(";").map { it.trim() }

        for (type in sizeType) {

            val decoupage = type.split(":")
            val typeId = decoupage[0].toInt()
            var valeurs = decoupage[1].split(",")

            if (typeId == 2) {

                val min = valeurs[0].toInt()
                val max = valeurs[1].toInt()
                val tab = mutableListOf<String>()

                for (i in min..max) {

                    tab.add(i.toString())

                }

                valeurs = tab.toList()

            }

            typeList[typeId-1] = valeurs

        }

        return typeList.toList()

    }
}