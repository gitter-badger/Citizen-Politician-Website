<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("activity");
		$this->load->model("newsfeed");
		$this->load->model("opinionpolls");
		$this->load->model("electiondate");
		$this->load->model("accounts");
	}

	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['activity']=$this->activity->get_activity_count_html();
		$data['potw']=$this->opinionpolls->get_potw();
		$data['election_date']=$this->electiondate->index();
		$data['comments']=$this->newsfeed->index("Comments");
		$data['achievements']=$this->newsfeed->index("Achievements");
		$data['critiques']=$this->newsfeed->index("Critiques");
		$this->load->view('news_feed',$data);
	}

	public function checkPolitician($here=1){
		if(isset($_POST['target'])){
			if($_POST['target']==='anonymous'){
				if($here===1)  echo 1;
				return true;
			}
			$row=$this->accounts->check_politician($_POST['target']);
			if($here===1) echo (is_object($row))?1:0;
			return (is_object($row));
		}else{
			redirect(site_url("home"),"location");
		}
	}

	public function like_function(){
		if(!isset($_POST)) redirect(site_url("news_feed"),"location");
		if($this->newsfeed->like($_POST['analysis'],$_POST['id'],$_POST['action'])){
			echo "Success";
		}else{
			echo "Failure";
		}
	}
	public function post(){
		if(!isset($_POST)) redirect(site_url("news_feed"),"location");
		if(!$this->checkPolitician(0)){
			echo "Politician does not exist or is not from your county.";
			return;
		}
		if($_POST['table']!=="Comments"){
			if(isset($_FILES['evidence']['name'])){
				foreach ($_FILES['evidence']['name'] as  $value) {
					$target_file = $target_dir. basename($value);
					$file_type=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					if(!in_array($file_type,array('jpg','jpeg','png','mp4','mpeg','mkv'))){
						echo "File type denied. Please use files of extension jpg, jpeg, mp4, png, mpeg, mkv.";
						return;
					}
				}
			}else{
				echo "You have to upload evidence in form of pictures to support your claim.";
				return;
			}
		}
		$_POST['evidence']=(isset($_FILES['evidence']['name'][0])) ? $_FILES['evidence']['name'][0]:"";
		$result=$this->newsfeed->add_comment($_POST['table'],$_POST['comment'],$_POST['target'],$_POST['evidence']);
		if($result){
			echo $this->newsfeed->index($_POST['table']);
		}
	}
}
?>