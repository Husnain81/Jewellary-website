<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php';
// include '/jewellery-website/functions.php';

// get settings function
function get_Settings($setting_key)
{
    global $conn;
    $query = "SELECT setting_value FROM tbl_site_settings WHERE setting_key = '$setting_key'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['setting_value'];
    } else {
        return null; // or handle error accordingly
    }
}
?>
<?php

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!isset($_SESSION['current_product_id']) || $_SESSION['current_product_id'] !== $product_id) 
{
    $_SESSION['quantity'] = 1;
    $_SESSION['current_product_id'] = $product_id;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['increase'])) {
        $_SESSION['quantity']++;
    } elseif (isset($_POST['decrease']) && $_SESSION['quantity'] > 1) {
        $_SESSION['quantity']--;
    }
}
$quantity = $_SESSION['quantity'];


?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- link to css -->
  <link rel="stylesheet" href="../style.css">
</head>

<body>
 

<!-- Nav Bar full code -->
<div class="" id="fixnav">
    <div class="nav">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/inc/header/logo.php'; ?>
        <div class="center-nav-bar">
            <?php
            $setting_key = "menu";
            $menu_json = get_Settings($setting_key);
            $menu_items = json_decode($menu_json, true);
            if (isset($menu_items['top-menu'])) {
                foreach ($menu_items['top-menu'] as $item) { ?>
                    <a href="<?php echo $item['link']; ?>"><span><?php echo $item['name']; ?></span>
                        <div class="hover-line"></div>
                    </a>
                <?php }
            } else {
                echo "Menu items not found.";
            }
            ?>
        </div>
       
        <div class="dropdown">
            <button onclick="toggleDropdown()" class="dropbtn"><i class="fa-solid fa-bars"></i></button>
            <div id="myDropdown" class="dropdown-content">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="profile.php">Profile</a>
                <?php endif; ?>
                <!-- <a href="#link2">Help</a>
                <a href="#link2">Settings</a> -->
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="logout.php">Log Out</a>
                <?php else: ?>
                    <a href="login.php">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php
$sql = "SELECT setting_value FROM tbl_site_settings WHERE setting_key = 'bannerOption'";
$resultOption = $conn->query($sql);

$displayOption = $resultOption->num_rows > 0 ? $resultOption->fetch_assoc()['setting_value'] : null;

// Fetch the selected banner ID
$sqlId = "SELECT setting_value FROM tbl_site_settings WHERE setting_key = 'selectedBannerId'";
$resultId = $conn->query($sqlId);

$selectedBannerId = $resultId->num_rows > 0 ? $resultId->fetch_assoc()['setting_value'] : null;




    // Check the value of displayOption and render the appropriate content
    if ($displayOption == 'slider') {
        ?>
        <div class="container-fluid" id="container">
            <?php
            $tbl_name = 'tbl_banner_items';
            $items = get_images($tbl_name);
            if (!empty($items)) {
                foreach ($items as $index => $item) {
                    ?>
                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $item['image_url']; ?>" alt="">
                        <div class="content">
                            <div class="text">
                                <h1><?php echo $item['heading']; ?></h1>
                                <p><?php echo $item['paragraph']; ?></p>
                                <button class="button"
                                    style="color: black; background-color: <?php echo $item['btn_color']; ?>;"><?php echo $item['btn_text']; ?></button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No images found.</p>";
            }
            ?>
        </div>
        <?php
    } elseif ($displayOption == 'image' && $selectedBannerId) {
        ?>
        <div class="container-fluid" id="container">
            <?php
            $tbl_name = 'tbl_banner_items';
            $item = get_image_by_id($tbl_name, $selectedBannerId); // Assuming you want the image with ID 1
            if (!empty($item)) {
                ?>
                <div class="image-option">
                    <img src="<?php echo $item['image_url']; ?>" alt="">
                    <div class="content">
                        <div class="text">
                            <h1><?php echo $item['heading']; ?></h1>
                            <p><?php echo $item['paragraph']; ?></p>
                            <button class="button"
                                style="color: black; background-color: <?php echo $item['btn_color']; ?>;"><?php echo $item['btn_text']; ?></button>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "<p>No image found.</p>";
            }
            ?>
        </div>
        <?php
    } elseif ($displayOption == 'color' && $selectedBannerId) {
        ?>
        <div class="container-fluid" id="container">
            <?php
            $tbl_name = 'tbl_banner_items';
            $item = get_image_by_id($tbl_name, $selectedBannerId); // Assuming you want the color from the image with ID 1
            if (!empty($item)) {
                ?>
                <div class="color-option" style="background-color: <?php echo $item['btn_color']; ?>;">
                    <p></p>
                    <div class="content">
                        <div class="text">
                            <h1><?php echo $item['heading']; ?></h1>
                            <p><?php echo $item['paragraph']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "<p>No color found.</p>";
            }
            ?>
        </div>
        <?php
    } else {
        echo "<p>Invalid display option selected.</p>";
    }
?>






<style>
    /* Dropdown container */
    .dropdown {
        position: relative;
        display: inline-block;
        z-index: 3;
    }

    /* Dropdown button */
    .dropbtn {
        font-size: 30px;
        background: none;
        color: #fff;
        border: none;
        cursor: pointer;
        padding-left: 180px;
    }

    /* Dropdown content (hidden by default) */
    .dropdown-content {
        display: none;
        border-radius: 5px;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        border-radius: 5px;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Show the dropdown menu on button click */
    .show {
        display: block;
    }
</style>
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
<script>
    function toggleDropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        let currentSlide = 0;

        function showNextSlide() {
            slides[currentSlide].classList.remove('active');
            slides[currentSlide].classList.add('prev');

            currentSlide = (currentSlide + 1) % slides.length;

            if (currentSlide === 0) {
                slides.forEach((slide) => slide.classList.remove('prev', 'active'));
                slides[currentSlide].classList.add('active');
            } else {
                slides[currentSlide].classList.remove('prev');
                slides[currentSlide].classList.add('active');
            }
        }

        setInterval(showNextSlide, 5000);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.button');

        buttons.forEach(button => {
            if (!button.textContent.trim()) {
                button.style.display = 'none';
            }
        });
    });

