<?php
include '../config/config.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM tbl_users WHERE username = '$username' && password ='$password'";
    

    $data = mysqli_query($conn, $query); 
    $total = mysqli_num_rows($data);

    if ($total > 0) {
        session_start();
        $_SESSION['username'] = $username; 
        header('location:index.php?msg=ok');
        exit();
    } else {
        echo header('location: login.php?msg=not-ok');
        exit;
    }
}
?>
   <?php
    // logout session-end
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['auth_user']);
        $_SESSION['status'] = "You are now logged out";
         header("Location: index.php?msg=you-are-logout");
        exit;
    }

            // logout session-end
            if (isset($_POST['logout_btn'])) {
                session_destroy();
                unset($_SESSION['auth']);
                unset($_SESSION['auth_user']);
                $_SESSION['status'] = "You are now logged out";
                 header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
            }
            
?>



<!-- Login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Jewelry System</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body style="background-image: linear-gradient(black, white, orange);">
<div class="container" id="add_new" style="margin-top: 7%; ">
  <div class="row justify-content-center">
    <div class="col-4 col-lg-4">
      <div style="background-color: #000; color: #fff;" class="border rounded shadow-sm p-5">
        <h5 style="color: #fff;" class="mb-3 display-6 text-center">Login</h5>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <label style="color: #fff;" for="username">Username:</label>
          <input style="color: #000000;" type="text" id="username" class="form-control" name="username">
          <label style="color: #fff;" for="password">Password:</label>
          <input style="color: #000000;" type="password" id="password" class="form-control" name="password"><br>
          <button style="color: #fff;" type="submit" class="btn btn-primary" name="submit">Sign in</button>
          <p style="color: #fff;" class="text-center">Don't have an account? <a href="register.php">Register</a></p>
          <?php if (isset($error)) { echo "<p style='color: #fff;'>$error</p>"; } ?>
        </form>
      </div>
    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlHj1/4A+ui9wzXbFfRvH+8abtTE1pi6jizo/YdPwXQf0hyy5D4e4Te6fj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGqKtv3z8G8a37bR0eI5vs/9OQ4yLGVRhmebXYne8B/6KUUHBYQ4G1rN/3E" crossorigin="anonymous"></script>
</body>
</html>