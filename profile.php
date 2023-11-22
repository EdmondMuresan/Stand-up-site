<?php
require_once "ShoppingCart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$member_id = $_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["cantitate"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (!empty($cartResult)) {
                    $newQuantity = $cartResult[0]["cantitate"] + $_POST["cantitate"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["cantitate"], $member_id);
                }
            }
            break;

        case "remove":
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;

        case "empty":
            $shoppingCart->emptyCart($member_id);
            break;
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
            <div class="txt-heading-label">Cos Cumparaturi</div>
            <a id="btnEmpty" href="profile.php?action=empty">
                <img src="empty-cart.png" alt="empty-cart" title="Empty Cart" />
            </a>
        </div>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
if (!empty($cartItem)) {
    $item_total = 0;
?>
    <table cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align: left;"><strong>Nume</strong></th>
                <th style="text-align: left;"><strong>Cod</strong></th>
                <th style="text-align: right;"><strong>Cantitate</strong></th>
                <th style="text-align: right;"><strong>Pret</strong></th>
                <th style="text-align: center;"><strong>Action</strong></th>
            </tr>
            <?php foreach ($cartItem as $item) { ?>
                <tr>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["titlu"]; ?></strong></td>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["id"]; ?></td>
                    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cantitate"]; ?></td>
                    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "$" . $item["pret"]; ?></td>
                    <td style="text-align: center; border-bottom: #F0F0F0 1px solid;">
                        <a href="profile.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="btnRemoveAction">
                            <img src="icon_delete.png" alt="icon-delete" title="Remove Item" />
                        </a>
                    </td>
                </tr>
                <?php
                $item_total += ($item["pret"] * $item["cantitate"]);
            } ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td align="right"><?php echo "$" . $item_total; ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php } ?>

</div>
    <div><a href="bilete.php">Alegeti alt produs</a></div>
    <div><a href="logout.php">Abandonati sesiunea de cumparare</a></div>

 
</BODY>
</HTML>