<?php 
 include 'includes/header/header.php';
 include 'includes/header/sidebar.php';
?>

  <div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">

          <h5 class="mb-3 display-5 text-center">Add New Setting</h5>
          <form action="insert_setting.php" method="POST">
            <label for="setting_key">Setting Key:</label>
            <input type="text" id="setting_key" class="form-control" name="setting_key" required><br>
            <label for="setting_value">Setting Value:</label>
            <input type="text" id="setting_value" class="form-control" name="setting_value" required><br>
            <input type="hidden" name="redirect_url" value="site_settings.php">
            <button type="submit" class="btn btn-primary" name="submit2">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
<?php include 'includes/footer/footer.php'; ?>