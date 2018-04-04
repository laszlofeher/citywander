<?php

class Visitor extends Basemodel {
    
    function login($emailaddress, $password){
        $this->db->select('id, emailaddress, password, salt, firstname, lastname, mobile, temppassword, tempsalt, templogin');
        $this->db->from('visitor');
        $this->db->where('emailaddress', $emailaddress);
        $this->db->where('checkedvisitor', 1);
        $query  = $this->db->get();
        $row    = $query->result();
        if(($query->num_rows() == 1) && ($row[0]->password === hash('sha512', trim($password).$row[0]->salt))) {
            return $row[0];
        }else if(($query->num_rows() == 1) && ($row[0]->temppassword === hash('sha512', trim($password).$row[0]->tempsalt))) {
            return $row[0];
        }else{		
            //die(hash('sha512',"e9ko_n5mtZag".$row->tempsalt)."--".$password." ".$row->emailaddress."---".$row->temppassword."---".hash('sha512', trim($password).$row->tempsalt));
            return false;
        }
    }
    
    /**
     * @param type $id
     * @return type
     */
    public function getVisitorById($id){
        $id = (int)$id;
        $this->db->select("id, firstname, lastname, password, salt, emailaddress, state ");
        $this->db->where("id",$id);
        $this->db->where("active",'2');
        $this->db->from("visitor");
        $query = $this->db->get();
        $visitor = array();
        if($query->num_rows() >0){
            foreach ($query->result() as $row){
                $visitor = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'password' => $row->password,
                    'salt' => $row->salt,
                    'emailaddress' => $row->emailaddress,
                    'state' => $row->state
                );
            }
        }
        return $visitor;
    }
    
    /**
     * @param type $id
     * @return type
     */
    public function getVisitorByFacebookId($facebookid){
        $this->db->select("id, firstname, lastname, password, salt, emailaddress, state ");
        $this->db->where("facebook_id",$facebookid);
        $this->db->where("active",'2');
        $this->db->from("visitor");
        $query = $this->db->get();
        $visitor = array();
        if($query->num_rows() >0){
            foreach ($query->result() as $row){
                $visitor = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'password' => $row->password,
                    'salt' => $row->salt,
                    'emailaddress' => $row->emailaddress,
                    'state' => $row->state
                );
            }
        }
        return $visitor;
    }
    /**
     * @param type $id
     * @return type
     */
    public function getVisitorByGoogleId($googleid){
        $this->db->select("id, firstname, lastname, password, salt, emailaddress, state ");
        $this->db->where("google_id",$googleid);
        $this->db->where("active",'2');
        $this->db->from("visitor");
        $query = $this->db->get();
        $visitor = array();
        if($query->num_rows() >0){
            foreach ($query->result() as $row){
                $visitor = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'password' => $row->password,
                    'salt' => $row->salt,
                    'emailaddress' => $row->emailaddress,
                    'state' => $row->state
                );
            }
        }
        return $visitor;
    }
    
    public function getVisitors(){
        $this->db->select("id, firstname, lastname, password, salt, emailaddress, state ");
        $this->db->where("id",$id);
        $this->db->where("active",'2');
        $this->db->where("active",'1');
        $this->db->from("visitors");
        $query = $this->db->get();
        $visitors = array();
        if($query->num_rows() >0){
            foreach ($query->result() as $row){
                $visitors[] = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'password' => $row->password,
                    'salt' => $row->salt,
                    'emailaddress' => $row->emailaddress,
                    'state' => $row->state
                );
            }
        }
        return $visitors;
    }
    
    public function getVisitorByEmail($email){
        $email = $email;
        $this->db->select("id, firstname, lastname, password, salt, emailaddress, state ");
        $this->db->where("emailaddress",$email);
        $this->db->where("active",'2');
        $this->db->from("visitor");
        $query = $this->db->get();
        $visitorArray =[];
        if($query->num_rows() >0){
            $visitorArray = $query->result_array()[0];
        }
        return $visitorArray;      
    }
    
    /**
     * @param type $visitorArray
     * firstname
     * lastname
     * email
     * password
     * visitorstate_id  = 2
     */
    
    public function addVisitor($firstname, 
            $lastname, $emailaddress,
            $password, $salt, $mobile,
            $facebook_id='',$google_id='',$newsletter = 0,
            $sponsoremail=''/*,
            $invoicename, $taxnumber,
            $zipcode, $city, $ppname,
            $pptype, $hnumber, $invoicezipcode,  
            $invoicecity, $invoiceppname,   
            $invoicepptype, $invoicehnumber,
            $postzipcode,
            $postcity, $postppname,
            $postpptype, $posthnumber,
            $newsletter, $noregistrated = 2*/){
        $visitorArray=array(
            'firstname'             =>  $firstname,
            'lastname'              =>  $lastname,
            'emailaddress'          =>  $emailaddress,
            'password'              =>  $password,
            'salt'                  =>  $salt,
            'mobile'                =>  $mobile,
            'facebook_id'           =>  $facebook_id,
            'google_id'             =>  $google_id,
            /*
            'invoicename'           =>  $invoicename,
            'taxnumber'             =>  $taxnumber,
            'zipcode'               =>  $zipcode,
            'city'                  =>  $city,
            'ppname'                =>  $ppname,
            'pptype'                =>  $pptype,
            'hnumber'               =>  $hnumber,
            'invoicezipcode'        =>  $invoicezipcode,
            'invoicecity'           =>  $invoicecity,
            'invoiceppname'         =>  $invoiceppname,
            'invoicepptype'         =>  $invoicepptype,
            'invoicehnumber'        =>  $invoicehnumber,
            'postzipcode'           =>  $postzipcode,
            'postcity'              =>  $postcity,
            'postppname'            =>  $postppname,
            'postpptype'            =>  $postpptype,
            'posthnumber'           =>  $posthnumber,
            'newsletter'            =>  $newsletter,
            'firstlogin'            =>  1,
            'noregistrated'         => $noregistrated,*/
            'deleted'               => 1,
            'checkedvisitor'        => 2,
            'visitorstate_id'       => 2,
            'active'                => 2,
            'news'                  => $newsletter  
        );
        $this->db->set('crd', 'NOW()', FALSE);
        $this->db->insert('visitor', $visitorArray);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    
    /**
     * @param type $visitorArray
     * firstname
     * lastname
     * email
     * password
     * visitorstate_id  = 2
     */
    public function addVisitorFirst($fullname, $emailaddress,
        $password, $salt, 
        $facebook_id='', $newsletter = 0, $buyeracquisitor_id){
        $visitorArray=array(
            'fullname'              =>  $fullname,
            'emailaddress'          =>  $emailaddress,
            'password'              =>  $password,
            'salt'                  =>  $salt,
            'facebook_id'           =>  $facebook_id,
            'deleted'               =>  1,
            'checkedvisitor'        =>  2,
            'visitorstate_id'       =>  2,
            'active'                =>  2,
            'news'                  =>  $newsletter,
            'buyeracquisitor_id'    =>  $buyeracquisitor_id
        );
        $this->db->set('crd', 'NOW()', FALSE);
        $this->db->insert('visitor', $visitorArray);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    
    public function deleteVisitor(){
        
    }
    
    public function updateVisitorWithFacebookid($id = -1, $facebookid){
        $id = (int)$id;
        $error = FALSE;
        if($id != -1){
            $updateArray = array(
                'facebook_id' => $facebookid
            );
            $this->db->where('id', $id);
            $this->db->update('visitor',$updateArray);
            
        }
    }
    public function updateVisitorWithGoogleid($id = -1, $googleid){
        $id = (int)$id;
        $error = FALSE;
        if($id != -1){
            $updateArray = array(
                'google_id' => $googleid

            );
            $this->db->where('id', $id);
            $this->db->update('visitor',$updateArray);
            
        }
    }
    
    public function firstLoginSave($id){
        if((int)$id > 0){
            $data = array(
                'firstlogin' => 2
            );
            $this->db->where('id', $id);
            $this->db->update('visitor', $data);
        }
    }
    
    public function updateCheckedVisitorString($visitor_id = -1, $checkedUserString){
        if(((int)$visitor_id) > 0){
            $data = array(
                'checkedvisitorstring' =>$checkedUserString,
                'visitorstate_id'      => 3
            );
            $this->db->where('id', (int)$visitor_id);
            $this->db->update('visitor', $data);
        }
    }
    public function updateCheckedVisitor($checkedVisitorString){
        $registreduser_id = -1;
        if(strlen($checkedVisitorString) > 0){
            $this->db->select('id, firstname, lastname, emailaddress');
            $this->db->from('visitor');
            $this->db->where('checkedvisitorstring', $checkedVisitorString);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {}
                $registreduser_id = $row->id;
            
                $data = array(
                    'checkedvisitorstring' =>  '',
                    'checkedvisitor'       =>  1
                );
                $this->db->set('checkeddate', 'NOW()', FALSE);
                $this->db->where('checkedVisitorString', $checkedVisitorString);
                $this->db->update('visitor', $data);
                return $registreduser_id;
            }
            return -1;
        }
    }
    /**
     * Elfelejtett jelszó resetid mentéséhez készített metódus
     * Forgott password 
     * @param type $emailaddress
     * @param type $resetid
     */
    public function updateVisitorResetid($emailaddress, $resetid){
        $data = array(
            'resetpassword' =>$resetid
        );
        $this->db->where('emailaddress', $emailaddress);
        $this->db->update('visitor', $data);
    }
    
    public function updateVisitorPassword($emailaddress, $password, $salt){
        $data = array(
            'password'      =>$password,
            'salt'          =>$salt,
            'resetpassword' => ''
        );
        $this->db->where('emailaddress', $emailaddress);
        $this->db->update('visitor', $data);
    }
    
    /**
     * 
     * @param type $emailaddress
     * @return boolean
     * deprecated
     */
    public function emailExist($emailaddress){
        $this->db->select('emailaddress');
        $this->db->from('visitor');
        $this->db->where('emailaddress', $emailaddress);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
    
    public function getResetpassword($resetid){
        $this->db->select('id, firstname, lastname, emailaddress, resetpassword');
        $this->db->from('visitor');
        $this->db->where('resetpassword', $resetid);
        $query = $this->db->get();
        $returnArray = [];
        if ($query->num_rows() > 0) {
            $returnArray = $query->result_array();
        }
        return $returnArray;
    }
    
    /**
     * 
     * @param type $oauth_facebook_id
     * @param type $firstname
     * @param type $lastname
     * @param type $emailaddress
     * @return type
     */
    public function saveVisitorFromFacebook($oauth_facebook_id, $firstname, 
                                                $lastname, $emailaddress){
        $data=array(
            'oauth_facebook_id'     =>  $oauth_facebook_id,
            'firstname'             =>  $firstname,
            'lastname'              =>  $lastname,
            'emailaddress'          =>  $emailaddress
        );
        $this->db->insert('visitor', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    
    /**
     * 
     * @param type $oauth_facebook_id
     * @param type $emailaddress
     */
    
    public function existVisitor($oauth_facebook_id, $emailaddress=NULL){
        $this->db->select('visitor.id ,firstname ,lastname, emailaddress, if(oauth_facebook_id is null,\'-1\',\'1\') as exist_facebook_id, if(emailaddress is null,\'-1\',\'1\') as exist_emailaddress ');
        $this->db->from('visitor');
        $this->db->where('emailaddress',$emailaddress);
        $this->db->or_where('oauth_facebook_id',$oauth_facebook_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data = array(
                    'id'                    =>$row->id,                        
                    'firstname'             =>$row->firstname,
                    'lastname'              =>$row->lastname,                  
                    'emailaddress'          =>$row->emailaddress,                  
                    'exist_facebook_id'     =>$row->exist_facebook_id,                  
                    'exist_emailaddress'    =>$row->exist_emailaddress                  
                );
            }
            return $data;
        }
        return false;
    }
    
    public function getRegistratedVisitorAddress($userId = -1){
        $this->db->select('visitor.id ,postcity, postcounty, postppname, postpptype, posthnumber, postzipcode, invoicecity, invoicecounty, invoiceppname, invoicepptype, invoicehnumber, invoicezipcode, taxnumber, invoicename ');
        $this->db->from('visitor');
        $this->db->where('visitor.id',(int)$userId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = array(
                    'id'                =>$row->id,
                    'postcity'              =>$row->postcity,
                    'postcounty'            =>$row->postcounty,
                    'postppname'            =>$row->postppname,
                    'postpptype'            =>$row->postpptype,
                    'posthnumber'           =>$row->posthnumber,
                    'postzipcode'           =>$row->postzipcode,
                    'invoicecity'       =>$row->invoicecity,
                    'invoicecounty'     =>$row->invoicecounty,
                    'invoiceppname'     =>$row->invoiceppname,
                    'invoicepptype'     =>$row->invoicepptype,
                    'invoicehnumber'    =>$row->invoicehnumber,
                    'invoicezipcode'    =>$row->invoicezipcode,
                    'invoicename'       =>$row->invoicename,
                    'taxnumber'         =>$row->taxnumber
                );
            }
            return $data;
        }
        return false;
    }
    
    //account update
    /**
     * @param type $registreduser_id
     * @param type $firstname
     * @param type $lastname
     * @param type $emailaddress
     * @param type $mobile
     */
    public function updateRegistratedVisitorAccount($registreduser_id = -1, $firstname, 
                                                $lastname, $emailaddress,
                                                $mobile,$password, $salt){
        if($password != NULL){
        
            $data = array(
                'firstname'         => $firstname,
                'lastname'          => $lastname,
                'emailaddress'      => $emailaddress,
                'mobile'            => $mobile,
                'password'          => $password,
                'salt'              => $salt);
        }else{
            $data = array(
                'firstname'         => $firstname,
                'lastname'          => $lastname,
                'emailaddress'      => $emailaddress,
                'mobile'            => $mobile);
        }
        $this->db->where('id',$registreduser_id);
        $this->db->update('visitor', $data);
    }
    
    /**
     * 
     * @param type $registreduser_id
     * @param type $invoicename
     * @param type $taxnumber
     * @param type $invoicezipcode
     * @param type $invoicecity
     * @param type $invoiceppname
     * @param type $invoicepptype
     * @param type $invoicehnumber
     * @param type $postzipcode
     * @param type $postcity
     * @param type $postppname
     * @param type $postpptype
     * @param type $posthnumber
     */
    public function updateRegistratedVisitorAddress($registreduser_id = -1, $invoicename, $taxnumber,
                                                    $invoicezipcode,  
                                                    $invoicecity, $invoiceppname,   
                                                    $invoicepptype, $invoicehnumber,
                                                    $postzipcode, $postcity, 
                                                    $postppname, $postpptype, 
                                                    $posthnumber){
        
        $data = array(
            'invoicename'           =>  $invoicename,
            'taxnumber'             =>  $taxnumber,
            'invoicezipcode'        =>  $invoicezipcode,
            'invoicecity'           =>  $invoicecity,
            'invoiceppname'         =>  $invoiceppname,
            'invoicepptype'         =>  $invoicepptype,
            'invoicehnumber'        =>  $invoicehnumber,
            'postzipcode'           =>  $postzipcode,
            'postcity'              =>  $postcity,
            'postppname'            =>  $postppname,
            'postpptype'            =>  $postpptype,
            'posthnumber'           =>  $posthnumber
        );
        
        $this->db->where('id',$registreduser_id);
        $this->db->update('visitor', $data);
    }
    
    /**
     * 
     * @param type $registreduser_id
     * @param type $firstname
     * @param type $lastname
     * @param type $emailaddress
     * @param type $mobile
     * @param type $invoicename
     * @param type $taxnumber
     * @param type $invoicename
     * @param type $invoicezipcode
     * @param type $invoicecity
     * @param type $invoiceppname
     * @param type $invoicepptype
     * @param type $invoicehnumber
     * @param type $postzipcode
     * @param type $postcity
     * @param type $postppname
     * @param type $postpptype
     * @param type $posthnumber
     * 
     * 
     */
    public function updateRegistratedVisitor($registreduser_id = -1, $firstname, 
            $lastname, $emailaddress,
            $mobile/*, $invoicename, $taxnumber,
            $invoicename, $invoicezipcode,  
            $invoicecity, $invoiceppname,   
            $invoicepptype, $invoicehnumber,
            $postzipcode,
            $postcity, $postppname,
            $postpptype, $posthnumber*/){
        
        
        $data = array(
            'firstname'         => $firstname,
            'lastname'          => $lastname,
            'emailaddress'      => $emailaddress,
            'mobile'            => $mobile/*,
            'postcity'          => $postcity,
            'postppname'        => $postppname,
            'postpptype'        => $postpptype,
            'posthnumber'       => $posthnumber,
            'postzipcode'       => $postzipcode,
            'invoicename'       => $invoicename,
            'invoicecity'       => $invoicecity,
            'invoiceppname'     => $invoiceppname,
            'invoicepptype'     => $invoicepptype,
            'invoicehnumber'    => $invoicehnumber,
            'invoicezipcode'    => $invoicezipcode,
            'invoicename'       => $invoicename,
            'taxnumber'         => $taxnumber*/
        );
        $this->db->where('id',$registreduser_id);
        $this->db->update('visitor', $data);
    }
            
    public function getMember($id){
        $fid = (int)$id;
        $this->db->select('id, firstname,
                lastname,
                emailaddress,
                picture,
                mobile,
                phone,
                office,
                oauth_facebook_id,
                oauth_google_plus_id,
                city,
                county,
                country,
                ppname,
                pptype,
                hnumber,
                zipcode,
                invoicename,
                invoicecity,
                invoicecounty,
                invoiceppname,
                invoicepptype,
                invoicehnumber,
                invoicezipcode,
                postcity,
                postcountry,
                postcounty,
                postppname,
                postpptype,
                posthnumber,
                postzipcode,
                taxnumber
            ');
        $this->db->from('visitor');
        $this->db->where('deleted','1');
        $this->db->where('id',$fid);

        $query = $this->db->get();
        //adat tömb elokeszitese
        $data = array();
        foreach ($query->result() as $row) {
            $data = array(
                'id'                    => $row->id,
                'firstname'             => $row->firstname,
                'lastname'              => $row->lastname,
                'emailaddress'          => $row->emailaddress,
                'picture'               => $row->picture,
                'mobile'                => $row->mobile,
                'phone'                 => $row->phone,
                'office'                => $row->office,
                'oauth_facebook_id'     => $row->oauth_facebook_id,
                'oauth_google_plus_id'  => $row->oauth_google_plus_id,
                'invoicename'           => $row->invoicename,
                'invoicecity'           => $row->invoicecity,
                'invoicecounty'         => $row->invoicecounty,
                'invoiceppname'         => $row->invoiceppname,
                'invoicepptype'         => $row->invoicepptype,
                'invoicehnumber'        => $row->invoicehnumber,
                'invoicezipcode'        => $row->invoicezipcode,
                'postcity'              => $row->postcity,
                'postcountry'           => $row->postcountry,
                'postcounty'            => $row->postcounty,
                'postppname'            => $row->postppname,
                'postpptype'            => $row->postpptype,
                'posthnumber'           => $row->posthnumber,
                'postzipcode'           => $row->postzipcode,
                'taxnumber'             => $row->taxnumber
            );
        }
        return $data;
    }
    
}