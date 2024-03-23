<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php'; ?>

<?php

// session_start();
include_once('./crud/connect.php');


?>

<div class="hero_area">
  <div class="bg-box">
    <img src="<?= $image_url ?>/hero-bg.jpg" alt="hot-pot">
  </div>

  <?php include_once './includes/navbar.php'; ?>

  <!-- slider section -->
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>

  </section>
  <!-- end slider section -->
</div>

<!-- offer section -->

<section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container ">
      <div class="row">
        <div class="col-md-6  ">
          <div class="box ">
            <div class="img-box">
              <img src="<?= $image_url ?>/o1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Tasty Thursdays
              </h5>
              <h6>
                <span>20%</span> Off
              </h6>
              <a href="">
                Order Now
                <i class="bi bi-cart-fill text-white"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6  ">
          <div class="box ">
            <div class="img-box">
              <img src="<?= $image_url ?>/o2.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Pizza Days
              </h5>
              <h6>
                <span>15%</span> Off
              </h6>
              <a href="">
                Order Now
                <i class="bi bi-cart-fill text-white"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end offer section -->

<!-- food section -->

<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Our Menu
      </h2>
    </div>
   
    <?php include_once './widgets/items.php'; ?>

  </div>
</section>

<!-- end food section -->

<!-- about section -->

<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="<?= $image_url ?>/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              We Are Food Paradise
            </h2>
          </div>
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
            the middle of text. All
          </p>
          <a href="">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Book A Table
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container">
          <form action="submit">
            <div>
              <input type="text" class="form-control" placeholder="Your Name" name="name" autocomplete="name">
            </div>
            <div>
              <input type="tel" class="form-control" placeholder="Phone Number" name="number" autocomplete="tel">
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Your Email" name="email" autocomplete="email">
            </div>
            <div>
              <select class="form-control nice-select wide" name="persons" autocomplete="on">
                <option value="" disabled selected>
                  How many persons?
                </option>
                <option value="2">
                  2
                </option>
                <option value="3">
                  3
                </option>
                <option value="4">
                  4
                </option>
                <option value="5">
                  5
                </option>
              </select>
            </div>
            <div>
              <input type="date" class="form-control" name="date" autocomplete="off">
            </div>
            <div class="btn_box">
              <button type="submit">
                Book Now
              </button>
            </div>
          </form>
        </div>
      </div>
      <!-- <div class="col-md-6">
        <div class="map_container ">
          <div id="googleMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231.89537620641596!2d79.81689774291517!3d11.942184982197604!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a53617270ddbe43%3A0xfdfe536301ef896!2sSaram%2C%20Puducherry!5e1!3m2!1sen!2sin!4v1702893217283!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</section>
<!-- end book section -->

<?php include_once './includes/comment.php'; ?>

<?php include_once './includes/footer_r.php'; ?>
<?php include_once './widgets/search.php'; ?>
<?php include_once './includes/footer.php'; ?>