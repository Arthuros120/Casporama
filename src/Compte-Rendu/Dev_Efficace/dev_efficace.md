# Developpement efficace - SAE

## 1 - Mise en place de méthodes pour montrer que l’application est correcte

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