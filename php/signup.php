<?php
  include_once 'config.php';

  session_start();
  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

  if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($cpassword)){
    //email validation...
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      // check email if already exist in database or not...
      $sql = mysqli_query($conn, "SELECT email from users WHERE email='{$email}'");
      if(mysqli_num_rows($sql) > 0){
        echo $email.' - This email already exist!';
      }else{
        //check password and confirm password matching or not...
        if($password != $cpassword){
          echo 'Password and Confirm Password are not matching!';
        }else{
          //check if user upload file or not...
          if(isset($_FILES['image'])){
            $imageName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];

            //get the image extension using explode method...
            $imageExploda = explode('.', $imageName);
            $imageExt = end($imageExploda);

            $extensions = ['png', 'jpg', 'jpeg'];
            if(in_array($imageExt, $extensions) == true){
              $time = time();
              $newImageName = $time.$imageName;
              if(move_uploaded_file($tmpName, 'images/'.$newImageName)){
                $status = "Active Now";
                $randomId = rand(time(), 10000000);

                //insert user data in users table...
                $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, first_name, last_name, email, password, image, status)
                                            VALUES('{$randomId}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$newImageName}', '{$status}')");
                if($sql2){
                  $sql3 = mysqli_query($conn, "SELECT * FROM users where email = '{$email}'");
                  if(mysqli_num_rows($sql3) > 0){
                    $row = mysqli_fetch_assoc($sql3);
                    $_SESSION['unique_id'] = $row['unique_id']; // using this session we have used user unique_id in other php files
                    echo 'success';
                  }
                }else{
                  echo 'Something went wrong!';
                }
              }
            }else{
              echo 'Please select an image file - jpeg, jpg, png!';
            }
          }else{
            echo 'Please select an image file!';
          }
        }
      }
    }else{
      echo $email.' - This is not a valid email!';
    }
  }else{
    echo 'All inputs fields are required!';
  }

?>