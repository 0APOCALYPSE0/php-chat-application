<?php
  include_once 'config.php';

  session_start();
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(!empty($email) && !empty($password)){
    //email validation...
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      //check if user with entered email and password exist or not...
      $sql = mysqli_query($conn, "SELECT * FROM users where email='{$email}' AND password='{$password}'");
      if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $status = "Active Now";
        $sql2 = mysqli_query($conn, "UPDATE users SET status = {$status} WHERE unique_id = {$row['unique_id']}");
        if($sql2){
          $_SESSION['unique_id'] = $row['unique_id']; // using this session we have used user unique_id in other php files
          echo 'success';
        }
      }else{
        echo 'Email or Password is incorrect!';
      }
    }else{
      echo $email.' - This is not a valid email!';
    }
  }else{
    echo 'All inputs fields are required!';
  }
?>