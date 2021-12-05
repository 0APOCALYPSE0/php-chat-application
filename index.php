<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Realtime Chat App | Sign Up</title>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Chat App</header>
      <form action="#">
        <div class="error-txt">This is an error message!</div>
        <div class="name-details">
          <div class="field input">
            <label for="">First Name</label>
            <input type="text" placeholder="First Name">
          </div>
          <div class="field input">
            <label for="">Last Name</label>
            <input type="text" placeholder="Last Name">
          </div>
        </div>
        <div class="field input">
          <label for="">Email Address</label>
          <input type="text" placeholder="Enter your email">
        </div>
        <div class="field input">
          <label for="">Password</label>
          <input type="password" placeholder="Enter your password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field input">
          <label for="">Confirm Password</label>
          <input type="password" placeholder="Enter your confirm password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label for="">Select Image</label>
          <input type="file">
        </div>
        <div class="field button">
          <input type="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already have a account? <a href="login.php">Login now</a></div>
    </section>
  </div>
  <script src="assets/js/main.js"></script>
</body>
</html>