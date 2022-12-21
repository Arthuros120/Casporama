package Location

import kotlinx.serialization.Serializable

@Serializable
data class Addresse(

    val commune: String,
    val codePostal: String,
    val numero: Int,
    val addresse: String,
    val latitude: Double,
    val longitude: Double,

    )
