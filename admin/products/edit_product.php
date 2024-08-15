<?php 
 include '../includes/header/header.php';
 include '../includes/header/sidebar.php';
 

 $tbl_name = 'tbl_products';
 $row = fetch_edit_record($tbl_name);

 $id = $row['id'];
 $image = $row['image'];
 $name = $row['name'];
 $description = $row['description'];
 $price = $row['price'];


?>


  <div class="container" id="add_new">
    <div class="row justify-content-center mt-5">
      <div class="col-12 col-lg-5">
        <div class="bg-white border rounded shadow-sm p-5">

          <h5 class="mb-3 display-5 text-center">Edit Product</h5>
          <form action="update_product.php" method="POST">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"><br><br>
            <label for="image">Image_Url</label>
            <input type="text" id="image" value="<?php echo $image; ?>" class="form-control" name="image"><br>
            <label for="name">Name</label>
            <input type="text" id="name"  value="<?php echo $name; ?>" class="form-control" name="name" required ><br>
            <label for="description">Description</label>
            <input type="text" id="description" value="<?php echo $description; ?>" class="form-control" name="description" required ><br>
            <label for="price">Price</label>
            <input type="number" id="price" value="<?php echo $price; ?>" class="form-control" name="price" required><br>

            <input type="hidden" name="redirect_url" value="products.php">
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include '../includes/footer/footer.php'; ?>