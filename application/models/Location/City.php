<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author Arango
 */
// Datos de las ciudades
class Application_Model_Location_Country extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_city';

    //obtiene los tipos de genero almacenados en la tabla list_gender
    public static function getCities($estado)
    {
        $tipo = new Application_Model_Location_Country();

        $order  = array('name ASC');
        $select = $tipo->select();

        $select ->from($tipo, array('idList_location_city', 'name'))
                ->where('idList_location_state = ?', $estado)
                ->order($order)
                ;

        return $rows = $tipo->fetchAll($select);
    }
    
    //Obtener la info de una ciudad
    public static function infoCity($idCity)
    {
        $ciudad = new Application_Model_Location_Country();

        $select = $ciudad->select();

        $select ->from($ciudad)
                ->where('idList_location_city = ?', $idCity)
                ;

        return $rows = $ciudad->fetchRow($select);
    }
}

?>