<?php
require_once "DBController.php";

class ViewEvent extends DBController
{
    function getAllProduct($table)
    {
        $query = "SELECT * FROM $table";

        $productResult = $this->getDBResult($query);
        return $productResult;
    }
    function getMemberCartItem($member_id)
    {
        $query = "SELECT tickets.*, tickets.id as cart_id, cos.quantity FROM tickets, cos WHERE tickets.id = cos.ID_TICKET AND cos.ID_USER = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }



    function getEventByID($eventId)
    {
        $query = "SELECT * FROM events WHERE ID=?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $eventId
            )
        );

        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }
    function getCartItemByProduct($product_id, $member_id)
    {
        $query = "SELECT * FROM events WHERE product_id = ? AND
member_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );


 $cartResult = $this->getDBResult($query, $params);
 return $cartResult;
 }
    function addToCart($product_id, $quantity, $member_id)
    {
        $query = "INSERT INTO events (product_id,quantity,member_id)VALUES (?, ?, ?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE events SET quantity = ? WHERE id= ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );


 $this->updateDB($query, $params);
 }
    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM events WHERE id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );

        $this->updateDB($query, $params);
    }
    function emptyCart($member_id)
    {
        $query = "DELETE FROM events WHERE member_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }

}