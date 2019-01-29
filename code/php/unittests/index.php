<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 9:27 AM
 */


?>

<!DOCTYPE HTML>

<html>
<head>

</head>
<body>
    <select onchange="window.location=this.value;">
        <option>Select Unit Test</option>
    <?php
    $files = scandir('.');
    session_start();
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === 'index.php') continue;
        $color = 'white';
        if (isset($_SESSION['okay_unit_tests']) && in_array($file, $_SESSION['okay_unit_tests']))
            $color = 'green';
        echo '<option style="background-color:'.$color.';">'.$file.'</option>';
    }
    ?>
    </select>
</body>
</html>






