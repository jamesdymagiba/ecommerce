<?php
require_once "database.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: account-login.php");
    exit();
}

$userid = $_SESSION["user"];

$sqlUser = "SELECT * FROM usertable WHERE userid = $userid";
$resultUser = mysqli_query($conn, $sqlUser);

if (!$resultUser) {
    die("Error retrieving user data: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($resultUser);

$sql = "SELECT productname, productdesc, producttype, productimage, productprice, productquantity, productid FROM producttable";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
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
                            </a>
                            <a href="logout.php" class="sub-menu-link">
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
            <input type="text" class= "search-bar" id="searchInput" placeholder="What are you looking for?" autofocus>
            <button class="search-btn" id="searchBtn">Search</button>
        </div>

        <div class="filter-container">
            <select class="filter-dd" name="filter-type" id="filterType">
                <option value="" disabled selected>Filter by Type</option>
                <option value="brakepad">Brake Pad</option>
                <option value="rearshock">Rear Shock</option>
                <option value="motoroil">Motor Oil</option>
                <option value="tiresealant">Tire Sealant</option>
                <option value="all">All Type</option>
            </select>
            <select class="sort-dd" name="sort-price" id="sortPrice">
                <option value="" disabled selected>Sort by Price</option>
                <option value="lowesthighest">Lowest-Highest</option>
                <option value="highestlowest">Highest-Lowest</option>
                <option value="any">Any Price</option>
            </select>
        </div>

        <div class="product-container" id="productContainer">
            <!-- Products will be dynamically added here using JavaScript -->
        </div>
    </div>

    <div class="footer">
        <div class="footer-about">
            <img src="images/biglogonobg.png">
            <p>J's Tech Garage was formed and built in 2005 out of Leslie Sineneng's passion and hobby for motorcycles. Today, it is one of the most famous places for motor parts and services.</p>
        </div>
        <div class="footer-contacts">
            <h3>Contacts</h3>
            <br>
            <h5>Facebook:</h5> 
            <a href="https://www.facebook.com/profile.php?id=100063721553694" target="_blank">J's Tech Garage</a>
            <br><br>
            <h5>Contact Number:</h5> 
            <p>09672180298</p>
            <br>
            <p>© 2023 J's Tech Garage</p>
        </div>
        <div class="footer-students">
            <h3>About</h3>
            <br>
            <p>This website is a school project made by students in Bulacan State University Sarmiento Campus.</p>
        </div>
    </div>

    <script src="product.js"></script>
    <script>
        
        var products = <?php echo json_encode($products); ?>;
        console.log(products);

        function filterProducts() {
            var searchInput = document.getElementById('searchInput');
            var searchValue = searchInput ? searchInput.value.toLowerCase() : '';
            var filterType = document.getElementById('filterType').value;
            var sortPrice = document.getElementById('sortPrice').value;

            var filteredProducts = products.filter(function (product) {
                var matchesSearch = !searchValue || product.productname.toLowerCase().includes(searchValue) || product.productdesc.toLowerCase().includes(searchValue);
                var matchesType = !filterType || filterType === 'all' || product.producttype === filterType;

                return matchesSearch && matchesType;
            });

            console.log('Filtered products before sorting:', filteredProducts);

            if (sortPrice === 'lowesthighest') {
                filteredProducts.sort(function (a, b) {
                    return a.productprice - b.productprice;
                });
            } else if (sortPrice === 'highestlowest') {
                filteredProducts.sort(function (a, b) {
                    return b.productprice - a.productprice;
                });
            }

            console.log('Filtered products after sorting:', filteredProducts);

            displayProducts(filteredProducts);
        }

        function displayProducts(products) {
            var productContainer = document.getElementById('productContainer');
            productContainer.innerHTML = '';
            products.forEach(function (product) {
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

                var productQuantity = document.createElement('div');
                productQuantity.className = 'product-quantity';
                productQuantity.textContent = 'Stock: ' + product.productquantity;

                var productPrice = document.createElement('div');
                productPrice.className = 'product-price';
                productPrice.textContent = '₱' + product.productprice;

                var addToCartBtn = document.createElement('button');
                addToCartBtn.className = 'add-to-cart-btn';
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.onclick = function () {
                    addToCart(product.productid, product);
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(productName);
                imgContainer.appendChild(productDesc);
                imgContainer.appendChild(productQuantity);
                imgContainer.appendChild(productPrice);
                imgContainer.appendChild(addToCartBtn);

                productContainer.appendChild(imgContainer);
            });
        }

        displayProducts(products);

        document.getElementById('searchBtn').addEventListener('click', function (event) {
            event.preventDefault();
            console.log('Search button clicked');
            filterProducts();
        });

        function addToCart(productid, product) {
    var quantityAvailable = product.productquantity; // Get the available quantity from the product data

    // Prompt the user for the quantity to add
    var quantityToAdd = prompt("Enter quantity to add to cart:");

    // Check if the entered quantity is a valid number
    if (quantityToAdd === null || isNaN(quantityToAdd) || quantityToAdd <= 0) {
        alert("Invalid quantity. Please enter a valid number greater than 0.");
        return;
    }

    // Convert to numbers for numerical comparison
    quantityToAdd = parseInt(quantityToAdd, 10);
    quantityAvailable = parseInt(quantityAvailable, 10);

    // Check if the quantity to add exceeds the available stock
    if (quantityToAdd > quantityAvailable) {
        alert("Cannot add to cart. Insufficient stock.");
        return;
    }

    // Continue with adding to cart if all checks pass
    console.log("Adding to cart:", { user: <?php echo $userid; ?>, productid: productid, product: product, quantityToAdd: quantityToAdd });
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log('Product added to cart:', product);
                updateCart(product);
            } else {
                console.error('Error adding product to cart:', xhr.statusText);
            }
        }
    };
    xhr.send(JSON.stringify({ user: <?php echo $userid; ?>, productid: productid, product: product, quantityToAdd: quantityToAdd }));
}

function updateCart(product) {
    // You can update the UI to reflect the changes in the cart
    // For example, you might want to show a notification or update the cart icon
    console.log('Updating cart UI:', product);

    // Refresh the product list after adding to the cart
    filterProducts();
}
    </script>
</body>
</html>
