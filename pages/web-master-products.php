<?php
    session_start();
    $user = null;
    if(isset($user)){
        $user = $_SESSION["user"];
    }

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused";
        die();
    }

    $query = "SELECT * FROM `product` INNER JOIN `category` ON product.categoryId=category.id";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../styles/products.css">
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/web-master-dashboard.css">
</head>
<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column page-wrapper">
                <div class="menu">
                    <div class="menu-content-wrapper">
                        <div class="logo-container">
                            <img src="../images/red_logo.png">
                        </div>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="menu-strip">
                                    <div class="search-container">
                                        <input type="text" id="search-input">
                                        <button type="button" id="search-button">
                                            <img src="../images/search.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="options-container">
                            <a class="option" href="../pages/user.php">
                                <img src=
                                <?php 
                                    if($user){
                                        echo $user["imagebase64"];
                                    }else{
                                        echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg";
                                    }
                                ?>>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="products-wrapper flex-d-column container">
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <h1>
                            <?php
                                $category = $_GET["categoryName"];
                                $category[0] = strtoupper($category[0]);
                                echo $category;
                            ?>
                        </h1>
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <div class="add-button" style="padding: 10px;" id="add-category-popup-trigger" data-target-popup="add-category-popup">
                                <img src="../images/plus.svg">
                                Add
                            </div>
                        </div>
                    </div>
                    <div class="row" id="products-list">
                        <?php
                            if($result = mysqli_query($sql_connection, $query)){
                                if($result->num_rows > 0){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        $imageUrl = $row["imagebase64"];
                                        $name = $row["name"];
                                        $price = $row["price"];
                                        echo "
                                        <a class='col col-lg product-item-container' href='../pages/item-details.php?item_id=5115315395' id='5115315395'>
                                            <div class='product-item'>
                                                <div class='product-item-thumbnail'>
                                                    <img loading='lazy' src='$imageUrl'>
                                                </div>
                                                <div class='product-item-details-container'>
                                                    <h4 class='p-0 m-0'>$name</h4>
                                                    <small>$name</small>
                                                    <h2>$ $price</h2>
                                                </div>
                                            </div>
                                            <a class='col col-lg product-item-container' href='../pages/item-details.php'>
                                            </a>
                                        </a>";
                                    }
                                }else{
                                    echo "<img src='../images/empty.png'>";
                                }
                            }
                        ?>  
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
        </div>
    </div>
    <div class="backdrop" id="backdrop"></div>
    <div class="popup-container-add-popular popup-container" id="add-product-popup">
        <form class="add-popular-form form" id="login-form" action="addProductHandler.php" method="post">
            <div class="form-header">
                Add Product
                <div class="close-btn-container">
                    <button class="close-btn" type="button">x</button>
                </div>
            </div>
            <div style="display: flex; margin: 10px;">
                <button type="button" class="image-option-button image-option-button-selected" id="image-option-file" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">File</button>
                <button type="button" class="image-option-button" id="image-option-url" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">URL</button>
            </div>
            <div style="display: flex; justify-content: center;">
                <img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; cursor: pointer;" id="item-image-preview">
            </div>
            <input type="file" id="item-image-input" placeholder="item Image" accept="image/*" style="display: none;">
            <input type="url" id="item-image-url" placeholder="URL" name="item-image-url" required hidden>
            <input type="text" id="item-caption" placeholder="Item Caption" name="item-name" required>
            <input type="text" id="item" placeholder="Item">
            <input type="number" id="price-input" placeholder="Price" name="price" required>
            <input type="text" value="<?php echo $_GET["categoryId"] ?>" name="categoryId" hidden>
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
    <script src="../scripts/WebMasterFunctions/web-master-functions.js"></script>
    <script src="../scripts/productsFunctions/product.js"></script>
    <!-- <script src="../scripts/productsFunctions/products-functions.js"></script> -->
    <script src="../scripts/utils.js"></script>
    <script>
        let imageOption = 0; // file, >0 = URL
        const addBtns = document.getElementsByClassName("add-button");
        const backdrop = document.getElementById("backdrop");
        const imageOptionButtons = document.getElementsByClassName("image-option-button");
        const itemImagePreview = document.getElementById("item-image-preview");
        const itemImageInput = document.getElementById("item-image-input");
        const itemImageUrl = document.getElementById("item-image-url");

        const popupIds = [
            "add-product-popup"
        ];

        const popups = [];

        for(var i = 0; i < addBtns.length; i++){
            var popup = new Popup(addBtns.item(i), document.getElementById(popupIds[i]), backdrop);
            popups.push(popup);
        }

        popups.forEach((p) => {
            p.initTriggers();
        });

        for (var i = 0; i < imageOptionButtons.length; i++) {
        imageOptionButtons.item(i).addEventListener("click", (e) => {
            const selectedImageOptions = document.getElementsByClassName("image-option-button-selected");
            for (var i = 0; i < selectedImageOptions.length; i++) {
                selectedImageOptions.item(i).classList.remove("image-option-button-selected");
            }
            e.target.classList.add("image-option-button-selected");
            imageOption === 0 ? imageOption = 1 : imageOption = 0;

            updateItemPopup();
        });
    }

    const updateItemPopup = () => {
        if (imageOption === 0) {
            itemImageUrl.setAttribute("hidden", true);
        } else {
            itemImageUrl.removeAttribute("hidden");
        }
    };

    itemImagePreview.addEventListener("click", (e) => {
        itemImageInput.click();
    });

    itemImageInput.addEventListener("input", async (e) => {
        try {
            const base64 = await Utils.compressImage(e.target.files[0]);
            if (base64) {
                itemImagePreview.src = base64;
                itemImageUrl.value = base64;
            }
        } catch (err) {
            console.log(err);
        }
    });

    itemImageUrl.addEventListener("input", (e) => {
        itemImagePreview.src = e.target.value;
    });
    </script>
</body>
</html>