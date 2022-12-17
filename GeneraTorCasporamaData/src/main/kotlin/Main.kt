import Product.Product
import Product.ProductGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File

@OptIn(ExperimentalSerializationApi::class)
fun main(args: Array<String>) {

    val productGenerator = ProductGenerator()

    val listFootballVetement = productGenerator.generate(1, 1, 50)

    for (product in listFootballVetement) {
        println(product)
    }

}