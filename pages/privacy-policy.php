<?php 
session_start();

$user = isset($_SESSION["user"]) ? $_SESSION["user"] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link rel="stylesheet" type="text/css" href="../styles/base.css">
    <link rel="stylesheet" type="text/css" href="../styles/privacy-policy.css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
</head>

<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column">
                <div class="menu">
                <div class="menu-content-wrapper">
                    <a class="logo-container" href="../index.php">
                        <img src="../images/red_logo.png">
                    </a>
                    <div class="menu-wrapper">
                        <div class="menu-container">
                            <div class="options-container" style="visibility: hidden;">
                                <a class="option" href=<?php
                                    if ($user) {
                                        echo "./pages/user.php";
                                    } else {
                                        echo "./pages/login.php";
                                    }
                                    ?>>
                                    <img src=<?php
                                        if ($user) {
                                            echo $user["image"];
                                        } else {
                                            echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg";
                                        }
                                    ?>>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="w-100 flex-d-column container">
                    <div class="page-wrapper container">
                        <div class="page-content-wrapper">
                            <div class="header-container">
                                <div class="caption-container">
                                    <h1>We've got<br>your privacy covered</h1>
                                </div>
                                <div class="img-container">
                                    <img loading="lazy" src="../images/6965339.png">
                                </div>
                            </div>
        
                            <div class="privacy-principles-container">
                                <h2>Our Privacy Commitment</h2>
                                <p>When you choose Red Dine, you're entrusting us with your personal information. Upholding that trust is paramount, and it begins with transparency about our privacy practices. Our Privacy Principles form the cornerstone of how we safeguard your privacy at Red Dine.</p>
        
                                <div class="principles-list-wrapper p-10">
                                    <div class="row">
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631549823/assets/47/ab929c-f63e-4cf2-ba1a-125d309618aa/original/We-do-the-right-thing-with-data.png">
                                                <h4>Data Collection</h4>
                                            </div>
                                            <p>We collect limited personal information when you use our services, such as your name, email, and payment details, to ensure smooth transactions and personalized </p>
                                        </div>
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631640001/assets/49/89bd9f-59b6-4bbf-91b4-43ac6815b253/original/Build-privacy-into-our-products.png">
                                                <h4>Data Usage</h4>
                                            </div>
                                            <p>Your information is solely used to provide and improve our services. We may analyze usage patterns to enhance user experience and troubleshoot technical issues.</p>
                                        </div>
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631640151/assets/eb/54c102-d149-47b0-8e2a-1cf3b4e57d7c/original/Collect-only-what-we-need.png">
                                                <h4>Data Protection</h4>
                                            </div>
                                            <p>We prioritize the security of your data and employ industry-standard measures to prevent unauthorized access, alteration, or disclosure.</p>
                                        </div>
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631640182/assets/c1/124157-c7fc-4128-9901-1f620727a565/original/Transparent-about-our-data-practice.png">
                                                <h4>Data Sharing</h4>
                                            </div>
                                            <p>Your information is never sold to third parties. We may share it with trusted partners for service provision or legal compliance, always ensuring strict confidentiality.</p>
                                        </div>
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631640205/assets/0b/c8d175-263a-4c85-9fc8-13e6a1899f2e/original/Give-users-choices.png">
                                                <h4>User Control</h4>
                                            </div>
                                            <p>You have the right to access, correct, or delete your personal data. We provide easy-to-use tools and support to manage your privacy preferences.</p>
                                        </div>
                                        <div class="col col-md principle-container">
                                            <div class="title-container">
                                                <img loading="lazy" src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_48,h_48/v1631640233/assets/e4/39e1d8-9408-4d4e-940e-09ce7598f873/original/Safetguard-personal-data.png">
                                                <h4>Policy Updates</h4>
                                            </div>
                                            <p>We may periodically update our privacy policy to reflect changes in regulations or service offerings. We'll notify you of any significant alterations and seek your consent if necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>