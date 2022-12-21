package Location

import kotlinx.serialization.Serializable

@Serializable
data class Fields(

    val quartier : String = "",
    val commune: String,
    val pole : String = "",
    val numero : Int = -1,
    val code_postal : String,
    val gid : String,
    val adresse : String,
    val geo_shape : GeoShape,

)
