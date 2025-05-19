<?php include('../include/check_login.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php
 include('../include/head.php');
 include('../functions/functions.php');
 include('../config/config.php');
  ?>


<body class="crm_body_bg">


<?php include('../include/sidebar.php'); ?>


<section class="main_content dashboard_part">



<?php include('../include/header.php'); ?>
<div class="main_content_iner">
<div class="container-fluid plr_30 body_white_bg pt_30">
<div class="row justify-content-center">
<div class="col-12">
<div class="QA_section">
<div class="white_box_tittle list_header">
<h4>Siyahı</h4>
<div class="box_right d-flex lms_block">
<div class="serach_field_2">
<div class="search_inner">
<form active="#">
<div class="search_field">
<input type="text" placeholder="Axtarış...">
</div>
<button type="submit"> <i class="ti-search"></i> </button>
</form>
</div>
</div>
<div class="add_button ms-2">
<a href="./add.php"  class="btn_1">Yeni istifadəçi əlavə et</a>
</div>
</div>
</div>
<?php if (isset($_GET['update_message']) && $_GET['update_message'] == 'success'): ?>
   <div class="alert alert-success" role = "alert">İstifadəçi uğurla yeniləndi!</div>
<?php endif ?>
<?php if (isset($_GET['delete_message']) && $_GET['delete_message'] == 'success'): ?>
    <div class="alert alert-success" role = "alert">İstifadəçi uğurla silindi!</div>
<?php endif ?>
<?php if (isset($_GET['add_message']) && $_GET['add_message'] == 'success'): ?>
    <div class="alert alert-success" role = "alert">İstifadəçi uğurla əlavə edildi!</div>
<?php endif ?>
<?php if (isset($_GET['add_message']) && $_GET['add_message'] == 'error'): ?>
    <div class="alert alert-danger" role = "alert">İstifadəçi əlavə olunan zaman xəta baş verdi, təkrar cəhd edin!</div>
<?php endif ?>
<div class="QA_table ">

<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
<table class="table lms_table_active">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">Ad, SoyAd</th>
<th scope="col">E-Poçt Ünvanı</th>
<th scope="col">Tarix</th>
<th scope="col">Əməliyyatlar</th>
</tr>
</thead>
<tbody>
<?php 
$sql = "SELECT * FROM users";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0) {
while ($row = mysqli_fetch_assoc($results)) { ?>
<tr>
<td><?php echo $row['id'] ?></td>
<td><?php echo $row['fullname'] ?></td>
<td><?php echo $row['email'] ?></td>
<td><?php echo $row['createdAt'] ?></td>
<td>
    <a class="status_btn" style="background: red!important;" href = "./delete.php?id=<?php echo $row['id'] ?>"> Sil</a> &nbsp&nbsp 
    <a class="status_btn" href = "./update.php?id=<?php echo $row['id'] ?>"> Redaktə et</a>
</td>
</tr> 
     <?php } 
     }else{
      echo "Məlumat tapılmadı...";
     } 
   ?>


</tbody>
</table>
</div>
</div>
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