</script>







  <?php
 
 
  ///////call the fetch function/////
//////////////////////////////////
  $tbl_name = 'tbl_products';
  $row = fetch_edit_record($tbl_name);
  ?>
  <!-- product details -->
  <div class=" bg-img max-w-4xl mx-auto p-4">
    <div class="flex flex-col md:flex-row">
      <div class="md:w-1/2">
        <img style="height: 800px;" src="<?php echo $row['image'] ?>" alt="Product Image"
          class="w-full h-auto rounded-lg">
      </div>
      <div class="md:w-1/2 md:pl-8 mt-4 md:mt-0">
        <h1 class="text-2xl font-bold text-secondary"><?php echo $row['name'] ?></h1>
        <div class="flex items-center mt-2">
          <span class="text-2xl font-semibold text-yellow-600"><?php echo $row['price'] ?></span>
          <span class="text-zinc-500 line-through ml-4"><?php echo $row['old_price']?></span>
          <span class="bg-yellow-500 text-white text-xs font-bold ml-2 px-2 py-1 rounded">SAVE 20%</span>
        </div>
        <div class="flex items-center mt-2">
          <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.392 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.392-2.46a1 1 0 00-1.176 0l-3.392 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z">
              </path>
            </svg>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.392 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.392-2.46a1 1 0 00-1.176 0l-3.392 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z">
              </path>
            </svg>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.392 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.392-2.46a1 1 0 00-1.176 0l-3.392 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z">
              </path>
            </svg>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.392 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.392-2.46a1 1 0 00-1.176 0l-3.392 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z">
              </path>
            </svg>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.392 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.392-2.46a1 1 0 00-1.176 0l-3.392 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z">
              </path>
            </svg>
          </div>
          <span class="ml-2 text-zinc-600">(3 reviews)</span>
        </div>
        <div class="mt-4">
          <h2 class="text-lg font-semibold text-secondary">Choose Your Color:</h2>
          <div class="flex mt-2">
            <button class="bg-black text-white px-4 py-2 rounded mr-2">Multi</button>
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded mr-2">Champagne</button>
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded mr-2">Maroon</button>
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded">Green</button>
          </div>
        </div>
        <div class="mt-4">
          <h2 class="text-lg font-semibold text-secondary">Quantity:</h2>
          <div class="flex items-center mt-2">
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded-l" id="decreaseBtn">-</button>
            <input type="text" id="quantityInput"
              class="w-12 text-center border-t border-b border-zinc-200 text-secondary" value="<?php echo $quantity; ?>"  readonly>
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded-r" id="increaseBtn">+</button>
          </div>
        </div>

        <form method="POST" action="../cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
          <input type="hidden" name="product_description" value="<?php echo $row['description']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
          <input type="hidden" name="quantity" id="formQuantityInput" value="<?php echo $quantity; ?>"> <!-- Default quantity -->
          <button type="submit" class="bg-black text-white px-8 py-3 mt-6 rounded w-full">ADD TO CART</button>
        </form>
      </div>
    </div>
  </div>

</body>

</ht>

<script>
    const decreaseBtn = document.getElementById('decreaseBtn');
    const increaseBtn = document.getElementById('increaseBtn');
    const quantityInput = document.getElementById('quantityInput');
    const formQuantityInput = document.getElementById('formQuantityInput');

    decreaseBtn.addEventListener('click', function() {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        formQuantityInput.value = quantityInput.value; // Update hidden input value
      }
    });

    increaseBtn.addEventListener('click', function() {
      let currentValue = parseInt(quantityInput.value);
      quantityInput.value = currentValue + 1;
      formQuantityInput.value = quantityInput.value; // Update hidden input value
    });
  </script>