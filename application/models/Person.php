<?php

class Application_Model_Person extends Zend_Db_Table_Abstract {

    protected $_name = 'person';

    public function newPerson($name, $lastname, $email) {

        $data = array(
            'name' => $name,
            'last_name' => $lastname,
            'email' => $email
        );

        return $this->insert($data);
    }

    public function getInfo($idUser) {
        $select = $this->select();

        $select->from($this)
                ->where('idUser = ?', $idUser);
        return $row = $this->fetchRow($select);
    }

}

?>
