<!-- FOOTER -->
<section class="main-footer" id="contact">
    <footer class="footer">

        <div class="footer-enter-email">

            <div class="col--1">
                <form action="subs.php" method="POST" id="subscribe-form">
                    <input class="email" type="email" id="email" name="email" placeholder="Enter your email">
                    <button type="submit" name="submit" value="submit"><i class='bx bx-right-arrow-alt'></i></button>
                </form>
                <div id="response-message" class="response-message"></div>
            </div>
            <div class="col--2">
                <a href="https://www.facebook.com"><i class='bx bxl-facebook'></i></a>
                <a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a>
                <a href="https://www.linkedin.com/in/husnain-zafar-61a292231/"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
        <div class="footer-child">
            <div class="footer-menu">
                <h3>Menu</h3>
                <?php foreach ($menu_items['bottom-menu'] as $item) { ?>
                    <div class="footer-menu-home"><a href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="footer-instagram">
                <h3>Instagram</h3>
                <div style="display: flex;">
                    <img src="assets/images/latest-products/necklace2-removebg-preview.png" alt="">
                    <span>Diamond Necklac</span>
                </div>
                <br>
                <div style="display: flex;">
                    <div>
                        <img src="assets/images/latest-products/earring1-removebg-preview.png" alt="">
                    </div>
                    <span>Diamond EarRing</span>
                </div>
            </div>
            <div class="footer-about">
                <h3>About Us</h3>
                <p>Welcome to HEALET, where elegance and craftsmanship meet. We offer high-quality, uniquely designed
                    jewelry made from premium materials like gold, silver, and precious gemstones. </p>
            </div>
            <?php
            $setting_key = "contact";
            $menu_json = get_Settingz($setting_key);
            $menu_items = json_decode($menu_json, true);
            ?>
            <div class="footer-contactus">
                <h3>Contact Us</h3>
                <?php foreach ($menu_items['info'] as $item) { ?>
                    <div class="contactus-links">
                        <a href="#"><i class="fas fa-map-marker-alt"></i><span><?php echo $item['city']; ?></span></a>
                    </div>
                    <div class="contactus-links">
                        <a href="#"><i class="fas fa-phone"></i><span><?php echo $item['phone']; ?></span></a>
                    </div>
                    <div class="contactus-links">
                        <a href="#"><i class="fas fa-envelope"></i><span><?php echo $item['email']; ?></span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <i class="fa-regular fa-copyright"></i><span> 2024 All Rights Reserved By WebPenter.com.</span>
    </div>
    <!-- </div> -->
    <div class="go-top-btn">
        <a href="#container"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script>
    
    document.getElementById('subscribe-form').addEventListener('submit', async function (event) {
    event.preventDefault();

    var email = document.getElementById('email').value; 
    var responseMessage = document.getElementById('response-message');

    var formData = new FormData();
    formData.append('email', email);

   
        let response = await fetch('subs.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            let text = await response.text();
            if (text === 'success') {
                responseMessage.innerText = 'Subscription successful!';
                responseMessage.style.color = 'green';
            } else if (text === 'exists') {
                responseMessage.textContent = 'This email already exists!';
                responseMessage.style.color = 'orange'; 
            } else {
                responseMessage.innerText = 'An error occurred. Please try again.';
                responseMessage.style.color = 'red';
            }
        } else {
            responseMessage.innerText = 'An error occurred. Please try again.';
            responseMessage.style.color = 'red';
        }
    } 
);

</script>



</body>

</html>