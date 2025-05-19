<?php  

include('../include/check_login.php');
$page_title = "İstifadəçi əlavə et | Admin panel";
$title = $titleErr = $body = $bodyErr = $pictureErr = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

include('../functions/functions.php');

    $title = yoxlama($_POST['title']);
    $body = yoxlama($_POST['body']);

    if(empty($title)){
       $titleErr = ' xanası boş qoyula bilməz!';
    }
    if(empty($body)){
       $bodyErr = ' boş qoyula bilməz!';
    }
 include('../config/config.php');

 //$sql_ = "SELECT email FROM users WHERE email = '$email'";
 //$result_ = $conn->query($sql_);
 //if (mysqli_num_rows($result_) > 0) {
 //  $emailErr = "Bu E-poçt ünvanı mövcuddur!";
 //} 


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
    $pictureErrupload = "Şəklinizi yüklərkən bir xəta baş verdi";
  }

}


if ($titleErr == '' and  $bodyErr == '') {
            
           

            $createdAt = date('Y-m-d H:i:s'); 

            $sql_2 = "INSERT INTO posts (p_title, p_body, p_cover, p_createdAt)
            VALUES ('$title', '$body', '$target_file', '$createdAt')";

            if ($conn->query($sql_2)) {

              header('Location: http://localhost/blog/admin/posts/list.php?add_message=success');

            } else {

              header('Location: http://localhost/blog/admin/posts/list.php?add_message=error');

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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
        <script>
             tinymce.init({
               selector: 'textarea#editor1', });
        </script>

<?php include('../include/header.php'); ?>

<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                           <h3 class="mb-0">Xəbər əlavə et</h3>
                        </div>
                    </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="name">Başlıq</label><span class="error"> <?php echo $titleErr;?></span>
                                    <input type="text"   value="<?=$title?>" name="title" class="form-control"  placeholder="Başlıq daxil edin...">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="name">Xəbər</label><span class="error"><?php echo $bodyErr; ?></span>                       
                                    <textarea id="editor1" placeholder="Xəbər daxil edin..." class="form-control" name="body"><?=$body?></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
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