<?php


class  Application_Model_Author extends Zend_Db_Table_Abstract
{
    protected $_name = 'author';

    public function addAuthor($city,$idImage,$name,$last_name,$birth_date,$death_date,$bio,
            $education)
    {

        $data = array(
            'city' => $city,
            'idImage' => $idImage,
            'name' => $name,
            'last_name' => $last_name,
            'birth_date' => $birth_date,
            'death_date' => $death_date,
            'bio' => $bio,
            'education' => $education
            );
        return $this->insert($data);
    }
    
    public function editAuthor($idAuthor,$city,$idImage,$name,$last_name,$birth_date,$death_date,
            $bio,$education)
    {

        $data = array(
            'city' => $city,
            'idImage' => $idImage,
            'name' => $name,
            'last_name' => $last_name,
            'birth_date' => $birth_date,
            'death_date' => $death_date,
            'bio' => $bio,
            'education' => $education
            );

        $where = $this->getAdapter()->quoteInto('idAuthor = ?', $idAuthor);
        $total = $this->update($data, $where);

        return $total;
        
    }
    
        
    public function getAllAuthors() 
    {
        
        $select = $this->select();
        $select->from($this);
        
        //echo $select;
        return $rows = $this->fetchAll($select);
    }
}