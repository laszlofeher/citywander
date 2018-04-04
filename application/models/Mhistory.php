<?php

class Mhistory extends Basemodel {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $historyArray
     * 
     * ipaddress
     * event
     * promotion_id
     * user_id
     * 
     * 
     */
    public function addHistory($historyArray) {
        $error = 0;
        if (isset($historyArray['ipaddress'])) {
            $error['ipaddress'] = 1;
        }

        if (isset($historyArray['event'])) {
            $error['event'] = 1;
        }

        if (isset($historyArray['promotion_id'])) {
            $error['promotion_id'] = 1;
        }

        if (isset($historyArray['user_id'])) {
            $error['user_id'] = 1;
        }

        $this->db->set('eventdate', 'NOW()', FALSE);
        $historyArray['deleted'] = '2';
        $this->db->insert('history', $historyArray);
    }

    public function removeHistory($historyid) {
        $this->db->set('deleted', '1');
        $this->db->where('id', $historyid);
        $this->db->update('history');
    }

    /**
     * 
     * 
     * 
     * ipaddress
     * eventdate
     * event
     * promotion_id
     * user_id
     * 
     * 
     */
    public function getHistory() {
        $this->db->select();
        $this->db->from();
        $this->db->join();
        $this->db->where();
        $query = $this->db->get();
        $history = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $history[] = array(
                    'id' => $row->id,
                    'ipaddress' => $row->ipaddress,
                    'eventdate' => $row->eventdate,
                    'event' => $row->event,
                    'promotion_id' => $row->promotion_id,
                    'user_id' => $row->user_id
                );
            }
        }
        return $history;
    }

}
