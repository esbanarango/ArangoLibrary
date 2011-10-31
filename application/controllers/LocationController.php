<?php
/*
 * DATOS AGREGADOS PARA SELECCIÓN DE LOCACIÓN
 */
//Controller para las vistas en select
//require_once '/../models/Location.php';
class LocationController extends Zend_Controller_Action
{
    public function init()
    {

    }

    //genera la lista de paises
    public function countryAction()
    {
        $this->_helper->getHelper("Layout")->disableLayout();
        $obligatorio = $this->getRequest()->getParam('obligatorio'); //Si el campo es obligatorio en el formularo, agrega el * a la vista
        $seleccion = $this->getRequest()->getParam('seleccion'); //Para edición, este es el valor seleccionado actualmente
        $this->view->seleccion = $seleccion;

        $tipos = new Application_Model_Location_Country();
        $this->view->lista = $tipos->getCountries();

        if($obligatorio != 0)
            $this->view->obligatorio = '*';
        else
            $this->view->obligatorio = '';
    }

    //genera la lista de estados de un pais
    public function stateAction()
    {
        $this->_helper->getHelper("Layout")->disableLayout();
        $pais = $this->getRequest()->getParam('ubicacion');
        $obligatorio = $this->getRequest()->getParam('obligatorio'); //Si el campo es obligatorio en el formularo, agrega el * a la vista
        $seleccion = $this->getRequest()->getParam('seleccion'); //Para edición, este es el valor seleccionado actualmente
        $this->view->seleccion = $seleccion;

        $tipos = new Application_Model_Location_State();
        $this->view->lista = $tipos->getStates($pais);

        if($obligatorio != 0)
            $this->view->obligatorio = '*';
        else
            $this->view->obligatorio = '';
    }

    //genera la lista de estados de un pais
    public function cityAction()
    {
        $this->_helper->getHelper("Layout")->disableLayout();
        $estado = $this->getRequest()->getParam('ubicacion');
        $obligatorio = $this->getRequest()->getParam('obligatorio'); //Si el campo es obligatorio en el formularo, agrega el * a la vista
        $seleccion = $this->getRequest()->getParam('seleccion'); //Para edición, este es el valor seleccionado actualmente
        $this->view->seleccion = $seleccion;

        $tipos = new Application_Model_Location_City();
        $this->view->lista = $tipos->getCities($estado);

        if($obligatorio != 0)
            $this->view->obligatorio = '*';
        else
            $this->view->obligatorio = '';
    }
}
