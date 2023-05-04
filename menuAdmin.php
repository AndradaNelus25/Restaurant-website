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

    // Handle CRUD operations
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Add a new menu item
        if (isset($_POST['AddDishSubmit'])) {
            $name = $_POST['nameDishA'];
            $description = $_POST['descriptionDishA'];
            $price = $_POST['priceA'];
            $category = $_POST['categoryDishA'];
            $query = "INSERT INTO dishes (name, description, price, category) VALUES ('$name', '$description', '$price', '$category')";
            mysqli_query($connection, $query);
        }
        // Update an existing menu item
        else if (isset($_POST['updateDishSubmit'])) {
            $id = $_POST['idU'];
            $oldname = $_POST['oldDishNAmeU'];
            $name = $_POST['nameDishU'];
            $description = $_POST['descriptionDishU'];
            $price = $_POST['priceU'];
            $category = $_POST['categoryU'];
            $query = "UPDATE dishes SET name='$name', description='$description', price='$price', category='$category' WHERE id=$id";
            mysqli_query($connection, $query);
        }
        // Delete a menu item
        else if (isset($_POST['deleteDishSubmit'])) {
            $id = $_POST['idD'];
            $query = "DELETE FROM dishes WHERE id=$id";
            mysqli_query($connection, $query);
        }
    }

    // Retrieve data from the table
    $query = "SELECT * FROM dishes";
    $result = mysqli_query($connection, $query);

    $menuData = array();
    // Check if any records were returned
		if (mysqli_num_rows($result) > 0) {
			// Display the results in a table
			// echo "<table id='menu-table'>";
			// echo "<tr><th>Dish</th><th>Description</th><th>Price</th><th>Category</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
        $menuData[] = $row;
				// echo "<tr><td>" . $row["name"] . "</td><td>" . $row["description"] . "</td><td>$" . $row["price"] . "</td><td>" . $row["category"] . "</td></tr>";
			}
			// echo "</table>";
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
            <li class="navbar__btn">
                  <a href="/logout.php" class="button">Logout</a>
              </li>
          </ul>
        </div>
       </nav>


    <h1 id="menuAdminH">Menu Management</h1>

    <!-- Add new menu item form -->

    <div class="menuManagement__container">
      <div class="addDish__container">
    <h2>Add New Item</h2>
    <form method="post" action="menuAdmin.php" id="addDishForm">

        <input type="text" name="nameDishA" id="nameDishA" placeholder="Name" required><br>

        <label for="descriptionDishA">Description:</label>
        <textarea name="descriptionDishA" id="descriptionDishA" required></textarea><br>

        <label for="priceA">Price:</label>

        <input type="number" name="priceA" id="priceA" required><br>

        <label for="categoryDishA">Category:</label>
        <select id="categoryDishA" name="categoryDishA" required>
				<option value="">Select Category</option>
				<option value="appetizer">Appetizer</option>
				<option value="entree">Entree</option>
				<option value="dessert">Dessert</option>
				<option value="drink">Drink</option>
		</select>
		<button type="submit" name="AddDishSubmit" id="AddDishSubmit">Add Dish</button>
	</form>
  </div>

  <div class="updateDish__container">
		<!-- Update Operation -->
		<h3>Update a Dish</h3>
		<form method="POST" action="menuAdmin.php" id="updateDishForm">
			<label for="idU">ID:</label>
			<input type="number" id="idU" name="idU" min="1" required><br>
            <!-- <input type="text" id="oldDishNAmeU" name="oldDishNAmeU" placeholder="Name of dish you want to update" required><br> -->
			
			<input type="text" id="nameDishU" name="nameDishU" placeholder="Updated Name" required><br>
			
			<label for="descriptionDishU">Description:</label>
            <textarea name="descriptionDishU" id="descriptionDishU" required></textarea><br>

			<label for="priceU">Updated price:</label>
			<input type="number" id="priceU" name="priceU" step="0.01" min="0" required><br>

			<label for="categoryU">Updated Category:</label>
			<select id="categoryU" name="categoryU" required>
				<option value="">Select Category</option>
				<option value="appetizer">Appetizer</option>
				<option value="entree">Entree</option>
				<option value="dessert">Dessert</option>
				<option value="drink">Drink</option>
			</select>
			<button type="submit" name="updateDishSubmit" id="updateDishSubmit">Update Dish</button>
		</form>
    </div>

    <div class="deleteDish__container">
		<!-- Delete Operation -->
		<h3>Delete a Dish</h3>
		<form action="menuAdmin.php" method="POST" id="deleteDishForm">
			<label for="idD">ID:</label>
			<input type="number" id="idD" name="idD" min="1" required>
			<button type="submit" name="deleteDishSubmit" id="deleteDishSubmit">Delete Dish</button>
		</form>
    </div>

	</div>
</div>


<table id="menu-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dish</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($menuData as $row): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td>$<?php echo $row["price"]; ?></td>
                <td><?php echo $row["category"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="app.js"></script> 
      
</body>
</html>
