<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';
    
    public function checkLogin($user, $pass)
    {

        $select = $this->select();
        $select ->from($this, array('idUser', 'name'))
                ->where('name = ?', $user)
                ->where('password = ?', $pass)
                ->where('status = "a"');
                
        //echo $select;
        return $rows = $this->fetchRow($select);
    }
    
    public function updateVisit($user)
    { 
        $data = array(
                    'last_visit' => date("Y-m-d")
                    );
        $where =  $this->getAdapter()->quoteInto('idUser = ?',$user);
        $this->update($data,$where);
    }

}

?>
