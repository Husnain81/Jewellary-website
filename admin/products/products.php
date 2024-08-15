<?php
include '../includes/header/header.php';
include '../includes/header/sidebar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-9">
            <h2>Products
                <a href="add_product.php" class="btn btn-primary float-end">Insert Product</a>

            </h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Decription</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /////////////////////call the function///////////////////////////////
                    $tbl_name = 'tbl_products';
                    $products = get_records($tbl_name);

                    $total_pages = isset($_SESSION['total_pages']) ? $_SESSION['total_pages'] : 1;
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td><img src='" . $product['image'] . "' alt='Product Image' width='90px' height='70px' /></td>";
                            echo "<td>" . $product['id'] . "</td>";
                            echo "<td>" . $product['name'] . "</td>";
                            echo "<td>" . $product['description'] . "</td>";
                            echo "<td>" . "$" . $product['price'] . "</td>";

                            echo "<td>
                         
                          <a href='/Jewellery-website/admin/products/edit_product.php?id=" . $product['id'] . "' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i></a>
                          <form action='delete_product.php' method='POST' style='display:inline;'>
                              <input type='hidden' name='id' value='" . $product['id'] . "'>
                              <button type='submit' class='btn btn-warning mx-1'><i class='fa-solid fa-trash'></i></button>
                          </form>
                      </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- pagination -->
            <nav>
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? "active" : "") . "'><a class='page-link' href='products.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>



<?php include '../includes/footer/footer.php'; ?>