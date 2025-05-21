<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Comunicado extends CI_Controller {
		
		public function pesquisar(){
			$this->verifica_sessao();

			$dsComunicado	= $this->input->post("dsComunicado");
			$idInstituicao	= $this->input->post("selInstituicao");
		
			$this->load->model("Comunicado_model");

			//Pega o resultado da pesquisa do banco
			$lista["listaComunicados"] = $this->Comunicado_model->pesquisar($dsComunicado, $idInstituicao); 

			$lista["listaInstituicoes"] = $this->Comunicado_model->listarInstituicao();

			//var_dump($lista); exit;

			//Seta em variavel na sessao o resultado da pesquisa
			$this->session->set_userdata($lista);
			
			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("comunicado/comunicado_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function editar(){
			$this->verifica_sessao();

			$idComunicado 			= $this->input->post("hdnIdComunicado");
			$comunicado = array(
				"ds_comunicado"			=> $this->input->post("dsComunicado")
			);

			$this->load->model("Comunicado_model");
			$resultadoBanco = $this->Comunicado_model->editar($comunicado, $idComunicado);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Comunicado alterado com sucesso!");

				redirect("Comunicado/pesquisar");
			}else{
				$this->session->set_flashdata("erro", "Comunicado não alterado!");

				redirect("Comunicado/pesquisar");
			}
		}

		public function selecionar($idComunicado=null){
			$this->verifica_sessao();

			if($idComunicado == null){
				redirect("Comunicado/pesquisar");
			}

			$this->load->model("Comunicado_model");
			$resultadoBanco = $this->Comunicado_model->selecionar($idComunicado);

			$parametro["listaInstituicoes"] = $this->Comunicado_model->listarInstituicao();

			if(count($resultadoBanco) == 1){
				
				$parametro["dadosComunicado"] = $resultadoBanco;
				
				/*
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_perfil_model->listarUsuarioPerfil();
				*/	
				//var_dump($parametro); exit;

				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("comunicado/comunicado_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "Erro tentando selecionar comunicado: ". $idComunicado);				

				redirect("Comunicado/editar");
			}
		}

		public function excluir($idComunicado=null){
			$this->verifica_sessao();

			//Para descubrir se vem dados do array debugando
			//var_dump($codUsuarioPerfil);
			//exit;

			if($idComunicado == null){
				redirect("Comunicado/listar");
			}

			$this->load->model("Comunicado_model");
			$resultadoBanco = $this->Comunicado_model->excluir($idComunicado);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Comunicado excluído com sucesso!");

				redirect("Comunicado/listar");
			}else{
				$this->session->set_flashdata("erro", "Comunicado não excluído!");

				redirect("Comunicado/listar");
			}	
		}	

		public function verificarSeExiste(){
			$this->verifica_sessao();

			$this->load->model("Comunicado_model");
			$dsComunicado 			= $this->input->post("dsComunicado");
			$resultadoBanco 	= $this->Comunicado_model->verificarSeExiste($dsComunicado);

			if(count($resultadoBanco) == 1){
				$arrayComunicado["comunicado"] 		= $resultadoBanco;	
				$ds_comunicadoa 		= $arrayComunicado["comunicado"][0]->ds_comunicado;

				$this->session->set_flashdata("erro", "Comunicado: ". $ds_comunicado ." já cadastrado!");				

				redirect("Comunicado/novo");
			}	
		}

		public function listar(){
			//unset($_SESSION['nomeFoto']); //Limpa a sessao da foto para nao ficar carregando
			$this->verifica_sessao();

			$this->load->model("Comunicado_model");
			$lista["listaComunicados"] = $this->Comunicado_model->listar();

			$lista["listaInstituicoes"] = $this->Comunicado_model->listarInstituicao();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("comunicado/comunicado_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			$this->verifica_sessao();
			$this->verificarSeExiste();

			//---GERA CODIGO DO TIPO QUALIDADE--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Comunicado_model");
			//$ultimoCodQualidade = $this->Qualidade_model->selecionarUltimoCodigoQualidade();

			//Soma com mais 1 e seta o novo codigo qualidade
			//$codQualidade = (($ultimoCodQualidade["cod_qualidade"] + 1));
			//-----------------------------------------------------------------------
			//var_dump($this->session->userdata("nome_usuario"). " ". $this->session->userdata("cod_usuario")); exit;
			$comunicado = array(
				"ds_comunicado"		=> $this->input->post("dsComunicado"),
				"id_instituicao"	=> $this->input->post("selInstituicao"),
				"st_ativo"				=> "S"
			);

			$this->load->model("Comunicado_model");
			$retorno = $this->Comunicado_model->cadastrar($comunicado);

			if($retorno){
				$this->session->set_flashdata("sucesso", "Cadastrado com sucesso!");

				redirect("Comunicado/novo");
			}else{
				$this->session->set_flashdata("erro", "Cadastro não realizado!");
			}
		}

		public function novo(){
			$this->verifica_sessao();

			$this->load->model("Comunicado_model");
			//$lista["listaTipoCliente"] = $this->Cliente_model->listarTipoCliente();
			$lista["listaInstituicoes"] = $this->Comunicado_model->listarInstituicao();
						
			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("comunicado/comunicado_cadastrar", $lista);
			$this->load->view("dashboard/include/footer");
			$this->load->view("dashboard/include/html_footer");
		}

		public function verifica_sessao(){
			if($this->session->userdata("logado") == false){
				redirect("Login/index");
			}		
		}
		
		public function swap_date($date_str)
		{
			if($date_str != ""){
			    if($date = \DateTime::createFromFormat('Y-m-d', $date_str)){
			        return $date->format('d/m/Y');
			    } elseif ($date = \DateTime::createFromFormat('d/m/Y', $date_str)){
			        return $date->format('Y-m-d');		
			    }	
			}else{
				return Null;
			}	

		    throw new \InvalidArgumentException('Formato de data inválida!');
		}		
	}
?>