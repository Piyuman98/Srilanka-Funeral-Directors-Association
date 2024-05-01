<?php
session_start();

@include 'config.php';

if(isset($_POST['add_product'])){
   $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `image`, `user_id`) VALUES('$p_name', '$p_price', '$p_image', '{$_SESSION['user_id']}')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product added successfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id AND user_id = '{$_SESSION['user_id']}'") or die('query failed');
  if($delete_query){
     header('location:view.php');
     $message[] = 'product has been deleted';
  }else{
     header('location:view.php');
     $message[] = 'product could not be deleted';
  };
};

$select_user_products = mysqli_query($conn, "SELECT * FROM `products` WHERE user_id = '{$_SESSION['user_id']}' ORDER BY id DESC");
$select_other_products = mysqli_query($conn, "SELECT * FROM `products` WHERE user_id != '{$_SESSION['user_id']}' ORDER BY id DESC");
$user_products = mysqli_fetch_all($select_user_products, MYSQLI_ASSOC);
$other_products = mysqli_fetch_all($select_other_products, MYSQLI_ASSOC);
$products = array_merge($user_products, $other_products);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Srilanka Funeral Directors Association</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Nova
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .product-image {
        width: 150px; /* Set your desired width */
        height: 100px; /* Set your desired height */
        object-fit: cover; /* Optional: Ensures the image covers the entire area */
    }
    #toggleFormBtn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
    }

    #toggleFormBtn:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body class="page-index">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <img src="assets/img/rrrrrrr.png" width="8%">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        
        <h1 class="d-flex align-items-center">SFDA</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="team.html">Directory </a></li>
          <li><a href="blog.html">Blog</a></li>

          <li><a href="contact.html">Contact</a></li>

          <li><a href="login.php">Member Login</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-xl-4">
          <h2 data-aos="fade-up">Srilanka Funeral Directors Association</h2>
          <blockquote data-aos="fade-up" data-aos-delay="100">
            <p>Our role is to provide support and guidance to funeral firms and the bereaved families in their care. 
            </p>
          </blockquote>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>

        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">
<br>
    
 <!-- Header, navigation, hero section, etc. -->
 <center>
 <button id="toggleFormBtn" class="btn">Add Product</button>
 <div id="addProductForm" style="display: none;">

    <!-- add_product_form.php -->
<style>
   /* Custom styles for the table */
   .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #f2f2f2;
    }

     .table {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .table th,
    .table td {
        font-weight: normal;
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    /* Custom styles for input fields */
    .box {
        width: 50%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    /* Custom style for buttons */
    .btn {
        padding: 10px 20px;
        background-color: #255bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Custom style for cancel button */
    #cancelBtn {
        padding: 10px 20px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none;
    }

    #cancelBtn:hover {
        background-color: #bb2d3b;
    }
    
</style>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
    <h3>ADD a new product</h3>
    <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
    <input type="number" name="p_price" placeholder="Enter the product price" class="box" required>
    <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required><br>
    <input type="submit" value="Add Product" name="add_product" class="btn">
    <button type="button" id="cancelBtn">Cancel</button>
    <a href="view.php" class="btn">Back to View Page</a>
</form>
<br><br>

<script>
    // JavaScript to handle cancel button click
    document.getElementById("cancelBtn").addEventListener("click", function() {
        document.querySelector(".add-product-form").reset();
    });
</script>

 </center>
<script>
    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var form = document.getElementById('addProductForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    });
</script>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach($products as $row){
                                echo "<tr>";
                                echo "<td>{$count}</td>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['price']}/-</td>";
                                echo "<td><img src='uploaded_img/{$row['image']}' class='product-image' alt='{$row['name']}'></td>";
                                echo "<td>";
                                if($row['user_id'] == $_SESSION['user_id']){
                                    echo "<a href='view.php?delete={$row['id']}' class='delete-btn' onclick='return confirm(`Are you sure you want to delete this product?`);'><i class='fas fa-trash'></i> Delete</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer, scripts, etc. -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <span>SFDA</span>
            </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links d-flex  mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-dash"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-dash"></i> <a href="#">Web Design</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Web Development</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Product Management</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Marketing</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    
  </footer><!-- End Footer --><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>