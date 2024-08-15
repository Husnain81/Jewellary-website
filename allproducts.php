<!-- HEADER -->
<?php include 'inc/header/header.php'; ?>
</div>

<!-- SIDEBAR -->
<?php include 'inc/sidebar.php' ?>
</div>

<section class="latest-products">
    <h2>LATEST PRODUCTS</h2>
    
   
    <div class="Jwellery-container">
      <!-- box1 -->
      <?php
                    $tbl_name = 'tbl_products';
                    $products = get_records($tbl_name);
                    if (!empty($products)) {
                        foreach ($products as $product) {  ?>
      <div class="box">
        <a href="product-details/product-details.php">
          <div class="box-img">
          <span class="new">NEW</span>
          <img src="<?php echo $product['image']; ?>" alt="" />
        </div>
        <div class="name-price">
          <p><?php echo $product['name']; ?></p>
          <p>Price $ <span><?php echo $product['price']; ?></span></p>
        </div>
      </a>
      </div>
      <?php
  }
} else {
    echo "<tr><td colspan='4'>0 results</td></tr>";
}
?>
      
    </div>
   
   
    
  </section>

  <!-- FOOTER -->
<?php include 'inc/footer/footer.php'; ?>