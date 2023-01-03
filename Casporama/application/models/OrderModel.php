<?php

require_once APPPATH . 'models/entity/ProductEntity.php';
require_once APPPATH .'models/entity/OrderEntity.php';
class OrderModel extends CI_Model
{


    public function findOrderById($id): OrderEntity
    {

        $queryOrder = $this->db->query("Call Orders.getOrderById(" . $id . ")");
        $queryOrder->next_result();

        $order = new OrderEntity() ;
        $newrow = $queryOrder->row();
        if ($newrow != null ) {

            $order->setIdorder($newrow->idorder);
            $order->setDateorder($newrow->dateorder);
            $order->setIdproducts($newrow->idproduct);
            $order->setQuantity($newrow->quantity);
            $order->setIduser($newrow->iduser);
            $order->setIdlocation($newrow->idlocation);
            $order->setState($newrow->state);

        }
        $queryOrder->free_result();
        return $order;

    }
}