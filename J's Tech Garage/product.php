<?php
require_once "database.php";
session_start(); // Check if there is a user session
if (!isset($_SESSION["user"])) {
    // Redirect to the login page if no user session
    header("Location: account-login.php");
    exit(); // Ensure script stops execution after redirection
}
$userid = $_SESSION["user"]; 

// Modify the SQL query to fetch data from producttable
$sql = "SELECT productname, productdesc, producttype, productimage, productprice FROM producttable";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch all rows from the result set
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    die("Error retrieving product data: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="productstyle.css">
</head>
<body>
    

    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="images/biglogonobg.png" width="125px"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><img src="images/icons/user.png" onclick="toggleMenu()"></li>
                 <div class="sub-menu-container" id="subMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                            <img src="Upload/<?php echo $user['filename']; ?>">
                            <div class="fname-container">
                            <?php echo isset($user["fname"]) ? $user["fname"] : ''; ?>
                            </div>
                            <div class="lname-container">
                            <?php echo isset($user["lname"]) ? $user["lname"] : ''; ?>
                            </div>
                            </div>
                            
                            <hr>

                            <a href="profile.php" class="sub-menu-link">
                                <img src="images/icons/user.png">
                                <p>Update Profile</p>
                                <span>></span>
                            </a><a href="logout.php" class="sub-menu-link">
                                <img src="images/icons/logout.png">
                                <p>Logout</p>
                                <span>></span>
                            </a>

                        </div>
                    </div>
                    <li> <a href="cart.php"><img src="images/icons/shopping-cart.png" class="cart"></a></li>
                </ul>
            </nav>
        </div>

        <div class="search-container">
        <input type="text" id="searchInput" placeholder="What are you looking for?" autofocus>
        <a href="#" class="search-img" onclick="filterProducts()"><img src="images/icons/search.png"></a>
    </div>
    
    <div class="filter-container">
        <select class="filter-dd" name="filter-type" id="filterType">
            <option value="" disabled selected>Filter by Type</option>
            <option value="brake-pad">Brake Pad</option>
            <option value="rear-shock">Rear Shock</option>
            <option value="motor-oil">Motor Oil</option>
            <option value="tire-sealant">Tire Sealant</option>
            <option value="all">All Type</option>
        </select>
        
        <select class="sort-dd" name="sort-price" id="sortPrice">
            <option value="" disabled selected>Sort by Price</option>
            <option value="lowest-highest">Lowest-Highest</option>
            <option value="highest-lowest">Highest-Lowest</option>
            <option value="any">Any Price</option>
        </select>
    </div>

    <div class="product-container" id="productContainer">
        <!-- Products will be dynamically added here using JavaScript -->
    </div>

        <div class="product-container">
        <?php
        // Loop through each product and display the relevant information
        foreach ($products as $product) {
            echo '<div class="img-container">';
            echo '<img src="images/products/' . $product['productimage'] . '">';
            echo '<div class="product-name">' . $product['productname'] . '</div>';
            echo '<div class="product-desc">' . $product['productdesc'] . '</div>';
            echo '<div class="product-price">₱' . $product['productprice'] . '</div>';
            echo '</div>';
        }
        ?>
    </div>
       

       
        
        <div class="footer">
            <div class="footer-about">
                <img src="images/biglogonobg.png">
                <p>J's Tech Garage was formed and built in 2005 out of <br>
                    Leslie Sineneng's passion and hobby for motorcycles. <br>
                    Today, it is one of the most famous places for motor <br>
                     parts and services. </p>
            </div>
            <div class="footer-contacts">
                    <h3>Contacts</h3>
                    <br>
                    <h5>Facebook:</h5> 
                    <a href="https://www.facebook.com/profile.php?id=100063721553694"target="_blank">J's Tech Garage</a>
                    <br><br>
                    <h5>Contact Number:</h5> 
                    <p>09672180298</p>
                    <br>
                    <p>© 2023 J's Tech Garage</p>
            </div>
            <div class="footer-students">
                    <h3>About</h3>
                    <br>
                    <p>This website is a school project made by students in <br>
                    Bulacan State University Sarmiento Campus.</p>
            </div>
        </div>
       
    </div>
    
    
    <script src="product.js"></script>

    <!-- Include dynamic data using a script tag -->
    <script>
        // Initialize products array with PHP data
        var products = <?php echo json_encode($products); ?>;

        // Function to filter and display products
        function filterProducts() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var filterType = document.getElementById('filterType').value;
            var sortPrice = document.getElementById('sortPrice').value;

            var filteredProducts = products.filter(function(product) {
                return (
                    (product.productname.toLowerCase().includes(searchInput) || 
                     product.productdesc.toLowerCase().includes(searchInput)) &&
                    (filterType === 'all' || product.producttype === filterType)
                );
            });

            if (sortPrice === 'lowest-highest') {
                filteredProducts.sort(function(a, b) {
                    return a.productprice - b.productprice;
                });
            } else if (sortPrice === 'highest-lowest') {
                filteredProducts.sort(function(a, b) {
                    return b.productprice - a.productprice;
                });
            }

            displayProducts(filteredProducts);
        }

        // Function to dynamically display products
        function displayProducts(products) {
            var productContainer = document.getElementById('productContainer');
            productContainer.innerHTML = '';

            products.forEach(function(product) {
                var imgContainer = document.createElement('div');
                imgContainer.className = 'img-container';

                var img = document.createElement('img');
                img.src = 'images/products/' + product.productimage;

                var productName = document.createElement('div');
                productName.className = 'product-name';
                productName.textContent = product.productname;

                var productDesc = document.createElement('div');
                productDesc.className = 'product-desc';
                productDesc.textContent = product.productdesc;

                var productPrice = document.createElement('div');
                productPrice.className = 'product-price';
                productPrice.textContent = '₱' + product.productprice;

                imgContainer.appendChild(img);
                imgContainer.appendChild(productName);
                imgContainer.appendChild(productDesc);
                imgContainer.appendChild(productPrice);

                productContainer.appendChild(imgContainer);
            });
        }

        // Initial display of products
        displayProducts(products);
    </script>
</body>
</html>