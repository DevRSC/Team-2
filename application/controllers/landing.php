<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landing extends CI_Controller {


	public function index()
	{
		//getting post, and then get requests guide
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
		// 	//$this->input->get_post('data', TRUE);
		// }
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }

		$data['userdata'] = $this->crud_central->getUsers();
		$this->load->view('landingpage', $data);
	}
}
