<?php 
 include '../includes/header/header.php';
 include '../includes/header/sidebar.php';
 
?>

  <div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">

        <h5 class="mb-3 display-5 text-center">Add Product</h5>
          <form action="insert_product.php" method="POST" enctype="multipart/form-data">
            <label for="image">Image_Url</label>
            <input type="text" id="image" value="" class="form-control" name="image" required><br>
            <label for="name">Name</label>
            <input type="text" id="name"  value="" class="form-control" name="name" required ><br>
            <label for="description">Description</label>
            <input type="text" id="description" value="" class="form-control" name="description" required ><br>
            <label for="price">Price</label>
            <input type="number" id="price" value="" class="form-control" name="price" required><br>
            <input type="hidden" name="redirect_url" value="products.php">
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </div>
      </div>
    </div>
  </div>
  
<?php include '../includes/footer/footer.php'; ?>