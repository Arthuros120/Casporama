package Information

import kotlinx.serialization.Serializable

@Serializable
data class Information(

    val id: Int,
    val firstname: String,
    val name: String,
    val mail: String,
    val mobile: String,
    val fix: String,
)
