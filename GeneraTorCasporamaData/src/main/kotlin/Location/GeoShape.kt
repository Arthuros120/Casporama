package Location

import kotlinx.serialization.Serializable

@Serializable
data class GeoShape(

    val coordinates: List<Double>,
    val type: String

)
