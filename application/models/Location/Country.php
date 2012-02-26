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
class Application_Model_Location_Country extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_country';

    //obtiene los tipos de genero almacenados en la tabla list_gender
    public static function getCountries()
    {
        $tipo = new Application_Model_Location_Country();

        $order  = array('name ASC');
        $select = $tipo->select();

        $select ->from($tipo, array('idList_location_country', 'name'))
                ->order($order)
                ;

        return $rows = $tipo->fetchAll($select);
    }
}

?>
