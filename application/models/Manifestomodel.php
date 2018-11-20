<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/Cloudinary/autoload.php";
require_once APPPATH."/third_party/Cloudinary/src/Api.php";
require_once APPPATH."/third_party/Cloudinary/src/Cloudinary.php";
require_once APPPATH."/third_party/Cloudinary/src/Helpers.php";
require_once APPPATH."/third_party/Cloudinary/src/Uploader.php";
class Manifestomodel extends CI_Model {
	public function __construct(){
		parent::__construct();
		\Cloudinary::config(array( 
		  "cloud_name" => "dkgtd3pil", 
		  "api_key" => "614412954515959", 
		  "api_secret" => "azKeL5xxqg9BEeC7TGrHsP5fnJM" 
		));
	}
	public function get_manifestos(){
		$return=$this->db->query("select manifestos.*,ifnull(photo,'anonymous.png') as photo from manifestos left join politician_profile on owner=userName where owner!=?",$this->session->userdata('username'))->result();
		foreach ($return as $value) {
			$value->photo=(stripos($value->photo, 'https')===false)?base_url("resources/$value->photo"):$value->photo;
		}
		return $return;
	}

	public function my_manifesto(){
		$return=$this->db->query("select manifestos.*,ifnull(photo,'anonymous.png') as photo from manifestos left join politician_profile on owner=userName where owner=?",$this->session->userdata('username'))->row();
		if(isset($return)){
			$return->photo=(stripos($return->photo, 'https')===false)?base_url("resources/$return->photo"):$return->photo;
		}
		return $return;
	}

	public function add_manifesto(){
		$id=$this->db->query("select max(manifestoID) as num from manifestos")->row()->num+1;
		$target_dir= "mwananchi/manifestos/";
		$data=\Cloudinary\Uploader::upload($_FILES['image']['tmp_name'], array("resource_type" => "auto","folder" => $target_dir,'public_id'=>$id));
		if($data){
			return $this->db->query("insert into manifestos(manifestoID,owner,manifesto) values (?,?,?)",array($id,$this->session->userdata('username'),$data['secure_url']));
		}else{
			return false;
		}
	}

	public function edit_manifesto($owner){
		$id=$this->db->query("select manifestoID as num from manifestos where owner=?",$owner)->row()->num;
		$target_dir= "mwananchi/manifestos/";
		$data=\Cloudinary\Uploader::upload($_FILES['image']['tmp_name'], array("resource_type" => "auto","folder" => $target_dir,'public_id'=>$id));
		if($data){
			return $this->db->query("update manifestos set manifesto=? where owner=?",array($data['secure_url'],$owner));
		}else{
			return false;
		}
	}
}
?>