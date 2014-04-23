<?php

namespace pzs12z\zagoruiko\bt;

class ValueElement extends Element {
    private $value;
    
    public function getValue() {
        return $this->value;
    }
    
    public function setValue($value) {
        $this->value = $value;
    }
    
    function calc() {
        return $this->value;
    }
    
    function append($value) {
        $this->value .= $value;
    }
}
