<?php
session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

$sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if (mysqli_connect_errno()) {
    mysqli_close($sql_connection);
    die("Database connection refused!");
}

$query_category = "SELECT * FROM `category`;";
$query_popular = "SELECT * FROM (SELECT * FROM `product` WHERE `popular`='1') AS Prods INNER JOIN `category` ON category.categoryId = Prods.categoryId;";
$query_featured = "SELECT * FROM (SELECT * FROM `product` WHERE `featured`='1') AS Prods INNER JOIN `category` ON category.categoryId = Prods.categoryId;";
$query_orders = "SELECT * FROM (SELECT * FROM `orders`) AS Orders INNER JOIN `user` ON user.userId = Orders.userId ORDER BY `orderId` DESC;";
$query_orderitems = "SELECT * FROM (SELECT * FROM `orderitems`) AS Items INNER JOIN `orders` ON orders.orderId = Items.orderId;";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Master Dashboard</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
    <link rel="stylesheet" href="../styles/carousel.css" type="text/css">
    <link rel="stylesheet" href="../styles/about-us.css" type="text/css">
    <link rel="stylesheet" href="../styles/web-master-dashboard.css" type="text/css">
    <link rel="stylesheet" href="../styles/loading-spinner.css" type="text/css">
</head>

<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column page-wrapper">
                <div class="menu">
                    <div class="menu-content-wrapper">
                        <a class="logo-container" href="">
                            <img src="../images/red_logo.png">
                        </a>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <!-- <div class="menu-strip">
                                    <div class="menu-button menu-icon-active" id="dashboard">
                                        <img src="../images/grid.svg">
                                    </div>
                                    <div class="menu-button" id="orders">
                                        <img src="../images/file-text.svg">
                                    </div>
                                    <div class="menu-button" id="about-us">
                                        <img src="../images/info.svg">
                                    </div>
                                    <div class="menu-button" id="logout">
                                        <img src="../images/log-out.svg">
                                    </div>
                                </div> -->
                                <!-- <div class="menu-button-text-container">
                                    <div class="menu-button-text menu-text-active" id="dashboard">
                                        <h3>Dashboard</h3>
                                    </div>
                                    <div class="menu-button-text" id="orders">
                                        <h3>Orders</h3>
                                    </div>
                                    <div class="menu-button-text" id="about-us">
                                        <h3>About us</h3>
                                    </div>
                                    <div class="menu-button-text" id="logout">
                                        <h3>Logout</h3>
                                    </div>
                                </div> -->
                                <div class="options-container">
                                    <a class="option" href="../pages/user.php">
                                        <img src=<?php if ($user)
                                            echo $user["image"];
                                        else
                                            echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg"; ?>>
                                    </a>
                                    <!-- <a class="floating-option" href="../pages/cart.html">
                                        <img src="../images/shopping-cart.svg">
                                        <div class="cart-label-container">
                                            <span id="cart-label">9+</span>
                                        </div>
                                    </a> -->
                                    <div class="another-container">
                                        <a class="floating-menu" id="floating-menu">
                                            <img src="../images/menu.svg">
                                        </a>
                                        <div class="floating-menu-container" id="floating-menu-container">
                                            <div class="floating-menu-button">
                                                <img src="../images/grid.svg">
                                                <h3>Home</h3>
                                            </div>
                                            <hr>
                                            <div class="floating-menu-button">
                                                <img src="../images/file-text.svg">
                                                <h3>Orders</h3>
                                            </div>
                                            <hr>
                                            <div class="floating-menu-button" id="menu-button">
                                                <img src="../images/info.svg">
                                                <h3>About us</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content active-tab" style="height: 100%; display: none; justify-content: center; align-items: center;" id="loading-spinner">
                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                </div>

                <!-- Dashboard -->
                <div class="tab-content flex-d-column container" id="tab-dashboard">
                    <!-- <div class="search-wrapper">
                        <div class="search-container" id="search-container">
                            <div class="input-container">
                                <input class="search-input" id="search-input" type="text">
                            </div>
                            <div class="icon-container">
                                <img src="../images/search.svg">
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="carousel-container px-10">
                        <div class="carousel">
                            <div class="slides fade">
                                <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=1380&t=st=1711548900~exp=1711549500~hmac=812f87fd25602c0895b89e4bf140debe5908c81c653622f5c03741cc63853d13">
                                <div class="slide-text">
                                    <h1><span>Savor</span> the Flavors of<br> Authentic Cuisine from<br>Around the World!</h1>
                                </div>
                            </div>
                            <div class="slides fade">
                                <img src="https://img.freepik.com/free-photo/penne-pasta-tomato-sauce-with-chicken-tomatoes-wooden-table_2829-19744.jpg?w=1380&t=st=1711548932~exp=1711549532~hmac=dacb4bd90d4acab4ba9ac48fa6834763d489c00fa166410d43f314409543dd18">
                                <div class="slide-text">
                                    <div class="slide-text">
                                        <h1><span>Experience</span> a Gastronomic <br>Adventure with <br>Every Bite!</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="slides fade">
                                <img src="https://img.freepik.com/free-photo/american-shrimp-fried-rice-served-with-chili-fish-sauce-thai-food_1150-26585.jpg?w=1380&t=st=1711549026~exp=1711549626~hmac=6d02d4d9208e66abc84ce18543b69a7fb8d0e2d8f841fd99cbf5603bfb4457ea">
                                <div class="slide-text">
                                    <h1><span>Tantalize</span> Your <br>Taste Buds with <br>Our Chef's <br>Signature Creations!</h1>
                                </div>
                            </div>
                            <div class="slides fade">
                                <img src="https://img.freepik.com/free-photo/flame-grilled-meat-cooking-flames-generative-ai_188544-12355.jpg?w=1380&t=st=1711548972~exp=1711549572~hmac=e73ee87745724d6ce0e60ec2699a827cd07ac0ceca4b6f6778409d3d21c50b97">
                                <div class="slide-text">
                                    <h1><span>Unleash</span> <br>Your Palate's Potential <br>with Our Unforgettable <br>Culinary Journey!</h1>
                                </div>
                            </div>
    
                            <a class="prev" onclick="plusSlide(-1)">❮</a>
                            <a class="next" onclick="plusSlide(1)">❯</a>
                        </div>
                        <br>
                        <div class="dots-container">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                            <span class="dot" onclick="currentSlide(4)"></span>
                        </div>
                    </div> -->
                    <div class="title-container px-10">
                        <div>
                            <h3 class="p-0 m-0">Categories</h3>
                            <small><span class="color-red">Craving</span> for different cuisines? take a look </small>
                        </div>
                        <div class="add-button" id="add-category-popup-trigger" data-target-popup="add-category-popup">
                            <img src="../images/plus.svg">
                            Add
                        </div>
                    </div>
                    <div class="categories-wrapper">
                        <div class="categories-overlay"></div>
                        <div class="container scroll-hide w-100" id="categories-list">
                            <div class="categories-container">
                                <?php
                                if ($result = mysqli_query($sql_connection, $query_category)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $imageUrl = $row["categoryImage"];
                                            $id = $row["categoryId"];
                                            $name = $row["categoryName"];
                                            echo "
                                                <a class='category-item-container'
                                                    href='../pages/web-master-products.php?categoryId=$id&categoryName=$name'>
                                                    <div class='category-item'>
                                                        <img loading='lazy' src='$imageUrl'>
                                                    </div>
                                                    <span>$name</span>
                                                </a>
                                                ";
                                        }
                                    } else {
                                        echo "<img src='../images/empty.png'>";
                                    }
                                    mysqli_free_result($result);
                                }
                                ?>
                                <div class="category-item-container">
                                    <div class="padded-category-item"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title-container px-10 pt-10">
                        <div>
                            <h3 class="p-0 m-0">Popular Dishes</h3>
                            <small><span class="color-red">Hey, </span>take a look at our popular dishes</small>
                        </div>
                        <!-- <div class="add-button">
                            <img src="../images/plus.svg">
                            Add
                        </div> -->
                    </div>
                    <div class="popular-wrapper">
                        <div class="popular-overlay"></div>
                        <div class="container scroll-hide w-100">
                            <div class="popular-container">
                                <?php

                                if ($result = mysqli_query($sql_connection, $query_popular)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $productId = $row["productId"];
                                            $imageUrl = $row["productImage"];
                                            $name = $row["productName"];
                                            $categoryName = $row["categoryName"];
                                            $price = number_format((float)$row["productPrice"], 2);
                                            echo "
                                                    <a class='popular-item-container' href='./item-details.php?item_id=$productId'>
                                                        <div class='popular-item'>
                                                            <div class='popular-item-content'>
                                                                <div class='popular-item-thumbnail'>
                                                                    <img loading='lazy' src='$imageUrl'>
                                                                </div>
                                                                <div class='details-container'>
                                                                    <div class='details-content'>
                                                                        <h4 class='p-0 m-0'>$name</h4>
                                                                        <small>" . strtoupper($categoryName) . "</small>
                                                                        <h4>LKR $price</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>";
                                        }
                                    } else {
                                        echo "<img src='../images/empty.png'>";
                                    }
                                    mysqli_free_result($result);
                                }
                                ?>
                                <div class="popular-item-container">
                                    <div class="padded-popular-item"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title-container px-10 pt-10">
                        <div>
                            <h3 class="p-0 m-0">Featured Dishes</h3>
                            <small><span class="color-red">Featured</span> Dishes</small>
                        </div>
                    </div>
                    <div class="featured-wrapper p-10">
                        <div class="row">
                            <?php
                            if ($result = mysqli_query($sql_connection, $query_featured)) {
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $productId = $row["productId"];
                                        $imageUrl = $row["productImage"];
                                        $name = $row["productName"];
                                        $categoryName = $row["categoryName"];
                                        $price = number_format((float)$row["productPrice"], 2);

                                        echo "
                                            <a class='col col-lg featured-item-container' href='./item-details.php?item_id=$productId'>
                                                <div class='featured-item'>
                                                    <div class='featured-item-thumbnail'>
                                                        <img loading='lazy'
                                                            src='$imageUrl'>
                                                    </div>
                                                    <div class='featured-item-details-container'>
                                                        <h4 class='p-0 m-0'>$name</h4>
                                                        <small>" . strtoupper($categoryName) . "</small>
                                                        <h4>LKR $price</h4>
                                                    </div>
                                                    <div class='featured-label'>
                                                        <small>FEATURED</small>
                                                    </div>
                                                </div>
                                            </a>
                                            ";
                                    }
                                } else {
                                    echo "<img src='../images/empty.png'>";
                                }
                                mysqli_free_result($result);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="page-footer">
                        <div class="page-footer-content">
                            <h3>Red Dine</h3>
                            <span>Copyright© 2023-2024 Red Dine Foodworks</span>
                            <div class="icons-container">
                                <img src="../images/facebook.svg">
                                <img src="../images/twitter.svg">
                                <img src="../images/instagram.svg">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Orders -->
                <div class="tab-content flex-d-column container" id="tab-orders">
                    <h1>Orders</h1>
                    <div class="empty-indicator-container display-none">
                        <div class="empty-indicator-content">
                            <img src="../images/deliveryman.png">
                            <span><span class="color-red">Feed</span> your cravings!<br>Place your order now.</span>
                        </div>
                    </div>

                    <div class="orders-list-wrapper" id="orders-list-wrapper">
                        <?php
                        $orders = mysqli_query($sql_connection, $query_orders);
                        if (mysqli_num_rows($orders) > 0) {
                            while ($row = mysqli_fetch_array($orders, MYSQLI_ASSOC)) {
                                $orderId = $row["orderId"];
                                $status = $row["status"];
                                $subTotal = number_format((float) $row["subtotal"], 2);
                                $dateTime = $row["time"];
                                $status = $row["status"];
                                $userName = $row["userName"];
                                $address =  $row["userAddress"];
                                $telephone = $row["userContactNumber"];

                                $order_items = mysqli_query($sql_connection, $query_orderitems);
                                if (mysqli_num_rows($order_items) > 0) {
                                    $str = "";
                                    while ($item = mysqli_fetch_array($order_items, MYSQLI_ASSOC)) {
                                        if ($item["orderId"] == $orderId)
                                            $str .= "<small>" . $item["productName"] . " x " . $item["qty"] . "</small>";
                                    }
                                }

                                echo "<div class='order-container'>
                                        <div class='order'>
                                            <div class='order-thumbnail-container'>
                                                <img loading='lazy' src='../images/order.png' style='object-fit: contain;'>
                                            </div>
                                            <div class='order-details-container'>
                                                <h4 class='p-0 m-0'>Order $orderId - <small>$dateTime</small></h4>
                                                <div class='order-items-container'>
                                                    <h4 style='margin-bottom: 0'>Items</h4>
                                                    $str
                                                </div>
                                                <hr class='m-0 p-0'>
                                                <div>
                                                    <h4 style='margin-bottom: 0'>Customer Information</h4>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td><small>User name</small></td>
                                                                <td><small> - </small></td>
                                                                <td><small>$userName</small></td>
                                                            </tr>
                                                            <tr style='max-width: 150px;'>
                                                                <td><small>Address</small></td>
                                                                <td><small> - </small></td>
                                                                <td style='word-wrap: break-word; text-wrap: wrap;'><small>$address</small></td>
                                                            </tr>
                                                            <tr>
                                                                <td><small>Telephone</small></td>
                                                                <td><small> - </small></td>
                                                                <td><small>$telephone</small></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr style='margin-left: 0; margin-right: 0;'>
                                                <small>Subtotal</small>
                                                <h4 class='p-0 m-0'>LKR $subTotal</h4>
                                            </div>
                                            <div class='order-status-label order-status-$status'>
                                                <small>" . strtoupper($status) . "</small>
                                            </div>
                                        </div>
                                        <form action='./orderStateChangeHandler.php?orderId=$orderId' method='post' class='order-actions-container' id='order-state-form'>
                                            <button type='submit' name='action' value='pending' class='order-action-pending" . ($status == 'pending' ? "-active" : "") . "'>Pending</button>
                                            <button type='submit' name='action' value='dispatched' class='order-action-dispatched" . ($status == 'dispatched' ? "-active" : "") . "'>Dispatched</button>
                                            <button type='submit' name='action' value='failed' class='order-action-failed" . ($status == 'failed' ? "-active" : "") . "'>Failed</button>
                                            <button type='submit' name='action' value='completed' class='order-action-completed" . ($status == 'completed' ? "-active" : "") . "'>Completed</button>
                                        </form>
                                    </div>";
                            }
                        }
                        ?>
                        <div>
                            <div class="page-footer">
                                <div class="page-footer-content">
                                    <h3>Red Dine</h3>
                                    <span>Copyright© 2023-2024 Red Dine Foodworks</span>
                                    <div class="icons-container">
                                        <img src="../images/facebook.svg">
                                        <img src="../images/twitter.svg">
                                        <img src="../images/instagram.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- about us -->
                <div class="tab-content flex-d-column container" id="tab-about">
                    <div class="about-us-wrapper">
                        <div class="top-header-container">
                            <img loading="lazy"
                                src="https://images.pexels.com/photos/5965676/pexels-photo-5965676.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                            <h1>About Us</h1>
                        </div>
                        <div class="block-container">
                            <div class="block">
                                <div class="block-content-container">
                                    <div class="content-container">
                                        <div class="content">
                                            <h1>Our Story</h1>
                                            <p>Welcome to Red Dine! We are passionate about providing high-quality
                                                dining experiences for our customers. Founded in 2024, Red Dine has been
                                                dedicated to serving delicious and healthy meals using locally-sourced
                                                ingredients whenever possible. Our team of chefs and food enthusiasts
                                                work tirelessly to create innovative dishes that satisfy your taste buds
                                                and nourish your body.</p>
                                        </div>
                                    </div>
                                    <div class="image-container">
                                        <img loading="lazy"
                                            src="https://images.pexels.com/photos/16116627/pexels-photo-16116627/free-photo-of-dramatic-sky-at-sunset.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-container">
                            <div class="block">
                                <div class="block-content-container">
                                    <div class="image-container">
                                        <img loading="lazy"
                                            src="https://images.pexels.com/photos/7363730/pexels-photo-7363730.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                    <div class="content-container">
                                        <div class="content">
                                            <h1>Our Mission</h1>
                                            <p>At Red Dine, our mission is simple: to make dining enjoyable, convenient,
                                                and healthy for everyone.
                                                We strive to exceed our customers' expectations by providing exceptional
                                                service, delicious food, and a welcoming atmosphere.
                                                Whether you're dining in our restaurant, ordering takeout, or catering
                                                an event, we want your experience with Red Dine to be memorable and
                                                satisfying.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-container">
                            <div class="block">
                                <div class="block-content-container">
                                    <div class="content-container">
                                        <div class="content">
                                            <h1>Our Team</h1>
                                            <p>Meet the faces behind Red Dine! Our team is composed of talented chefs,
                                                friendly servers, and dedicated staff who are committed to delivering
                                                excellence every day.
                                                We value teamwork, creativity, and customer satisfaction, and we're
                                                always looking for new ways to improve and innovate.</p>
                                        </div>
                                    </div>
                                    <div class="image-container">
                                        <img loading="lazy"
                                            src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-container">
                            <div class="block">
                                <div class="block-content-container">
                                    <div class="image-container">
                                        <img loading="lazy"
                                            src="https://images.pexels.com/photos/4064227/pexels-photo-4064227.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                    <div class="content-container">
                                        <div class="content">
                                            <h1>Contact us</h1>
                                            <p>
                                            <h4 class="p-0 m-0">Email</h4>
                                            <span>info.reddine@gmail.com</span>
                                            <br><br>
                                            <h4 class="p-0 m-0">Telephone</h4>
                                            <span>+94 76 4 886 903</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-footer">
                            <div class="page-footer-content">
                                <h3>Red Dine</h3>
                                <span>Copyright© 2023-2024 Red Dine Foodworks</span>
                                <div class="icons-container">
                                    <img src="../images/facebook.svg">
                                    <img src="../images/twitter.svg">
                                    <img src="../images/instagram.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User -->
                <div class="tab-content flex-d-column container" id="tab-user">
                    User tab
                </div>

                <!-- Preferences -->
                <div class="tab-content flex-d-column container" id="tab-preferences">
                    Preferences tab
                </div>


            </div>
        </div>
    </div>
    <div class="backdrop" id="backdrop"></div>
    <div class="popup-container-add-category popup-container" id="add-category-popup">
        <form class="add-category-form form" id="login-form" action="addCategoryHandler" method="post"
            enctype="multipart/form-data">
            <div class="form-header">
                Add Category
                <div class="close-btn-container">
                    <button class="close-btn" type="button">x</button>
                </div>
            </div>
            <div style="display: flex; margin: 10px;">
                <button type="button" class="image-option-button image-option-button-selected" id="image-option-file"
                    style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">File</button>
                <button type="button" class="image-option-button" id="image-option-url"
                    style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">URL</button>
            </div>
            <div style="display: flex; justify-content: center;">
                <img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png"
                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; cursor: pointer;"
                    id="item-image-preview">
            </div>
            <input type="file" id="item-image-input" placeholder="Category Image" accept="image/*"
                style="display: none;" name="imageFile">
            <input type="url" id="item-image-url" placeholder="URL" name="category-image-url" required hidden>
            <input type="text" name="category-name" id="cat-caption" placeholder="Category Caption" required>
            <!-- <div>
                <hr>
            </div> -->
            <div class="form-footer">
                <div class="btn-container">
                    <input class="btn-submit m-0" type="submit" id="popup-form-submit" value="Confirm"></input>
                </div>
            </div>
        </form>
    </div>
    <div class="popup-container-add-popular popup-container" id="add-popular-popup">
        <form class="add-popular-form form" id="login-form">
            <div class="form-header">
                Add Popular Item
                <div class="close-btn-container">
                    <button class="close-btn" type="button">x</button>
                </div>
            </div>
            <input type="file" id="item-image-input" placeholder="Popular Image" required>
            <input type="text" id="item-caption" placeholder="Item Caption" required>
            <input type="text" id="category" placeholder="Category">
            <input type="number" id="price-input" placeholder="Price" required>
            <!-- <div>
                <hr>
            </div> -->
            <div class="form-footer">
                <div class="btn-container">
                    <button class="btn-submit" type="submit" id="popup-form-submit">Confirm</button>
                </div>
            </div>
        </form>
    </div>
    <div class="popup-container-add-featured popup-container" id="add-featured-popup">
        <form class="add-featured-form form" id="login-form">
            <div class="form-header">
                Add Featured Item
                <div class="close-btn-container">
                    <button class="close-btn" type="button">x</button>
                </div>
            </div>
            <input type="file" id="item-image-input" placeholder="Featured Image" required>
            <input type="text" id="item-caption" placeholder="Item Caption" required>
            <input type="text" id="category" placeholder="Category" style="color: #ececec;">
            <input type="number" id="price-input" placeholder="Price" required>
            <!-- <div>
                <hr>
            </div> -->
            <div class="form-footer">
                <div class="btn-container">
                    <button class="btn-submit" type="submit" id="popup-form-submit">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../scripts/homeFunctions/MenuOption.js"></script>
<script src="../scripts/homeFunctions/Tab.js"></script>
<script src="../scripts/homeFunctions/home-animations.js"></script>
<!-- <script src="../scripts/homeFunctions/carousel.js"></script> -->
<script src="../scripts/homeFunctions/Menu.js"></script>
<script src="../scripts/homeFunctions/home-functions.js"></script>
<script src="../scripts/homeFunctions/PopularItem.js"></script>
<script src="../scripts/WebMasterFunctions/web-master-functions.js"></script>
<script src="../scripts/utils.js"></script>
<script>
    const addBtns = document.getElementsByClassName("add-button");
    const backdrop = document.getElementById("backdrop");

    const popupsIds = [
        "add-category-popup",
        "add-popular-popup",
        "add-featured-popup"
    ];

    const popups = [];

    for (var i = 0; i < addBtns.length; i++) {
        var popup = new Popup(addBtns.item(i), document.getElementById(popupsIds[i]), backdrop);
        popups.push(popup);
        popup.initTriggers();
    }
</script>
<?php
mysqli_close($sql_connection);
?>

</html>