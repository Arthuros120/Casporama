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
                /**
                 * @var ProductEntity $product
                 */
                $product = $this->ProductModel->findById($order['idproduct']);
                $newOrder->addProducts($product);
                $newOrder->addVariants($product->getVariant($order['idvariant']));
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
            
            foreach ($orders as $order) {
                $newOrder = new OrderEntity;
                
                $newOrder->setId($order['id']);
                $newOrder->setIdorder($order['idorder']);
                $newOrder->setDate($order['dateorder']);

                $product = $this->ProductModel->findById($order['idproduct']);
                $newOrder->setProduct($product);

                $location = $this->LocationModel->getLocationByUserId($order['iduser'],$order['idlocation']);
                $newOrder->setLocation($location);

                foreach ($product->getStock() as $variant) {
                    if ($variant->getId() == $order['idvariant']) {
                        $newOrder->setVariant($variant);
                    }
                }

                $newOrder->setQuantity($order['quantity']);
                $newOrder->setState($order['state']);

                $newOrder->setIduser($order['iduser']);

                array_push($res,$newOrder);
            }

            $alreadydone = array();
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
                    $user->setOrder($order2);
                }
            }

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

    public function maxIdOrder(int $iduser) : int {
        $query = $this->db->query("Call `order`.maxIdOrder('" . $iduser . "')");

        $order = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($order->max)) {

            return $order->max+1;
        }

        return 1;
    }

    public function addOrder(int $idcart, UserEntity $user, int $idlocation) {

        $id = $this->generateId();
        $iduser = $user->getId();
        $idorder = $this->maxIdOrder($iduser);

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
            foreach ($carts as $cart) {
                $this->db->query("Call `order`.addOrder(" . $id . "," . $iduser . "," . $idorder . "," . "'$date'" . "," . $cart->getProduct()->getId() . "," . $cart->getVariant()->getId() . "," . $cart->getQuantity() . "," . $idlocation . "," . "'Non preparer'" . "," . 'true' . "," . "'$dateLastUpdate'" . ")");
            }
        }
        // decrementer le stock pour les produits commandés.

        if ($cart->getIdcart() == 0) {
            delete_cookie('cart');
        } else {
            $this->CartModel->deleteCart($cart->getIdcart(),$user->getId());
        }

    }

}