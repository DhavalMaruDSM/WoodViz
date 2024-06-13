<?php
require_once 'vendor/autoload.php';

$clientID = '161838807721-nsk7kos3a1tgefuhq5hoosmnabem2pie.apps.googleusercontent.com'; // your client id
$clientSecret = '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'; // your client secret
$redirectUri = 'http://localhost/woodviz/callback.php'; // your redirect URI

// Configure Google Client
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    // Exchange the authorization code for an access token
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        // Log the raw response for debugging
        error_log('Token response: ' . print_r($token, true));

        // Check for errors in the token response
        if (isset($token['error'])) {
            throw new Exception('Error fetching the access token: ' . htmlspecialchars($token['error']));
        }

        // Check if the token is an array and contains an access_token
        if (!is_array($token) || !isset($token['access_token'])) {
            throw new Exception('Invalid token response: ' . print_r($token, true));
        }

        // Set the access token
        $client->setAccessToken($token['access_token']);

        // Get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // Display user info (you can also handle login and redirection here)
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";

    } catch (Exception $e) {
        // Handle exceptions and log errors
        error_log('Exception caught: ' . $e->getMessage());
        echo 'An error occurred: ' . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Authentication failed.";
}
?>
