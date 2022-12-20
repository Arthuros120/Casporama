package Catalog

import kotlinx.serialization.Serializable
import java.lang.module.ModuleReference

@Serializable
data class Catalog(

    val id : Int,
    val nuproduct : Int,
    val reference: Long,
    val color : String,
    val size : String,
    val quantity : Int,
    val isALive : Int,
    val dateLastUpdate : String

)
