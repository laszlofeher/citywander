<?php
class Members extends CI_Model{
 	
    function login($ncode, $password){
        $this -> db -> select('id, emailaddress, password, salt, firstname, lastname, temppassword, tempsalt, templogin');
        $this -> db -> from('visitor');
        $this -> db -> where('emailaddress', $ncode);
        $this -> db -> where('checkeduser', 1);

        $query = $this -> db -> get();
        foreach($query->result() as $row){
        }
        if(($query -> num_rows() == 1) && ($row->password === hash('sha512', trim($password).$row->salt))) {
            return $row;
        }else if(($query -> num_rows() == 1) && ($row->temppassword === hash('sha512', trim($password).$row->tempsalt))) {
            return $row;
        }else{		
            //die(hash('sha512',"e9ko_n5mtZag".$row->tempsalt)."--".$password." ".$row->emailaddress."---".$row->temppassword."---".hash('sha512', trim($password).$row->tempsalt));
            return false;
        }
    }
        
    //username, newpassword
    public function newPassword($username, $oldpassword, $password){
        // membercode miatt kell ez a lekérdezés
        $this -> db -> select('emailaddress, temppassword, tempsalt, membercode');
        $this -> db -> from('visitor');
        $this -> db -> where('emailaddress', $username);

        $query = $this -> db -> get();
        foreach($query->result() as $row){
        }
        if(($query -> num_rows() == 1) && ($row->temppassword === hash('sha512', trim($oldpassword).$row->tempsalt))) {
            $salt 		= uniqid(mt_rand(), true);
            $spassword 	= hash('sha512', $password.$salt);	;

            $data = array(
                'password' => $spassword,
                'salt' => $salt,
                'temppassword' => '',
                'tempsalt' => '',
                'templogin' => '0'
            );	

            $this->db->where('emailaddress', $username);
            $this->db->update('visitor', $data); 
        }
    }

}
?>