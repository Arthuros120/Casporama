import Product.Product
import Product.ProductGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File

@OptIn(ExperimentalSerializationApi::class)
fun main(args: Array<String>) {

    val productGenerator = ProductGenerator()

    val listProduct = productGenerator.generate(1, 1, 50)

    val file = File("src/main/resources/Output/", "test.json").outputStream()

    Json.encodeToStream<List<Product>>(listProduct, file)

    file.close()

}