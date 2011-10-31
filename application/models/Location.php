<?php
// Datos de los paises
class Country extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_country';

    //obtiene los tipos de genero almacenados en la tabla list_gender
    public static function getCountries()
    {
        $tipo = new Country();

        $order  = array('name ASC');
        $select = $tipo->select();

        $select ->from($tipo, array('idList_location_country', 'name'))
                ->order($order)
                ;

        return $rows = $tipo->fetchAll($select);
    }
}


// Datos de los estados
class State extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_state';


    public static function getStates($pais)
    {
        $tipo = new State();

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
        $estado = new State();

        $select = $estado->select();
        $select ->from($estado)
                ->where('idList_location_state = ?', $idState)
                ;

        return $rows = $estado->fetchRow($select);
    }
}


// Datos de las ciudades
class City extends Zend_Db_Table_Abstract
{
    protected $_name = 'list_location_city';

    //obtiene los tipos de genero almacenados en la tabla list_gender
    public static function getCities($estado)
    {
        $tipo = new City();

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
        $ciudad = new City();

        $select = $ciudad->select();

        $select ->from($ciudad)
                ->where('idList_location_city = ?', $idCity)
                ;

        return $rows = $ciudad->fetchRow($select);
    }
}