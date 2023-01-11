from os import walk

DEFAULT_PATH = "/var/www/html/sae_3/"

LIST_FOLDER = ["GeneraTorCasporamaData/src/main", "sql/mariadb", "Casporama/static",
                "Casporama/application/models", "Casporama/application/config",
                "Casporama/application/controllers", "Casporama/application/views",
                "Casporama/application/interfaces", "Casporama/application/models",
                "src"]

"""Recover all files in a folder"""
def recover_files(path):
    
    list_files = []
    
    for (repertoire, _, files) in walk(path):
        
        for file in files:
            
            if not file.endswith((".png", ".webp", ".jpg", ".svg", ".ttf", ".ico", ".woff", ".woff2", ".eot", ".otf")):
                
                list_files.append(repertoire + "/" + file)
        
    return list_files

def count_lines(list_files):
    
    count = 0
    
    for file in list_files:
        
        with open(file, 'r') as f:
            
            try :
                
                lignes = f.readlines()
                count += len(lignes)
            
            except UnicodeDecodeError:
                
                pass

    return count

if __name__ == "__main__":
    
    list_files = {}
    
    for folder in LIST_FOLDER:
        
        list_files[folder] = recover_files(DEFAULT_PATH + folder)
    
    
    nbr_total_lines = 0
    
    for file in list_files:
        
        nbr_lines = count_lines(list_files[file])
        
        nbr_total_lines += nbr_lines
    
        print("Nombre de lignes dans le dossier {} : {} lignes.".format(file, nbr_lines))
    
    print("Nombre total de lignes du project: {} lignes.".format(nbr_total_lines))