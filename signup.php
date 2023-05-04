<?php

// Start output buffering
 ob_start();

 //  Connect to your database
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "Lisa's";

 $conn = mysqli_connect($servername, $username, $password, $dbname);

 // Check connection
 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 

 // Process form data when form is submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $country = mysqli_real_escape_string($conn, $_POST['country']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $userType = mysqli_real_escape_string($conn, $_POST['userType']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   if($userType == 'admin') {
     // Insert admin user into database
     $sql = "INSERT INTO userSignUp (name, email, password, country, city, address, is_admin)
   VALUES ('$name', '$email', '$password', '$country', '$city', '$address', 1)";
   }
   else {
      // Insert regular user into database
     $sql = "INSERT INTO userSignUp (name, email, password, country, city, address, is_admin)
   VALUES ('$name', '$email', '$password', '$country', '$city', '$address', 0)";
   }
   
   
   if (mysqli_query($conn, $sql)) {
     // echo "New record created successfully";
     header('Location: /login.php');
     exit();
   } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
  }

 mysqli_close($conn); 

 // Flush the output buffer and send the output to the browser
 ob_end_flush(); 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="a.js"></script>
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
                <li class="navbar__item">
                    <a href="/menu.php" class="navbar__links">Menu</a>
                </li>
                <li class="navbar__item">
                    <a href="/about_us.html" class="navbar__links">About Us</a>
                </li>
                <li class="navbar__item">
                    <a href="/locations.html" class="navbar__links">Locations</a>
                </li>
                <li class="navbar__item">
                    <a href="/jobs.html" class="navbar__links">Jobs</a>
                </li>
                <li class="navbar__item">
                    <a href="/contact.html" class="navbar__links">Contact</a>
                </li>
                <li class="navbar__btn">
                    <a href="/login.php" class="button">Order Online</a>
                </li>
            </ul>
        </div>
       </nav>

      

       <!-- SignUp Page -->
 
 
      <div class="signupBigContainer">
      <div class="signup__container">
       <h1>Fill in the form below to create an account</h1>
        <form name="signupForm" method="post" action="signup.php" id="signupForm">
  
          <input type="text" id="name" name="name" placeholder="Name Surname" required>
          <input type="email" id="email" name="email" placeholder="Email" required>
          
          <input type="text" id="countryInput" placeholder="Search country...">
            <select id="countrySignUp" multiple="multiple" name="country" onchange="updateCities()" required>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="Romania">Romania</option>
                <option value="Greece">Greece</option>
            </select>
         
            <label for="city">City:</label>
            <select id="citySignUp" name="city" required>
                <option value="">Select a city</option>
            </select>
            
          
            <label for="userType">Choose a user type:</label>
            <select name="userType" id="userSignUp" required>
              <option value="admin">admin</option>
              <option value="regular">regular</option>
            </select>

          <textarea id="address" name="address" placeholder="Please enter your address" required></textarea>
          <input type="password" name="password" id="password" placeholder="Set a password" required>

          <button type="submit" id="signupFormSend">SignUp</button>

        </form>
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
</body>
</html>