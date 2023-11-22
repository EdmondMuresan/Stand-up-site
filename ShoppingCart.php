<?php
require_once "DBController.php";

class ShoppingCart extends DBController
{
    function getAllProduct()
    {
        $query = "SELECT * FROM bilete";

        $productResult = $this->getDBResult($query);
        return $productResult;

    }
    function getMemberCartItem($member_id)
    {
        $query = "SELECT bilete.*, cos.id, cos.cantitate FROM bilete, cos WHERE bilete.id = cos.produs_id AND cos.clientID = ?";
        $params = array(
            array(
                "param_type"=>"i",
                "param_value"=>$member_id
            )
            );
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
    }

    function getProductByCode($product_code)
    {
        $query = "SELECT * FROM bilete WHERE id=?";

        $params = array(
            array(
            "param_type" => "s",
            "param_value" => $product_code
            )
            );
            $productResult = $this->getDBResult($query, $params);
            return $productResult;
    }
    function getCartItemByProduct($produs_id, $member_id)
    {
        $query = "SELECT * FROM cos WHERE produs_id = ? AND clientID = ?";

        $params = array(
            array(
            "param_type" => "i",
            "param_value" => $produs_id
            ),
            array(
            "param_type" => "i",
            "param_value" => $member_id
            )
            );
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
    }
    function addToCart($produs_id, $cantitate, $member_id)
    {
        $query = "INSERT INTO cos (produs_id,cantitate,clientID) VALUES (?, ?, ?)";
        $params = array(
            array(
            "param_type" => "i",
            "param_value" => $produs_id
            ),
            array(
            "param_type" => "i",
            "param_value" => $cantitate
            ),
            array(
            "param_type" => "i",
            "param_value" => $member_id
            )
            );
            $this->updateDB($query, $params);

    }
    function updateCartQuantity($cantitate, $id)
    {
        $query = "UPDATE cos SET cantitate = ? WHERE id= ?";
        $params = array(
            array(
            "param_type" => "i",
            "param_value" => $cantitate
            ),
            array(
            "param_type" => "i",
            "param_value" => $id
            )
            );
            $this->updateDB($query, $params);
    }
    function deleteCartItem($id)
    {
        $query = "DELETE FROM cos WHERE id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        $this->updateDB($query, $params);

    }
    function emptyCart($member_id)
    {
        $query = "DELETE FROM cos WHERE clientID = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }



}
?>