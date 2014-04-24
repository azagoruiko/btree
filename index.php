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
        <title>Вычисление выражения бинарным деревом</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script>
            function drawVertex(ctx, vertex, x, y, level) {
                var gap = 150 - (level*50);
                if (vertex.right) {
                    ctx.beginPath();
                    ctx.moveTo(x, y);
                    ctx.lineTo(x - gap, y + 50);
                    ctx.stroke();
                    ctx.closePath();
                    drawVertex(ctx, vertex.right, x - gap, y + 50, level++);
                }
                if (vertex.left) {
                    ctx.beginPath();
                    ctx.moveTo(x, y);
                    ctx.lineTo(x + gap, y + 50);
                    ctx.stroke();
                    ctx.closePath();
                    drawVertex(ctx, vertex.left, x + gap, y + 50, level--);
                }
                ctx.beginPath();
                ctx.arc(x, y, 20, 0, 2*Math.PI);
                ctx.fillStyle = "green";
                ctx.fill();
                ctx.fillStyle = "red";
                var text = vertex.op;
                if (vertex.op === 'leave') {
                    text = vertex.value;
                }
                ctx.fillText(text, x-6, y+6);
                ctx.closePath();
            }
            
            var data = <?php echo json_encode($obj); ?>;
            $().ready( function () {
                var drw = document.getElementById("draw");
                var ctx = drw.getContext("2d");

                ctx.font = "20px Arial";
                ctx.fillStyle = "#FF3300";
                ctx.strokeStyle = "#000000";

                drawVertex(ctx, data, 500, 20, 1);
            });
            
        </script>
    </head>
    <body>
        <form method="post" action="">
            <input type="text" name="exp" value="<?php echo $string;?>" />
            <input type="submit" value="Посчитать" />
        </form>
        <?php
        echo "Expression: $string <br />";
        echo 'Result: ' . $tree->calc() . '<br />';
        ?>
        <div id="graph">
            <div>Дерево:</div>
            <canvas width="1000" height="500" id="draw"></canvas>
        </div>
    </body>
</html>
