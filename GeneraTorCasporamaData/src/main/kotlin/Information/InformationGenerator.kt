package Information

import kotlinx.serialization.ExperimentalSerializationApi
import kotlinx.serialization.json.Json
import kotlinx.serialization.json.decodeFromStream
import java.io.File

class InformationGenerator {

    private val listNameFirstname = recoverNameAndFirstname()
    private val listPhone = mutableListOf<String>()
    private val listFix = mutableListOf<String>()

    fun generateNameFirstname(): Pair<String, String> {

        val name = listNameFirstname.first.random()
        val firstname = listNameFirstname.second.random()

        listNameFirstname.first.remove(name)
        listNameFirstname.second.remove(firstname)

        return Pair(name, firstname)

    }

    fun generateMail(name: String, firstname: String): String = "$name.$firstname@fictive.trash"

    fun generateMobile(): String {

        val mobile = randomPhone("06")

        if (listPhone.contains(mobile)) {

            generateMobile()

        } else {

            listPhone.add(mobile)

        }

        return mobile

    }

    fun generateFix(): String {

        val fix = randomPhone("02")

        if (listFix.contains(fix)) {

            generateFix()

        } else {

            listFix.add(fix)

        }

        return fix

    }

    @OptIn(ExperimentalSerializationApi::class)
    private fun recoverNameAndFirstname(): Pair<MutableList<String>, MutableList<String>> {

        val tabNames = Json.decodeFromStream<MutableList<String>>(
            File(
                "src/main/resources/Input/Information/names.json"
            ).inputStream()
        )

        val tabFirstName = Json.decodeFromStream<MutableList<String>>(
            File(
                "src/main/resources/Input/Information/first-names.json"
            ).inputStream()
        )

        return Pair(tabNames, tabFirstName)
    }

    private fun randomPhone(depart: String): String {

        val phone = StringBuilder()

        phone.append(depart)

        for (i in 0..7) phone.append((0..9).random())

        return phone.toString()

    }

}