<?php 
 include '../includes/header/header.php';
 include '../includes/header/sidebar.php';
 

 $tbl_name = 'tbl_banner_items';
 $row = fetch_edit_record($tbl_name);

 $id = $row['id'];
 $image_url = $row['image_url'];
 $heading = $row['heading'];
 $paragraph = $row['paragraph'];
 $btn_text = $row['btn_text'];
 $btn_color = $row['btn_color'];


?>


  <div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">

          <h5 class="mb-3 display-5 text-center">Edit Banner-Item</h5>
          <form action="update-banner-item.php" method="POST">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"><br><br>
            <label for="image">Image_Url</label>
            <input type="text" id="image" value="<?php echo $image_url; ?>" class="form-control" name="image_url"><br>
            <label for="name">heading</label>
            <input type="text" id="heading"  value="<?php echo $heading; ?>" class="form-control" name="heading" required ><br>
            <label for="description">Description</label>
            <input type="text" id="description" value="<?php echo $paragraph; ?>" class="form-control" name="paragraph" required ><br>
            <label for="price">Btn_text</label>
            <input type="text" id="btn_text" value="<?php echo $btn_text; ?>" class="form-control" name="paragraph" required ><br>
            <label for="price">Btn_Color</label>
            <input type="text" id="btn_color" value="<?php echo $btn_color; ?>" class="form-control" name="btn_color" required><br>

            <input type="hidden" name="redirect_url" value="banner-items.php">
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include '../includes/footer/footer.php'; ?>