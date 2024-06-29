<header class="header">
   <div class="flex">
      <a href="#" class="logo">Stationery Shop</a>
      <nav class="navbar">
         <a href="admin.php">Add Products</a>
         <a href="products.php">View Products</a>
      </nav>
      <?php
      @include 'config.php'; // Ensure the connection is included

      // Check if the connection is successful
      if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
      }

      $select_rows = mysqli_query($conn, "SELECT * FROM cart");
      if (!$select_rows) {
         die("Query failed: " . mysqli_error($conn));
      }
      $row_count = mysqli_num_rows($select_rows);
      ?>
      <a href="cart.php" class="cart">Cart <span><?php echo $row_count; ?></span></a>
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>
</header>

<script>
   let menu = document.querySelector('#menu-btn');
   let navbar = document.querySelector('.header .navbar');

   menu.onclick = () =>{
      menu.classList.toggle('fa-times');
      navbar.classList.toggle('active');
   };

   window.onscroll = () =>{
      menu.classList.remove('fa-times');
      navbar.classList.remove('active');
   };
</script>
