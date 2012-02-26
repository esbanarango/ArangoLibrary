<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

        protected function _initView()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->setBaseUrl();

        Zend_Session::start();
        Zend_Layout::startMvc();
         
        // Inicializar la vista
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle("Arango's Library");
        $view->doctype('HTML4_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');


        // Añadir al ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);

        // Retorno, de modo que pueda ser almacenada en el arranque (bootstrap)
        return $view;
        
    }

    public function _initViewHelperPath()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addHelperPath('View/Helper');

        Zend_Session::start();
    }
    
    

}

