<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <link rel="stylesheet" href="prod.css">
</head>
<body>
<?php include("nav.php"); ?>
        <br><br><br>
<!--dog food-->
  <main class="product-page">
    <div class="product">
      <img src="images/dog.jpeg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Dog Food</h2>
        <p class="product-description">This premium dog food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='dog_page.php';">View More</button>

      </div>
    </div>
  </main>
  <!--cat food-->
  <main class="product-page">
    <div class="product">
      <img src="images/cat.jpeg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Cat Food</h2>
        <p class="product-description">This premium cat food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='cat_page.php';">View More</button>
      </div>
    </div>
  </main>

<!--bird food-->

  <main class="product-page">
    <div class="product">
      <img src="images/bird.jpeg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Bird Food</h2>
        <p class="product-description">This premium bird food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='bird_page.php';">View More</button>
      </div>
    </div>
  </main>

<!--fish food-->

  <main class="product-page">
    <div class="product">
      <img src="images/fish.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Fish Food</h2>
        <p class="product-description">This premium fish food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='fish_page.php';">View More</button>
      </div>
    </div>
  </main>

  <!--rabbit food-->

  <main class="product-page">
    <div class="product">
      <img src="images/rabbit.jpeg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Rabbit Food</h2>
        <p class="product-description">This premium rabbit food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='rabbit_page.php';">View More</button>
      </div>
    </div>
  </main>

  <!--turtle-->
  <main class="product-page">
    <div class="product">
      <img src="images/turtle.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium turtle Food</h2>
        <p class="product-description">This premium turtle food is packed with nutrients and flavors your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='turtle_page.php';">View More</button>

      </div>
    </div>
  </main>
  <main class="product-page">
    <div class="product">
      <img src="images/access.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Elegant and Premium Accessory</h2>
        <p class="product-description">This premium accessories your pet will love.</p>
        <!-- <p class="product-price">$29.99</p> -->
        <button class="view-more" onclick="location.href='acces.php';">View More</button>
      </div>
    </div>
  </main>
  <!-- footer -->
  <?php include("footer.php"); ?>
</body>
</html>
