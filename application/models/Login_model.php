<?php

class Login_model extends CI_Model {

    // fungsi validate login membership
	public function validasi($user_name, $password)
	{
		$sql = sprintf("SELECT * FROM karyawan WHERE user='$user_name' AND pass='$password' ");
		$query = $this->db->query($sql);
		if($query->num_rows() == 1)
		{
			return true;
		}
	}

	public function tampilUser($user){
		$sql = sprintf("SELECT * FROM karyawan WHERE user='$user' ");
		$query = $this->db->query($sql);
		$data_row = $query->row();

		return $data_row;
	}

	public function updatePassword($ps,$id){
		$sql = sprintf("UPDATE karyawan SET user='$ps[user]', pass='$ps[pass]' WHERE id_karyawan='$id'");
		$this->db->query($sql);
	}

    // mendapatkan session login dari user
    // fungsi get_db_session_data
	public function ambil_sesi_user()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	

	
}

