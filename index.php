<?php 

/* ustawia bardziej rygorystyczne testy kodu związane z typami danych */
declare(strict_types=1);

use MyLib\Classes\HttpState;
use MyLib\Classes\HtmlDataGrid;
use MyLib\Classes\DefaultConfig;

require_once realpath('vendor/autoload.php');

$rows = json_decode(file_get_contents("data.json"), true);

$state = HttpState::create(); // instanceof State, dane powinny zostać pobrane z $_GET

$config = (new DefaultConfig) // instanceof Config, z dodatkowymi metodami
->addIntColumn('id')
->addTextColumn('name')
->addIntColumn('age')
->addTextColumn('company')
->addCurrencyColumn('balance', 'USD')
->addTextColumn('phone')
->addTextColumn('email');

/* echo "<pre>";
print_r($config);
echo "</pre>"; */

$dataGrid = new HtmlDataGrid(); // instanceof DataGrid

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap Style -->
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <section>
            <div class="row">
                <div class="col-12 m-2">
                    <?php
                        $dataGrid->withConfig($config)->render($rows, $state);
                    ?>
                </div>
            </div>
        </section>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>