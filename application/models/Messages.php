<?php
class Messages extends CI_Model{
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function getMessage($settingsname, $language='en'){
        $this->db->select('id ,textproperty, textproperty1');
        $this->db->from('settings');
        $this->db->where('settingsname',$settingsname);
        $this->db->where('settingsgroup','_messages');
        $this->db->where('language',$language);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data = array(
                    'id'=>$row->id,
                    'title'=>$row->textproperty,
                    'description'=>$row->textproperty1);
            }
            return $data;
        }
        return array();
    }
}
?>