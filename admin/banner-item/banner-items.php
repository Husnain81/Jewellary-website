<?php
session_start();
include '../includes/header/header.php';
include '../includes/header/sidebar.php';

?>

<style>
    .heading {
        display: flex;
        justify-content: space-between;
    }

    .form-check-container {
        padding: 0 15px;
        display: flex;
        justify-content: space-between;
        width: 270px;
    }

    .heading-text {
        display: flex;
    }

    .form-check {
        padding: 10px 0px 10px 25px;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="heading">
                <div class="heading-text">
                    <h2>Main Banner Style
                    </h2>
                    <div class="form-check-container">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bannerOption" id="sliderOption"
                                value="slider" onchange="updateBannerOption(this.value)" checked>
                            <label class="form-check-label" for="sliderOption">
                                Slider
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bannerOption" id="imageOption"
                                value="image" onchange="updateBannerOption(this.value)">
                            <label class="form-check-label" for="imageOption">
                                Image
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bannerOption" id="colorOption"
                                value="color" onchange="updateBannerOption(this.value)">
                            <label class="form-check-label" for="colorOption">
                                Color
                            </label>
                        </div>
                    </div>
                </div>
                <div class="insert-button">
                    <a href="add-banner-items.php" class="btn btn-primary float-end">Insert Items</a>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const radioButtons = document.querySelectorAll('input[name="bannerOption"]');

                    radioButtons.forEach(button => {
                        button.addEventListener('change', function () {
                            const option = this.value;
                            updateBannerOption(option);
                        });
                    });
                });

                async function updateBannerOption(option) {
                console.log("Updating banner option:", option); // Debugging statement

                try {
                    const response = await fetch('update-banner-option.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `bannerOption=${option}`
                    });

                    if (response.ok) {
                        const text = await response.text();
                        console.log("Display option updated successfully:", text);
                    } else {
                        console.error('Error:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
            </script>




            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Features</th>
                        <th>Image</th>
                        <th>Id</th>
                        <th>Heading</th>
                        <th>Paragraph</th>
                        <th>Btn_text</th>
                        <th>Btn_color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /////////////////////call the function///////////////////////////////
                    $tbl_name = 'tbl_banner_items';
                    $products = get_records($tbl_name);

                    $total_pages = isset($_SESSION['total_pages']) ? $_SESSION['total_pages'] : 1;
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

                    $selectedBannerId = isset($_SESSION['selected_banner_id']) ? $_SESSION['selected_banner_id'] : null;

                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td>
                            <input type='radio' name='selected_banner_id' value='" . $product['id'] . "' " . ($product['id'] == $selectedBannerId ? "checked" : "") . " onchange='updateSelectedBanner(" . $product['id'] . ")' />
                          </td>";
                            echo "<td><img src='" . $product['image_url'] . "' alt='Product Image' width='90px' height='70px' /></td>";
                            echo "<td>" . $product['id'] . "</td>";
                            echo "<td>" . $product['heading'] . "</td>";
                            echo "<td>" . $product['paragraph'] . "</td>";
                            echo "<td>" . $product['btn_text'] . "</td>";
                            echo "<td>" . $product['btn_color'] . "</td>";

                            echo "<td>
                         
                          <a href='/Jewellery-website/admin/banner-item/edit-banner-item.php?id=" . $product['id'] . "' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i></a>
                          <form action='delete-banner-item.php' method='POST' style='display:inline;'>
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
                        echo "<li class='page-item " . ($i == $page ? "active" : "") . "'><a class='page-link' href='banner-items.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
async function updateSelectedBanner(selectedId) {
    console.log("Updating selected banner ID:", selectedId); 

    try {
        const response = await fetch('update-selected-banner.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `selected_banner_id=${selectedId}`
        });

        if (response.ok) {
            const text = await response.text();
            console.log("Selected banner ID updated successfully:", text);
        } else {
            console.error('Error:', response.statusText);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
</script>



<?php include '../includes/footer/footer.php'; ?>