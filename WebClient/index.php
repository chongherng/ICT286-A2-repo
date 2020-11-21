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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../WebClient/css/navbar.css">
    <script src="../WebClient/js/jquery-3.5.1.js" defer></script>
    <script src="../WebClient/js/script.js" defer></script>
</head>

<body>
    <div id="main">
        <nav>
            <ul class="menu">
                <li class="nav-logo"><a href="#home">Eco-Fabrics</a></li>
                <?php
                if (isset($_SESSION["userID"])) {
                    echo '<li class="mobile-only nav-link"><a href="#profile">Profile</a></li>';
                }
                ?>
                <li class="nav-link link active"><a href="#home">Home</a></li>
                <li class="nav-link link"><a href="#about">About</a></li>
                <li class="nav-link link"><a href="#products">Product</a></li>
                <li class="nav-link link"><a href="#help">Help</a></li>
                <li class="nav-link mobile-first searchbar">
                    <form action="#" method="GET">
                        <div class="searchbar-container">
                            <input type="text" name="search" placeholder="Search.." autocomplete="off">
                            <input type="image" src="../WebClient/images/searchbar.png" alt="search" id="search-icon">
                        </div>
                    </form>
                </li>
                <?php
                if (isset($_SESSION["userID"])) {
                    echo '<li class="nav-link cart"><a href="#cart"><i class="fa fa-shopping-cart"></i></a></li>';
                    if ($_SESSION["userType"] == "Member") {
                        echo '<div class="dropdown nav-link secondary mobile-first">
                                    <button class="dropbtn">' . $_SESSION["username"] . '</button>
                                    <div class="dropdown-content">
                                        <a href="#profile">Profile</a>
                                        <a href="../Server/logout.php">Logout</a>
                                    </div>
                                    </div>';
                    } else if ($_SESSION["userType"] == "Staff") {
                        echo '<div class="dropdown nav-link secondary mobile-first">
                            <button class="dropbtn">' . $_SESSION["username"] . '</button>
                            <div class="dropdown-content">
                            <a href="#profile">Profile</a>
                            <a href="#">Manage</a>
                            <a href="logout.php">Logout</a>
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
                <p> This is the Home page.</p>
                <!--Default: Load content of home page here.-->
            </article>
            <article id="about" hidden="hidden">
                <p style="color: red"> This is the About page.</p>
                <!--Load content of about page here.-->
            </article>
            <article id="products" hidden="hidden">
                <!--Load content of products page here-->
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
                                <hr>
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
                                <hr>
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
                                <hr>
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
                                <hr>
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
                                <hr>
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
                                <hr>
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
            <article id="login" hidden="hidden">
                <div class="article-container">
                    <div class="login-main">
                        <div class="login-title">
                            <h2>Sign in</h2>
                        </div>
                        <div class="login-form-container">
                            <form action="../Server/login.php" method="POST" id="login-form">
                                <div class="field">
                                    <label for="username">Username:</label>
                                    <br>
                                    <input type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="field">
                                    <label for="password">Password:</label>
                                    <br>
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-btn">
                                    <button type="submit" name="submit">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                            <?php
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
                            ?>
                        </div>
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
                                    <br>
                                    <input type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="field">
                                    <label for="password">Password:</label>
                                    <br>
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="field">
                                    <label for="fname">First Name:</label>
                                    <br>
                                    <input type="text" name="fname" id="fname" placeholder="First Name" required>
                                </div>
                                <div class="field">
                                    <label for="lname">Last Name:</label>
                                    <br>
                                    <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                                </div>
                                <div class="form-btn">
                                    <button type="submit" name="submit">
                                        Create Account
                                    </button>
                                </div>
                            </form>
                            <?php
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
                            ?>
                        </div>

                    </div>
                </div>
            </article>
            <?php
            if(isset($_SESSION["userID"])){
                echo '<article id="profile" hidden="hidden">
                    <div class="article-container">
                        <div class="profile-main">
                            <div class="profile-name">
                                <h2>'. $_SESSION["userFName"]." ". $_SESSION["userLName"].'</h2>
                            </div>
                            <div class="profile-form-container">
                                <form action="../Server/update-profile.php" method="POST" id="update-profile-form">
                                    <div class="field">
                                        <label for="username">Username</label>
                                        <br>
                                        <input type="text" name="username" value="'.$_SESSION["username"].'" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="password">Password</label>
                                        <br>
                                        <input type="password" name="password" value="' . $_SESSION["userPwd"] . '" required>
                                    </div>
                                    <div class="field">
                                        <label for="fname">First Name</label>
                                        <br>
                                        <input type="text" name="fname" value="' . $_SESSION["userFName"] . '" required>
                                    </div>
                                    <div class="field">
                                        <label for="lname">Last Name</label>
                                        <br>
                                        <input type="lname" name="lname" value="' . $_SESSION["userLName"] . '" required>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email</label>
                                        <br>
                                        <input type="email" name="email" value="' . $_SESSION["userEmail"] . '">
                                    </div>
                                    <div class="field">
                                        <label for="address">Address</label>
                                        <br>
                                        <input type="address" name="address" value="' . $_SESSION["userAddress"] . '">
                                    </div>
                                    <div class="field">
                                        <label for="gender">Gender: </label>
                                        <select name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label for="contact">Contact Number</label>
                                        <br>
                                        <input type="contact" name="contact" value="' . $_SESSION["userContact"] . '">
                                    </div>
    
                                    <div class="form-btn">
                                        <button type="submit" name="submit">
                                            Update Profile
                                        </button>
                                    </div>
                                </form>';
                                if (isset($_GET["error"])) {
                                    if ($_GET["error"] == "emptyInput") {
                                        echo "<p>Please fill in all required fields!</p>";
                                    }
                                    if ($_GET["error"] == "invalidName") {
                                        echo "<p>Please enter a proper name!</p>";
                                    }
                                    if ($_GET["error"] == "invalidEmail") {
                                        echo "<p>Please enter a proper email!</p>";
                                    }
                                    if ($_GET["error"] == "invalidContact") {
                                        echo "<p>Please enter contact only in digits!</p>";
                                    }
                                    if ($_GET["error"] == "invalidGender") {
                                        echo "<p>Please select one of the gender option!</p>";
                                    }
                                    if ($_GET["error"] == "none") {
                                        echo "<p>You have successfully update your profile!</p>";
                                    }
                                }
                            echo'</div>
                        </div>
                    </div>
                </article>';
            }
            ?>
        </div>
    </div>
    <footer>
        <p>footer</p>
    </footer>
</body>

</html>