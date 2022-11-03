<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function simpan($table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
}
