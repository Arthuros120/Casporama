package User

import kotlinx.serialization.Serializable

@Serializable
data class User(

    val id : Int,
    val login : String,
    val password : String,
    val salt : String,
    val cookieId : String,
    val status : String,
    val isVerified : Int,
    val isALive : Int,
    val dateLastUpdate : String

)
