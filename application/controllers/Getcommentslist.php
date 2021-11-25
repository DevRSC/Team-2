<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getcommentslist extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('url');
        //$this->load->helper('cookie');
    } 
//thank you,  Vicky Salunkhe
							//return current date time
							function getCurrentDateTime(){
								date_default_timezone_set("Asia/Manila");
								return date("Y-m-d H:i:s");
							}
							function getDateString($date){
								$dateArray = date_parse_from_format('Y/m/d', $date);
								$monthName = DateTime::createFromFormat('!m', $dateArray['month'])->format('F');
								return $dateArray['day'] . " " . $monthName  . " " . $dateArray['year'];
							}

							function getDateTimeDifferenceString($datetime){
								$currentDateTime = new DateTime($this->getCurrentDateTime());
								$passedDateTime = new DateTime($datetime);
								$interval = $currentDateTime->diff($passedDateTime);
								//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
								$day = $interval->format('%a');
								$hour = $interval->format('%h');
								$min = $interval->format('%i');
								$seconds = $interval->format('%s');

								if($day > 7)
									return $this->getDateString($datetime);
								else if($day >= 1 && $day <= 7 ){
									if($day == 1) return $day . " day ago";
									return $day . " days ago";
								}else if($hour >= 1 && $hour <= 24){
									if($hour == 1) return $hour . " hour ago";
									return $hour . " hours ago";
								}else if($min >= 1 && $min <= 60){
									if($min == 1) return $min . " minute ago";
									return $min . " minutes ago";
								}else if($seconds >= 1 && $seconds <= 60){
									if($seconds == 1) return $seconds . " second ago";
									return $seconds . " seconds ago";
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
		//sleep(1.5);//lol
		$ind = $this->input->get_post('ind', TRUE);
		$currentComments = $this->Crudcentral->getAllComments($ind);

		if (!isset($currentComments['code'])) {
			$aacomp = "";
			foreach ($currentComments as $comm) {
				$yow = $this->getDateTimeDifferenceString($comm['dte']);
				$yowyow = intval($comm['upvoteType']) == 1 ? site_url('/images/likeselected.png') : site_url('/images/like.png');
				$aaa = '
					<li class="comment depth-1">
						<div class="avatar"><a href="Accountview?a=' . $comm['userIndex'] . '"><img src="images/avatar.jpg" alt="" /></a></div>
						<div class="comment-box">
							<div class="comment-author meta"> 
								<strong>' . $comm['commentor'] . '</strong> said ' . $yow . '
								<div id="comm_' . $comm['commIndex'] . '" onClick="toggleUpvote(' . "'" . $comm['commIndex'] . "'" . ');" style="height: 30px;cursor: pointer;display: inline-block" class="comment-reply-link" >
								<span id="commspan_' . $comm['commIndex'] . '" style="position: relative;top: -5px;">' . $comm['upvoteCount'] . '</span>&nbsp;&nbsp;&nbsp;
								<img id="likedimg_' . $comm['commIndex'] . '" src=' . $yowyow . ' style="height: 20px;display: inline-block" /> </div>
								<img id="loadingupv_' . $comm['commIndex'] . '" src="images/gil.gif" style="float: right; height: 30px;margin-right: 80px;display: none;">
							</div>
							<div class="comment-text">
								<p>' . $comm['comment'] . '</p>
							</div>
						</div> 
					</li>
				';
				$aacomp = $aacomp . $aaa;
			}
			echo $aacomp;
		}
		
		
	}
}
