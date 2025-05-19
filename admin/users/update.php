<?php  

include('../include/check_login.php');
$page_title = "İstifadəçi redaktə et | Admin panel";
$email = $emailErr = $password_ = $passwordErr = $fullname = $fullnameErr = $password2_ = $password2Err = $phonenumber = $phonenumberErr = '';
$target_file = $birthdate = $birthdateErr = $pictureErr = $pictureErrupload = '';

$row_id = $_GET['id'];

include('../functions/functions.php');

    include('../config/config.php');

   $sql = "SELECT * FROM users WHERE id=".$row_id."";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();

   $new_user_image = $row['user_image']; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $fullname = yoxlama($_POST['fullname']);
    $email = yoxlama($_POST['email']);
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
  
if (empty($phonenumber)) {
    $phonenumberErr = ' xanası boş ola bilməz!';
  } 
if (empty($birthdate)) {
    $birthdateErr = 'xanası boş ola bilməz!';
  }  




if(isset($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
  
$target_dir = "../assets/uploads/";
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
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //$pictureErrupload = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $new_user_image = $tr_filename;
    if ($row['user_image'] != '') {
       if (file_exists('../assets/uploads/'.$row['user_image'])) {
           unlink('../assets/uploads/'.$row['user_image']);
       }
    }
  } else {
    $pictureErrupload = "Şəklinizi yüklərkən bir xəta baş verdi";
  }
}

}

if ($emailErr == '' and  $fullnameErr == '' and $passwordErr == '' and $password2Err == '' and $phonenumberErr == '' and $birthdateErr == '' and $pictureErrupload == '') {
            
$sql = "UPDATE users SET fullname = '".$_POST['fullname']."' ,  email = '".$_POST['email']."' , phonenumber = '".$_POST['phonenumber']."' , birthdate = '".$_POST['birthdate']."' , user_image = '".$new_user_image."'   WHERE id='".$_POST['user_id']."'";

      if (mysqli_query($conn, $sql)) {
      header('Location: http://localhost/blog/admin/users/list.php?update_message=success');
      } else {
      header('Location: http://localhost/blog/admin/users/list.php?add_message=error');
      }
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
                           <h3 class="mb-0">İstifadəçi redaktə et</h3>
                        </div>
                    </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name">Ad, Soyad</label><span class="error"> <?php echo $fullnameErr;?></span>
                                    <input type="text" value="<?=$row['fullname']?>" name="fullname" class="form-control"  placeholder="Tam ad daxil edin...">
                                    <input type="hidden" name="user_id" value="<?=$row['id']?>">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email">E-poçt ünvanı</label><span class="error">  <?php echo $emailErr;?></span>
                                    <input type="text" value="<?=$row['email']?>"  name="email" class="form-control" placeholder="E-poçt ünvanınızı daxil edin...">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name">Əlaqə nömrəsi</label><span class="error"> <?php echo $phonenumberErr;?></span>
                                    <input type="text" value="<?=$row['phonenumber']?>" name="phonenumber" class="form-control"  placeholder="Əlaqə nömrəsi daxil edin...">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email">Doğum tarixi&nbsp</label><span class="error"> <?php echo $birthdateErr;?></span>
                                    <input type="text" value="<?=$row['birthdate']?>"  name="birthdate" class="form-control" placeholder="Doğum tarixinizi daxil edin...">
                                </div>
                            </div>
                            <br>

                            <div class="row">                               
                                <label class="form-label" for="name">Şəkil</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="fileToUpload" class="form-control">
                                    <label class="input-group-text" for="inputGroupFile02">Şəkli yüklə</label>
                                </div>
                                <br>
                                <?php if ($pictureErrupload != ''): ?>
                                     <span style="color:red;"><b><?=$pictureErrupload;?></b></span>
                                 <?php endif ?>
                            </div>
                            <br>
                            <div class="row">
                               <label class="form-label" for="name">Cari Şəkil</label> 
                               <?php if ($row['user_image'] != ''): ?>
                                   <img class="img-fluid" style="max-width: 300px;" src="http://localhost/blog/admin/assets/uploads/<?=$row['user_image']?>">
                               <?php else: ?>
                                    <span style="color:red;"><b>Şəkil əlavə edilməmişdir</b></span>
                               <?php endif ?>
                            </div>
                            <br>
                            <center>
                            <input class="btn btn-outline-primary" type="submit" name="submit" value="Redaktə et">
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