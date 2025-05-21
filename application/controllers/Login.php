<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {
	
		public function autenticar(){
			$this->load->model("Usuario_model");
			$usuario 		= strtolower($this->input->post("usuario"));
			$senha 			= md5($this->input->post("senha"));
			$resultadoBanco = $this->Usuario_model->autenticar($usuario, $senha);

			if(count($resultadoBanco) == 1){
				$arrayUsuario["usuario"] 			= $resultadoBanco;	
				$dadosLogin["usuario"] 				= $arrayUsuario["usuario"][0]->usuario;
				$dadosLogin["id_usuario"] 			= $arrayUsuario["usuario"][0]->id_usuario;
				$dadosLogin["id_perfil"] 			= $arrayUsuario["usuario"][0]->id_perfil;
				$dadosLogin["ds_perfil"] 			= $arrayUsuario["usuario"][0]->ds_perfil;
				$dadosLogin["nome"] 			= $arrayUsuario["usuario"][0]->nome;
				$dadosLogin["cpf"] 			= $arrayUsuario["usuario"][0]->cpf;
				$dadosLogin["logado"] 				= true;

				$this->session->set_flashdata("success", "Logado com sucesso!");
				$this->session->set_userdata($dadosLogin);

				redirect("DashBoard/index"); //DashBoard/index	 Cliente/listar			
			}else{
				$this->session->set_flashdata("danger", "Usuário ou senha incorreto!");

				redirect("Login/index");	
			}	
		}

		public function logout(){
			$this->session->sess_destroy();

			redirect("Login/index");
		}	

		public function index(){
			$this->load->view('dashboard/include/html_header');
			$this->load->view("login/login");
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}
	}
?>