<?php

require_once './autoload.php';
require_once './functions.php';

$string = $_REQUEST['exp'];
if (!isset($string)) {
    $string = '2+2*2*2+2';
}
$obj = buildTree($string);
$tree = buildObjectTree($obj);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="">
            <input type="text" name="exp" value="<?php echo $string;?>" />
            <input type="submit" value="Посчитать" />
        </form>
        <?php
        
        
        echo "Expression: $string <br />";
        echo 'Result: ' . $tree->calc() . '<br />';
        var_dump($tree);
        ?>
    </body>
</html>
