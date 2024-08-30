import os
import re

# Dossier à scanner
directory = './path/to/your/php/files'

# Fichier de sortie
output_file = './extracted_sql_queries.txt'

# Liste des expressions régulières pour détecter les requêtes SQL
patterns = [
    r'SELECT\s+.*?\s+FROM\s+.*?;',
    r'INSERT\s+INTO\s+.*?\s+VALUES\s+.*?;',
    r'UPDATE\s+.*?\s+SET\s+.*?;',
    r'DELETE\s+FROM\s+.*?\s+WHERE\s+.*?;'
]

# Liste des répertoires à exclure
excluded_dirs = {'vendor', 'config', 'tests', 'node_modules', 'migrations'}  # Ajoutez d'autres répertoires si nécessaire

# Fonction pour scanner les fichiers et extraire les requêtes SQL
def scan_directory_for_sql(dir_path, patterns, output_file, excluded_dirs):
    # Ouvrir le fichier de sortie en mode écriture
    with open(output_file, 'w') as output:
        # Parcourir tous les fichiers dans le répertoire et ses sous-répertoires
        for root, dirs, files in os.walk(dir_path):
            # Exclure les répertoires non pertinents
            dirs[:] = [d for d in dirs if d not in excluded_dirs]

            for file in files:
                # Vérifier que le fichier est un fichier PHP
                if file.endswith('.php'):
                    file_path = os.path.join(root, file)
                    try:
                        # Lire le contenu du fichier
                        with open(file_path, 'r', encoding='utf-8') as f:
                            content = f.read()
                        
                        # Chercher les requêtes SQL dans le contenu
                        found_queries = False
                        for pattern in patterns:
                            matches = re.findall(pattern, content, re.DOTALL | re.IGNORECASE)
                            if matches:
                                found_queries = True
                                # Écrire le chemin du fichier et les requêtes dans le fichier de sortie
                                output.write(f'Fichier: {file_path}\n')
                                for query in matches:
                                    output.write(f'Requête SQL:\n{query.strip()}\n\n')
                                output.write('----------------------\n\n')
                        
                        if found_queries:
                            print(f"Requêtes SQL trouvées dans {file_path}")
                        
                    except Exception as e:
                        print(f"Erreur lors de la lecture du fichier {file_path}: {e}")

    print(f"Extraction terminée. Les requêtes SQL ont été enregistrées dans '{output_file}'.")

# Appel de la fonction
scan_directory_for_sql(directory, patterns, output_file, excluded_dirs)