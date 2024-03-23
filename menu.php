<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php'; ?>

<div class="sub_page">
  <div class="hero_area">
    <div class="bg-box">
      <img src="<?= $image_url ?>/hero-bg.jpg" alt="">
    </div>

    <?php include_once './includes/navbar.php'; ?>

  </div>
  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>

        <?php include_once './widgets/items.php'; ?>
   
  </section>

  <!-- end food section -->
  <?php include_once './includes/footer_r.php'; ?>

</div>
<?php include_once './widgets/search.php'; ?>
<?php include_once './includes/footer.php'; ?>