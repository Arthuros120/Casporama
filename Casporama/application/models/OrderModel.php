<?php

// * On importe les classes nécessaires

use PhpParser\Node\Expr\Cast\Double;

require_once APPPATH . 'models/entity/OrderEntity.php';
require_once APPPATH . 'models/entity/ProductEntity.php';
require_once APPPATH . 'models/entity/StockEntity.php';

/*

    * Class OrderModel

    * Cette classe permet de visualiser les commandes

*/
class OrderModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProductModel");
    }

    /*
        * Fonction findOrderById

        * Cette fonction permet de récupérer une commande par son id et l'iduser

        * @param int $idorder, int $iduser

        * @return OrderEntity|null

    */
    public function findOrderById($idorder,$iduser): ?OrderEntity
    {
        $queryOrder = $this->db->query("Call `order`.getOrderUserById(" . $idorder . "," . $iduser . ")");
        $rows = $queryOrder->result_array();

        $queryOrder->next_result();
        $queryOrder->free_result();

        $newOrder = null;
        if ($rows != null ) {
            $order = $rows[0];
            $newOrder = new OrderEntity;

            $newOrder->setId($order['id']);
            $newOrder->setDate($order['dateorder']);

            $location = $this->LocationModel->getLocationByUserId($order['iduser'],$order['idlocation']);
            $newOrder->setLocation($location);
            $newOrder->setState($order['state']);

            $newOrder->setIduser($order['iduser']);
            $newOrder->setPrice($order['price']);


            foreach ($rows as $order) {
                
                $product = $this->ProductModel->findById($order['idproduct']);

                foreach ($product->getStock() as $stock) {
                    if ($stock->getId() == $order['idvariant']) {
                        $newOrder->addVariants($stock);
                    }
                }

                $newOrder->addProducts($product);
                $newOrder->addQuantities($order['idvariant'], $order['quantity']);
            }

        }
        
        return $newOrder;

    }

    /*
        * Fonction getOrderByUser

        * Cette fonction permet de récupérer les commandes d'un utilisateur

        * @param UserEntity $user

        * @return array|null

    */
    public function getOrderByUser(UserEntity $user) : ?array {

        $query = $this->db->query('call `order`.getOrderUser('.$user->getId().')');

        $orders = $query->result_array();

        $query->next_result();
        $query->free_result();

        if ($orders != null) {
            $res = array();


            foreach ($orders as $orderid) {
                $order = $this->findOrderById($orderid["id"], $user->getId());
                $res[] = $order;
            }

            $user->setOrder($res);
            return $user->getOrder();
        }

        return null;
    }

    /*
        * Fonction generateId

        * Cette fonction permet de générer un id aléatoire

        * @return int

    */
    private function generateId(): Int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveOrderById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }

    /*
        * Fonction heHaveOrderById

        * Cette fonction permet de vérifier si un id existe

        * @param int $id

        * @return Bool

    */
    public function heHaveOrderById(int $id): Bool
    {

        $query = $this->db->query("Call `order`.verifyId('" . $id . "')");

        $cart = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($cart->idorder)) {

            return true;
        }

        return false;
    }

    /*
        * Fonction addOrder

        * Cette fonction permet d'ajouter une commande

        * @param array $carts, UserEntity $user, int $idlocation, float $price

        * @return int

    */
    public function addOrder(array $carts, UserEntity $user, int $idlocation, float $price) : int {

        $id = $this->generateId();
        $iduser = $user->getId();

        $datestringLastUpdate = 'Y-m-d H:i:s';
        $time = time();
        $datestring = 'Y-m-d';
        
        $date = date($datestring, $time);
        $dateLastUpdate = date($datestringLastUpdate, $time);

        if ($carts != null) {
            $this->db->query("Call `order`.addOrder(" . $id . "," . $iduser . "," . "'$date'" . "," . $idlocation . "," . "'Non preparer'" . "," . 'true' . "," . "'$dateLastUpdate'" . "," . $price . ")");
            foreach ($carts as $cart) {
                $this->db->query("Call `order`.addProductToOrder(" . $id . "," . $cart->getProduct()->getId() . "," . $cart->getVariant()->getId() . "," . $cart->getQuantity() . ")");
                
                $query = $this->db->query('call catalog.getStockByVariant('. $cart->getVariant()->getId() .')');

                $quantity = $query->result_array()[0]['quantity'] ;

                $query->next_result();
                $query->free_result();

                $this->db->query("Call catalog.updateQuantity(". $cart->getVariant()->getId() . "," . $quantity-$cart->getQuantity() .")");
            }
        }

        if ($carts[0]->getIdcart() == 0) {
            delete_cookie('cart');
        } else {
            $this->CartModel->deleteCart($carts[0]->getIdcart(),$user->getId());
        }

        return $id;

    }

    /*
        * Fonction totalOrder

        * Cette fonction permet d'obtenir le total d'une commande

        * @param OrderEntity $order

        * @return float

    */
    public function totalOrder(OrderEntity $order) :float {
        $res = 0.0;
        foreach ($order->getProducts() as $product) {
            foreach ($order->getVariants() as $variant) {
                if ($product->getId() == $variant->getNuproduct()) {
                    $res += $product->getPrice()*$order->getQuantities()[$variant->getId()];
                }
            }
        }
        return $res;
    }

    /*
        * Fonction delOrder

        * Cette fonction permet de supprimer une commande

        * @param int $idorder

        * @return void

    */
    public function delOrder(int $idorder) {

        $order = $this->getOrderById($idorder)[0];

        $this->db->db_debug = false;

        $err = $this->db->query("call `order`.delOrder(". $idorder .")");

        // var_dump($this->db->error());

        $this->db->db_debug = true;

        foreach ($order->getVariants() as $variant) {
            $query = $this->db->query('call catalog.getStockByVariant('. $variant->getId() .')');

            $quantity = $query->result_array()[0]['quantity'] ;

            $query->next_result();
            $query->free_result();
            
            $this->db->query("Call catalog.updateQuantity(". $variant->getId() . "," . $quantity+$order->getQuantities()[$variant->getId()] .")");
        
        }

        return $err;
    }

    /*
        * Fonction getAllOrderWithInfo

        * Cette fonction permet d'obtenir toutes les commandes avec le nom et prenom de l'utilisateur

        * @return array|null

    */    
    public function getAllOrderWithInfo() : ?array
    {

        $query = $this->db->query('call `order`.getAllWithInfo()');

        $orders = $query->result_array();
        
        $query->next_result();
        $query->free_result();

        
        $res = [];

        foreach ($orders as $order) {

            $newOrder = new OrderEntity;

            $newOrder->setId($order['id']);
            $newOrder->setDate($order['dateorder']);
            $newOrder->setState($order['state']);
            $newOrder->setIduser($order['iduser']);

            $newOrder->setLocation($this->LocationModel->getLocationByUserId($order['iduser'],$order['idlocation']));

            $userCivil = $order['name'] . ' ' . $order['firstname'];

            $res[$order['id']] = array (

                'order' => $newOrder,
                'userCivil' => $userCivil
            );
        }

        if (!empty($res)) {
            return $res;
        } else {
            return null;
        }
    }

    /*
        * Fonction getAllOrder

        * Cette fonction permet d'obtenir toutes les commandes

        * @return array|null

    */
    public function getAllOrder() : ?array {

        $query = $this->db->query('call `order`.getAll()');

        $orders = $query->result_array();
        
        $query->next_result();
        $query->free_result();

        
        $res = [];

        foreach ($orders as $order) {

            $newOrder = new OrderEntity;

            $newOrder->setId($order['id']);
            $newOrder->setDate($order['dateorder']);
            $newOrder->setState($order['state']);
            $newOrder->setIduser($order['iduser']);
            $newOrder->setLocation($this->LocationModel->getLocationByUserId($order['iduser'],$order['idlocation']));

            $query = $this->db->query('call `order`.getOrderProduct('. $order['id'] .')');

            $orderproducts = $query->result_array();
        
            $query->next_result();
            $query->free_result();

            foreach ($orderproducts as $products) {
                $product = $this->ProductModel->findById($products['idproduct']);
                $product->setStock($this->ProductModel->getStockAll($products['idproduct']));
                
                $newOrder->addProducts($product);
                $newOrder->addVariants($product->getVariant($products['idvariant']));
                $newOrder->addQuantities($products['idvariant'],$products['quantity']);
            }

            array_push($res,$newOrder);
        }
        if (!empty($res)) {
            return $res;
        } else {
            return null;
        }
    }

    /*
        * Fonction haveStock

        * Cette fonction permet d'obtenir le stock d'un panier

        * @param array $carts

        * @return array

    */
    public function haveStock(array $carts) : array {

        $res = [];

        foreach ($carts as $cart) {
            $query = $this->db->query('call catalog.getStockByVariant('. $cart->getVariant()->getId() .')');
            $res[$cart->getVariant()->getId()] = $cart->getQuantity() <= $query->result_array()[0]['quantity'] ;

            $query->next_result();
            $query->free_result();

        }

        return $res;
    }

    /*
        * Fonction updateStatus

        * Cette fonction permet de modifier le statut d'une commande

        * @param int $idorder

        * @param string $status

        * @return void

    */
    public function updateStatus(int $idorder, string $status) {

        $this->db->query("call `order`.updateState(". $idorder . "," . "'$status'" .")");

    }

    /*
        * Fonction getOrderById

        * Cette fonction permet d'obtenir une commande par son id

        * @param int $idorder

        * @return array|null

    */
    public function getOrderById(int $idorder) :?array {

        $query = $this->db->query("call `order`.getOrderById(". $idorder .")");

        $order = $query->result_array();

        $query->next_result();
        $query->free_result();


        if ($order != null) {
            $order = $query->result_array()[0];
            $newOrder = new OrderEntity;

            $newOrder->setId($order['id']);
            $newOrder->setDate($order['dateorder']);
            $newOrder->setState($order['state']);
            $newOrder->setIduser($order['iduser']);
            $newOrder->setLocation($this->LocationModel->getLocationByUserId($order['iduser'],$order['idlocation']));
            $newOrder->setPrice($order['price']);

            $query = $this->db->query('call `order`.getOrderProduct('. $order['id'] .')');

            $orderproducts = $query->result_array();
        
            $query->next_result();
            $query->free_result();

            foreach ($orderproducts as $products) {
                $product = $this->ProductModel->findById($products['idproduct']);
                $newOrder->addProducts($product);
                $newOrder->addVariants($product->getVariant($products['idvariant']));
                $newOrder->addQuantities($products['idvariant'],$products['quantity']);
            }

            return array($newOrder);
        } 

        return null;

    }

}