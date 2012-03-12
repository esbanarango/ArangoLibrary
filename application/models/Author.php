<?php


class  Application_Model_Author extends Zend_Db_Table_Abstract
{
    protected $_name = 'author';

    public function save($city,$idImage,$name,$last_name,$birth_date,$death_date,$bio,$education)
    {
       
        /**
         * 	 idAuthor	int(10)		UNSIGNED            No      None	auto_increment	 	 	 	 	 	 	
         *       city           int(11)                             No      None		 	 	 	 	 	 	
         *       idImage        int(10)	        UNSIGNED            Sí      NULL		 	 	 	 	 	 	
         *       name           varchar(100)	latin1_swedish_ci   No      None		 	 	 	 	 	 	
         *       last_name	varchar(100)	latin1_swedish_ci   Sí	    NULL		 	 	 	 	 	 	
         *       birth_date	date                                Sí      NULL		 	 	 	 	 	 	
         *       death_date	date                                Sí	    NULL		 	 	 	 	 	 	
         *       bio            text            latin1_swedish_ci   Sí	    NULL		 	 	 				
         *       education	text            latin1_swedish_ci   Sí	    NULL		 	 	 				
         */
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