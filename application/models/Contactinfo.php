<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactinfo extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	//Add a contact us request to the database. Data to database must be properly sanitized to prevent sql injection and xss attacks.
	public function add_contact($name,$email,$question){
		return $this->db->query("insert into contact(name,email,question) values (?,?,?,?)",array($name,$email,$question));
	}

	//A function that gets all the frequently asked questions from the database based on a search string, limit and offset. This enables one to get only the amount of data that is required. The search string is used in a LIKE statement as shown.
	public function get_faq($search,$limit,$offset){
		$search='%'.preg_replace('/[ ]/','%',$search).'%';
		return $this->db->query("select * from contact where faq=1 and reply is not null and (name like ? or email like ? or question like ? or reply like ?) order by contactID desc limit ? offset ?",array($search,$search,$search,$search,(int)$limit,(int)$offset))->result();
	}

	//A function that counts all the frequently asked questions from the database based on a search string. The search string is used in a LIKE statement as shown. This is useful for pagination requirements to know the number of pages for a search string.
	public function get_faq_count($search){
		$search='%'.preg_replace('/[ ]/','%',$search).'%';
		return $this->db->query("select count(*) as num from contact where faq=1 and reply is not null and (name like ? or email like ? or question like ? or reply like ?) order by contactID desc",array($search,$search,$search,$search))->row()->num;
	}
}
?>