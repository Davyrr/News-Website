<?php
include('../config/config.php');

$row_id = $_GET['id'];

if (isset($row_id)) {
  $sql = "SELECT * FROM posts WHERE id=".$row_id."";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['p_cover'] != '' && file_exists($row['p_cover'])) {
        unlink($row['p_cover']); 
     } 

  $sql = "DELETE FROM posts WHERE id=".$row_id."";

  if (mysqli_query($conn, $sql)) {
    header('Location: http://localhost/blog/admin/posts/list.php?delete_message=success');
  } else {
    header('Location: http://localhost/blog/admin/posts/list.php?delete_message=error');
  } 
    } 

} else {
    header('Location: http://localhost/blog/admin/posts/list.php?delete_message=not_found');
}



?>