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
class AuthorController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function newAction() {
        
    }

    public function createAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $name = $this->view->funciones()->clean_post($this->getRequest()->getParam('name'));
        $last_name = $this->view->funciones()->clean_post($this->getRequest()->getParam('last_name'));
        $bio = $this->view->funciones()->clean_post($this->getRequest()->getParam('bio'));
        $education = $this->view->funciones()->clean_post($this->getRequest()->getParam('edu'));
        $city = $this->view->funciones()->clean_post($this->getRequest()->getParam('Ciudad'));
        $country = $this->view->funciones()->clean_post($this->getRequest()->getParam('Pais'));
        $state = $this->view->funciones()->clean_post($this->getRequest()->getParam('Estado'));
        $birth_date = $this->view->funciones()->clean_post($this->getRequest()->getParam('birthdate'));
        $null = new Zend_Db_Expr("NULL");
        $authorModel = new Application_Model_Author();
        $idAuthor = $authorModel->save($city, $null, $name, $last_name, $birth_date, $null, $bio, $education);
        
        if ($idAuthor) {
            echo 'bien|-estado-|'.'Autor insertado correctamente'.$idAuthor;
        } else {
            echo 'mal|-estado-|' .'Error al inserter el autor';
        }
    }
}

?>
