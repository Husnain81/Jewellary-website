<?php
include 'includes/header/header.php';
include 'includes/header/sidebar.php';
?>

<?php
//fetching data into the fields for update....
$tbl_name = 'tbl_site_settings';
$row = fetch_edit_record($tbl_name);
$id = $row['id'];
$setting_key = $row['setting_key'];
$setting_value = $row['setting_value'];
?>


<div class="container" id="add_new">
  <div class="row justify-content-center mt-5">
    <div class="col-12 col-lg-5">
      <div class="bg-white border rounded shadow-sm p-5">

        <h5 class="mb-3 display-5 text-center">Edit Setting</h5>
        <form action="update_setting.php" method="POST">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"><br><br>
          <label for="setting_key">Setting Key:</label>
          <input type="text" id="setting_key" class="form-control" name="setting_key"
            value="<?php echo $setting_key; ?>" required><br>
          <label for="setting_value">Setting Value:</label>
          <input type="text" id="setting_value" class="form-control" name="setting_value"
            value="<?php echo $setting_value; ?>" required><br>
          <input type="hidden" name="redirect_url" value="settings.php">
          <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include 'includes/footer/footer.php';
?>