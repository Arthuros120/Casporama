import Catalog.CatalogGenerator
import Information.Information
import Information.InformationGenerator
import Location.Location
import Location.LocationGenerator
import Product.Product
import Product.ProductGenerator
import User.User
import User.UserGenerator
import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.encodeToStream
import mu.KotlinLogging
import java.io.File
import java.io.FileOutputStream
import java.nio.file.Files
import java.nio.file.Paths

class Generator {

    private val productGenerator = ProductGenerator()
    private val categoryGenerator = CatalogGenerator()
    private val userGenerator = UserGenerator()
    private val informationGenerator = InformationGenerator()
    private val locationGenerator = LocationGenerator()
    
    private val logger = KotlinLogging.logger {}

    @OptIn(ExperimentalSerializationApi::class)
    fun generate(nbrProductByType: Int, nbrCatMax: Int = 20, nbrUser: Int = 100) {

        logger.info("----------GeneraTorCasporamaData----------")
        logger.info("")
        logger.info("Début de la génération des données")
        logger.info("Le nombre de produits par type est de $nbrProductByType")
        logger.info("Le nombre de catégories par produit est de $nbrCatMax maximum")
        logger.info("Le nombre d'utilisateurs est de $nbrUser")
        logger.info("")
        logger.info("------------------------------------------")
        logger.info("")

        logger.info("Initialisation de la date...")

        val date = java.time.LocalDate.now().toString()
        val time = java.time.LocalTime.now().toString().split(".")[0]

        logger.info("Date initialisée : $date à $time")

        logger.info("")

        logger.info("Génération des Utilisateur et des Informations...")

        val listPairUserInfo = generateFullUsers(nbrUser, "$date $time")

        logger.info("Génération des Utilisateur et des Informations terminée")

        val listUser = listPairUserInfo.first
        val listInformation = listPairUserInfo.second

        logger.info("")

        logger.info("Génération des Locations...")

        val listLocation: MutableList<Location> = mutableListOf()

        for (user in listUser) {

            listLocation.addAll(locationGenerator.generateLocations(user, "$date $time", 6))

        }

        logger.info("Génération des Locations terminée")

        logger.info("")

        logger.info("Génération des Produits...")

        val listProduct: MutableList<Product> = mutableListOf()

        for (i in 1..4) {

            logger.info("Generation des produits de ${productGenerator.donneNameSport(i)}")

            for (y in 1..3) {

                logger.info("Generation des produits du type ${productGenerator.donneNameType(y)}")

                listProduct.addAll(productGenerator.generate(i, y, date, time, nbrProductByType))

            }
        }

        logger.info("Génération des Produits terminée")

        logger.info("")

        logger.info("Génération des Catégories...")

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

        logger.info("Génération des Catégories terminée")

        logger.info("")

        logger.info("Génération des données terminée")

        logger.info("")

        logger.info("----------Résumé----------")

        logger.info("")

        logger.info("NbrUser: ${listUser.size},")
        logger.info("NbrInformation: ${listInformation.size},")
        logger.info("listLocation: ${listLocation.size},")
        logger.info("Nbr de produit ayant une catégorie: $countProduct,")
        logger.info("listProduct: ${listProduct.size},")
        logger.info("listCategory: ${listCategory.size}")

        logger.info("")

        if (
            countProduct == listProduct.size &&
            listUser.size == listInformation.size
        ) {

            logger.info("Démarage de l'écriture des données dans les fichiers...")

            val folderName = "src/main/resources/Output/Data-${date}_${time}/"

            Files.createDirectory(Paths.get(folderName))

            val fileUser = File(folderName, "User.json").outputStream()
            val fileInformation = File(folderName, "Information.json").outputStream()
            val fileLocation = File(folderName, "Location.json").outputStream()
            val fileProduct = File(folderName, "Product.json").outputStream()

            val fileCategorys : MutableList<FileOutputStream> = mutableListOf()
            val countTotCategoryFile = kotlin.math.ceil(listCategory.size.toDouble() / 5000).toInt()

            for (i in 1..countTotCategoryFile) {

                fileCategorys.add(File(folderName, "Category_$i.json").outputStream())

            }

            val listsCategory = listCategory.chunked(5000)


            Json.encodeToStream(listUser, fileUser)
            Json.encodeToStream(listInformation, fileInformation)
            Json.encodeToStream(listLocation, fileLocation)
            Json.encodeToStream(listProduct, fileProduct)

            for (i in listsCategory.indices) {

                Json.encodeToStream(listsCategory[i], fileCategorys[i])

            }

            fileUser.close()
            fileInformation.close()
            fileProduct.close()

            for (i in fileCategorys.indices) {

                fileCategorys[i].close()

            }

            logger.info("Ecriture des données terminée")

            logger.info("")

        }

        logger.info("----------Fin----------")

    }

    private fun generateFullUsers(nbr: Int, dateLastUpdate: String): Pair<List<User>, List<Information>> {

        val listUser: MutableList<User> = mutableListOf()
        val listInformation: MutableList<Information> = mutableListOf()

        for (i in 1..nbr) {

            val pair = generateFullUser(dateLastUpdate)
            listUser.add(pair.first)
            listInformation.add(pair.second)

        }

        return Pair(listUser.toList(), listInformation.toList())

    }

    private fun generateFullUser(dateLastUpdate: String): Pair<User, Information> {

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

        val user = User(

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

        val information = Information(

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