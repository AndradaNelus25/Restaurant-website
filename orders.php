<?php
    // Retrieve the form data
    $customer_name = $_POST["customer_name"];
    // $order_details = implode(", ", $_POST["order_details"]);

    $order_details = "";
    if (isset($_POST["order_details"]) && !empty($_POST["order_details"])) {
      $order_details = implode(", ", $_POST["order_details"]);
    }
    
    // Connect to the database and insert the order
    $db = mysqli_connect("localhost", "root", "", "Lisa's");
    $query = "INSERT INTO orders (customer_name, order_details, order_total, payment_status) VALUES ('$customer_name', '$order_details', 0, 'unpaid')";
    mysqli_query($db, $query);
    mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisa's Restaurants</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/5d1efda6c2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
</head>
<body> 
    <!-- Navbar Section -->
    <nav class="navbar">
        <div class="navbar__container">
            <a href="/" id="navbar__logo">
                <img src="images/logo.png" alt="logo" id="logo">LISA'S</a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
              <!-- <li class="navbar__item">
                  <a href="/menu.php" class="navbar__links">Menu</a>
              </li> -->
              <li class="navbar__btn">
                  <a href="/logout.php" class="button">Logout</a>
              </li>
          </ul>
        </div>
     </nav>


        <div class="ordersBigcontainer">
            <div class="orders__container">
                <form action="orders.php" method="post" id="ordersForm">
                        <h1>Please fill in the order details : </h1>
                       
                        <input type="text" id="customer_name" name="customer_name" placeholder="Enter your name : " required><br><br>
                        
                        <label for="order_details">Order Details:</label><br>
                        <?php
                            // Connect to the database and retrieve the menu items
                            $db = mysqli_connect("localhost", "root", "", "Lisa's");
                            $result = mysqli_query($db, "SELECT * FROM dishes");
                            
                            // Display the menu items as checkboxes
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<input type="checkbox" id="order_details" name="order_details[]" value="'.$row["id"].'" > '.$row["name"].' - '.$row["price"].'<br>';
                            }
                            mysqli_close($db);
                        ?>
                        <br>
                        
                        <input type="submit" value="Place Order" id="ordersFormSend">
                    </form>
                    <?php
                        // Check if the form has been submitted and display a confirmation message
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            echo "Thank you for your order!";
                        }
                    ?>
            </div>
        </div>



<!-- Footer Section -->
       
<div class="footer__container">
        <div class="footer__links">
          <div class="footer__link--wrapper">
            <div class="footer__link--items">
              <h2>About Us</h2>
              <a href="/contact.html">Contact us</a> 
              <a href="/">GDPR</a>
              <a href="/">Terms & Conditions</a> 
              <a href="/jobs.html">Join us</a>
            </div>
            <div class="footer__link--items">
              <h2>We recommend</h2>
              <a href="https://olivocaffe.com/">Olivo Cafe</a> 
              <a href="https://olivocoffeeroasters.com/">Olivo</a>
              <a href="https://narcoffee.com/">Narcoffee</a> 
              <a href="https://theopenbar.ro/">Theopenbar</a>
            </div>
          </div>
          <div class="footer__link--wrapper">
            <div class="footer__link--items">
              <h2>Who are we?</h2>
              <p>A special place to spend your mornings, afternoons or nights</p>
            </div>
          </div>
        </div>
        <hr class="hr__main">
        <section class="social__media">
          <div class="social__media--wrap">
            <div class="footer__logo">
              <a href="/" id="footer__logo"><img src="images/logo.png" alt="logo" id="logo__footer">LISA'S</a>
            </div>
            <p class="website__rights">© LISA'S 2023. All rights reserved</p>
            <div class="social__icons">
              <a
                class="social__icon--link"
                href="/"
                target="_blank"
                aria-label="Facebook"
              >
                <i class="fab fa-facebook"></i>
              </a>
              <a
                class="social__icon--link"
                href="/"
                target="_blank"
                aria-label="Instagram"
              >
                <i class="fab fa-instagram"></i>
              </a>
              <a
                class="social__icon--link"
                href="/"
                target="_blank"
                aria-label="Youtube"
              >
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
        </section>
      </div>
      <script src="app.js"></script>
</body>
</html>