<?php
  include_once 'header.php';
  session_start();
  if(isset($_SESSION['unique_id'])){
    header('location: users.php');
  }
?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
      <form action="#">
        <div class="error-txt"></div>
        <div class="field input">
          <label for="">Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label for="">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Don't have a account? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  <script src="assets/js/main.js"></script>
</body>
</html>