<?php
include 'config/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    $query = "INSERT INTO tbl_users (username, password,email,phone,city,state) VALUES ('$username', '$password','$email','$phone','$city','$state')";
    $result = $conn->query($query);

    if ($result) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit;
    } else {
        $error = "Registration failed";
    }
}

?>

<!-- Registration form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Jewelry System</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="background-image: linear-gradient(black, white, orange);">
    <div class="container" id="add_new" style="margin-top: 7%; ">
        <div class="row justify-content-center">
            <div class="col-4 col-lg-4">
                <div style="background-color: #000; color: #fff;" class="border rounded shadow-sm p-5">
                    <h5 style="color: #fff;" class="mb-3 display-6 text-center">Register</h5>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <label style="color: #fff;" for="username">Username:</label>
                        <input style="color: #000000;" type="text" id="username" class="form-control" name="username">
                        <label style="color: #fff;" for="password">Password:</label>
                        <input style="color:#000000;" type="password" id="password" class="form-control" name="password">
                        <label style="color: #fff;" for="email">email:</label>
                        <input style="color: #000000;" type="text" id="email" class="form-control" name="email">
                        <label style="color: #fff;" for="phone">Phone:</label>
                        <input style="color: #000000;" type="text" id="phone" class="form-control" name="phone">
                        <label style="color: #fff;" for="city">City:</label>
                        <input style="color: #000000;" type="text" id="city" class="form-control" name="city">
                        <label style="color: #fff;" for="state">State:</label>
                        <input style="color: #000000;" type="text" id="state" class="form-control" name="state"><br>
                        <button style="color: #fff;" type="submit" class="btn btn-primary"
                            name="submit">Register</button>
                        <p style="color: #fff;" class="text-center">Already have an account? <a
                                href="login.php">Login</a></p>
                        <?php if (isset($error)) {
                            echo "<p style='color: #fff;'>$error</p>";
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>