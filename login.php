<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
</head>
<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$clientID = $_ENV['clientID'];
$clientSecret = $_ENV['clientSecret'];
$redirectUri = $_ENV['redirectUri'];
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

$loginUrl = $client->createAuthUrl();
?>

<body id="login-body">
    <div class="container d-flex align-items-center justify-content-center login-container">
        <div class="login-card col-md-6 col-lg-4">
            <h2 class="text-center fw-bold fs-1">Login</h2>
            <p class="text-center text-secondary fst-italic fs-5 mb-5">Hey, Welcome Back!</p>

            <form id="form" action="php/login.php" method="POST" onsubmit="validateForm()">
                <!--Email/Username-->
                <div class="mb-3">
                    <input type="text" class="form-control rounded-field" name="email" id="email" placeholder="Email/Username">
                    <div class="error text-danger ms-2 mt-1"></div>

                </div>

                <!--Password-->
                <div class="mb-3">
                    <input type="password" class="form-control rounded-field" name="password" id="password" placeholder="Password">
                    <div class="error text-danger ms-2 mt-1"></div>

                </div>

                <!--Forgot Password-->
                <div class="mb-3 ms-2 text-start">
                    <a href="#" class="text-decoration-none text-secondary fst-italic">Forgot password?</a>
                </div>

                <!--Sign in Button-->
                <button type="submit" class="btn w-100 mb-3 rounded-btn signin-btn fw-bold" name="signin">Sign In</button>

                <p class="text-center mb-3 mt-3 fst-italic text-secondary">Or signup with</p>

                <!--Google signup-->
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn google-btn rounded-btn fs-5">
                        <a class="text-decoration-none text-black" href="<?php echo $loginUrl ?>"><img src="assets/resources/google.png" alt="Google logo">
                            Google</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center">
        <h6 class="fw-bold">Copyright &copy; 2024 ADS Vizion</h6>
    </div>

    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>