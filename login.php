<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM tbl_users WHERE username = '$username' && password ='$password'";
    

   $result = $conn->query($query);
   if($result->num_rows>0){
      $row = $result->fetch_assoc();
      session_start();
      $_SESSION['id']=$row['id'];
      $_SESSION['username']=$row['username'];
      $_SESSION['image']=$row['image'];
      $_SESSION['password']=$row['password'];
      $_SESSION['email']=$row['email'];
      $_SESSION['phone']=$row['phone'];
      $_SESSION['city']=$row['city'];
      $_SESSION['state']=$row['state'];
   
       header('location: index.php?msg=ok');
    } else {
        echo header('location: login.php?msg=not-ok');
        exit;
    }
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