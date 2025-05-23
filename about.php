
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="about.css" />
    <title>ABOUT</title>
  </head>
  <body>
     
  <?php
    // navbar connection
    include("nav.php");
  ?>
<header class="header__container">
      <div class="header__image">
        <img src="images/abt.jpeg" alt="header" />
      </div>
      <div class="header__content">
        <h1>Your One-Stop Platform for<span> Pet Food </span>& Accessories </h1>
        <h3>
        Welcome to Pets Pantry, your one-stop destination for premium pet food and accessories. We believe that pets are not just animals—they’re family. Our mission is to provide high-quality, nutritious food and stylish accessories that help your pet live a happy and healthy life.
</h3>
         
      </div>
    </header>

    <div class="container">
       
      <div class="destination__container">
        <img class="bg__img__1" src="photo/about.jpg" alt="bg" />
        <img class="bg__img__2" src="images/aboutbggg.jpg" alt="bg" />
        <div class="socials">
          <span><i class="ri-twitter-fill"></i></span>
          <span><i class="ri-facebook-fill"></i></span>
          <span><i class="ri-instagram-line"></i></span>
          <span><i class="ri-youtube-fill"></i></span>
        </div>
        <div class="content">
          <h1>MEET OUR <span>MEMBERS</span></h1>
          <h3>
          At Pets Pantry, we’re not just a team—we’re a family of passionate pet lovers dedicated to providing the best for your furry, feathered, or scaly companions. Each member brings a unique set of skills, experience, and love for animals to ensure that your pets receive the care they deserve. Get to know the faces behind the brand!
          </h3>
           
        </div>
        <div class="destination__grid">
          <div class="destination__card">
            <img src="images/archita verma.jpg" alt="destination" />
            <div class="card__content">
              <h4>ARCHITA VERMA</h4>
               
            </div>
          </div>
          <div class="destination__card">
            <img src="images/nausheen.jpg" alt="destination" />
            <div class="card__content">
              <h4>NAUSHEEN FAROOUQI</h4>
               
            </div>
          </div>
          <div class="destination__card">
            <img src="images/priya sharan.jpg" alt="destination" />
            <div class="card__content">
              <h4>PRIYA SHARAN</h4>
               
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class = "contact-section">
      <div class = "contact-bg">
        <h3>Get in Touch with Us</h3>
        <h2>contact us</h2>
        <div class = "line">
          <div></div>
          <div></div>
          <div></div>
        </div>
        <p class = "text">Welcome to Pets Pantry, your one-stop destination for premium pet food and accessories. We believe that pets are not just animals—they’re family. Our mission is to provide high-quality, nutritious food and stylish accessories that help your pet live a happy and healthy life</p>
      </div>


      <div class = "contact-body">
        <div class = "contact-info">
          <div>
            <span><i class = "fas fa-mobile-alt"></i></span>
            <span>Phone No.</span>
            <span class = "text">1-2392-23928-2</span>
          </div>
          <div>
            <span><i class = "fas fa-envelope-open"></i></span>
            <span>E-mail</span>
            <span class = "text">mail@company.com</span>
          </div>
          <div>
            <span><i class = "fas fa-map-marker-alt"></i></span>
            <span>Address</span>
            <span class = "text">Bailey road, Patna, Bihar, India</span>
          </div>
          <div>
            <span><i class = "fas fa-clock"></i></span>
            <span>Opening Hours</span>
            <span class = "text">Monday - Friday (9:00 AM to 5:00 PM)</span>
          </div>
        </div>
      </div>
      <div class = "map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d223700.1490386933!2d-97.11558670486288!3d28.829485511234168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864266db2e2dac3b%3A0xeee20d566f63267d!2sVictoria%2C%20TX%2C%20USA!5e0!3m2!1sen!2snp!4v1604921178092!5m2!1sen!2snp" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
      <?php
    // navbar connection
    include("footer.php");
  ?> 
    </section>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="about.js"></script>
  </body>
</html>


