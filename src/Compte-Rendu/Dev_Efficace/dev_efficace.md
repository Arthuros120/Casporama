# Developpement efficace - SAE

## 1 - Mise en place de méthodes pour montrer que l’application est correcte

Casporama est un site de e-commerce divisé en 4 sport distinct : Football, Volleyball, Badminton et Arts-Martiaux. Pour chaque sport nous avons 3 catégories différentes contenant des produits : Vêtement, Chaussure et Equipement. Cette répartition des produits permet d'éviter un appel à la base de donnée pour un grand nombre de produit puisqu'ils sont triés par sport et par type. Pour continuer, l'utilisateur peut ajouter des produits à son panier pour ensuite soit l'enregistrer ou bien le payer directement. Lors du paiement une vérification du stock est réalisé. 

Pour finir les pages ont été réalisées de telle sorte que les entités requisent contienne uniquement le contenu requis pour la page demandée par exemple dans le panneau d'admin, gestion d'utilisateur on n'utilise pas les entitées location, coordonnée qui sont présent dans l'entité user, donc pour éviter d'utiliser trop de requête vers la base de donnée on définit l'entité user sans adresses et avec uniquement son nom, prénom qui provienne de l'entité coordonnée. 

Voyons maintenant quelques algorithme réalisé pour des demandes plus spécifique


### 1.1 - Algorithme de filtre par prix

Cette algorithme permet de trier une liste de produit par prix avec un prix minimum et un prix maximum.

- Précondition : $products > 1$, $get > 1$

```

public function filterByPrice(string $title, array $products, array $get) : array
    {
    
        if (!empty($get['price']) && stristr($get['price'], '-')) {

            $price = $get['price'];

            $listPrice = explode('-', $price);

            $title .= " Prix -> " . $listPrice[0] . "€ - " . $listPrice[1] . "€, ";

            // * Initialisation du tableau de retour
            $listProductByPrice = array();

            // * On parcours le tableau de produit

            foreach ($products as &$product) {

                if ($product->getPrice() >= $listPrice[0] && $product->getPrice() <= $listPrice[1]) {

                    // * On ajoute l'objet au tableau de retour
                    array_push($listProductByPrice, $product);
                }
            }

            // * On retourne le tableau de retour

            return array(
                'title' => $title,
                'products' => $listProductByPrice
            );

        } else {

            return array(
                'title' => $title,
                'products' => $products
            );


        }
    }

```
 - Résultat obtenue :

Si les produits ou les filtres ou les deux sont vides, l'algo renvoie la liste de produits sans modification ainsi que le titre

Si les produits et les filtres ne sont pas vides, pour tout les produits on regarde si ils sont compris entre le prix minimum et le prix maximum on les ajoutes l'objet au tableau de retour et on renvoie ce tableau ainsi que le titre.


