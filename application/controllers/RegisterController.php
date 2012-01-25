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

    public function loginAction() {

        if ($this->getRequest()->isPost() && ($this->getRequest()->getParam('view') != "view")) {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $user = $this->view->funciones()->clean_post($this->getRequest()->getParam('name'));
            $pass = md5($this->view->funciones()->clean_post($this->getRequest()->getParam('password')));

            $userModel = new Application_Model_User();
            $login = $userModel->checkLogin($user, $pass);

            if (count($login) == 1) {
                $userModel->updateVisit($login->idUser);

                $personModel = new Application_Model_Person();
                $person = $personModel->getInfo($login->idUser);

                Zend_Session::start();
                $userLog = new Zend_Session_Namespace("userLog");
                $userLog->iniciado = "si";
                $userLog->id = $login->idUser;
                $userLog->username = $user;
                $userLog->nombre = $person->name;
                $userLog->apellido = $person->last_name;
                $userLog->email = $person->email;
            } else {

                echo 'mal|-estado-|' . "Mal" . $pass . $login;
            }
        }else if($this->getRequest()->getParam('view') == "view"){
            $this->_helper->layout->disableLayout();
        }else {
            $this->_helper->layout->disableLayout();
            $this->_helper->layout->setLayout('login-layout');
        }
    }

    public function logoutAction() {
        $this->_helper->getHelper("Layout")->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        Zend_Session::destroy(true);

        $this->_redirect(''); //no funciona
    }

    public function newuserAction() {

        if ($this->getRequest()->isPost() && ($this->getRequest()->getParam('view') != "view")) {
            
            
            
            
        }else if($this->getRequest()->getParam('view') == "view"){
            $this->_helper->layout->disableLayout();
        }else {
            $this->_helper->layout->disableLayout();
            $this->_helper->layout->setLayout('login-layout');
        }
    }
    
    public function remeberpasswordAction() {

        if ($this->getRequest()->isPost() && ($this->getRequest()->getParam('view') != "view")) {
            
            
            
            
        }else if($this->getRequest()->getParam('view') == "view"){
            $this->_helper->layout->disableLayout();
        }else {
            $this->_helper->layout->disableLayout();
            $this->_helper->layout->setLayout('login-layout');
        }
    }

}

?>
