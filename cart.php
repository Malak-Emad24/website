<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
</head>
<body>
<a href="javascript:history.back()" class="back-btn">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c79a5b"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>
</a>


<h2 class="cart-title">Shopping Cart</h2>

<div class="cart">
<?php
$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {

        $result = mysqli_query($conn, "SELECT * FROM dishes WHERE id=$id");
        $product = mysqli_fetch_assoc($result);

        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
?>
    <div class="cart-item">
        <img src="images/<?php echo $product['image']; ?>">
        <div>
            <h4 class=cart_product_name><?php echo $product['name']; ?></h4>
            <p>Price: $<?php echo $product['price']; ?></p>
            
            <!-- تعديل الكمية + / - -->
            <p>Qty: 
                <button class="qty-btn" type="button" data-id="<?php echo $id; ?>" data-action="decrease">-</button>
                <span id="qty-<?php echo $id; ?>"><?php echo $qty; ?></span>
                <button class="qty-btn" type="button" data-id="<?php echo $id; ?>" data-action="increase">+</button>
            </p>
            
            <p>Subtotal: $<span id="subtotal-<?php echo $id; ?>"><?php echo $subtotal; ?></span></p>
            <a href="remove.php?id=<?php echo $id; ?>" class="remove" >Remove</a>
        </div>
    </div>
<?php
    }
} else {
    echo "<p>Your cart is empty</p>";
}
?>
</div>

<h3 class="total">Total: $<span id="total"><?php echo $total; ?></span></h3>

<a href="checkout.php">
    <button class="checkout-btn">Checkout</button>
</a>

<script src="script.js"></script>
</body>
</html>
