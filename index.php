<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cookie&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<!-- CATEGORY BAR -->
<ul class="categories">
    <li class="active" data-category="all">All</li>
    <li data-category="breakfast">Breakfast</li>
    <li data-category="brunch">Brunch</li>
    <li data-category="lunch">Lunch</li>
    <li data-category="dinner">Dinner</li>
    <li data-category="dessert">Dessert</li>
    <li data-category="beverages">Beverages</li>
    
    
</ul>
<div class="menu-wrapper">


<div class="images-row">
  <img src="images\chef-left.jpg">
  <div class="center-box">
    <h2 class=chef-head>Global Chefs Unforgettable Flavors</h2>
    <p class=chef-intro>Our menu is crafted by renowned chefs from around the globe, each bringing their unique culinary heritage and expertise. Experience a symphony of flavors, from classic favorites to bold, innovative creations, all prepared with passion and excellence.</p>
  </div>
  <img src="images\chef-right.jpg">
</div>





<h2 class="section-title">Our International Selection</h2>

<a href="cart.php" class="cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg> <span id="cart-count">0</span>
</a>

<!-- MENU GRID -->
<div class="menu">
<?php
$result = mysqli_query($conn, "SELECT * FROM dishes");
while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="card" data-category="<?php echo $row['category']; ?>">
        <img src="images/<?php echo $row['image']; ?>">
        
        <h4><?php echo $row['name']; ?></h4>
        <p class="description"><?php echo $row['description']; ?></p>
        <span>$<?php echo $row['price']; ?></span>

        <button class="add-to-cart" data-id="<?php echo $row['id']; ?>">
        Add to Cart
        </button>

    </div>
<?php } ?>
</div>
</div>


<script src="script.js"></script>
</body>
</html>
