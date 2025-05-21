<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuario extends CI_Controller {
		
		public function editar(){
			//$this->verifica_sessao();
			
			$codUsuario 				= $this->input->post("hdnCodUsuario");
			$usuario = array(
				"usuario" 				=> mb_strtoupper($this->input->post("usuario")),
				"id_perfil"				=> $this->input->post("selUsuarioPerfil"),			
			    "celular"				=> $this->input->post("celular")
			);

			$this->load->model("Usuario_model");
			$resultadoBanco = $this->Usuario_model->editar($usuario, $codUsuario);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Usuario alterado com sucesso!");

				redirect("Usuario/listar");
			}else{
				$this->session->set_flashdata("erro", "Usuário não alterado!");

				redirect("Usuario/listar");
			}
		}

		public function selecionar($codUsuario=null){
			//$this->verifica_sessao();

			if($codUsuario == null){
				redirect("Usuario/listar");
			}

			$this->load->model("Usuario_model");
			$resultadoBanco = $this->Usuario_model->selecionar($codUsuario);

			if(count($resultadoBanco) == 1){
				$parametro["dadosUsuario"] = $resultadoBanco;
				
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_model->listarUsuarioPerfil();
							
				$parametro["listaInstituicoes"] = $this->Usuario_model->listarInstituicao();

				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("usuario/usuario_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "Erro tentando selecionar usuário: ". $codUsuario);				

				redirect("Usuario/editar");
			}
		}

		public function excluir($codUsuario=null){
			//$this->verifica_sessao();

			if($codUsuario == null){
				redirect("Usuario/listar");
			}

			$this->load->model("Usuario_model");
			$resultadoBanco = $this->Usuario_model->excluir($codUsuario);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Usuário excluído com sucesso!");

				redirect("Usuario/listar");
			}else{
				$this->session->set_flashdata("erro", "Usuário não excluído!");

				redirect("Usuario/listar");
			}
		}	

		public function verificarSeExiste(){
			//$this->verifica_sessao();

			$this->load->model("Usuario_model");
			$usuario 		= mb_strtoupper($this->input->post("usuario"));
			$resultadoBanco = $this->Usuario_model->verificarSeExiste($usuario);

			if(count($resultadoBanco) == 1){
				$arrayUsuario["usuario"] 			= $resultadoBanco;	
				$dadoCadastro["nome_usuario"] 		= $arrayUsuario["usuario"][0]->usuario;

				$this->session->set_flashdata("erro", "USUÁRIO: ". $usuario ." JÁ CADASTRADO!");				

				redirect("Usuario/novo");
			}	
		}

		public function listar(){
			unset($_SESSION['nomeFoto']); //Limpa a sessao da foto para nao ficar carregando
			//$this->verifica_sessao();

			$this->load->model("Usuario_model");
			$lista["listaUsuarios"] = $this->Usuario_model->listar();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("usuario/usuario_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			//$this->verifica_sessao();			
			$this->verificarSeExiste();

			//---GERA CODIGO DO USUARIO--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Usuario_model");
			$ultimoCodUsuario = $this->Usuario_model->selecionarUltimoCodigoUsuario();

			//Soma com mais 1 e seta o novo codigo do usuario
			$codUsuario = (($ultimoCodUsuario["id_usuario"] + 1));
			//-----------------------------------------------------------------------
			
			$usuario = array(
				//"id_usuario"   			=> $codUsuario,
				"usuario" 				=> $this->input->post("usuario"),
				"senha"					=> md5($this->input->post("senha")),
				"id_perfil"				=> $this->input->post("selUsuarioPerfil"),			
			    "celular"				=> $this->input->post("celular"),
				"id_instituicao"		=> $this->input->post("selInstituicao"),
				"nome"				    => $this->input->post("nome"),
				"cpf"					=> $this->input->post("cpf"),
				"st_ativo"				=> "S"
			);

			if($this->input->post("selUsuarioPerfil") == "0"){
				$this->session->set_flashdata("erro", "Selecione um usuário perfil!");
				redirect("Usuario/novo");		
			}	

			$this->load->model("Usuario_model");
			$retorno = $this->Usuario_model->cadastrar($usuario);

			if($retorno){
				$this->session->set_flashdata("sucesso", "Cadastrado com sucesso!");

				redirect("Usuario/novo");
			}else{
				$this->session->set_flashdata("erro", "Cadastro não realizado!");
			}
		}

		public function novo(){
			//$this->verifica_sessao();

			$this->load->model("Usuario_model");
			$lista["listaUsuarioPerfis"] = $this->Usuario_model->listarUsuarioPerfil();
			
			$lista["listaInstituicoes"] = $this->Usuario_model->listarInstituicao();

			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("usuario/usuario_cadastrar", $lista);
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