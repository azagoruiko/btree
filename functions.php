<?php
use pzs12z\zagoruiko\bt\OperationElement;
use pzs12z\zagoruiko\bt\ValueElement;
function splitToNode($string, $ops) {
    for ($i = 0; $i<strlen($string); $i++) {
        if (in_array($string[$i], $ops)) {
            return [
                'op'=> $string[$i],
                'left'=> substr($string, 0, $i),
                'right'=> substr($string, $i+1, strlen($string)-1),
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
        return ['op'=> $node['op'],
                'left' => buildTree($node['left']), 
                'right'=> buildTree($node['right']),
        ];
    } else if ($node = splitToNode($string, $high)) {
        return ['op'=> $node['op'],
                'left'=> buildTree($node['left']), 
                'right'=> buildTree($node['right']),
        ];
    } else {
        return ['op' => 'leave', 'value' => $string];
    }
}

function buildObjectTree($obj) {
    if ($obj['op'] === 'leave') {
        $el = new ValueElement();
        $el->setValue($obj['value']);
        return $el;
    } else {
        $el = new OperationElement();
        $el->setType($obj['op']);
        $el->setLeft(buildObjectTree($obj['left']));
        $el->setRight(buildObjectTree($obj['right']));
        return $el;
    }
}

