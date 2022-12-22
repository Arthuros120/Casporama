package Location

import kotlinx.serialization.Serializable

@Serializable
data class Location(

    val idlocation: Int,
    val id: Int,
    val name: String,
    val location: String,
    val codepostal: String,
    val city: String,
    val department: String,
    val country: String,
    val latitude: Double,
    val longitude: Double,
    val isDefault: Int,
    val isALive: Int,
    val dateLastUpdate: String

)
