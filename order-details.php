<?php 
session_start();
include 'config/config.php';

if (isset($_GET['my-order'])) {
    $order_number = intval($_GET['my-order']);    
    $sql = "SELECT tbl_orders.id, order_no, user_id, order_date, status, total_amount, tbl_products.name AS productname, tbl_products.price AS productprice, tbl_products.description	AS productdescription, quantity, tbl_products.image
            FROM tbl_orders
            INNER JOIN tbl_order_items ON tbl_order_items.order_id = tbl_orders.id
            INNER JOIN tbl_products ON tbl_products.id = tbl_order_items.product_id
            WHERE tbl_orders.order_no = $order_number";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error fetching data: " . $conn->error);
     }
 
     if ($result->num_rows > 0) {
        
     
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- LINK TO FAV ICON -->
    <link rel="icon" type="image/png" href="assets/images/fav-icon/diamond-favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <title>Order Details</title>

</head>

<body>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo $_SESSION['image']; ?>" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3"><?php echo $_SESSION['username']; ?></h5>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0"><a href=user-orders.php>Orders</a></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg text-body"></i>
                                    <p class="mb-0"><a href=user-invoices.php>Invoices</a></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <h1 class="text-primary me-1 ml-3 mb-3">Order Details <span style="font-size:16px";>ORD#<?php echo $order_number; ?></span> </h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Order Date</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php       
                                $totalSum = 0;
                                $rowCount = 0;                         
                                while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><img src='" . $row['image'] . "' alt='Product Image' width='90px' height='70px' /></td>";
                                        echo "<td>" . $row['order_date'] . "</td>";
                                        echo "<td>" . $row['productname'] . "</td>";
                                        echo "<td>" . $row['productdescription'] . "</td>";
                                        echo "<td>" . $row['productprice'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['quantity']* $row['productprice'] . "</td>";      
                                        echo "</tr>";
                                        $totalSum = $totalSum  + $row['quantity']* $row['productprice'];
                                        $rowCount++;
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div style="float: right; padding: 15px; background-color: #d3d3d3; border-radius: 10px;" class="col-lg-5 bg-body-tertiary ">
                        <div class="">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="text-uppercase">items <?php echo $rowCount; ?></h5>
                                <h5>$ <?php 
                                            echo $totalSum;
                                            ?>
                                </h5>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-uppercase">Delivery Charges:</h6>
                                <h5>$20</h5>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="text-uppercase">Total price</h5>
                                <h5>$ <?php echo $totalSum + 20; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>