import Catalog.CatalogGenerator
import kotlinx.serialization.ExperimentalSerializationApi

@OptIn(ExperimentalSerializationApi::class)
fun main(args: Array<String>) {

    val generator = Generator()

    generator.generate()

}