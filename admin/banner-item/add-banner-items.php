<?php 
 include '../includes/header/header.php';
 include '../includes/header/sidebar.php';

?>

  <div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">

        <h5 class="mb-3 display-5 text-center">Add-Banner-Items</h5>
          <form action="insert-banner-item.php" method="POST" enctype="multipart/form-data">
            <label for="image">Image_Url</label>
            <input type="text" id="image" value="" class="form-control" name="image_url" required><br>
            <label for="Heading">Heading</label>
            <input type="text" id="heading"  value="" class="form-control" name="heading" required ><br>
            <label for="Paragraph">Paragraph</label>
            <input type="text" id="btn_text" value="" class="form-control" name="btn_text" required ><br>
            <label for="btn">Btn-text</label>
            <input type="text" id="btn_color" value="" class="form-control" name="btn_color" required ><br>
            <label for="btn">Btn-Color</label>
            <input type="text" id="btn_color" value="" class="form-control" name="btn_color" required><br>
            <input type="hidden" name="redirect_url" value="banner-items.php">
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </div>
      </div>
    </div>
  </div>
  
<?php include '../includes/footer/footer.php'; ?>