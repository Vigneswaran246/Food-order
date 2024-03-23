<!-- header section strats -->

<header class="header_section">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="<?= $base_url ?>index.php">
        <span>
          Food Paradise
        </span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  mx-auto ">
          <li class="nav-item">
            <a class="nav-link" href="<?= $base_url ?>index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $base_url ?>menu.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $base_url ?>about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $base_url ?>book.php">Book Table</a>
          </li>
          <?php
          if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == '1') {
            echo '<li class="nav-item"><a class="nav-link" href="' . $admin_url . 'fooditems.php">Dashboard</a></li>';
          }
          ?>
        </ul>
        <div class="user_option">
          <a href="../profile.php" class="user_link">
            <i class="fa fa-user" aria-hidden="true"></i>
          </a>
          <a class="cart_link" href="cart.php">
            <i class="bi bi-cart-fill text-white"></i>
          </a>
          <form class="form-inline">
            <button class="btn  my-2 my-sm-0 nav_search-btn" type="button" data-toggle="modal" data-target="#searchModal">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form>       
         </div>
        </ul>
        <div class="user_option">
          <?php
          if (isset($_SESSION['user_id'])) {
            echo '<a href="' . $admin_url . 'logout.php" class="order_online">Sign out</a>';
          } else {
            echo '<a href="' . $base_url . 'login.php" class="order_online">Login</a>';
          }
          ?>


        </div>
      </div>
    </nav>
  </div>
</header>
<!-- end header section -->


<script>
  // Get the current page URL
  var currentPage = window.location.href;

  // Function to set the active link based on the current page
  function setActiveLink() {
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(function(link) {
      if (link.href === currentPage) {
        link.parentNode.classList.add('active');
      }
    });
  }

  // Call the function on page load
  document.addEventListener('DOMContentLoaded', function() {
    setActiveLink();
  });
</script>