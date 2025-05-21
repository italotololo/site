<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class DashBoard extends CI_Controller {

		public function verifica_sessao(){
			if($this->session->userdata("logado") == false){
				redirect("Login/index");
			}		
		}
		
		public function index(){
			$this->verifica_sessao();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view('dashboard/dashboard');
			$this->load->view('dashboard/include/html_footer');
			//$this->load->view('dashboard/include/footer');
		}
		
		public function administracao(){
			$this->verifica_sessao();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view('dashboard/administracao');
			$this->load->view('dashboard/include/html_footer');
			//$this->load->view('dashboard/include/footer');
		}
		
	}
?>