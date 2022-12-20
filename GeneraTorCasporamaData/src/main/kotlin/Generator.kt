import Catalog.CatalogGenerator
import Product.Product
import Product.ProductGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File

class Generator {

    private val productGenerator = ProductGenerator()
    private val categoryGenerator = CatalogGenerator()

    @OptIn(ExperimentalSerializationApi::class)
    fun generate() {

        val date = java.time.LocalDate.now().toString()
        val time = java.time.LocalTime.now().toString().split(".")[0]

        val listProduct = productGenerator.generate(1, 1, date, time, 50)
        val listCategory = categoryGenerator.generate(listProduct, 20, "$date $time")

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

        if (count == listProduct.size) {

            val fileProduct = File("src/main/resources/Output/", "Product_${date}_${time}.json").outputStream()
            val fileCategory = File("src/main/resources/Output/", "Catalog_${date}_${time}.json").outputStream()

            Json.encodeToStream(listProduct, fileProduct)
            Json.encodeToStream(listCategory, fileCategory)

            fileProduct.close()
            fileCategory.close()

        }
    }
}