<?php
session_start();
$user = null;
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

$sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if (mysqli_connect_errno()) {
    echo "Database connection refused";
    die();
}

$categoryId = $_GET["categoryId"];
$categoryName = $_GET["categoryName"];

if($_SERVER["REQUEST_METHOD"] == "GET"){

}

$query = "SELECT * FROM (SELECT * FROM `product` AS Rel_Prods WHERE categoryId='$categoryId') AS Prods INNER JOIN `category` ON Prods.categoryId = category.categoryId;";
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
                        <a class="logo-container" href="./web-master-dashboard.php">
                            <img src="../images/red_logo.png">
                        </a>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="menu-strip">
                                    <form class="search-container" id="search-form">
                                        <input class="m-0" type="text" id="search-input">
                                        <button type="submit" id="search-button">
                                            <img src="../images/search.svg">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="options-container">
                            <a class="option" href="../pages/user.php">
                                <img src=<?php if ($user)
                                    echo $user["image"];
                                else
                                    echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg"; ?>>
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
                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                            <div class="add-button" style="padding: 10px;" id="add-category-popup-trigger"
                                data-target-popup="add-category-popup">
                                <img src="../images/plus.svg">
                                Add
                            </div>
                            <div class="delete-button" style="padding: 10px;" id="delete-category-button">
                                <img src="../images/trash.svg">
                                Delete
                            </div>
                        </div>
                    </div>
                    <div class="row" id="products-list">
                        <?php
                        if ($result = mysqli_query($sql_connection, $query)) {
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $id = $row["productId"];
                                    $imageUrl = $row["productImage"];
                                    $name = $row["productName"];
                                    $price = $row["productPrice"];
                                    $category = $row["categoryName"];
                                    echo "
                                        <a class='col col-lg product-item-container' href='../pages/item-details.php?item_id=$id' id='$id'>
                                            <div class='product-item'>
                                                <div class='product-item-thumbnail'>
                                                    <img loading='lazy' src='$imageUrl'>
                                                </div>

                                                <div class='product-item-details-container'>
                                                    <h4 class='p-0 m-0'>$name</h4>
                                                    <small>$category</small>
                                                    <h2>LKR $price</h2>
                                                </div>

                                                <form action='productActionHandler.php?categoryId=$categoryId&categoryName=$categoryName&productId=$id' method='post' class='product-item-options-container'>
                                                    <button type='button' data-product-id='$id' class='edit-item-button' name='btnEdit' style='background-color: #4285f4; border-bottom-left-radius: 20px;' data-target-popup='add-item-popup'>
                                                        <div>
                                                            <img src='../images/edit-2.svg' style='width: 20px; height: 20px;'>
                                                            Edit
                                                        </div>
                                                    </button>
                                                    <button type='submit' data-product-id='$id' name='btnDelete' style='background-color: #A84843; border-bottom-right-radius: 20px;'>
                                                        <div>
                                                            <img src='../images/trash.svg'>
                                                            Delete
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </a>";
                                }
                            } else {
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
        <form class="add-popular-form form" id="login-form" action=<?php echo "addProductHandler.php?categoryId=$categoryId&categoryName=$categoryName" ?> method="post" enctype="multipart/form-data">
            <div class="form-header">
                Add Product
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
            <input type="file" id="item-image-input" placeholder="item Image" accept="image/*" style="display: none;" name="imageFile">
            <input type="url" id="item-image-url" placeholder="URL" name="item-image-url" required hidden>
            <input type="text" id="item-caption" placeholder="Item Caption" name="item-name" required>
            <input type="textarea" id="item-description" placeholder="Item Description" name="item-description">
            <input type="number" id="price-input" placeholder="Price" name="price" required>
            <div style="color: #ececec; display: flex; flex-direction: row; gap: 10px; align-items: center; margin-left: 12px;">
                <label for="veg">Veg?</label>
                <input type="checkbox" id="veg" name="veg">
            </div>
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
    <div class="popup-container-add-popular popup-container" id="edit-product-popup">
        <form class="add-popular-form form" id="login-form" action=<?php echo "editProductHandler.php?categoryId=$categoryId&categoryName=$categoryName" ?> method="post" enctype="multipart/form-data">
            <div class="form-header">
                Edit Product
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
            <input type="file" id="item-image-input" placeholder="item Image" accept="image/*" style="display: none;" name="imageFile">
            <input type="url" id="item-image-url" placeholder="URL" name="item-image-url" required hidden>
            <input type="text" id="item-caption" placeholder="Item Caption" name="item-name" required>
            <input type="textarea" id="item-description" placeholder="Item Description" name="item-description">
            <input type="number" id="price-input" placeholder="Price" name="price" required>
            <div style="color: #ececec; display: flex; flex-direction: row; gap: 10px; align-items: center; margin-left: 12px;">
                <label for="veg">Veg?</label>
                <input type="checkbox" id="veg" name="veg">
            </div>
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
        const searchForm = document.getElementById("search-form");
        const txtSearch = document.getElementById("search-input");
        const btnSearch = document.getElementById("search-button");
        const btnDeleteCategory = document.getElementById("delete-category-button");
        const editButtons = document.getElementsByClassName("edit-item-button");

        const popupIds = [
            "add-product-popup"
        ];

        const popups = [];

        for (var i = 0; i < addBtns.length; i++) {
            var popup = new Popup(addBtns.item(i), document.getElementById(popupIds[i]), backdrop);
            popups.push(popup);
            popup.initTriggers();
        }

        var optionBtns = document.querySelectorAll("a button");
        optionBtns.forEach(btn => {
            if(btn.getAttribute("name").match("btnDelete")) return;
            btn.addEventListener("click", async (e) => {
                e.stopPropagation();
                e.preventDefault();

                try{
                    const urlParams = new URLSearchParams(window.location.search);
                    const res = await fetch("./productActionHandler.php?categoryId=" + urlParams.get("categoryId") + "&categoryName=" + urlParams.get("categoryName") + "&productId=" + btn.getAttribute("data-product-id"), {
                        method: "POST"
                    });
                    if(res){
                        const raw = await res.text();

                        var editPopup = new Popup(btn, document.getElementById("edit-product-popup"), backdrop);
                        editPopup.popupElement.innerHTML = "";
                        editPopup.popupElement.innerHTML = raw;
                        editPopup.open();
                        editPopup.initTriggers();
                    }
                }catch(err){
                    console.log(err);
                }
            });
        });

        searchForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            try{
                const urlParams = new URLSearchParams(window.location.search);
                const res = await fetch("./productsSearchHandler.php?categoryId=" + urlParams.get("categoryId") + "&searchQuery=" + txtSearch.value, {
                    method: "GET"
                });
                if(res){
                    const productsList = document.getElementById("products-list");
                    productsList.innerHTML = await res.text();
                }
            }catch(err){
                console.log(err);
            }
        }); 

        btnDeleteCategory.addEventListener("click", async (e) => {
            try{
                const urlParams = new URLSearchParams(window.location.search);
                const res = await fetch("./deleteCategoryHandler.php?categoryId=" + urlParams.get("categoryId"), {
                    method: "GET"
                });
                if(res){
                    console.log(await res.text());
                    location.reload();
                }
            }catch(err){
                console.log(err);
            }
        });
    </script>
</body>

</html>