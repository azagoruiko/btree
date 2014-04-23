<?php
namespace pzs12z\zagoruiko\bt;

abstract class Element {
    /**
     *
     * @var Element
     */
    protected $left=NULL;
    /**
     *
     * @var Element
     */
    protected $right=NULL;
    /**
     *
     * @var Element
     */
    protected $parent=NULL;
    
    /**
     * 
     * @return Element 
     */
    function getLeft() {
        return $this->left;
    }
    
    /**
     * 
     * @return Element 
     */
    function getRight() {
        return $this->right;
    }
    
    /**
     * 
     * @return Element 
     */
    function getParent() {
        return $this->parent;
    }
    
    function setLeft(Element $element) {
        $element->setParent($this);
        $this->left = $element;
    }
    
    /**
     * 
     * @param \pzs12z\zagoruiko\bt\Element $element
     * @return Element 
     */
    function setRight(Element $element) {
        $element->setParent($this);
        $this->right = $element;
    }
    
    /**
     * 
     * @param \pzs12z\zagoruiko\bt\Element $element
     * @return Element 
     */
    function setParent(Element $element) {
        $this->parent = $element;
    }
    
    abstract function calc();
}
