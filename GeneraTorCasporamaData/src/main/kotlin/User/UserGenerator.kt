package User

import org.mindrot.jbcrypt.BCrypt
import kotlin.random.Random

class UserGenerator {

    private val stringLength = 35
    private val charPool: List<Char> = ('a'..'z') + ('0'..'9') + '.'
    private val listId = mutableListOf<Int>()
    private val listSalt = mutableListOf<String>()

    fun generateStatus(): String {

        val chance = Random.nextInt(0, 100)

        return if (chance < 30) {

            "Caspor"

        } else {

            "Client"

        }

    }

    fun generateLogin(
        name: String,
        firstname: String
    ): String = "$name$firstname"

    fun generatePassword(name: String, salt: String): String = BCrypt.hashpw("${name}123$${salt}", BCrypt.gensalt())

    fun generateSalt(): String {

        val salt = randomString()

        if (listSalt.contains(salt)) {

            generateSalt()

        } else {

            listSalt.add(salt)

        }

        return salt
    }

    fun generateId(
        min: Int = 1,
        max: Int = 100
    ): Int {

        var id = (min..max).random()

        while (listId.contains(id)) {

            id = (min..max).random()

        }

        listId.add(id)

        return id
    }

    private fun randomString() = (1..stringLength)
        .map { Random.nextInt(0, charPool.size).let { charPool[it] } }
        .joinToString("")

}