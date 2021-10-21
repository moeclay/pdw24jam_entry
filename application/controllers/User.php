<?php

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	// validasi tingkat ke 2
	public function index()
	{
		/*
			tujuan : mengarahkan pengguna untuk di direct ke controller mana.
		*/
		
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			redirect('admin');
		}elseif($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){
			redirect('staff');
		}elseif($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){
			redirect('bj');
		}elseif($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
			redirect('koperasi');
		}elseif($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='reseller'){
			redirect('reseller');
		}elseif($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){
			redirect('karyawan');
		}else{
        	$this->session->set_flashdata('error_login', "Username atau Password Salah !");
        	redirect('app');
        }

	}

	// konvert ke md5
    public function __encrip_password($password) {
        return md5("kin_".$password);
    }	

    // validasi tingkat 1
    public function validasi_credensial()
	{	
		$user_name = $this->input->post('username');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Login_model->validasi($user_name, $password);
		
		if($is_valid) {
			$data_user = $this->Login_model->tampilUser($user_name);

			$data = array(
				'user_name' 		=> $user_name,
				'id_user' 			=> $data_user->id_karyawan,
				'nama_lengkap' 		=> $data_user->nama,
				'status' 			=> $data_user->stts_login,
				'is_logged_in' 		=> true
			);
			$this->session->set_userdata($data);
			redirect('user');
		}
		else {
			redirect('user');
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama_lengkap');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('is_logged_in');
		redirect('app');
	}

	// ubah_password
	public function ubah_password(){
		// ubah password
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){

			$d['main_page']	= 'admin/ubah_password';
			$this->load->view('admin/template', $d);

		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){

			$d['main_page']	= 'staff/ubah_password';
			$this->load->view('staff/template', $d);

		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){

			$d['main_page']	= 'bj/ubah_password';
			$this->load->view('bj/template', $d);

		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){

			$d['main_page']	= 'koperasi/ubah_password';
			$this->load->view('koperasi/template', $d);

		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){
			
			$d['main_page']	= 'karyawan/ubah_password';
			$this->load->view('karyawan/template', $d);

		}else{
			redirect('user');
		}
	}

	// simpan password
	public function simpan_password(){
		// simpan password
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			// simpan password admin1
			$this->form_validation->set_rules('pass_lama','password pama','trim|required');
			$this->form_validation->set_rules('pass_baru','password baru','trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru','ulangi password baru','trim|required');
			
			$id 	= $this->input->post('id_form');
			$user_o = $this->session->userdata('user_name');
			$pass_o = $this->input->post('pass_lama');
			$pb 	= $this->input->post('pass_baru');
			$upb	= $this->input->post('ulangi_pass_baru');
			// validasi form
			if($this->form_validation->run() == TRUE){
				$is_valid = $this->Login_model->validasi($user_o, md5("kin_".$pass_o));
				if($is_valid){
					if($pb==$upb){
						$ps['user'] = $user_o;
						$ps['pass'] = md5("kin_".$pb);
						$this->Login_model->updatePassword($ps,$id);

						$this->session->set_flashdata('sukses','Sukses, Password anda telah dirubah !');
						header('location:'.site_url('user/ubah_password'));
					}else{
						$this->session->set_flashdata('pesan','Gagal, Password baru anda tidak sama !');
						header('location:'.site_url('user/ubah_password'));
					}
				} else {
					$this->session->set_flashdata('pesan','Gagal, Password lama anda salah !');
					header('location:'.site_url('user/ubah_password'));
				}
			}else{
				$this->session->set_flashdata('pesan','Isi form untuk mengubah password login !');
				redirect('user/ubah_password');
			}
		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){
			// simpan password admin2
			$this->form_validation->set_rules('pass_lama','password pama','trim|required');
			$this->form_validation->set_rules('pass_baru','password baru','trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru','ulangi password baru','trim|required');
			
			$id 	= $this->input->post('id_form');
			$user_o = $this->session->userdata('user_name');
			$pass_o = $this->input->post('pass_lama');
			$pb 	= $this->input->post('pass_baru');
			$upb	= $this->input->post('ulangi_pass_baru');
			// validasi form
			if($this->form_validation->run() == TRUE){
				$is_valid = $this->Login_model->validasi($user_o, md5($pass_o));
				if($is_valid){
					if($pb==$upb){
						$ps['user'] = $user_o;
						$ps['pass'] = md5($pb);
						$this->Login_model->updatePassword($ps,$id);

						$this->session->set_flashdata('sukses','Sukses, Password anda telah dirubah !');
						header('location:'.site_url('user/ubah_password'));
					}else{
						$this->session->set_flashdata('pesan','Gagal, Password baru anda tidak sama !');
						header('location:'.site_url('user/ubah_password'));
					}
				} else {
					$this->session->set_flashdata('pesan','Gagal, Password lama anda salah !');
					header('location:'.site_url('user/ubah_password'));
				}
			}else{
				$this->session->set_flashdata('pesan','Isi form untuk mengubah password login !');
				redirect('user/ubah_password');
			}
		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){
			// simpan password admin2
			$this->form_validation->set_rules('pass_lama','password pama','trim|required');
			$this->form_validation->set_rules('pass_baru','password baru','trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru','ulangi password baru','trim|required');
			
			$id 	= $this->input->post('id_form');
			$user_o = $this->session->userdata('user_name');
			$pass_o = $this->input->post('pass_lama');
			$pb 	= $this->input->post('pass_baru');
			$upb	= $this->input->post('ulangi_pass_baru');
			// validasi form
			if($this->form_validation->run() == TRUE){
				$is_valid = $this->Login_model->validasi($user_o, md5($pass_o));
				if($is_valid){
					if($pb==$upb){
						$ps['user'] = $user_o;
						$ps['pass'] = md5($pb);
						$this->Login_model->updatePassword($ps,$id);

						$this->session->set_flashdata('sukses','Sukses, Password anda telah dirubah !');
						header('location:'.site_url('user/ubah_password'));
					}else{
						$this->session->set_flashdata('pesan','Gagal, Password baru anda tidak sama !');
						header('location:'.site_url('user/ubah_password'));
					}
				} else {
					$this->session->set_flashdata('pesan','Gagal, Password lama anda salah !');
					header('location:'.site_url('user/ubah_password'));
				}
			}else{
				$this->session->set_flashdata('pesan','Isi form untuk mengubah password login !');
				redirect('user/ubah_password');
			}
		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
			// simpan password admin2
			$this->form_validation->set_rules('pass_lama','password pama','trim|required');
			$this->form_validation->set_rules('pass_baru','password baru','trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru','ulangi password baru','trim|required');
			
			$id 	= $this->input->post('id_form');
			$user_o = $this->session->userdata('user_name');
			$pass_o = $this->input->post('pass_lama');
			$pb 	= $this->input->post('pass_baru');
			$upb	= $this->input->post('ulangi_pass_baru');
			// validasi form
			if($this->form_validation->run() == TRUE){
				$is_valid = $this->Login_model->validasi($user_o, md5($pass_o));
				if($is_valid){
					if($pb==$upb){
						$ps['user'] = $user_o;
						$ps['pass'] = md5($pb);
						$this->Login_model->updatePassword($ps,$id);

						$this->session->set_flashdata('sukses','Sukses, Password anda telah dirubah !');
						header('location:'.site_url('user/ubah_password'));
					}else{
						$this->session->set_flashdata('pesan','Gagal, Password baru anda tidak sama !');
						header('location:'.site_url('user/ubah_password'));
					}
				} else {
					$this->session->set_flashdata('pesan','Gagal, Password lama anda salah !');
					header('location:'.site_url('user/ubah_password'));
				}
			}else{
				$this->session->set_flashdata('pesan','Isi form untuk mengubah password login !');
				redirect('user/ubah_password');
			}
		}else if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){
			// simpan password admin2
			$this->form_validation->set_rules('pass_lama','password pama','trim|required');
			$this->form_validation->set_rules('pass_baru','password baru','trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru','ulangi password baru','trim|required');
			
			$id 	= $this->input->post('id_form');
			$user_o = $this->session->userdata('user_name');
			$pass_o = $this->input->post('pass_lama');
			$pb 	= $this->input->post('pass_baru');
			$upb	= $this->input->post('ulangi_pass_baru');
			// validasi form
			if($this->form_validation->run() == TRUE){
				$is_valid = $this->Login_model->validasi($user_o, md5($pass_o));
				if($is_valid){
					if($pb==$upb){
						$ps['user'] = $user_o;
						$ps['pass'] = md5($pb);
						$this->Login_model->updatePassword($ps,$id);

						$this->session->set_flashdata('sukses','Sukses, Password anda telah dirubah !');
						header('location:'.site_url('user/ubah_password'));
					}else{
						$this->session->set_flashdata('pesan','Gagal, Password baru anda tidak sama !');
						header('location:'.site_url('user/ubah_password'));
					}
				} else {
					$this->session->set_flashdata('pesan','Gagal, Password lama anda salah !');
					header('location:'.site_url('user/ubah_password'));
				}
			}else{
				$this->session->set_flashdata('pesan','Isi form untuk mengubah password login !');
				redirect('user/ubah_password');
			}
		}else{
			redirect('user');
		}
	}
	
}