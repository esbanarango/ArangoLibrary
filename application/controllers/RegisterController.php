<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registerController
 *
 * @author Arango
 */
class RegisterController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function newbookAction() {
        
    }

    public function newauthorAction() {
        
    }

    public function newauthorgetAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function neweditorialAction() {
        
    }

}

?>
