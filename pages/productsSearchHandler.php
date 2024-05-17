<?php
if (!isset($_GET["searchQuery"]))
    die("Unexpected request!");

$con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if (mysqli_connect_errno()) {
    die("Database connection refused");
}

$searchQuery = $_GET["searchQuery"];
$categoryId = $_GET["categoryId"];
$query = "SELECT * FROM (SELECT * FROM `product` AS Rel_Prods WHERE categoryId='$categoryId' AND `productName` LIKE '%$searchQuery%') AS Prods INNER JOIN `category` ON Prods.categoryId = category.categoryId;";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["productId"];
        $imageUrl = $row["productImage"];
        $name = $row["productName"];
        $price = number_format((float)$row["productPrice"], 2);
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
                        <h2>$ $price</h2>
                    </div>
                </div>

            </a>";
    }
}

die();
?>