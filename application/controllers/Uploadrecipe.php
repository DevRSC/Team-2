<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadrecipe extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 
	public function strcont($x, $y) {
		//for PHP 7 compatibility
		if (strpos($x, $y) !== false) {
			return true;
		} else {
			return false;
		}
	}
	
	public function do_upload() {
			$config['upload_path']          = './static/images/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;
			$config['max_width']            = 1920;
			$config['max_height']           = 1080;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('recipeimg')) {
					$error = array('error' => $this->upload->display_errors());
					return print_r ($error, true);
			} else {
					$data = array('upload_data' => $this->upload->data());
					return $data['upload_data']['file_name'];
			}
	}
	public function index()
	{
		//getting post, and then get requests guide
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
		// 	//$this->input->get_post('data', TRUE);
		// }
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }

		//$data['userdata'] = $this->Crudcentral->getUsers();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$recipetitle = $this->input->get_post('recipetitle', TRUE);

			$recipepreptime = $this->input->get_post('recipepreptime', TRUE);
			$recipecooktime = $this->input->get_post('recipecooktime', TRUE);
			$recipeserveshowmany = $this->input->get_post('recipeserveshowmany', TRUE);
			$recipedesc = $this->input->get_post('recipedesc', TRUE);
			$mainrecipedesc = $recipepreptime . "|||" . $recipecooktime . "|||" . $recipeserveshowmany . "|||" . $recipedesc; //genius I know

			$recipecategory = $this->input->get_post('recipecategory', TRUE);
			$recipeinst = $this->input->get_post('recipeinst', TRUE);

			$iimg = $this->do_upload();
			$res1 = $this->Crudcentral->insertRecipe($recipetitle, $mainrecipedesc, $recipeinst, $iimg, "null", "null", $recipecategory);

			if(intval($res1['code']) == 1) {
				$rrindex = $res1['recIndex'];
				foreach($this->input->post() as $key => $val) {
					//echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
					if ($this->strcont($key, "_ing")) {
						$ingred = $this->input->get_post($key, TRUE);
						$randnum = "_quan" . explode("_ing",$key)[1];
						$ingquantity = $this->input->get_post($randnum, TRUE);
						$res2 = $this->Crudcentral->insertIngredients($rrindex, $ingred, "null", "null", "null", $ingquantity);
						
					}
				}
				//redi
				redirect('Recipes');
			} else {
				//brah
			}

			

		} else {
			//bro i dont even know
		}

	
		
	}
}
