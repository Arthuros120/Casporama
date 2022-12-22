import mu.KotlinLogging
import Location.LocationGenerator

val argumentAccepted = arrayOf("--help", "-p", "-u", "-c", "-f")
fun main(arg : Array<String>) {
    val logger = KotlinLogging.logger {}
    logger.info("Starting the program")

    var triggerFiltre = false
    var nbProductByType = 50
    var nbrCatMax = 20
    var nbrUser = 100

    if (arg.isNotEmpty()){

        logger.info("Processing arguments...")

        var param = ""

        for (a in arg){

            if (a.contains("-")){

                if (a in argumentAccepted){

                    if (a == "--help"){

                        logger.info("Les paramètres acceptés sont :")
                        logger.info("-p : Nombre de produits par type")
                        logger.info("-u : Nombre d'utilisateurs")
                        logger.info("-c : Nombre de catégories maximum par produit")
                        logger.info("-f : Filtre le fichier GeoApi")
                        return

                    }

                    param = a

                }else{

                    logger.info("Argument $a not accepted")
                    return

                }

            } else {

                if (param == ""){

                    logger.info("Argument $a not accepted")
                    return

                }

                when (param){

                    "-p" -> nbProductByType = a.toInt()
                    "-u" -> nbrUser = a.toInt()
                    "-c" -> nbrCatMax = a.toInt()
                    "-f" -> triggerFiltre = "true".toBoolean()
                    else -> {
                        logger.info("Argument $a not accepted")
                        return
                    }
                }

                param = ""

            }
        }

        logger.info("Arguments processed")

    } else {

        logger.info("No arguments detected")
        logger.info("Processing default arguments...")

    }

    logger.info("Parameters :")
    logger.info("Nombre de produits par type : $nbProductByType")
    logger.info("Nombre d'utilisateurs : $nbrUser")
    logger.info("Nombre de catégories maximum par produit : $nbrCatMax")
    logger.info("Filtre le fichier GeoApi : $triggerFiltre")

    if (triggerFiltre){

        try {

            val locationGenerator = LocationGenerator()
            locationGenerator.convertGeopApiToAddresse()

        }catch (e : Exception){

            logger.error("Erreur lors de la conversion du fichier GeoApi")
            logger.error(e.message)
            return

        }

    }

    try {

        val generator = Generator()
        generator.generate(nbProductByType, nbrCatMax, nbrUser)

    }catch (e : Exception){

        logger.error("Erreur lors de la génération des données")
        logger.error("Cela est souvent du à un de nombre de generation demandé par rapport au nombre de données disponibles")
        logger.error(e.message)
        return

    }



}