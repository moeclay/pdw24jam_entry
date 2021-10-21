<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		$options = array(
		    'cluster' => 'ap1',
		    'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
		    'e9fb609c093c4a456d73',
		    '5a5f7f43dcd6d4323ad1',
		    '926404',
		    $options
		);
		$data = array('update_pusher' => date('d-m-Y H:i:s'));
		$pusher->trigger('my-channel', 'my-event', $data);
	}

	public function hallo(){
		echo json_encode(['code' => 'code started !']);
	}
}
