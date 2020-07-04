<?php 

/* ustawia bardziej rygorystyczne testy kodu związane z typami danych */
declare(strict_types=1);

use MyLib\HtmlDataGrid\HtmlDataGrid;

require_once realpath('vendor/autoload.php');

$rows = json_decode(file_get_contents("data.json"), true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $dataGrid = new HtmlDataGrid(); // instanceof DataGrid
        echo $dataGrid->withConfig()->render($rows);

    ?>
</body>
</html>