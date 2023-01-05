<?php

// * On importe les classes nécessaires

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

            /*$alreadydone = array();
            for ($i = 0; $i < count($res); $i++) {
                $order2 = array();
                if (!in_array($res[$i]->getIdorder(),$alreadydone)) {
                    array_push($order2,$res[$i]);
                    array_push($alreadydone,$res[$i]->getIdorder());
                    for ($j = $i+1; $j < count($res); $j++) {
                        if ($res[$i]->getIdorder() == $res[$j]->getIdorder()) {
                            array_push($order2,$res[$j]);
                        }
                    }

                }
            }*/

            $user->setOrder($res);
            return $user->getOrder();
        }

        return null;
    }

    private function generateId(): Int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveOrderById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }

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

    public function addOrder(int $idcart, UserEntity $user, int $idlocation) {

        $id = $this->generateId();
        $iduser = $user->getId();

        $datestringLastUpdate = 'Y-m-d H:i:s';
        $time = time();
        $datestring = 'Y-m-d';
        
        $date = date($datestring, $time);
        $dateLastUpdate = date($datestringLastUpdate, $time);

        if ($idcart == 0) {
            $carts = $this->CartModel->getCart();
        } else {
            $carts = $this->CartModel->getCartDBbyID($iduser, $idcart);
        }

        if ($carts != null) {
            $this->db->query("Call `order`.addOrder(" . $id . "," . $iduser . "," . "'$date'" . "," . $idlocation . "," . "'Non preparer'" . "," . 'true' . "," . "'$dateLastUpdate'" . ")");
            foreach ($carts as $cart) {
                $this->db->query("Call `order`.addProductToOrder(" . $id . "," . $cart->getProduct()->getId() . "," . $cart->getVariant()->getId() . "," . $cart->getQuantity() . ")");
            }
        }
        // decrementer le stock pour les produits commandés.

        if ($cart->getIdcart() == 0) {
            delete_cookie('cart');
        } else {
            $this->CartModel->deleteCart($cart->getIdcart(),$user->getId());
        }

    }

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

    public function delOrder(int $idorder) {
        $this->db->db_debug = false;

        $err = $this->db->query("call `order`.delOrder(". $idorder .")");

        $this->db->db_debug = true;

        return $err;
    }

}