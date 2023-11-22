<?php
require_once "ShoppingCart.php";

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
header('Location: index.html');
exit;
$member_id=$_SESSION['loggedin']
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
 switch ($_GET["action"]) {
 case "add":
19
 if (! empty($_POST["quantity"])) {
 
 $productResult = $shoppingCart-
>getProductByCode($_GET["code"]);
 
 $cartResult = $shoppingCart-
>getCartItemByProduct($productResult[0]["id"], $member_id);
 
 if (! empty($cartResult)) {
 // Modificare cantitate in cos
 $newQuantity = $cartResult[0]["quantity"] + 
$_POST["quantity"];
 $shoppingCart->updateCartQuantity($newQuantity, 
$cartResult[0]["id"]);
 } else {
 // Adaugare in tabelul cos
 $shoppingCart->addToCart($productResult[0]["id"], 
$_POST["quantity"], $member_id);
 }
 }
 break;
 case "remove":
 // Sterg o sg inregistrare
 $shoppingCart->deleteCartItem($_GET["id"]);
 break;
 case "empty":
 // Sterg cosul
 $shoppingCart->emptyCart($member_id);
 break;
 }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HaHaTickets</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div id="Menubar">
        <ul id="horizontalList">
            <li><a href="Acasa.php">Acasă</a></li>
            <li><a href="agenda.php">Agendă</a></li>
            <li><a href="evenimente.php">Evenimente</a></li>
            <li><a href="artisti.php">Artiști</a></li>
            <li><a href="bilete.php">Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a>
            <li><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a><li> 
        </ul>
    </div>
    <h1>Bine ai venit  <?=$_SESSION['name']?> !</h1>  
    <div id="shopping-cart">
 <div class="txt-heading">
20
 <div class="txt-heading-label">Cos Cumparaturi</div> <a 
id="btnEmpty" href="cos.php?action=empty"><img src="empty-cart.png" 
alt="empty-cart" title="Empty Cart" /></a>
 </div>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
if (! empty($cartItem)) {
 $item_total = 0;
 ?>
<table cellpadding="10" cellspacing="1">
 <tbody>
 <tr>
 <th style="text-align: left;"><strong>Name</strong></th>
 <th style="text-align: left;"><strong>Code</strong></th>
 <th style="text-align: 
right;"><strong>Quantity</strong></th>
 <th style="text-align: 
right;"><strong>Price</strong></th>
 <th style="text-align: 
center;"><strong>Action</strong></th>
 </tr>
<?php
 foreach ($cartItem as $item) {
 ?>
<tr>
 <td
 style="text-align: left; border-bottom: #F0F0F0 1px 
solid;"><strong><?php echo $item["name"]; ?></strong></td>
 <td
 style="text-align: left; border-bottom: #F0F0F0 1px 
solid;"><?php echo $item["code"]; ?></td>
 <td
 style="text-align: right; border-bottom: #F0F0F0 1px 
solid;"><?php echo $item["quantity"]; ?></td>
 <td
 style="text-align: right; border-bottom: #F0F0F0 1px 
solid;"><?php echo "$".$item["price"]; ?></td>
 <td
 style="text-align: center; border-bottom: #F0F0F0 1px 
solid;"><a
 href="cos.php?action=remove&id=<?php echo 
$item["cart_id"]; ?>"
21
 class="btnRemoveAction"><img src="icon-delete.png" 
alt="icon-delete" title="Remove Item" /></a></td>
 </tr>
<?php
 $item_total += ($item["price"] * $item["quantity"]);
 }
 ?>
<tr>
 <td colspan="3" 
align=right><strong>Total:</strong></td>
 <td align=right><?php echo "$".$item_total; ?></td>
 <td></td>
 </tr>
 </tbody>
 </table>
 <?php
}
?>
</div>
<div><a href="magazin.php">Alegeti alt produs</a></div>
<div><a href="logout.php">Abandonati sesiunea de 
cumparare</a></div>
<?php //require_once "product-list.php"; ?>
 
</BODY>
</HTML>