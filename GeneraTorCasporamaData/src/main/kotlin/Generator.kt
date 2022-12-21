import Catalog.CatalogGenerator
import Product.Product
import Product.ProductGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File
import java.nio.file.Files
import java.nio.file.Paths

class Generator {

    private val productGenerator = ProductGenerator()
    private val categoryGenerator = CatalogGenerator()

    @OptIn(ExperimentalSerializationApi::class)
    fun generate(nbrProductByType : Int, nbrCatMax : Int = 20) {

        val date = java.time.LocalDate.now().toString()
        val time = java.time.LocalTime.now().toString().split(".")[0]

        val listProduct : MutableList<Product> = mutableListOf()

        for (i in 1..1) {

            for (y in 1..3){

                listProduct.addAll(productGenerator.generate(i, y, date, time, nbrProductByType))

            }
        }

        val listCategory = categoryGenerator.generate(listProduct, nbrCatMax, "$date $time")

        var count = 0

        for (i in listProduct.indices) {

            for (y in listCategory.indices) {

                if (listProduct[i].idproduct == listCategory[y].nuproduct) {

                    count++
                    break

                }
            }
        }

        println("Count: $count, listProduct: ${listProduct.size}")

        if (count == listProduct.size ) {

            val folderName = "src/main/resources/Output/Data-${date}_${time}/"

            Files.createDirectory(Paths.get(folderName))

            val fileProduct = File(folderName, "Product.json").outputStream()
            val fileCategory = File(folderName, "Catalog.json").outputStream()

            Json.encodeToStream(listProduct, fileProduct)
            Json.encodeToStream(listCategory, fileCategory)

            fileProduct.close()
            fileCategory.close()

        }
    }
}