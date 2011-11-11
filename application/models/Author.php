<?php


class  Application_Model_Author extends Zend_Db_Table_Abstract
{
    protected $_name = 'author';

    public static function addAuthor($city,$idImage,$name,$last_name,$birth_date,$death_date,$bio,
            $education)
    {
        $author = new Application_Model_Author();

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
        $author->insert($data);
    }
    
    public static function editAuthor($idAuthor,$city,$idImage,$name,$last_name,$birth_date,$death_date,
            $bio,$education)
    {
        $author = new Application_Model_Author();

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

        $where = $author->getAdapter()->quoteInto('idAuthor = ?', $idAuthor);
        $total = $author->update($data, $where);

        return $total;
        
    }
    
        
    public static function getAllAuthors($idOffer) 
    {
        $author = new Application_Model_Author();
        
        $select = $author->select();

        $select->from($author);
        
        
        //echo $select;
        return $rows = $author->fetchAll($select);
    }
}