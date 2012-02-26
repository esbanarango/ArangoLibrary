<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of State
 *
 * @author Arango
 */
// Datos de los estados
class Application_Model_Location_State extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_state';


    public static function getStates($pais)
    {
        $tipo = new Application_Model_Location_State();

        $order  = array('name ASC');
        $select = $tipo->select();

        $select ->from($tipo, array('idList_location_state', 'name'))
                ->where('idList_location_country = ?', $pais)
                ->order($order)
                ;

        return $rows = $tipo->fetchAll($select);
    }
    
    //Obtener la info de una ciudad
    public static function infoState($idState)
    {
        $estado = new Application_Model_Location_State();

        $select = $estado->select();
        $select ->from($estado)
                ->where('idList_location_state = ?', $idState)
                ;

        return $rows = $estado->fetchRow($select);
    }
}