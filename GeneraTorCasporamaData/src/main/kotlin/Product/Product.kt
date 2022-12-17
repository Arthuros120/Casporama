package Product

import kotlinx.serialization.Serializable

@Serializable
data class
Product(

    val idproduct : Int,
    val type : String,
    val nusport : Int,
    val brand : String,
    val name : String,
    val gender : String,
    val price : Double,
    val description : String,
    val image : String,
    val isALive : Int,
    val dateLastUpdate : String

)
