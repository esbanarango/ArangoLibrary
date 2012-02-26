<?php

class Application_Model_User extends Zend_Db_Table_Abstract {

    protected $_name = 'user';

    public function newUser($idPerson, $userName, $password) {

        $data = array(
            'idUser' => $idPerson,
            'username' => $userName,
            'password' => $password,
            'register_date' => date("Y-m-d"),
            'last_visit' => date("Y-m-d")
        );

        return $this->insert($data);
    }

    public function checkLogin($user, $pass) {

        $select = $this->select();
        $select->from($this, array('idUser'))
                ->where('username = ?', $user)
                ->where('password = ?', $pass)
                ->where('status = "a"');

        //echo $select;
        return $rows = $this->fetchRow($select);
    }

    public function updateVisit($user) {
        $data = array(
            'last_visit' => date("Y-m-d")
        );
        $where = $this->getAdapter()->quoteInto('idUser = ?', $user);
        $this->update($data, $where);
    }

    public function checkUsername($username) {
        $select = $this->select();

        $select->from($this)
                ->where('username = ?', $username);
        return $row = $this->fetchRow($select);
    }

}

?>
