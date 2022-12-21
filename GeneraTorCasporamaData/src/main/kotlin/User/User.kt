package User

data class User(

    val id : Int,
    val login : String,
    val password : String,
    val salt : String,
    val cookieId : String,
    val status : String,
    val isVerified : Int,
    val IsALive : Int,
    val dateLastUpdate : String

)
