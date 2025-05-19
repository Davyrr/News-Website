<?php

$x = $y = $z = $xError = $yError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = $_POST['x'];
    $y = $_POST['y'];

    

    if (empty($x && $y)) {
       echo "Fill!";
    }elseif($value == "Add") {
        $z = $x + $y;
    }elseif ($value == "Subtract") {
         $z = $x - $y;
    }elseif ($value == "Multiply") {
         $z = $x * $y;
    }elseif ($value == "Divide") {
         $z = $x / $y;
    }else{
        echo "Something is wrong!";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Calculator</title>
</head>
<body style="background-color:turquoise ;">

 <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 </form>
 <center>
    <a style="border:2px solid tomato;" href="https://www.online-calculator.com/">Menimki islemese bura click edin!</a>
<h3>Davudun 'Make in proggress'de olan Kalkulyatoru</h3>
<input type="number" name="x" placeholder="Add a number..."><br><br>
<input type="number" name="y" placeholder="Add a number..."><br>
Add-<input type="radio" name="emeliyyat" value="Add"><br>
Subtract-<input type="radio" name="emeliyyat" value="Subtact"><br>
Multiply<input type="radio" name="emeliyyat" value="Multiply"><br>
Divide<input type="radio" name="emeliyyat" value="Divide"><br>
<input type="submit" name="submit">
<h4>Result:<?php echo $z; ?><h4>
</center>
</body>
</html>