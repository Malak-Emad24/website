<?php
session_start();
include("db.php");

if (!isset($_SESSION['email'])) {
    header("Location: index2.php");
    exit();
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Homepage</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, sans-serif;
}

html{
  scroll-behavior:smooth;
}

body{
  background: url('images/background.jpg') #000;
  background-size: cover;
  background-attachment: fixed;
  color:white;
}

/* ================= NAVBAR ================= */
.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:15px 40px;
  background:rgba(19, 15, 8, 0.71);
  border-bottom: 2px solid #D7CBBE;
}

.logo img{
  height:80px;
}

.menu-toggle{
  font-size:28px;
  cursor:pointer;
  display:none;
  color: #D7CBBE;
}

.nav-links{
  display:flex;
  gap:25px;
}

.nav-links a{
  color:#D7CBBE;
  text-decoration:none;
  font-weight:bold;
  padding:8px 15px;
  transition:all 0.3s ease;
  border-radius: 5px;
}

.nav-links a:hover{
  background:#645A4E;
  color:#130F08;
}

.logout{
  color:#D7CBBE;
  background:#3D271A;
  padding: 8px 15px;
  border-radius: 5px;
}

.logout:hover{
  background:#645A4E;
}

/* ================= HERO ================= */
.hero{
  min-height:90vh;
  display:flex;
  background: linear-gradient(rgba(19, 15, 8, 0.7), rgba(61, 39, 26, 0.8)), 
              url('images/background.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}

.hero-image{
  flex:1;
  overflow:hidden;
}

.hero-image img{
  width:100%;
  height:100%;
  object-fit:cover;
  opacity:0.3;
  filter: brightness(0.7) sepia(0.2);
}

.hero-content{
  flex:1;
  padding:80px 60px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  background: rgba(19, 15, 8, 0.5);
}

.hero-content h1{
  font-size:52px;
  color:#D7CBBE;
  margin-bottom:20px;
}

.hero-content p{
  font-size:18px;
  margin-bottom:30px;
  color:#D7CBBE;
}

.hero-buttons{
  display:flex;
  gap:15px;
  flex-wrap:wrap;
}

.btn{
  padding:14px 30px;
  border-radius:8px;
  text-decoration:none;
  font-weight:bold;
  transition:background 0.3s;
}

.btn:hover{
  opacity:0.9;
}

.primary{
  background:#645A4E;
  color:#fff;
}

.primary:hover{
  background:#D7CBBE;
  color:#130F08;
}

.secondary{
  border:2px solid #D7CBBE;
  color:#D7CBBE;
  background:transparent;
}

.secondary:hover{
  background:#D7CBBE;
  color:#130F08;
}

/* ================= SECTIONS ================= */
.section{
  padding:70px 30px;
  text-align:center;
}

.section h2{
  font-size:36px;
  margin-bottom:20px;
  color:#645A4E;
}

.section p{
  color:#D7CBBE;
}

/* ===== ABOUT ===== */
.about{
  background: url('images/background.jpg') #130F08;
  background-size: cover;
  background-attachment: fixed;
}

.about-content{
  display:flex;
  align-items:center;
  gap:40px;
  max-width:1200px;
  margin:0 auto;
  flex-wrap:wrap;
}

.about-image{
  flex:1;
  min-width:300px;
}

.about-image img{
  width:100%;
  border-radius:10px;
  border:3px solid #D7CBBE;
}

.about-info{
  flex:1;
  min-width:300px;
}

.about-text{
  max-width:none;
  margin:0 0 25px 0;
  font-size:18px;
  line-height:1.8;
  color:#D7CBBE;
  text-align:left;
}

.about-features{
  display:flex;
  justify-content:center;
  gap:25px;
  flex-wrap:wrap;
}

.about-features div{
  border:1px solid #645A4E;
  padding:18px 28px;
  border-radius:30px;
  font-weight:bold;
  color:#645A4E;
  background:transparent;
  transition:background 0.3s ease, color 0.3s ease;
}

.about-features div:hover{
  background:#645A4E;
  color:#130F08;
}

/* ===== SERVICES ===== */
.services-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:20px;
  margin-top:40px;
}

.service-card{
  background:#3D271A;
  padding:30px 20px;
  border-radius:15px;
  font-size:18px;
  cursor:pointer;
  transition:
    transform 0.3s ease,
    background 0.3s ease,
    color 0.3s ease;
  text-align:center;
}

.service-card img{
  width:100%;
  height:200px;
  object-fit:cover;
  border-radius:10px;
  margin-bottom:15px;
}

.service-card:hover{
  transform:translateY(-10px);
  background:#645A4E;
  color:#130F08;
}

/* ================= MOBILE ================= */
@media (max-width:768px){
  .menu-toggle{
    display:block;
  }

  .nav-links{
    display:none;
    flex-direction:column;
    position:absolute;
    top:100%;
    right:0;
    background:#000;
    width:100%;
    text-align:center;
  }

  .nav-links a{
    padding:15px;
    border-top:1px solid #222;
  }

  .hero{
    flex-direction:column;
  }

  .hero-content{
    padding:40px 25px;
    text-align:center;
  }

  .services-grid{
    grid-template-columns:1fr;
  }
}
</style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
  <div class="logo">
    <a href="home.php">
      <img src="images/photo_2025-12-23_18-35-36.jpg" alt="Logo">
    </a>
  </div>

  <div class="menu-toggle" id="menu-toggle">&#9776;</div>

  <nav class="nav-links" id="nav-links">
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="#contact">Contact</a>
    <a href="logout.php" class="logout">Logout</a>
  </nav>
</header>

<!-- ================= HERO ================= -->
<section class="hero" id="home">
  <div class="hero-image">
    <img src="images/photo_2025-12-23_18-35-36.jpg" alt="Food">
  </div>

  <div class="hero-content">
    <h1>Hello <?php echo $user['firstName']." ".$user['lastName']; ?> </h1>
    <p>Welcome back! Experience delicious food and unforgettable moments.</p>

    <div class="hero-buttons">
      <a href="reservation.php" class="btn primary">Reservation</a>
      <a href="index.php" class="btn secondary">View Menu</a>
    </div>
  </div>
</section>

<!-- ================= ABOUT ================= -->
<section class="section about" id="about">
  <h2>About Us</h2>
  
  <div class="about-content">
    <div class="about-image">
      <img src="images/restaurant_about.png" alt="Our Restaurant">
    </div>
    
    <div class="about-info">
  <p class="about-text">
    At our restaurant, food is more than just a meal — it’s an experience.
    We focus on quality, fresh ingredients, and authentic flavors, served
    in a warm and welcoming atmosphere.
  </p>

  <div class="about-features">
    <div>Fresh Ingredients</div>
    <div>Authentic Taste</div>
    <div>Cozy Atmosphere</div>
  </div>
    </div>
  </div>
</section>

<!-- ================= SERVICES ================= -->
<section class="section" id="services">
  <h2>Our Services</h2>
  <div class="services-grid">
    <div class="service-card">
      <img src="images/dine_in.png" alt="Dine In">
      <div>🍽️ Dine In</div>
    </div>
    <div class="service-card">
      <img src="images/takeaway.png" alt="Take Away">
      <div>🥡 Take Away</div>
    </div>
    <div class="service-card">
      <img src="images/online_reservation.png" alt="Online Reservation">
      <div>📅 Online Reservation</div>
    </div>
  </div>
</section>

<!-- ================= CONTACT ================= -->
<section class="section" id="contact">
  <h2>Contact Us</h2>
  <p>Email: info@restaurant.com</p>
  <p>Phone: +218 91 000 0000</p>
</section>

<footer style="padding:20px; text-align:center; color:#D7CBBE;">
  Developed by Rodina Salih Elbargathy and Malak Emad Alenaizi
</footer>

<!-- ================= JS ================= -->
<script>
// Mobile menu toggle
const toggle = document.getElementById("menu-toggle");
const navLinks = document.getElementById("nav-links");

toggle.addEventListener("click", () => {
  if (navLinks.style.display === "flex") {
    navLinks.style.display = "none";
  } else {
    navbar.classList.remove("scrolled");
  }
});

// Smooth scroll for navigation links
document.querySelectorAll('.nav-links a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
  }
});
</script>

</body>
</html>
