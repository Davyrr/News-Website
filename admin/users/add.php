<?php  

include('../include/check_login.php');
$page_title = "İstifadəçi əlavə et | Admin panel";
$email = $emailErr = $password_ = $passwordErr = $fullname = $fullnameErr = $password2_ = $password2Err = $phonenumber = $phonenumberErr = '';
$target_file = $birthdate = $birthdateErr = $pictureErr = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

include('../functions/functions.php');

    $fullname = yoxlama($_POST['fullname']);
    $email = yoxlama($_POST['email']);
    $password_ = yoxlama($_POST['password']);
    $password2_ = yoxlama($_POST['password2']);
    $phonenumber = yoxlama($_POST['phonenumber']);
    $birthdate = yoxlama($_POST['birthdate']);

    if(empty($fullname)){
       $fullnameErr = ' xanası boş qoyula bilməz!';
    }
    if(empty($email)){
       $emailErr = ' boş qoyula bilməz!';
    }else{
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)  {
            $emailErr = 'düzgün deyil';
        }
    }
  if ($_POST['password'] !== $_POST['password2']) {
    $password2Err = 'Şifrələr eyni deyil!';
 }
  if (strlen($_POST['password']) < 8) {
    $passwordErr = 'Şifrə 8 xarakterdən az ola bilməz!';
}


  if (empty($password_)) {
      $passwordErr = ' xanası boş ola bilməz!';
  }
if (empty($password2_)) {
    $password2Err = ' xanası boş ola bilməz!';
  } 
if (empty($phonenumber)) {
    $phonenumberErr = ' xanası boş ola bilməz!';
  } 
if (empty($birthdate)) {
    $birthdateErr = 'xanası boş ola bilməz!';
  }

 include('../config/config.php');

 $sql_ = "SELECT email FROM users WHERE email = '$email'";
 $result_ = $conn->query($sql_);
 if (mysqli_num_rows($result_) > 0) {
   $emailErr = "Bu E-poçt ünvanı mövcuddur!";
 } 


if(isset($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
  
$target_dir = "../blog/uploads/";
$tr_filename = rand(). basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $tr_filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //$pictureErrupload = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $pictureErrupload = "Fayl şəkil deyil";
    $uploadOk = 0;
  }
}


if (file_exists($target_file)) {
  $pictureErrupload = "Bu şəkil mövcuddur";
  $uploadOk = 0;
}


if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Şəklin həcmi çox böyükdür";
  $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $pictureErrupload = "Yalnız JPG, JPEG, PNG & GIF faylları olar";
  $uploadOk = 0;
}


if ($uploadOk == 0) {
  $pictureErrupload = "Şəkliniz yüklənmədi";

} else {
    $pictureErrupload = "Şəklinizi yüklərkən bir xəta baş verdi";
  }

}


if ($emailErr == '' and  $fullnameErr == '' and $passwordErr == '' and $password2Err == '' and $phonenumberErr == '' and $birthdateErr == '' and $pictureErr == '') {
            
           

            $createdAt = date('Y-m-d H:i:s'); 
            $password_for_db = md5($password_);

            $sql_2 = "INSERT INTO USERS (fullname, email, password, phonenumber, createdAt, birthdate, user_image)
            VALUES ('$fullname', '$email', '$password_for_db', '$phonenumber', '$createdAt' , '$birthdate' , '$target_file')";

            if ($conn->query($sql_2)) {

              header('Location: http://localhost/blog/admin/users/list.php?add_message=success');

            } else {

              header('Location: http://localhost/blog/admin/users/list.php?add_message=error');

            }

     
}

}


?>


<!DOCTYPE html>
<html lang="en">

<?php include('../include/head.php');?>

<body class="crm_body_bg">


<?php include('../include/sidebar.php'); ?>


<section class="main_content dashboard_part">



<?php include('../include/header.php'); ?>

<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                           <h3 class="mb-0">İstifadəçi əlavə et</h3>
                        </div>
                    </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name">Ad, Soyad</label><span class="error"> <?php echo $fullnameErr;?></span>
                                    <input type="text" value="<?=$fullname?>" name="fullname" class="form-control"  placeholder="Tam ad daxil edin...">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email">E-poçt ünvanı</label><span class="error">  <?php echo $emailErr;?></span>
                                    <input type="text" value="<?=$email?>"  name="email" class="form-control" placeholder="E-poçt ünvanınızı daxil edin...">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name">Şifrə</label><span class="error"><?php echo $passwordErr; ?></span>
                                    <input type="password" name="password" class="form-control"  placeholder="Şifrə daxil edin...">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email">Şifrə təstiqləmə</label><span class="error">  <?php echo $password2Err; ?></span>
                                    <input type="password"  name="password2" class="form-control" placeholder="Şifrənizi təstiqləyin...">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name">Əlaqə nömrəsi</label><span class="error"> <?php echo $phonenumberErr;?></span>
                                    <input type="text" value="<?=$phonenumber?>" name="phonenumber" class="form-control"  placeholder="Əlaqə nömrəsi daxil edin...">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email">Doğum tarixi&nbsp</label><span class="error"> <?php echo $birthdateErr;?></span>
                                    <input type="text" value="<?=$birthdate?>"  name="birthdate" class="form-control" placeholder="Doğum tarixinizi daxil edin...">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="form-label" for="name">Şəkil </label><span class="error"><?=$pictureErr;?></span>
                                <div class="input-group mb-3">
                                    <input type="file" name="fileToUpload" class="form-control">
                                    <label class="input-group-text" for="inputGroupFile02">Şəkil yüklə</label>
                                </div>
                            </div>
                            <br>
                            <center>
                            <input class="btn btn-outline-primary" type="submit" name="submit" value="Göndər">
                        </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../include/footer.php'); ?>

</section>

<?php include('../include/scripts.php'); ?>


</body>
</html>