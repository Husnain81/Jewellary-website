<section class="latest-products" id="products">
    <h2>LATEST PRODUCTS</h2>
    
   
    <div class="Jwellery-container">
      <!-- box1 -->
      <?php
                    $tbl_name = 'tbl_products';
                    $products = get_product($tbl_name);  
                    if (!empty($products)) {
                        foreach ($products as $product) {  ?>
      <div class="box">
        <a href="product-details/product-details.php?id=<?php echo $product['id'] ?>">
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
   
    <div class="vlp"><a href="allproducts.php">View All Products</a></div>
    
  </section>
 