
<?php   
include $_SERVER['DOCUMENT_ROOT'].'/jewellery-website/config/config.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/jewellery-website/admin/functions.php';           
            $setting_key = "contact";
            $menu_json = get_Settingz($setting_key);
            $menu_items = json_decode($menu_json, true);
 ?>
<?php 
session_start();
include 'config/config.php';

if (isset($_GET['my-invoice'])) {
    $invoice_number = intval($_GET['my-invoice']);    
    $sql = "SELECT tbl_invoices.id, invoice_no, tbl_invoices.status, tbl_invoices.order_no, user_id, date, total_amount,tbl_products.name AS productname,tbl_products.price AS productprice, quantity
            FROM tbl_invoices
            INNER JOIN tbl_orders ON tbl_orders.order_no = tbl_invoices.order_no
            INNER JOIN tbl_order_items ON tbl_order_items.order_id = tbl_orders.id
            INNER JOIN tbl_products ON tbl_products.id = tbl_order_items.product_id
            WHERE tbl_invoices.invoice_no = $invoice_number";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error fetching data: " . $conn->error);
     }
 
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK TO FAV ICON -->
    <link rel="icon" type="image/png" href="assets/images/fav-icon/diamond-favicon.png">
    <title>Invoice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <style>
    body {
        margin-top: 20px;
        background-color: #eee;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        border-radius: 1rem;
    }
    </style>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-15"><span
                                        class="badge bg-success font-size-12 ms-2"><?php echo $row['status']; ?></span>
                                </h4>
                                <div class="mb-4">
                                    <h2 class="mb-1 text-muted">HEALET</h2>
                                </div>
                                <?php foreach ($menu_items['info'] as $item) { ?>
                                <div class="text-muted">
                                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> <?php echo $item['city']; ?></p>
                                    <p class="mb-1"><i class="fas fa-envelope me-1"></i> <?php echo $item['email']; ?></p>
                                    <p><i class="fas fa-phone me-1"></i> <?php echo $item['phone']; ?></p>
                                </div>
                                <?php }?>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-3">Billed To:</h5>
                                        <h5 class="font-size-15 mb-2"><?php echo $_SESSION['username']; ?></h5>
                                        <p class="mb-1"><?php echo $_SESSION['city']; ?></p>
                                        <p class="mb-1"><?php echo $_SESSION['email']; ?></p>
                                        <p><?php echo $_SESSION['phone']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <div class="text-muted">
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>INVO#<?php echo $row['invoice_no']; ?></p>
                                        <h5 class="font-size-15 mb-1 mt-4">Invoice Date:</h5>
                                        <p><?php echo $row['date']; ?></p>
                                        <h5 class="font-size-15 mb-1 mt-4">Order No:</h5>
                                        <p>ORD#<?php echo $row['order_no']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <h5 class="font-size-15">Order Summary</h5>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">Order No.</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    // Reset the result pointer and loop through all rows
                                    $result->data_seek(0);
                                    $total = 0;
                                    while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <th scope="row">ORD#<?php echo $row['order_no']; ?></th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 mb-1">
                                                            <?php echo $row['productname']; ?></h5>
                                                        
                                                    </div>
                                                </td>
                                                <td>$ <?php echo $row['productprice'] ?></td>
                                                <td><?php echo $row['quantity'] ?></td>
                                                <td class="text-end">$ <?php echo $row['quantity']* $row['productprice']; ?></td>
                                            </tr>
                                            <?php  
                                    $total = $total + $row['quantity']* $row['productprice'];   }
                                ?>




                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total:</th>
                                                <td class="text-end">$<?php echo $total; ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Shipping Charge:</th>
                                                <td class="border-0 text-end">$20</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Service Charges:</th>
                                                <td class="border-0 text-end">$10</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total Amount:</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0 fw-semibold">$<?php echo $total + 20 + 10; ?>
                                                    </h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                                class="fa fa-print"></i></a>
                                        <!-- <a href="#" class="btn btn-primary w-md">Send</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php      
           }
        }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>