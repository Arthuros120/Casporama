
# Equipe1-1

## Procédure de déploiement :
Pour tout les commits, `git pull` dans le répertoire du site de dev, utilisation de la bd de test ou de production a écrire dans le `.htaccess` 
dans la variable d'environement Deploymentmode qui accepte 2 valeurs : Production, Developement

Lorsqu'une version est bonne pour le déploiement en prod, tag le commit `
git commit -m blabla -t &&  git tag -a vX.X HEAD -m "version X.X" && git push`du label "version X.X" avec une progression de 0 a 9 pour le deuxième chiffre (1.0, 1.1, 1.2 ... 1.9, 2.0) 
Puis, faire un pull dans le répertoire du site prod , ainsi qu'un reload d'apache (pour être sûr) 

- IP: 172.26.82.58
- Pass: zCQiZB83an55
