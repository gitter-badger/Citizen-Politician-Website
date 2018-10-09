<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadScripts {
	public function index(){
		return "<title>Mwananchi</title><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><link rel='shortcut icon' type='image/png' href='".base_url()."resources/favicon.png'><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'><link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'><link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script><style>body,html {margin: 0;height: 100%;background-color: whitesmoke;}span.fa{padding-top: 10px;color: limegreen;}input::-ms-reveal{display: none;}</style>";
	}

	public function load_main_js(){
		return "<script src='".base_url()."/resources/js/main_js.js'></script>";
	}

	public function load_index_page_scripts(){
		return "<script src='".base_url()."/resources/js/index_page.js'></script><script src='".base_url()."/resources/js/animate_number.js'></script><link rel='stylesheet' href='".base_url()."/resources/css/index_page.css'>";
	}

	public function load_animeJS(){
		return "<script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js'></script>";
	}

	public function load_datatable(){
		return "<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'><script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script><script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>";
	}
}