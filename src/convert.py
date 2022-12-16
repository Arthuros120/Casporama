import os

listeFichiers = []

for (repertoire, sousRepertoires, fichiers) in os.walk("/home/arks/Téléchargements"):

    listeFichiers.extend(fichiers)
    

listeFichiers = [fichier for fichier in listeFichiers if fichier.endswith(".webp")]

for fichier in listeFichiers:
    
    newFichier = fichier.replace(".webp", ".png")
    
    command = "dwebp /home/arks/Téléchargements/" + fichier + " -o " + newFichier + "&& rm " + fichier 

    os.system(command)

