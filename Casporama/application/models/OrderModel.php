<?php

// * On importe les classes nécessaires

require_once APPPATH . 'models/entity/OrderEntity.php';

/*

    * Class OrderModel

    * Cette classe permet de visualiser les commandes

*/
class OrderModel extends CI_Model {

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

}