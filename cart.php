<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_price = isset($_POST['product_price']) ? (float)$_POST['product_price'] : 0.0;
  $product_image = $_POST['product_image'];
  $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

  // Initialize the cart if not already set
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }

  // Add the product to the cart
  $_SESSION['cart'][$product_id] = [
      'id' => $product_id,
      'name' => $product_name,
      'description' => $product_description,
      'price' => $product_price,
      'image' => $product_image,
      'quantity' => $quantity
  ];
}


include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';

///////call the fetch function/////
//////////////////////////////////
$tbl_name = 'tbl_products';
$row = fetch_edit_record($tbl_name);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cartstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <title>HEALET-Cart</title>
</head>

<body>
  <section class="h-100 h-custom" style="background-color: #F8F8FF">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted"><?php echo count($_SESSION['cart']); ?> items</h6>
                    </div>
                    <hr class="my-4">

                    <?php 
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item): 
                      $total_price += (float)$item['price'] * (int)$item['quantity'];

                    ?>
                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img src="<?php echo $item['image']; ?>" class="img-fluid rounded-3" alt="Product Image">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <h6 class="text-muted"><?php echo $item['name']; ?></h6>
                          <h6 class="mb-0">$<?php echo $item['price']; ?></h6>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                          <?php echo $item['quantity']; ?>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                          <h6 class="mb-0">$<?php echo $item['price'] * $item['quantity']; ?></h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-black">
                          <a href="delete-cart_data.php?id=<?php echo $item['id']; ?>" class="text-muted">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </div>
                      </div>
                      <hr class="my-4">
                    <?php endforeach; ?>

                    <div class="pt-5">
                      <h6 class="mb-0"><a href="index.php" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-body-tertiary">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">items <?php echo count($_SESSION['cart']); ?></h5>
                      <h5>$<?php echo $total_price; ?></h5>
                    </div>

                    <h5 class="text-uppercase mb-3">Shipping</h5>

                    <div class="mb-4 pb-2">
                      <select class="form-select">
                        <option value="1">Standard-Delivery- $20</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                      </select>
                    </div>

                    <h5 class="text-uppercase mb-3">Give code</h5>

                    <div class="mb-5">
                      <div class="form-outline">
                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea2">Enter your code</label>
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5>$<?php echo $total_price + 20; ?></h5>
                    </div>

                    <a href="checkout.php"><button type="button" class="btn btn-dark btn-block btn-lg">Register</button></a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
