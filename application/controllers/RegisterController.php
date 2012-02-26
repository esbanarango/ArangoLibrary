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

            $user = $this->view->funciones()->clean_post($this->getRequest()->getParam('username'));
            $pass = md5($this->view->funciones()->clean_post($this->getRequest()->getParam('password')));

            $userModel = new Application_Model_User();
            $login = $userModel->checkLogin($user, $pass);

            if (count($login) == 1) {
                
                $userModel->updateVisit($login->idUser); // Last visit

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

    public function newAction() {

        if ($this->getRequest()->isPost() && ($this->getRequest()->getParam('view') != "view")) {
            
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            
            $username = $this->view->funciones()->clean_post($this->getRequest()->getParam('username'));
            $password = md5($this->view->funciones()->clean_post($this->getRequest()->getParam('password')));
            $email = $this->view->funciones()->clean_post($this->getRequest()->getParam('email'));
            $name = $this->view->funciones()->clean_post($this->getRequest()->getParam('name'));
            $lastname = $this->view->funciones()->clean_post($this->getRequest()->getParam('lastname'));
            
            $personModel = new Application_Model_Person();
            $userModel = new Application_Model_User();
            
            $idPerson = $personModel->newPerson($name, $lastname, $email);         
            $userId = $userModel->newUser($idPerson, $username, $password);
            
            if($userId == $idPerson){
                echo 'bien|-estado-|' . "Bien";
            }else{
                echo 'mal|-estado-|' . "Error en el servidor";
            }
             
             
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
    
    public function checkusernameAction() {
        $this->_helper->getHelper("Layout")->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $username = $this->getRequest()->getParam('username');
        
        $userModel = new Application_Model_User();
        $userRow = $userModel->checkUsername($username);
        
        if (count($userRow) == 1){
            echo 'mal|-estado-|' . "Nombre de usuario ya existente";
        }else{
            echo 'bien|-estado-|' . "Bien";
        }
    }
    

}

?>
