<?php
		// Connect to the database
		$host = "localhost";
		$user = "root";
		$password = "";
		$dbname = "Lisa's";

		$connection = mysqli_connect($host, $user, $password, $dbname);

		// Check connection
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Retrieve data from the table
		$query = "SELECT * FROM dishes";
		$result = mysqli_query($connection, $query);

    $menuData = array();
    // Check if any records were returned
		if (mysqli_num_rows($result) > 0) {
			// Display the results in a table
			
			while ($row = mysqli_fetch_assoc($result)) {
        $menuData[] = $row;
			}
			
		} else {
			// No records found
			echo "No dishes found.";
		}

		// Close the database connection
		mysqli_close($connection);
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

       <!-- Menu Table -->

       <div class="menu__container">
        <label for="searchMenu">Search for dish</label>
        <input type="text" id="searchMenu" name="searchMenu">
        <table id="menu-table">
              <thead>
                  <tr>
                      <th>Dish <span class="sort-icon"></span></th>
                      <th>Description <span class="sort-icon"></span></th>
                      <th>Price <span class="sort-icon"></span></th>
                      <th>Category <span class="sort-icon"></span></th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($menuData as $row): ?>
                      <tr>
                          <td><?php echo $row["name"]; ?></td>
                          <td><?php echo $row["description"]; ?></td>
                          <td>$<?php echo $row["price"]; ?></td>
                          <td><?php echo $row["category"]; ?></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
        </table>
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