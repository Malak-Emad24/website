<?php
session_start();
include 'db.php';

$successMessage = '';
$errorMessage = '';

if(isset($_POST['makeReservation'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $guests = (int)$_POST['guests'];
    $specialRequests = $conn->real_escape_string($_POST['special_requests']);
    
    // Create table if not exists
    $createTable = "CREATE TABLE IF NOT EXISTS reservation (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        reservation_date DATE NOT NULL,
        reservation_time TIME NOT NULL,
        guests INT NOT NULL,
        special_requests TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending'
    )";
    $conn->query($createTable);
    
    // Insert reservation
    $insertQuery = "INSERT INTO reservation (name, email, phone, reservation_date, reservation_time, guests, special_requests) 
                    VALUES ('$name', '$email', '$phone', '$date', '$time', $guests, '$specialRequests')";
    
    if($conn->query($insertQuery) === TRUE){
        $successMessage = "Reservation successfully made! We'll contact you shortly.";
    } else {
        $errorMessage = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-image: url("images/background.jpg");
        }

        .reservation-container {
            background: rgba(30, 30, 30, 0);
            border: 2px solid #D7CBBE;
            max-width: 1000px;
            width: 100%;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .back-btn {
            display: inline-block;
            color: #D7CBBE;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            color: #645A4E;
        }

        h1 {
            color: #D7CBBE;
            font-size: 28px;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            color: #D7CBBE;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .input-wrapper {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid #D7CBBE;
            border-radius: 7px;
            padding: 12px;
            display: flex;
            align-items: center;
        }

        .input-wrapper:focus-within {
            border-color: #645A4E;
        }

        .input-wrapper i {
            color: #D7CBBE;
            margin-right: 10px;
        }

        input, select, textarea {
            background: none;
            border: none;
            outline: none;
            color: #fff;
            width: 100%;
            font-size: 14px;
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        textarea {
            resize: vertical;
            min-height: 70px;
            font-family: Arial, sans-serif;
        }

        select {
            cursor: pointer;
        }

        select option {
            background: #1a1a1a;
            color: #fff;
        }

        .btn {
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background: #645A4E;
            color: #fff;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #D7CBBE;
            color: #130F08;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.5);
            color: #4caf50;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.2);
            border: 1px solid rgba(244, 67, 54, 0.5);
            color: #f44336;
        }

        @media (max-width: 400px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .reservation-container {
                padding: 80px 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="reservation-container">
        <a href="homepage.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        <h1><i class="fas fa-utensils"></i> Make a Reservation</h1>
        <p class="subtitle">Reserve your table and enjoy an unforgettable dining experience</p>

        <?php if($successMessage): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if($errorMessage): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" placeholder="John Doe" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="john@example.com" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone" placeholder="+1 234 567 8900" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="guests"><i class="fas fa-users"></i> Number of Guests</label>
                    <div class="input-wrapper">
                        <i class="fas fa-users"></i>
                        <select id="guests" name="guests" required>
                            <option value="">Select</option>
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                            <option value="6">6 Guests</option>
                            <option value="7">7 Guests</option>
                            <option value="8">8+ Guests</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date"><i class="fas fa-calendar"></i> Date</label>
                    <div class="input-wrapper">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="time"><i class="fas fa-clock"></i> Time</label>
                    <div class="input-wrapper">
                        <i class="fas fa-clock"></i>
                        <select id="time" name="time" required>
                            <option value="">Select Time</option>
                            <option value="11:00:00">11:00 AM</option>
                            <option value="11:30:00">11:30 AM</option>
                            <option value="12:00:00">12:00 PM</option>
                            <option value="12:30:00">12:30 PM</option>
                            <option value="13:00:00">1:00 PM</option>
                            <option value="13:30:00">1:30 PM</option>
                            <option value="14:00:00">2:00 PM</option>
                            <option value="17:00:00">5:00 PM</option>
                            <option value="17:30:00">5:30 PM</option>
                            <option value="18:00:00">6:00 PM</option>
                            <option value="18:30:00">6:30 PM</option>
                            <option value="19:00:00">7:00 PM</option>
                            <option value="19:30:00">7:30 PM</option>
                            <option value="20:00:00">8:00 PM</option>
                            <option value="20:30:00">8:30 PM</option>
                            <option value="21:00:00">9:00 PM</option>
                            <option value="21:30:00">9:30 PM</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="special_requests"><i class="fas fa-comment"></i> Special Requests (Optional)</label>
                <div class="input-wrapper">
                    <i class="fas fa-comment"></i>
                    <textarea id="special_requests" name="special_requests" placeholder="Allergies, dietary restrictions, special occasions, etc."></textarea>
                </div>
            </div>

            <button type="submit" name="makeReservation" class="btn">
                <i class="fas fa-check"></i> Confirm Reservation
            </button>
        </form>
    </div>
</body>
</html>
 