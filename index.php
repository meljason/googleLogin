<?php
include 'config.php';

$login_button = '';

if (isset($_GET['code'])) {
    $token = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $googleClient->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($googleClient);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email'] = $data['email'];
        }

    }
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $googleClient->createAuthUrl() . '">Login with google</a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with google</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Lab 5 API Call - Google Login System</span>
        </nav>
    </header>
    <div class="container">
        <div class="row justify-content-center>">
            <div class="col-md-3">
                <?php
if ($login_button == '') {
    echo '<div class="panel-heading">Welcome ' . $_SESSION["user_first_name"] . '</div><div class="panel-body">';
    echo '<h3><b>Name: </b>' . $_SESSION["user_first_name"] . ' ' . $_SESSION['user_last_name'] . '</h3>';
    echo '<h3><b>Email: </b>' . $_SESSION["user_email"] . '</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
} else {
    echo '<div align="center">' . $login_button . '</div>';
}
?>
            </div>
        </div>
    </div>
</body>
</html>