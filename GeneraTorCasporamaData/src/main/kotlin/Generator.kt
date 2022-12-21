import Catalog.CatalogGenerator
import Information.Information
import Information.InformationGenerator
import Product.Product
import Product.ProductGenerator
import User.User
import User.UserGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import java.io.File
import java.nio.file.Files
import java.nio.file.Paths

class Generator {

    private val productGenerator = ProductGenerator()
    private val categoryGenerator = CatalogGenerator()
    private val userGenerator = UserGenerator()
    private val informationGenerator = InformationGenerator()

    @OptIn(ExperimentalSerializationApi::class)
    fun generate(nbrProductByType : Int, nbrCatMax : Int = 20, nbrUser : Int = 100) {

        val date = java.time.LocalDate.now().toString()
        val time = java.time.LocalTime.now().toString().split(".")[0]

        val listPairUserInfo = generateFullUsers(nbrUser, "$date $time")

        val listUser = listPairUserInfo.first
        val listInformation = listPairUserInfo.second

        val listProduct : MutableList<Product> = mutableListOf()

        for (i in 1..1) {

            for (y in 1..3){

                listProduct.addAll(productGenerator.generate(i, y, date, time, nbrProductByType))

            }
        }

        val listCategory = categoryGenerator.generate(listProduct, nbrCatMax, "$date $time")

        var countProduct = 0

        for (i in listProduct.indices) {

            for (y in listCategory.indices) {

                if (listProduct[i].idproduct == listCategory[y].nuproduct) {

                    countProduct++
                    break

                }
            }
        }

        println("NbrUser: ${listUser.size}, NbrInformation: ${listInformation.size}")
        println("Count: $countProduct, listProduct: ${listProduct.size}")

        if (countProduct == listProduct.size && listUser.size == listInformation.size) {

            val folderName = "src/main/resources/Output/Data-${date}_${time}/"

            Files.createDirectory(Paths.get(folderName))

            val fileUser = File(folderName, "User.json").outputStream()
            val fileInformation = File(folderName, "Information.json").outputStream()
            val fileProduct = File(folderName, "Product.json").outputStream()
            val fileCategory = File(folderName, "Catalog.json").outputStream()

            Json.encodeToStream(listUser, fileUser)
            Json.encodeToStream(listInformation, fileInformation)
            Json.encodeToStream(listProduct, fileProduct)
            Json.encodeToStream(listCategory, fileCategory)

            fileUser.close()
            fileInformation.close()
            fileProduct.close()
            fileCategory.close()

        }
    }

    private fun generateFullUsers(nbr : Int, dateLastUpdate: String) : Pair<List<User>, List<Information>> {

        val listUser : MutableList<User> = mutableListOf()
        val listInformation : MutableList<Information> = mutableListOf()

        for (i in 1..nbr) {

            val pair = generateFullUser(dateLastUpdate)
            listUser.add(pair.first)
            listInformation.add(pair.second)

        }

        return Pair(listUser.toList(), listInformation.toList())

    }

    private fun generateFullUser(dateLastUpdate : String) : Pair<User, Information> {

        val nameFirstname = informationGenerator.generateNameFirstname()

        val name = nameFirstname.first
        val firstname = nameFirstname.second
        val mail = informationGenerator.generateMail(name, firstname)
        val mobile = informationGenerator.generateMobile()
        val fix = informationGenerator.generateFix()


        val id = userGenerator.generateId(20, 5000)
        val login = userGenerator.generateLogin(name, firstname)
        val salt = userGenerator.generateSalt()
        val password = userGenerator.generatePassword(name, salt)
        val status = userGenerator.generateStatus()

        val user  = User (

            id,
            login,
            password,
            salt,
            "",
            status,
            1,
            1,
            dateLastUpdate

        )

        val information = Information (

            id,
            name,
            firstname,
            mail,
            mobile,
            fix,

        )

        return Pair(user, information)
    }
}