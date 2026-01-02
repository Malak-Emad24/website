<?php
session_start();
include 'db.php';

// مثال بيانات المستخدم بعد تسجيل الدخول
// $_SESSION['user_name'] = "Malak Enaizi";
// $_SESSION['user_email'] = "malak@example.com";
// $_SESSION['user_phone'] = "912345678";

if(empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

$total = 0;
$deliveryCharge = 5; // مثال رسوم التوصيل
$discount = 0;       // مثال الخصم
$finalTotal = 0;

// حساب المجموع
foreach($_SESSION['cart'] as $id => $qty){
    $result = mysqli_query($conn, "SELECT * FROM dishes WHERE id=$id");
    $product = mysqli_fetch_assoc($result);
    $total += $product['price'] * $qty;
}
$finalTotal = $total - $discount + $deliveryCharge;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
</head>
<body>
<a href="javascript:history.back()" class="back-btn">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c79a5b"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>
</a>


<h2 class="section-title">Checkout</h2>

<div class="checkout-container">
    <!-- Billing Details -->
    <div class="billing">
        <h3 >Billing Details</h3>
        
        <input type="text" name="name"  placeholder="Full Name" required
               value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>">
        <input type="email" name="email" placeholder="Email" required
               value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>">
        <input type="text" name="phone" placeholder="Phone Number"
               value="<?php echo isset($_SESSION['user_phone']) ? $_SESSION['user_phone'] : ''; ?>">

        <select id="street-select">
            <option value="">Select Street Name</option>
            <option value="Main Street">AL FUWAYHAT</option>
            <option value="Market Street">AL KISH</option>
            <option value="Libya Avenue">AL SULMANI</option>
            <option value="Freedom Road">TABALINO</option>
            <option value="Freedom Road">BELOUN</option>
        </select>

        <textarea placeholder="Optional Description of Location"></textarea>

        <h3 >Payment Method</h3>
        <select id="payment-method">
            <option value="cash">Cash</option>
            <option value="Edfaly">Edfaly</option>
            <option value="Sadad">Sadad</option>
            <option value="Bank-Card">Bank Card</option>
            <option value="Mobi-Cash">Mobi Cash</option>
            <option value="Tadawul">Tadawul</option>
        </select>

        <button id="confirm-order">Confirm Order</button>
    </div>

    <!-- Order Summary -->
    <div class="summary">
        <h3 >Order Summary</h3>
        <ul>
            <?php foreach($_SESSION['cart'] as $id => $qty):
                $result = mysqli_query($conn, "SELECT * FROM dishes WHERE id=$id");
                $product = mysqli_fetch_assoc($result);
            ?>
            <li><?php echo $product['name']; ?> x <?php echo $qty; ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="invoice">
            <div><span>Subtotal:</span> <span>$<?php echo $total; ?></span></div>
            <div><span>Discount:</span> <span>$<?php echo $discount; ?></span></div>
            <div><span>Delivery:</span> <span>$<?php echo $deliveryCharge; ?></span></div>
            <div><strong>Total:</strong> <strong>$<?php echo $finalTotal; ?></strong></div>
        </div>
    </div>
</div>

<!-- Modal لتأكيد الطلب -->
<div class="modal-bg" id="modal-bg">
    <div class="modal" id="modal">
        <p>Are you sure you want to confirm your order?</p>
        <button id="yes-btn">Yes</button>
        <button id="no-btn">No</button>
    </div>
</div>

<!-- Modal رسالة شكر -->
<div class="modal-bg" id="thanks-bg">
    <div class="modal">
        <p>Thank you for choosing us! Your order is preparing now.</p>
        <button id="thanks-ok">OK</button>
    </div>
</div>

<script src="checkout.js"></script>
</body>
</html>

