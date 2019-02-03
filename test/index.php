<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 10:02 AM
 */
$GLOBALS['files'] = [];

function listFolderFiles($dir){
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    foreach($ffs as $ff) {
        if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
        else $GLOBALS['files'][] =$dir.'/'.$ff;
    }
}

listFolderFiles('../code');
$testFiles = [];
foreach ($GLOBALS['files'] as $file) {
    if (strpos($file,'Tests')) {
        $testFiles[] = $file;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Test</title>
</head>
<?php
if (isset($_GET['load_unit_tests'])) {
    echo '<body  style="opacity:.2;">';
} else {
    echo '<body>';
}
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Unit Tests</h1>
    </div>
    <div class="input-group mb-3">
        <input placeholder="Search For Any Unit Test File..." type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <?php
    foreach ($testFiles as $file) {
        ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= basename($file) ?></h5>
                <p class="card-text"><?= $file ?></p>
                <a href="/test/?load_unit_tests=<?= $file ?>" class="btn btn-primary">Run Unit Tests</a>
            </div>
        </div>
        <?php
    }



    ?>
    <hr>

    <?php
    $loadUnitTests = isset($_GET['load_unit_tests']);

    if ($loadUnitTests) {
    ?>
        <div class="accordion" id="accordionExample">

            <?php
            $classPath = $_GET['load_unit_tests'];
            require_once $classPath;
            $file = basename($classPath);
            $class = str_replace('.php','',$file);
            $classMethods = get_class_methods($class);
            $instance = new $class();
            ?>

            <?php

            foreach ($classMethods as $method) {
                ?>
                <div class="card unit-test">
                    <div class="card-header" id="heading<?= $method ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $method ?>" aria   -expanded="true" aria-controls="collapse<?= $method ?>">
                                <?= $method ?>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse<?= $method ?>" class="collapse" aria-labelledby="heading<?= $method ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
                            try {
                                echo '<div style="color:purple;font-weight:bold;">';
                                $instance->{$method}();
                                echo '</div>';
                            } catch (Exception $e) {
                                echo '</div>';
                                echo '<div style="color:red;font-size:30px;">Exception Was Thrown</div>';
                                echo '<hr>';
                                do {
                                    echo '<div style="color:red;">ExceptionMessage - '.$e->getMessage().' @ '.$e->getFile().':'.$e->getLine().'</div>';
                                    $e = $e->getPrevious();
                                    echo '<hr>';
                                } while ($e instanceof Exception);
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
            }

            ?>

        </div>
    <?php
    }
    ?>


    <div style="height:400px;"></div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


<script>
    $(function () {
        $.each($('.unit-test'), function (index, val) {
            if ($(val).html().indexOf('Exception Was Thrown') > 0) {
                $(val).find('.card-header .mb-0').append('<span style="color:red;font-size:16px;">[FAILED]</span>');
            } else {
                $(val).find('.card-header .mb-0').append('<span style="color:lightgreen;font-size:16px;">[PASSED]</span>');
            }
        });
        $('body').css('opacity','1');
    });
</script>

</body>
</html>




