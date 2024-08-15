<?php 
include '../includes/header/header.php';
include '../includes/header/sidebar.php';
?>
<?php

// $username = '';
// $password = '';

// // Check if an id is provided to fetch the setting
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
    
//     // Fetch the current setting
//     $sql = "SELECT username, password FROM tbl_users WHERE id = $id";
//     $result = $conn->query($sql);
    
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $username = $row['username'];
//         $password = $row['password'];
//     } else {
//         die("Invalid setting ID.");
//     }
// }



$tbl_name = 'tbl_users';
$row = fetch_edit_record($tbl_name);
$id = $row['id'];
$username = $row['username'];
$password = $row['password'];
?>


<div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">
          <h5 class="mb-3 display-5 text-center">Edit User</h5>
          <form action="update_user.php" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"><br><br>
            <label for="username">Username:</label>
            <input type="text" id="username" class="form-control" name="username" value="<?php echo $username; ?>" required><br>
            <label for="passsword">Password:</label>
            <input type="password" id="password" class="form-control" name="password" value="<?php echo $password; ?>" required><br>
            <input type="hidden" name="redirect_url" value="users.php">
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlHj1/4A+ui9wzXbFfRvH+8abtTE1pi6jizo/YdPwXQf0hyy5D4e4Te6fj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGqKtv3z8G8a37bR0eI5vs/9OQ4yLGVRhmebXYne8B/6KUUHBYQ4G1rN/3E" crossorigin="anonymous"></script>

<?php
include '../includes/footer/footer.php';
?>
