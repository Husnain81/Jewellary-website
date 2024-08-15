<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';
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
<!-- Nav Bar full code -->
<div class="" id="fixnav">
    <div class="nav">
        <?php include 'logo.php'; ?>
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
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                <span><?php echo $_SESSION['username']; ?></span>
                <img src="<?php echo $_SESSION['image']; ?>" alt="User Image"
                    style="width:50px; height:50px; border-radius:50%; margin-left:15px; display: inline;">
            <?php endif; ?>
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
    /* Adjusted Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
    z-index: 1000; /* Ensure the dropdown appears on top */
}

/* Dropdown button */
.dropbtn {
    font-size: 30px;
    background: none;
    color: #fff;
    border: none;
    cursor: pointer;
    /* Remove or adjust the padding */
    padding-left: 20px;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    border-radius: 5px;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    position: absolute;
    right: 0; /* Align to the right of the dropdown button */
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1000; /* Ensure the dropdown appears on top */
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