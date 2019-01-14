<!DOCTYPE HTML>
<html lang="en">
<?php session_start();
unset($_SESSION['signed']);
unset($_SESSION['pwPass']);
unset($_SESSION['nameNull']);
?>
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/sticky.css"/>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/uikit.js"></script>
    <script src="../js/components/sticky.js"></script>
    <script src="../Validation/signIn.js"></script>

</head>
<body>
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
                <a href="../Index/index.php"><i class="uk-icon-bars"></i> Words</a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li><a href="../MemorizeWord/memorizeWords.php?section=1">Section 1</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=2">Section 2</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=3">Section 3</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=4">Section 4</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=5">Section 5</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=6">Section 6</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=7">Section 7</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=8">Section 8</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=9">Section 9</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=10">Section 10</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=11">Section 11</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=12">Section 12</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="">Review</a></li>
            <li><a href="../Upload/upload.php">Upload your own list</a></li>
        </ul>
        <div class="uk-navbar-flip uk-hidden-small">
            <ul class="uk-navbar-nav">
                <li><a href="login.php">Login</a></li>
                <li><a href="signUp.php">Sign up</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="uk-margin-large-top">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-medium-1-1 uk-width-large-1-1 uk-width-small-1-1">
                <h1 class="uk-h2 uk-text-center">User Login</h1>
                <div class="uk-container-center uk-width-medium-2-5 uk-width-large-3-10 uk-width-small-3-5 uk-margin-large-top">
                    <form id="form_user" action="loginAction.php" method="post" class="uk-form uk-form-stacked">
                        <div class="uk-form-row">
                            <label class="uk-form-label">Username</label>
                            <div class="uk-form-controls">
                                <input id="input_userID" type="text" name="username" value=""
                                       class="uk-form-large uk-width-1-1" maxlength="40">
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">Password</label>
                            <div class="uk-form-controls">
                                <input id="input_userPW" type="password" name="password" value=""
                                       class="uk-form-large uk-width-1-1" maxlength="40">
                            </div>
                        </div>
                        <button onclick="submitForm()" type="button"
                                class="uk-button uk-button-primary uk-width-1-1 uk-button-large uk-margin-top loader">
                            Login
                        </button>
                        <!--                        <div class="uk-grid uk-text uk-margin-large-top">-->
                        <!--                            <div class="uk-width-1-1 uk-align-center">-->
                        <!--                                <input type="checkbox" name="remember_me" value="yes"> Remember me? -->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="uk-grid">
                            <div class="uk-width-1-1 uk-margin-top uk-text-right">
                                Don't have an account? <a href="signUp.php">Sign up</a>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (!isset($_SESSION['userExisted']) || $_SESSION['userExisted'] === true) {
                        if (!isset($_SESSION['userPass']) || $_SESSION['userPass'] === true) {
                        } else {
                            echo "<div class='uk-alert uk-alert-danger uk-text-center'>Your password is wrong.</div>";
                        }
                    } else {
                        echo "<div class='uk-alert uk-alert-danger uk-text-center'>This user does not exist.</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>