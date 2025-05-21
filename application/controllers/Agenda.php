<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Agenda extends CI_Controller {
		
		public function pesquisar(){
			$this->verifica_sessao();

			$dsAgenda	= $this->input->post("dsAgenda");
			$idInstituicao	= $this->input->post("selInstituicao");
			$dtagenda		= $this->swap_date($this->input->post("txtdtagenda"));
		
			$this->load->model("Agenda_model");

			//Pega o resultado da pesquisa do banco
			$lista["listaAgendas"] = $this->Agenda_model->pesquisar($dsAgenda, $idInstituicao, $dtagenda); 

			$lista["listaInstituicoes"] = $this->Agenda_model->listarInstituicao();

			//var_dump($lista); exit;

			//Seta em variavel na sessao o resultado da pesquisa
			$this->session->set_userdata($lista);
			
			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("agenda/agenda_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function editar(){
			$this->verifica_sessao();

			$idAgenda 			= $this->input->post("hdnIdAgenda");
			$agenda = array(
				"ds_agenda"			=> $this->input->post("dsAgenda"),
				"dt_agenda"		=> $this->swap_date($this->input->post("txtdtagenda"))
			);

			$this->load->model("Agenda_model");
			$resultadoBanco = $this->Agenda_model->editar($agenda, $idAgenda);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Agenda alterada com sucesso!");

				redirect("Agenda/pesquisar");
			}else{
				$this->session->set_flashdata("erro", "Agenda não alterado!");

				redirect("Agenda/pesquisar");
			}
		}

		public function selecionar($idAgenda=null){
			$this->verifica_sessao();

			if($idAgenda == null){
				redirect("Agenda/pesquisar");
			}

			$this->load->model("Agenda_model");
			$resultadoBanco = $this->Agenda_model->selecionar($idAgenda);

			$parametro["listaInstituicoes"] = $this->Agenda_model->listarInstituicao();

			if(count($resultadoBanco) == 1){
				
				$parametro["dadosAgenda"] = $resultadoBanco;
				
				/*
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_perfil_model->listarUsuarioPerfil();
				*/	
				//var_dump($parametro); exit;

				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("agenda/agenda_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "Erro tentando selecionar agenda: ". $idAgenda);				

				redirect("Agenda/editar");
			}
		}

		public function excluir($idAgenda=null){
			$this->verifica_sessao();

			//Para descubrir se vem dados do array debugando
			//var_dump($codUsuarioPerfil);
			//exit;

			if($idAgenda == null){
				redirect("Agenda/listar");
			}

			$this->load->model("Agenda_model");
			$resultadoBanco = $this->Agenda_model->excluir($idAgenda);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Agenda excluído com sucesso!");

				redirect("Agenda/listar");
			}else{
				$this->session->set_flashdata("erro", "Agenda não excluído!");

				redirect("Agenda/listar");
			}	
		}	

		public function verificarSeExiste(){
			$this->verifica_sessao();

			$this->load->model("Agenda_model");
			$dsAgenda 			= $this->input->post("dsAgenda");
			$resultadoBanco 	= $this->Agenda_model->verificarSeExiste($dsAgenda);

			if(count($resultadoBanco) == 1){
				$arrayAgenda["agenda"] 		= $resultadoBanco;	
				$ds_agenda 		= $arrayAgenda["agenda"][0]->ds_agenda;

				$this->session->set_flashdata("erro", "Agenda: ". $ds_agenda ." já cadastrada!");				

				redirect("Agenda/novo");
			}	
		}

		public function listar(){
			//unset($_SESSION['nomeFoto']); //Limpa a sessao da foto para nao ficar carregando
			$this->verifica_sessao();

			$this->load->model("Agenda_model");
			$lista["listaAgendas"] = $this->Agenda_model->listar();

			$lista["listaInstituicoes"] = $this->Agenda_model->listarInstituicao();

			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("agenda/agenda_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			$this->verifica_sessao();
			$this->verificarSeExiste();

			//---GERA CODIGO DO TIPO QUALIDADE--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Agenda_model");
			//$ultimoCodQualidade = $this->Qualidade_model->selecionarUltimoCodigoQualidade();

			//Soma com mais 1 e seta o novo codigo qualidade
			//$codQualidade = (($ultimoCodQualidade["cod_qualidade"] + 1));
			//-----------------------------------------------------------------------
			//var_dump($this->session->userdata("nome_usuario"). " ". $this->session->userdata("cod_usuario")); exit;
			$agenda = array(
				"ds_agenda"		=> $this->input->post("dsAgenda"),
				"id_instituicao"		=> $this->input->post("selInstituicao"),
				"dt_agenda"		=> $this->swap_date($this->input->post("txtdtagenda")),
				"st_ativo"				=> "S"				
			);

			$this->load->model("Agenda_model");
			$retorno = $this->Agenda_model->cadastrar($agenda);

			if($retorno){
				$this->session->set_flashdata("sucesso", "Cadastrada com sucesso!");

				redirect("Agenda/novo");
			}else{
				$this->session->set_flashdata("erro", "Cadastro não realizado!");
			}
		}

		public function novo(){
			$this->verifica_sessao();

			$this->load->model("Agenda_model");
			//$lista["listaTipoCliente"] = $this->Cliente_model->listarTipoCliente();
			$lista["listaInstituicoes"] = $this->Agenda_model->listarInstituicao();
						
			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("agenda/agenda_cadastrar", $lista);
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