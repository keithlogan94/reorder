<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 9:27 AM
 */

function get_unit_test_files() {
    $files = scandir('.');
    $unitTestFiles = [];
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === 'index.php') continue;
        $unitTestFiles[] = $file;
    }
    return $unitTestFiles;
}

?>

<!DOCTYPE HTML>

<html>
<head>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script>
        setInterval(function () {
            runAllUnitTests();
        }, 5000)
    </script>
</head>
<body>
    <button onclick="runAllUnitTests();">Run all unit tests</button>
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

    <div id="unit-test-results">
    </div>
    <script>
        function runUnitTestFile(file) {
            $.ajax({
                url: '/code/php/unittests/'+file,
                method: 'POST',
                async:true,
            }).done(function (result) {
                const html = `
                 <div>
                    <p>${file} </p>
                    <p>${result}</p>
                </div>
                `;
                $('#unit-test-results').append(html);
            });
        }
        function runAllUnitTests() {
            $('#unit-test-results').html('');
        <?php
            foreach (get_unit_test_files() as $file) {
                ?>
                runUnitTestFile('<?= $file ?>');
                <?php
            }
        ?>
        }
        runAllUnitTests();
    </script>

</body>
</html>






