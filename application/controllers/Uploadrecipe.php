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
					return "errorrrr";
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
		$errorind = "ATTENTION: ";
		if (empty($_SESSION['userid'])) { 
			redirect('Login'); 
		} else {
			if ($this->input->server('REQUEST_METHOD') == 'POST') {
				$isedit = false;
				$previndex = $this->input->get_post('previndex', TRUE);
				$previmg = $this->input->get_post('previmg', TRUE);
				if (empty($previndex)) {
					$isedit = false;
				} else {
					$isedit = true;
				}
				$aaa = "";
				if ($isedit) {
					$aaa = $this->Crudcentral->getRecipe($previndex)[0]['userIndex'];
				}
				
				if ($aaa != $_SESSION['userid'] && $isedit) { 
					redirect('Login'); 
					//echo $aaa;
				} else {
					$recipetitle = $this->input->get_post('recipetitle', TRUE);

					$recipepreptime = $this->input->get_post('recipepreptime', TRUE);
					$recipecooktime = $this->input->get_post('recipecooktime', TRUE);
					$recipeserveshowmany = $this->input->get_post('recipeserveshowmany', TRUE);
					$recipedesc = $this->input->get_post('recipedesc', TRUE);
					$mainrecipedesc = $recipepreptime . "|||" . $recipecooktime . "|||" . $recipeserveshowmany . "|||" . $recipedesc; //genius I know

					$recipecategory = $this->input->get_post('recipecategory', TRUE);
					$recipeinst = $this->input->get_post('recipeinst', TRUE);

					$iimg = $this->do_upload();

					if ($isedit && $iimg == "errorrrr") {
						$iimg = $previmg;
					} else if (!$isedit && $iimg == "errorrrr") {
						$errorind = $errorind . " \\n There was a problem uploading your image. Please try again.";
					}
					//user input checking
					$cats = $this->Crudcentral->getAllCategories();
					$foundcat = false;
					foreach($cats as $cat) {
						if ($cat['catname'] == $recipecategory) {
							$foundcat = true;
							break;
						}
					}
					if (!$foundcat) {
						$errorind = $errorind . " \\n Please check your recipe category and try again.";
					}
					if (strlen($recipetitle) <= 2 || ctype_space($recipetitle)) {
						$errorind = $errorind . " \\n Please check your recipe title and try again.";
					}
					if (strlen($recipepreptime) <= 2 || ctype_space($recipepreptime)) {
						$errorind = $errorind . " \\n Please check your recipe preparation time and try again.";
					}
					if (strlen($recipecooktime) <= 2 || ctype_space($recipecooktime)) {
						$errorind = $errorind . " \\n Please check your recipe cook time and try again.";
					}
					if (strlen($recipeserveshowmany) <= 2 || ctype_space($recipeserveshowmany)) {
						$errorind = $errorind . " \\n Please check your recipe's serving suggestions and try again.";
					}
					if (strlen($recipedesc) <= 10 || strlen($recipedesc) >= 1000 || ctype_space($recipedesc)) {
						$errorind = $errorind . " \\n Between 10 to 2000 characters are allowed in a recipe's description.";
					}
					if (strlen($recipeinst) <= 10 || strlen($recipeinst) >= 3000 || ctype_space($recipeinst)) {
						$errorind = $errorind . " \\n Between 10 to 3000 characters are allowed in a recipe's instructions.";
					}
					foreach($this->input->post() as $key => $val) {
						if ($this->strcont($key, "_ing")) {
							$ingred = $this->input->get_post($key, TRUE);
							$randnum = "_quan" . explode("_ing",$key)[1];
							$ingquantity = $this->input->get_post($randnum, TRUE);
							if (strlen($ingquantity) <= 0 || strlen($ingquantity) >= 10 || ctype_space($ingquantity)) {
								$errorind = $errorind . " \n Some of your ingredients has invalid quantity. Please try again.";
								break;
							}			
						}
					}
					
					//if all is well
					if ($errorind == "ATTENTION: ") {
						$res1 = array();
						if ($isedit) {
							$res1 = $this->Crudcentral->insertRecipe($recipetitle, $mainrecipedesc, $recipeinst, $iimg, "null", "null", $recipecategory, 0, $previndex);
						} else {
							$res1 = $this->Crudcentral->insertRecipe($recipetitle, $mainrecipedesc, $recipeinst, $iimg, "null", "null", $recipecategory);
						}
						
						if(intval($res1['code']) == 1) {
							$rrindex = "";
							if ($isedit) {
								$rrindex = $res1['prevRecIndex'];
							} else {
								$rrindex = $res1['recIndex'];
							}
							
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
							if ($isedit) {
								redirect('Recipeview?r=' . urlencode($recipetitle));
							} else {
								redirect('Recipes');
							}
							
						} else {
							//brah
							$this->session->set_userdata('postrecipelog',$res1['msg']);
							redirect('Postrecipe');
						}
					} else {
						$this->session->set_userdata('postrecipelog',$errorind);
						redirect('Postrecipe');
					}
				}
			
				
			} else {
				//bro i dont even know
			
			}
		}
	
		
	}
}
