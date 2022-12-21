import Information.InformationGenerator
import User.UserGenerator
import org.mindrot.jbcrypt.BCrypt

fun main() {

    val generator = Generator()

    generator.generate(50, 20, 100)

}