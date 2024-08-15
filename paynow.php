<head>
  <link rel="stylesheet" href="css/checkoutstyle.css">

</head>
<div class="mainscreen">
  
  <div class="card">
    <div class="leftside">
      <img src="assets/images/bride.png" class="product" alt="" />
    </div>
    <div class="rightside">
      
        <h1>Payment Details</h1>
        <p>Cardholder Name</p>
        <input type="text" class="inputbox" name="name"  />
        <p>Card Number</p>
        <input type="number" class="inputbox" name="card_number" id="card_number"  />
        <p>Card Type</p>
        <select class="inputbox" name="card_type" id="card_type">
          <option value="">--Select a Card Type--</option>
          <option value="Visa">Visa</option>
          <option value="RuPay">RuPay</option>
          <option value="MasterCard">MasterCard</option>
        </select>
        <div class="expcvv">

          <p class="expcvv_text">Expiry</p>
          <input type="date" class="inputbox" name="exp_date" id="exp_date" required />

          <p class="expcvv_text2">CVV</p>
          <input type="password" class="inputbox" name="cvv" id="cvv" required />
        </div>
        <p></p>
        <a href="thank-you.php"><button type="submit" class="button">PAY</button></a>
      </form>
    </div>
  </div>
</div>