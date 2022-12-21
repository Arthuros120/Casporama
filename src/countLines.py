from os import walk

DEFAULT_PATH = "/var/www/html/sae_3/"

LIST_FOLDER = ["GeneraTorCasporamaData/src/main", "sql/mariadb", "Casporama/static",
                "Casporama/application/models", "Casporama/application/config",
                "Casporama/application/controllers", "Casporama/application/views",
                "Casporama/application/interfaces", "Casporama/application/models"]

"""Recover all files in a folder"""
def recover_files(path):
    
    liste_fichier = []
    
    for (_, _, fichiers) in walk(path):
        
        liste_fichier.extend(fichiers)
        
    return liste_fichier


print(recover_files(DEFAULT_PATH + LIST_FOLDER[0] + "/"))


# Liste = open(
#     "/var/www/html/sae_3/Casporama/application/models/VerifyModel.php", 'r')

# lignes = Liste.readlines()

# print(len(lignes))
