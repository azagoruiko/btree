<?php

namespace pzs12z\zagoruiko\bt;


class OperationElement extends Element {
    const MULTIPLY = '*';
    const DIVIDE = '/';
    const SUBTRACT = '-';
    const ADD = '+';
    
    private $type;
    
    function getType() {
        return $this->type;
    }
    
    function setType($value) {
        $this->type = $value;
    }
    
    function isComplete() {
        return isset($this->left) && isset($this->right);
    }
    
    function isEmpty() {
        return $this->left === NULL && $this->right === NULL;
    }
    
    function isMultOrDiv() {
        return $this->type === self::DIVIDE || $this->type === self::MULTIPLY;
    }
    
    function isAddOrSub() {
        return $this->type === self::ADD || $this->type === self::SUBTRACT;
    }
    
    function isHigher(OperationElement $op) {
        return $this->isMultOrDiv() && $op->isAddOrSub();
    }
    
    function isEqual(OperationElement $op) {
        return $this->isMultOrDiv() === $op->isMultOrDiv() 
                && $this->isAddOrSub() === $op->isAddOrSub();
    }
    
    function calc() {
        switch ($this->type) {
            case self::MULTIPLY:
                return $this->left->calc() * $this->right->calc();
            case self::DIVIDE:
                return $this->left->calc() / $this->right->calc();
            case self::ADD:
                return $this->left->calc() + $this->right->calc();
            case self::SUBTRACT:
                return $this->left->calc() - $this->right->calc();
        }
    }
    
    function __toString() {
        return $this->type;
    }
}
