package Location

import java.io.File

class LocationGenerator {

    private val listId = mutableListOf<Int>()
    private val listName = recoverNames()

    private fun generateId(
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

    private fun recoverNames () : List<String> = recoverWords("src/main/resources/Location/names.txt")
    private fun recoverWords(path: String): List<String> = File(path).readText().split(",").map { it.trim() }

}