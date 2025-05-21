<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class UsuarioPerfil extends CI_Controller {
		
		public function editar(){
			$this->verifica_sessao();

			$codUsuarioPerfil 			= $this->input->post("hdnCodUsuarioPerfil");
			$usuarioPerfil = array(
				"des_usuario_perfil"	=> mb_strtoupper($this->input->post("desUsuarioPerfil")),			
			    "observacao"			=> mb_strtoupper($this->input->post("observacao"))
			);

			$this->load->model("Usuario_perfil_model");
			$resultadoBanco = $this->Usuario_perfil_model->editar($usuarioPerfil, $codUsuarioPerfil);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "USUÁRIO PERFIL ALTERADO COM SUCESSO!");

				redirect("UsuarioPerfil/listar");
			}else{
				$this->session->set_flashdata("erro", "USUÁRIO PERFIL NÃO ALTERADO!");

				redirect("UsuarioPerfil/listar");
			}
		}

		public function selecionar($codUsuarioPerfil=null){
			$this->verifica_sessao();

			if($codUsuarioPerfil == null){
				redirect("UsuarioPerfil/listar");
			}

			$this->load->model("Usuario_perfil_model");
			$resultadoBanco = $this->Usuario_perfil_model->selecionar($codUsuarioPerfil);

			if(count($resultadoBanco) == 1){
				
				$parametro["dadosUsuarioPerfil"] = $resultadoBanco;
				
				/*
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_perfil_model->listarUsuarioPerfil();
				*/			
				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("usuarioPerfil/usuarioPerfil_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "ERRO TENTANDO SELECIONAR USUÁRIO PERFIL: ". $codUsuarioPerfil);				

				redirect("UsuarioPerfil/editar");
			}
		}

		public function excluir($codUsuarioPerfil=null){
			$this->verifica_sessao();

			//Para descubrir se vem dados do array debugando
			//var_dump($codUsuarioPerfil);
			//exit;

			if($codUsuarioPerfil == null){
				redirect("UsuarioPerfil/listar");
			}

			$this->load->model("Usuario_perfil_model");
			$resultadoBanco = $this->Usuario_perfil_model->excluir($codUsuarioPerfil);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "USUÁRIO PERFIL EXCLUÍDO COM SUCESSO!");

				redirect("UsuarioPerfil/listar");
			}else{
				$this->session->set_flashdata("erro", "USUÁRIO PERFIL NÃO EXCLUÍDO!");

				redirect("UsuarioPerfil/listar");
			}	
		}	

		public function verificarSeExiste(){
			$this->verifica_sessao();

			$this->load->model("Usuario_perfil_model");
			$usuarioPerfil 		= mb_strtoupper($this->input->post("desUsuarioPerfil"));
			$resultadoBanco 	= $this->Usuario_perfil_model->verificarSeExiste($usuarioPerfil);

			if(count($resultadoBanco) == 1){
				$arrayUsuarioPerfil["usuarioPerfil"] 		= $resultadoBanco;	
				$dadoCadastro["des_usuario_perfil"] 		= $arrayUsuarioPerfil["usuarioPerfil"][0]->usuarioPerfil;

				$this->session->set_flashdata("erro", "USUÁRIO PERFIL: ". $usuarioPerfil ." JÁ CADASTRADO!");				

				redirect("UsuarioPerfil/novo");
			}	
		}

		public function listar(){
			unset($_SESSION['nomeFoto']); //Limpa a sessao da foto para nao ficar carregando
			$this->verifica_sessao();

			$this->load->model("Usuario_perfil_model");
			$lista["listaUsuariosPerfil"] = $this->Usuario_perfil_model->listar();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("usuarioPerfil/usuarioPerfil_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			$this->verifica_sessao();
			$this->verificarSeExiste();

			//---GERA CODIGO DO USUARIO--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Usuario_perfil_model");
			$ultimoCodUsuarioPerfil = $this->Usuario_perfil_model->selecionarUltimoCodigoUsuarioPerfil();

			//Soma com mais 1 e seta o novo codigo do usuario perfil
			$codUsuarioPerfil = (($ultimoCodUsuarioPerfil["cod_usuario_perfil"] + 1));
			//-----------------------------------------------------------------------

			$usuarioPerfil = array(
				"cod_usuario_perfil"   	=> $codUsuarioPerfil,
				"des_usuario_perfil"	=> $this->input->post("desUsuarioPerfil"),
				"observacao"			=> $this->input->post("observacao")
			);

			$this->load->model("Usuario_perfil_model");
			$retorno = $this->Usuario_perfil_model->cadastrar($usuarioPerfil);

			if($retorno){
				$this->session->set_flashdata("sucesso", "CADASTRADO COM SUCESSO!");

				redirect("UsuarioPerfil/novo");
			}else{
				$this->session->set_flashdata("erro", "CADASTRO NÃO REALIZADO!");
			}
		}

		public function novo(){
			$this->verifica_sessao();
			/*
			$this->load->model("Usuario_perfil_model");
			$lista["listaUsuarioPerfis"] = $this->Usuario_model->listarUsuarioPerfil();
			*/
						
			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("usuarioPerfil/usuarioPerfil_cadastrar");
			$this->load->view("dashboard/include/footer");
			$this->load->view("dashboard/include/html_footer");
		}

		public function verifica_sessao(){
			if($this->session->userdata("logado") == false){
				redirect("Login/index");
			}		
		}
	}
?>