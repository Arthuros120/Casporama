package Location

import kotlinx.serialization.Serializable

@Serializable
data class AddresseGeoApi(

    val datasetid: String,
    val recordid: String,
    val fields: Fields,
    val record_timestamp : String

)
