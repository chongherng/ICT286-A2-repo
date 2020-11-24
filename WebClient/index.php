<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

</html>
<html>

<head>
    <title>Eco-Fabrics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../WebClient/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../WebClient/css/navbar.css" />
    <script src="../WebClient/js/jquery-3.5.1.js"></script>
    <script src="../WebClient/js/script.js"></script>
</head>

<body>
    <div id="main">
        <nav>
            <ul class="menu">
                <li class="nav-logo"><a href="#home">Eco-Fabrics</a></li>
                <?php
                if (isset($_SESSION["userID"])) {
                    echo '<li class="mobile-only nav-link"><a href="#profile">Profile</a></li>';
                    if ($_SESSION["userType"] == "Staff") {
                        echo '<li class="mobile-only nav-link"><a href="#manage">Manage</a></li>';
                    }
                }
                ?>
                <li class="nav-link link active"><a href="#home">Home</a></li>
                <li class="nav-link link"><a href="#about">About</a></li>
                <li class="nav-link link" id="id1"><a href="#products">Product</a></li>
                <li class="nav-link link"><a href="#help">Help</a></li>
                <li class="nav-link mobile-first searchbar">
                    <form method="POST" action="" id="searchForm">
                        <div class="searchbar-container">
                            <input type="text" id="searchtext" name="search" placeholder="Search.." autocomplete="off" />
                            <input type="image" src="../WebClient/images/searchbar.png" alt="search" id="search-icon" />
                        </div>
                    </form>
                </li>
                <?php
                if (isset($_SESSION["userID"])) {
                    echo '<li class="nav-link cart"><a href="#cart"><i class="fa fa-shopping-cart"></i></a></li>';
                    if ($_SESSION["userType"] == "Member") {
                        echo '<div class="dropdown nav-link secondary mobile-first">
                                    <button class="dropbtn">' . $_SESSION["username"] . '</button>
                                    <div class="dropdown-content-member login-nav">
                                        <a href="#profile">Profile</a>
                                        <a href="../Server/logout.php">Logout</a>
                                    </div>
                                    </div>';
                    } else if ($_SESSION["userType"] == "Staff") {
                        echo '<div class="dropdown nav-link secondary mobile-first">
                            <button class="dropbtn">' . $_SESSION["username"] . '</button>
                            <div class="dropdown-content-staff login-nav">
                            <a href="#profile">Profile</a>
                            <a href="#manage">Manage</a>
                            <a href="../Server/logout.php">Logout</a>
                            </div>
                            </div>';
                    }
                    echo '<li class="mobile-only nav-link"><a href="../Server/logout.php">Logout</a></li>';
                } else {
                    echo '<li class="nav-link link mobile-first"><a href="#login">Login</a></li>';
                    echo '<li class="nav-link link mobile-first secondary"><a href="#register">Register</a></li>';
                }
                ?>

                <li class="toggle"><i class="fa fa-bars"></i></li>
            </ul>
        </nav>
        <div class="content-container">
            <article id="home">
                <div id="h" class="article-container">
                    <div class="welcome">
                        <h1>Welcome!</h1>
                        <br />
                        <p>
                            Users who are interested in purchasing our products can browse through our online catalog,
                            which can be accessed by clicking "Products" in the navigation bar above.
                        </p>
                        <br />
                        <p>
                            For those who have something specific in mind, they can search for it,
                            which is also done through the navigation bar.
                        </p>
                        <br />
                        <p>
                            To actually be able to buy them though, they have to register an account on our website.
                        </p>
                        <br />
                        <p>
                            If you need more help, just look at the Help section! Have a nice day!
                        </p>
                        <br />
                        <p>
                            PS: To contact us, look at the footer, which is located at the bottom of the page.
                        </p>
                        <p id="source">© Background by Yugal Srivastava from Pexels</p>
                    </div>
                </div>
            </article>
            <article id="about" hidden="hidden">
                <div id="a" class="article-container">
                    <div class="vertical-menu">
                        <div id="t" class="sidebar-active">History</div>
                        <div id="m">Mission Statement</div>
                        <div id="g">Historical Glory</div>
                        <div id="s">Charitable Support</div>
                        <div id="w">Product Information</div>
                    </div>
                    <div class="pages">
                        <div id="history">
                            <h1>History</h1>
                            <br />
                            <p>
                                Eco-Fabrics was founded in 2018 by John Doe, who at the time just graduated from the National University of Singapore with a degree in Environmental Studies.
                            </p>
                            <br />
                            <p>
                                As someone who grew up without the money to buy new clothes when needed,
                                he was dismayed when he learnt of just how much textiles were wasted and wanted to do something about it.
                            </p>
                            <br />
                            <p>
                                Before founding Eco-Fabrics, he volunteered to take in any clothes that people did not want anymore and recycle them into new clothes (also known as upscaling).
                            </p>
                            <br />
                            <p>
                                Feedback from these people, who were satisfied with his services, gave him the confidence he needed to expand his reach from a one-man job to an entire company.
                            </p>
                        </div>
                        <div id="mission">
                            <h1>Mission Statement</h1>
                            <br />
                            <p>
                                Did you know? Every year, roughly 100 million tonnes of textiles end up in landfills.
                            </p>
                            <br />
                            <p>
                                Here at Eco-Fabrics, our goal is to reduce that number by providing an alternative, which is recycling them into new clothes.
                                They are then sold at cheap prices.
                            </p>
                        </div>
                        <div id="glory">
                            <h1>Historical Glory</h1>
                            <br />
                            <p>
                                As Eco-Fabrics is still a relatively new company, we have not made as much impact on the world as we would like.
                            </p>
                            <br />
                            <p>
                                Of course, that is subject to change.
                            </p>
                            <br />
                            <p>
                                Already, we are the proud winner of the 2019 Greenest Startups Award, with hopefully more to come.
                            </p>
                        </div>
                        <div id="support">
                            <h1>Charitable Support</h1>
                            <br />
                            <p>
                                We are a major supporter of "Caritas",
                                an organization dedicated to ensuring that everyone's basic needs are met,
                                one of which includes access to affordable clothing.
                            </p>
                            <br />
                            <p>
                                Every year, we donate at least 500 of our products, as well as our gross profits to them.
                            </p>
                            <br />
                            <p>
                                In return, they help us reach out to more people and organizations, persuading them to donate their unwanted textiles to us.
                            </p>
                            <br />
                            <p>
                                It is a win-win relationship, since as we expand, we are able to donate more of our products and gross profits to them.
                            </p>
                        </div>
                        <div id="why">
                            <h1>Product Information</h1>
                            <br />
                            <p>
                                Our products are made from unwanted textiles, which would have ended up in landfills if it weren't for us.
                            </p>
                            <br />
                            <p>
                                Rest assured that these recycled clothes are just as good as any clothes you can find in regular shops,
                                for every stitch of them is meticulously crafted by highly-trained weavers who have experience in upscaling and share the same goal of reducing textile wastage.
                            </p>
                        </div>
                    </div>
                </div>
            </article>
            <article id="products" hidden="hidden">
                <div class="product-container">
                    <div class="categories-header">
                        <h1>Categories</h1>
                    </div>
                    <div class="categories-container">
                        <div class="categories-link">
                            <a href="#jackets">Jackets</a>
                            <a href="#shirts">Shirts</a>
                            <a href="#skirts">Skirts</a>
                            <a href="#undergarments">Undergarments</a>
                            <a href="#pants">Pants</a>
                        </div>
                    </div>
                    <div class="product-main">
                        <div id="jackets" class="products-details-container">
                            <div class="product-header">
                                <h2>Jackets</h2>
                            </div>
                            <div class="products-details-content">

                            </div>
                        </div>
                        <div id="shirts" hidden="hidden">
                            <div class="product-header">
                                <h2>Shirts</h2>
                            </div>
                            <div class="products-details-content">

                            </div>
                        </div>
                        <div id="skirts" hidden="hidden">
                            <div class="product-header">
                                <h2>Skirts</h2>
                            </div>
                            <div class="products-details-content">

                            </div>
                        </div>
                        <div id="undergarments" hidden="hidden">
                            <div class="product-header">
                                <h2>Undergarments</h2>
                            </div>
                            <div class="products-details-content">

                            </div>
                        </div>
                        <div id="pants" hidden="hidden">
                            <div class="product-header">
                                <h2>Pants</h2>
                            </div>
                            <div class="products-details-content">

                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article id="help" hidden="hidden">
                <div class="article-container">
                    <div class="help-container">
                        <h1>
                            CUSTOMER CARE
                        </h1>
                        <h3>
                            FAQ TOPICS
                        </h3>
                        <div class="FAQ-container">
                            <div class="FAQ Delivery">
                                <i class="fa fa-truck"></i>
                                <span>Delivery</span>
                                <hr />
                                <p>Q: Is there international deliveries?</p>
                                <p>A: Yes, there is. </p>
                                <p>Q: How long is the delivery?</p>
                                <p>A: Up to 48 hours for local and a week for overseas. </p>
                                <p>Q: Can I have my parcel delivered to my work address?</p>
                                <p>A: We can deliver to your work address.</p>
                            </div>
                            <div class="FAQ Returns">
                                <i class="fa fa-tag"></i>
                                <span>Returns & Refunds</span>
                                <hr />
                                <p>Q: What is your returns policy?</p>
                                <p>A: If you request a refund within 28 days of the item being delivered, we'll give you a full
                                    refund.</p>
                                <p>Q: How do i return something to you?</p>
                                <p>A: You will have to mark your parcel as 'returned goods' and mail it back.</p>
                                <p>Q: Do I have to pay for the return shipping fee?</p>
                                <p>A: Yes you have to pay for the shipping fee.</p>
                            </div>
                            <div class="FAQ Order-issues">
                                <i class="fa fa-warning"></i>
                                <span>Order Issues</span>
                                <hr />
                                <p>Q: I've cancelled my order - when will my money be available again?</p>
                                <p>A: It can take out to 10 working days before you receive your refund.</p>
                                <p>Q: I've received a faulty item, what should I do?</p>
                                <p>A: Please return the item to us as soon as possible so we can get a replacement for you.</p>
                                <p>Q: I've received an incorrect item in my order, what do I do?</p>
                                <p>A: If you've received something you haven't ordered, please send it back to us and we'll
                                    refund you as
                                    soon as we receive it.</p>
                            </div>
                            <div class="FAQ Stock">
                                <i class="fa fa-cube"></i>
                                <span>Product & Stock</span>
                                <hr />
                                <p>Q: Will an item be back in stock?</p>
                                <p>A: We will send you an email when the item is back in stock.</p>
                                <p>Q: How can I search for items on the website?</p>
                                <p>A: There is a search bar on top of the screen where you can enter what you are looking for.
                                </p>
                                <p>Q: Can I have an item sent to someone as a gift?</p>
                                <p>A: You can use their address for your order to send them the item. However, we do not offer
                                    gift wrapping
                                    services.</p>
                            </div>
                            <div class="FAQ Payment">
                                <i class="fa fa-credit-card"></i>
                                <span>Payment, Promos & Gift Vouchers</span>
                                <hr />
                                <p>Q: What type of payment do you accept?</p>
                                <p>A: We accept MasterCard, VISA and PayPal.</p>
                                <p>Q: How do I place an order?</p>
                                <p>A: You will need to log in first. Afterwards, click Add To Cart to place the item you want to buy in your cart. Once you have finished
                                    shopping,
                                    click the cart icon and click Checkout.</p>
                                <p>Q: My Payment was declined, what should I do?</p>
                                <p>A: Place your oder again and check that your card details are correct. If it still fails,
                                    contact our
                                    Customer Service.</p>
                            </div>
                            <div class="FAQ Technical">
                                <i class="fa fa-cog"></i>
                                <span>Technical</span>
                                <hr />
                                <p>Q: How do I create an account?</p>
                                <p>A: <a href="#register">Click here to create an account</a></p>
                                <p>Q: How do I update my profile?</p>
                                <p>A: You can update your profile once you logged in by mousing over your name and clicking on profile. If you are on mobile, open the drop down menu and click on profile.</p>
                                <p>Q: How do I logout of my account?</p>
                                <p>A: Mouse over your name and click logout. If you are on mobile, click on the drop down menu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article id="search-result" hidden="hidden">
                <div class="article-container">
                    <div class="product-main">
                        <div class="search-page-container">
                            <div class="search-details-container">

                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php
            if (isset($_SESSION["userID"])) {
                echo '<article id="profile" hidden="hidden">
                    <div class="article-container">
                        <div class="profile-main">
                            <div class="profile-name">
                                <h2>' . $_SESSION["userFName"] . " " . $_SESSION["userLName"] . '</h2>
                            </div>
                            <div class="profile-form-container">
                                <form action="" method="POST" id="update-profile-form">
                                    <div class="field">
                                        <label for="username">Username</label>
                                        <br/>
                                        <input type="text" name="username" value="' . $_SESSION["username"] . '" readonly/>
                                    </div>
                                    <div class="field">
                                        <label for="password">Password</label>
                                        <br/>
                                        <input type="password" name="password" value="' . $_SESSION["userPwd"] . '" required/>
                                    </div>
                                    <div class="field">
                                        <label for="fname">First Name</label>
                                        <br/>
                                        <input type="text" name="fname" value="' . $_SESSION["userFName"] . '" required/>
                                    </div>
                                    <div class="field">
                                        <label for="lname">Last Name</label>
                                        <br/>
                                        <input type="lname" name="lname" value="' . $_SESSION["userLName"] . '" required/>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email</label>
                                        <br/>
                                        <input type="email" name="email" value="' . $_SESSION["userEmail"] . '"/>
                                    </div>
                                    <div class="field">
                                        <label for="address">Address</label>
                                        <br/>
                                        <input type="address" name="address" value="' . $_SESSION["userAddress"] . '"/>
                                    </div>
                                    <div class="field">
                                        <label for="gender">Gender: </label>
                                        <select name="gender">';
                if ($_SESSION["userGender"] == "male") {
                    echo '<option value="male" selected>Male</option>
                                                <option value="female">Female</option>';
                } else {
                    echo '<option value="male">Male</option>
                                                <option value="female" selected>Female</option>';
                }
                echo '</select>
                                    </div>
                                    <div class="field">
                                        <label for="contact">Contact Number</label>
                                        <br/>
                                        <input type="contact" name="contact" value="' . $_SESSION["userContact"] . '"/>
                                    </div>
                                    <div class="form-btn">
                                        <button type="submit" name="submit">
                                            Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
                <article id="cart" hidden="hidden">
                <div class="cart-container">
                            <div id="cart-form-container">
            <header>
                <h3>CART</h3>
            </header>
            <form id="purchase-form" action="" method="POST" onsubmit="return validateForm(event)">
                <div class="cart-row">
                    <span class="cart-header-item cart-col">ITEM</span>
                    <span class="cart-header-price cart-col">SIZE</span>
                    <span class="cart-header-price cart-col">PRICE</span>
                    <span class="cart-header-quantity cart-col">QUANTITY</span>
                </div>
                <div class="cart-items">
                </div>
                <div class="cart-total">
                    <strong class="cart-total-title">Total</strong>
                    <span class="cart-total-price">$0.00</span>
                </div>
                <button id="purchase-btn">PURCHASE</button>
            </form>
        </div>
        <div id="cart-response-container">

        </div>
                </div>
                </article>';
                if ($_SESSION["userType"] == "Staff") {
                    echo '<article id="manage" hidden="hidden">
                <div class = "article-container">
                    <div class="admin-main">
                        <div id="register-staff-form-container">
                            <div class="reg-title">
                                <h2>Create Staff Account</h2>
                            </div>
                            <form action="../Server/register-staff.php" method="POST" id="register-staff-form">
                                <div class="field">
                                    <label for="username">Username:</label>
                                    <br/>
                                    <input type="text" name="username" placeholder="Username" required/>
                                </div>
                                <div class="field">
                                    <label for="password">Password:</label>
                                    <br/>
                                    <input type="password" name="password" placeholder="Password" required/>
                                </div>
                                <div class="field">
                                    <label for="fname">First Name:</label>
                                    <br/>
                                    <input type="text" name="fname" id="fname" placeholder="First Name" required/>
                                </div>
                                <div class="field">
                                    <label for="lname">Last Name:</label>
                                    <br/>
                                    <input type="text" name="lname" id="lname" placeholder="Last Name" required/>
                                </div>
                                <div class="form-btn">
                                    <button type="submit" name="submit">
                                        Create Account
                                    </button>
                                </div>
                            </form>';
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyInput") {
                            echo "<p>Please fill in all fields!</p>";
                        }
                        if ($_GET["error"] == "invalidUsername") {
                            echo "<p>Please enter a proper username!</p>";
                        }
                        if ($_GET["error"] == "invalidName") {
                            echo "<p>Please enter a proper name!</p>";
                        }
                        if ($_GET["error"] == "usernameTaken") {
                            echo "<p>Username already taken!</p>";
                        }
                        if ($_GET["error"] == "none") {
                            echo "<p>You have signed up!</p>";
                        }
                    }
                    echo '</div>
                    </div>
                    </div>
                </article>';
                }
            } else {
                echo '            <article id="login" hidden="hidden">
                <div class="article-container">
                    <div class="login-main">
                        <div class="login-title">
                            <h2>Sign in</h2>
                        </div>
                        <div class="login-form-container">
                            <form action="../Server/login.php" method="POST" id="login-form">
                                <div class="field">
                                    <label for="username">Username:</label>
                                    <br/>
                                    <input type="text" name="username" placeholder="Username" required/>
                                </div>
                                <div class="field">
                                    <label for="password">Password:</label>
                                    <br/>
                                    <input type="password" name="password" placeholder="Password" required/>
                                </div>
                                <div class="form-btn">
                                    <button type="submit" name="submit">
                                        Sign In
                                    </button>
                                </div>
                            </form>';
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyInput") {
                        echo "<p>Please fill in all fields!</p>";
                    }
                    if ($_GET["error"] == "invalidUsername") {
                        echo "<p>Please enter a proper username!</p>";
                    }
                    if ($_GET["error"] == "invalidLogin") {
                        echo "<p>Invalid login information!</p>";
                    }
                }

                echo '</div>
                    </div>
                </div>
            </article>
            <article id="register" hidden="hidden">
                <div class="article-container">
                    <div class="register-main">
                        <div class="reg-title">
                            <h2>Create Account</h2>
                        </div>
                        <div class="register-form-container">
                            <form action="../Server/register.php" method="POST" id="register-form">
                                <div class="field">
                                    <label for="username">Username:</label>
                                    <br/>
                                    <input type="text" name="username" placeholder="Username" required/>
                                </div>
                                <div class="field">
                                    <label for="password">Password:</label>
                                    <br/>
                                    <input type="password" name="password" placeholder="Password" required/>
                                </div>
                                <div class="field">
                                    <label for="fname">First Name:</label>
                                    <br/>
                                    <input type="text" name="fname" id="fname" placeholder="First Name" required/>
                                </div>
                                <div class="field">
                                    <label for="lname">Last Name:</label>
                                    <br/>
                                    <input type="text" name="lname" id="lname" placeholder="Last Name" required/>
                                </div>
                                <div class="form-btn">
                                    <button type="submit" name="submit">
                                        Create Account
                                    </button>
                                </div>
                            </form>';
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyInput") {
                        echo "<p>Please fill in all fields!</p>";
                    }
                    if ($_GET["error"] == "invalidUsername") {
                        echo "<p>Please enter a proper username!</p>";
                    }
                    if ($_GET["error"] == "invalidName") {
                        echo "<p>Please enter a proper name!</p>";
                    }
                    if ($_GET["error"] == "usernameTaken") {
                        echo "<p>Username already taken!</p>";
                    }
                    if ($_GET["error"] == "none") {
                        echo "<p>You have signed up!</p>";
                    }
                }
                echo '</div>
                    </div>
                </div>
            </article>';
            }
            ?>
        </div>
    </div>
    <div class="footer">
        <div class="contact">
            <h3>Contact Us</h3>
            <br />
            <p>Tel: +65 8342 6435</p>
            <p>Email: contact@ecofabrics.com</p>
            <p>Address: 2 Geylang East Avenue 2 #04-109, 389754, Singapore</p>
        </div>
        <br />
        <p>© Copyright 2020 Eco-Fabrics. All Rights Reserved.</p>
    </div>
</body>

</html>