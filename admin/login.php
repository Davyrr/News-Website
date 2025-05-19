<?php
$email = $emailErr = $password = $passwordErr = $errorErr = '';

include('functions/functions.php');
include('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    $email = yoxlama($_POST['email']);
    $password = yoxlama($_POST['password']);

    if (empty($email))
    {
        $emailErr = 'Email xanası boş qoyula bilməz!';
    }
    else
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            $emailErr = 'Düzgün e-poçt ünvanı daxil edin!';
        }
    }
    if (strlen($_POST['password']) < 8)
    {
        $passwordErr = 'Şifrə 8 xarakterdən az ola bilməz!';
    }
    if (empty($password))
    {
        $passwordErr = 'Şifrə xanası boş ola bilməz!';
    }

    if ($emailErr == '' and $passwordErr == '')
    {

        $password_for_db = md5($password);

        $sql = "SELECT id FROM users WHERE email = '$email' and password = '$password_for_db'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0)
        {
            session_start();
            $_SESSION['login'] = 'yes';
            if (isset($_SESSION['login']))
            {
                header('Location: http://localhost/blog/admin/dashboard/index.php');
            }
            else
            {
                header('Location: http://localhost/blog/admin/login.php');
            }
        }else{
        	$errorErr = "Daxil etdiyiniz istifadəçi adı və ya şifrə yanlışdır";
        }

       

    }
}

?>


<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<style>
.error{
    color: #FF0000;
}
</style>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Hesaba Daxil Ol</title>
<link rel="icon" href="../assets/img/logo.png" type="image/png">
<link rel="stylesheet" href="./assets/css/bootstrap1.min.css" />
<link rel="stylesheet" href="./assets/css/style1.css" />
</head>

<body class="crm_body_bg">

<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_box">
<div class="row justify-content-center">
<div class="col-lg-3">

<div class="modal-content cs_modal mt_50">
<div class="modal-header">
<h5 class="modal-title">Hesaba daxil ol</h5>
</div>
<div class="modal-body">
	<?php if ($errorErr != ''): ?>
	    <div class="alert alert-danger" role="alert">
		  <?php echo $errorErr; ?>
		</div>		
	<?php endif ?>
<form method="POST" action="" enctype="multipart/form-data">
<div class="">
<span class="error"><?php echo $emailErr;?></span>
<input style="margin-top: 10px;" type="text" value="<?=$email?>" name="email" placeholder="E-poçt ünvanınızı daxil edin">
</div>
<div class="">
<span class="error"><?php echo $passwordErr; ?></span>
<input style="margin-top: 10px;" type="password" name="password" placeholder="Şifrənizi daxil edin">
</div>
<button class="btn_1 full_width text-center">Daxil ol</button>
</form>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</body>
</html>