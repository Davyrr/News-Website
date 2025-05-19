<?php
include('../config/config.php');

$row_id = $_GET['id'];

if (isset($row_id)) {
  $sql = "SELECT * FROM users WHERE id=".$row_id."";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['user_image'] != '' && file_exists($row['user_image'])) {
        unlink($row['user_image']); 
     } 

  $sql = "DELETE FROM users WHERE id=".$row_id."";

  if (mysqli_query($conn, $sql)) {
    header('Location: http://localhost/blog/admin/users/list.php?delete_message=success');
  } else {
    header('Location: http://localhost/blog/admin/users/list.php?delete_message=error');
  } 
    } 

} else {
    header('Location: http://localhost/blog/admin/users/list.php?delete_message=not_found');
}



?>