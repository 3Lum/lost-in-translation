<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    echo readfile("webtext.txt");
    ?>

    <?php
    $myfile = fopen("webtext.txt", "w") or die("Unable to open file!");
    $txt = "John Doe1\n";
    fwrite($myfile, $txt);
    $txt = "Jane Doe\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    echo readfile("webtext.txt");
?>
</body>
</html>