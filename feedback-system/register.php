<?php
session_start();
include("includes/functions.php");

if (isset($_SESSION['student_login'])) {
    header("location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, 
    initial-scale=1" />
    <link rel="stylesheet" href="assets/css/style-reg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <title>Student Registration</title>
</head>

<body>
    <div class="kt-div w-75">
        <div class="kt-logo"></div>
        <div class="kt-title">Student Registration</div>

        <form method="POST" action="register.php" class="kt-form">
            <div class="error-box" style="display: <?php echo (!empty($errors)) ? "block" : "none"; ?>">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                        echo $value . "<br>";
                    }
                } else {
                    echo "";
                }
                ?>
            </div>
            <div class="kt-input-block">
                <div class="kt-name">
                    <object type="image/svg+xml" data="assets/img/svg/user.svg"></object>
                    <input type="text" placeholder="Enter Name" name="name" />
                </div>
                <div class="kt-email">
                    <object type="image/svg+xml" data="assets/img/svg/email.svg"></object>
                    <input type="email" placeholder="Enter Email" name="email" />
                </div>
            </div>

            <div class="kt-input-block">
                <div class="kt-password">
                    <object type="image/svg+xml" data="assets/img/svg/password.svg"></object>
                    <input type="password" placeholder="Enter Password" name="password" />
                </div>
                <div class="kt-phone">
                    <object type="image/svg+xml" data="assets/img/svg/phone.svg"></object>
                    <input type="text" placeholder="Enter Phone Number" name="phone" />
                </div>
            </div>

            <div class="kt-input-block kt-div">
                <div class="kt-question">
                    <div class="kt-text">
                        Select Branch:
                    </div>
                    <div class="radiogroup">
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="me" value="Mechanical Engineering" />
                            <label class="label" for="me">
                                <div class="indicator"></div>
                                <span class="text">Mechanical Engineering</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="etc" value="E &amp; TC Engineering" />
                            <label class="label" for="etc">
                                <div class="indicator"></div>
                                <span class="text">E &amp; TC Engineering</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="pe" value="Production Engineering" />
                            <label class="label" for="pe">
                                <div class="indicator"></div>
                                <span class="text">Production Engineering</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="ce" value="Computer Engineering" />
                            <label class="label" for="ce">
                                <div class="indicator"></div>
                                <span class="text">Computer Engineering</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="it" value="Information Technology" />
                            <label class="label" for="it">
                                <div class="indicator"></div>
                                <span class="text">Information Technology</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="branch" id="mca" value="MCA" />
                            <label class="label" for="mca">
                                <div class="indicator"></div>
                                <span class="text">MCA</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-input-block kt-div">
                <div class="kt-question">
                    <div class="kt-text">
                        Select Year:
                    </div>
                    <div class="radiogroup">
                        <div class="wrapper">
                            <input class="state" type="radio" name="year" id="first" value="First" />
                            <label class="label" for="first">
                                <div class="indicator"></div>
                                <span class="text">First</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="year" id="second" value="Second" />
                            <label class="label" for="second">
                                <div class="indicator"></div>
                                <span class="text">Second</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="year" id="third" value="Third" />
                            <label class="label" for="third">
                                <div class="indicator"></div>
                                <span class="text">Third</span>
                            </label>
                        </div>
                        <div class="wrapper">
                            <input class="state" type="radio" name="year" id="fourth" value="Fourth" />
                            <label class="label" for="fourth">
                                <div class="indicator"></div>
                                <span class="text">Fourth</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-input-block">

            </div>

            <button type="submit" name="register" class="kt-button">
                Register</button>
            <div class="kt-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </form>
</body>

</html>