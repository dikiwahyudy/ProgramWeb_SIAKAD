<!-- Model Dosen -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_semester extends CI_Model
{
    public function Get($id_semester = null)
    {
        if ($id_semester != null) {
            $this->db->where('id_semester', $id_semester);
        }

        return $this->db->get('semester');
    }

    function Save($data)
    {
        return $this->db->insert('semester', $data);
    }

    function Updated($data, $where)
    {
        $this->db->where('id_semester', $where);
        return $this->db->update('semester', $data);
    }
    function Deleted($id_semester)
    {
        return $this->db->delete('semester', ['id_semester' => $id_semester]);
    }
    function GetIdSemester()
    {
        $this->db->select('id_semester, semester');
        return $this->db->get('semester')->result_array();
    }
}