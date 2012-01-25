<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $usuarioLogeado = new Zend_Session_Namespace("userLog");
        $idUser = $usuarioLogeado->id;
        
        if($idUser == '')
            $this->_redirect('/public/register/login');
        else
            $this->_redirect('');
    }

    public function indexAction()
    {

    }


}

