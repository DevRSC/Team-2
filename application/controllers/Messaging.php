<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Manila');
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 
	public function loadMsg() {
		$data['msgsummary'] = $this->Crudcentral->readMessages("mah name chef",2);
			$a = array();
			foreach ($data['msgsummary'] as $mm) {
				array_push($a, array('ind' => $mm['userIndexTo'], 'nm' => $mm['mainname'], 'data' =>  $this->Crudcentral->readMessages($mm['userIndexTo'],0)));
			}
			$data['allmsgdata'] = $a;
			if (empty($_SESSION['userid'])) { 
				redirect('Login');
			} else {
				$this->load->view('msgpage', $data);
			}
	}
	public function allMsgRefresh() {
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		$dataa1 = $this->Crudcentral->readMessages("mah name chef",2);
		$a = array();
		
		foreach ($dataa1 as $mm) {
			array_push($a, array('ind' => $mm['userIndexTo'], 'nm' => $mm['mainname'], 'data' =>  $this->Crudcentral->readMessages($mm['userIndexTo'],0)));
		}
		echo "retry: 1000\n";
		echo "data: " . json_encode($dataa1) . "\n\n";
		flush();
	}
	public function loadMsgSpeck($x) {
		date_default_timezone_set('Asia/Manila');
		$dataa1 = $this->Crudcentral->readMessages($x,0);
			// $a = array();
			// foreach ($dataa1 as $mm) {
				// array_push($a, array('ind' => $mm['userIndexTo'], 'nm' => $mm['mainname'], 'data' =>  $this->Crudcentral->readMessages($mm['userIndexTo'],0)));
			// }
			//$allmsgdata = $a;
			if (empty($_SESSION['userid'])) { 
				redirect('Login');
			} else {
				$outt = "";
				$cc = "n";
				foreach ($dataa1 as $msg) {
					if ($cc == "n") {
						$cc = $msg['msgIndex'];
					}
					$x1 = $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "";
					$x2 = "";
					if ($msg['userIndexFrom'] != $_SESSION['userid']) {
						$x2 = '<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" alt="avatar">';
					}
					$varprep = ($msg['msgDate'] == "1999-01-01 00:00:00" ? "System generated message" : date("F j Y, g:i a", strtotime($msg['msgDate'])));
					$outtx = '
						<div class="message ' . $x1 . '">' . 
														$x2 . 
														'<div class="text-main">
															<div class="text-group ' . $x1 . '">
																<div class="text ' . $x1 . '">
																	<p>' . $msg['msg'] . '</p>
																</div>
															</div>
															<span>' . $varprep . '</span>
														</div>
													</div>
					';
					if ($msg['msg'] != "__blankbro__") {
						$outt = $outt . "\n" . $outtx;
					}
					
				}
				echo $outt;
			}
	}
	public function sendMsg($to, $msg) {
		if (strlen($msg) <= 0 || strlen($msg) >= 500 || ctype_space($msg)) {
			echo 'thatsbad';
		} else {
			$arr = $this->Crudcentral->sendMessage($to, $msg);
			date_default_timezone_set('Asia/Manila');
			$x1 = "me";
						$x2 = '<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" alt="avatar">';
					$outtx = '
						<div class="message ' . $x1 . '">' .
														'<div class="text-main">
															<div class="text-group ' . $x1 . '">
																<div class="text ' . $x1 . '">
																	<p>' . $msg . '</p>
																</div>
															</div>
															<span>' . date("F j Y, g:i a", time()) . '</span>
														</div>
													</div>
					';
			echo $outtx;
		}
	}
	public function index()
	{
		//getting post, and then get requests guide
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
			// $this->input->get_post('data', TRUE);
		// }
		//foreach($this->input->post() as $key => $val) {
		// 	echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
		// }
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$mo = intval($this->input->get_post('mo', TRUE));
			if ($mo == 1) {
				$msgrep = $this->input->get_post('msgreply', TRUE);
				$userto = $this->input->get_post('userto', TRUE);
				$this->sendMsg($userto, $msgrep);
			} else if ($mo == 2) {
				$userto = $this->input->get_post('userto', TRUE);
				$this->loadMsgSpeck($userto);
			}
		} else if ($this->input->server('REQUEST_METHOD') == 'GET' && intval($this->input->get('mod')) == 2) {
			$this->allMsgRefresh();
		} else {
			$this->loadMsg();
		}
		
	}
}
