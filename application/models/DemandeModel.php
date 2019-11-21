<?php


class DemandeModel extends CI_Model
{
	public function getAll(){
		$query=$this->db->get('demandes');
		return $query->result_array();
	}

	function insert_data($data)
	{
		$this->db->insert('demandes', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	function update_data($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("demandes", $data);
	}

	function delete_data($user_id)
	{
		$this->db->where("id", $user_id);
		$this->db->delete("demandes");
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}
}
