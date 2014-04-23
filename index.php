<?php
use pzs12z\zagoruiko\bt\OperationElement;
use pzs12z\zagoruiko\bt\ValueElement;

require_once './autoload.php';

?>
<!DOCTYPE html>



<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        function splitToNode($string, $ops) {
            for ($i = 0; $i<strlen($string); $i++) {
                if (in_array($string[$i], $ops)) {
                    return [
                        'left'=> substr($string, 0, $i),
                        'right'=> substr($string, $i+1, strlen($string)-1),
                        'op'=> $string[$i],
                        'type'=> 'operation',
                    ];
                }
            }
            return false;
        }
        
        function buildTree($string) {
            $numbers = ['0','1','2','3','4','5','6','7','8','9'];
            $high=['/','*'];
            $low=['+','-'];
            if ($node = splitToNode($string, $low)) {
                return ['left' => buildTree($node['left']), 
                        'right'=> buildTree($node['right']),
                'op'=> $node['op']];
            } else if ($node = splitToNode($string, $high)) {
                return ['left'=> buildTree($node['left']), 
                        'right'=> buildTree($node['right']),
                'op'=> $node['op']];
            } 
        }
        
        
        
        $string = "2*2+2*2+2*2+2*2";
        
        $tree=[];
        
        echo "calculation $string <br />";
        
        $obj = buildTree($string);
        
        var_dump($obj);
        
        ?>
    </body>
</html>
