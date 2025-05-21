<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Frequencia extends CI_Controller {
		
		public function pesquisar(){
			$this->verifica_sessao();

			$idInstituicao	= $this->input->post("selInstituicao");
			$idDisciplina	= $this->input->post("selDisciplina");
			$idAluno	= $this->input->post("selAluno");
			$idStatus	= $this->input->post("selStatus");
			$dtfrequencia		= $this->swap_date($this->input->post("txtdtfrequencia"));
		
			$cpf = $this->session->userdata("cpf");
			$idPerfil = $this->session->userdata("id_perfil");


			$this->load->model("Frequencia_model");

			//Pega o resultado da pesquisa do banco
			$lista["listaFrequencias"] = $this->Frequencia_model->pesquisar($idInstituicao, $idDisciplina, $idAluno, $idStatus, $dtfrequencia, $cpf, $idPerfil); 

			$lista["listaInstituicoes"] = $this->Frequencia_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Frequencia_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Frequencia_model->listarAluno();
			$lista["listaStatuss"] = $this->Frequencia_model->listarStatus();

			//var_dump($lista); exit;

			//Seta em variavel na sessao o resultado da pesquisa
			$this->session->set_userdata($lista);
			
			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("frequencia/frequencia_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function editar(){
			$this->verifica_sessao();

			$idFrequencia 			= $this->input->post("hdnIdFrequencia");
			$frequencia = array(
				
				"id_instituicao"	=> $this->input->post("selInstituicao"),
				"id_disciplina"	=> $this->input->post("selDisciplina"),
				"id_aluno"	=> $this->input->post("selAluno"),
				"id_status"	=> $this->input->post("selStatus"),
				"dt_frequencia"		=> $this->swap_date($this->input->post("txtdtfrequencia"))
			);

			$this->load->model("Frequencia_model");
			$resultadoBanco = $this->Frequencia_model->editar($frequencia, $idFrequencia);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Frequência alterado com sucesso!");

				redirect("Frequencia/pesquisar");
			}else{
				$this->session->set_flashdata("erro", "Frequência não alterado!");

				redirect("Frequencia/pesquisar");
			}
		}

		public function selecionar($idFrequencia=null){
			$this->verifica_sessao();

			if($idFrequencia == null){
				redirect("Frequencia/pesquisar");
			}

			$this->load->model("Frequencia_model");
			$resultadoBanco = $this->Frequencia_model->selecionar($idFrequencia);
			
			$parametro["listaInstituicoes"] = $this->Frequencia_model->listarInstituicao();
			$parametro["listaDisciplinas"] = $this->Frequencia_model->listarDisciplina();
			$parametro["listaAlunos"] = $this->Frequencia_model->listarAluno();
			$parametro["listaStatuss"] = $this->Frequencia_model->listarStatus();

			if(count($resultadoBanco) == 1){
				
				$parametro["dadosFrequencia"] = $resultadoBanco;
				
				/*
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_perfil_model->listarUsuarioPerfil();
				*/	
				//var_dump($parametro); exit;

				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("frequencia/frequencia_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "Erro tentando selecionar frequência: ". $idFrequencia);

				redirect("Frequencia/editar");
			}
		}

		public function excluir($idFrequencia=null){
			$this->verifica_sessao();

			//Para descubrir se vem dados do array debugando
			//var_dump($codUsuarioPerfil);
			//exit;

			if($idFrequencia == null){
				redirect("Frequencia/listar");
			}

			$this->load->model("Frequencia_model");
			$resultadoBanco = $this->Frequencia_model->excluir($idFrequencia);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Frequência excluído com sucesso!");

				redirect("Frequencia/listar");
			}else{
				$this->session->set_flashdata("erro", "Frequência não excluído!");

				redirect("Frequencia/listar");
			}	
		}	

		/*
		public function verificarSeExiste(){
			$this->verifica_sessao();

			$this->load->model("Frequencia_model");
			$dsFrequencia 			= $this->input->post("dsComunicado");
			$resultadoBanco 	= $this->Comunicado_model->verificarSeExiste($dsComunicado);

			if(count($resultadoBanco) == 1){
				$arrayComunicado["comunicado"] 		= $resultadoBanco;	
				$ds_comunicadoa 		= $arrayComunicado["comunicado"][0]->ds_comunicado;

				$this->session->set_flashdata("erro", "Comunicado: ". $ds_comunicado ." já cadastrado!");				

				redirect("Comunicado/novo");
			}	
		}
		*/

		public function listar(){
			//unset($_SESSION['nomeFoto']); //Limpa a sessao da foto para nao ficar carregando
			$this->verifica_sessao();

			$cpf = $this->session->userdata("cpf");
			$idPerfil = $this->session->userdata("id_perfil");


			$this->load->model("Frequencia_model");
			$lista["listaFrequencias"] = $this->Frequencia_model->listar($cpf, $idPerfil);
			
			$lista["listaInstituicoes"] = $this->Frequencia_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Frequencia_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Frequencia_model->listarAluno();
			$lista["listaStatuss"] = $this->Frequencia_model->listarStatus();


			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("frequencia/frequencia_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			$this->verifica_sessao();
			//$this->verificarSeExiste();

			//---GERA CODIGO DO TIPO QUALIDADE--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Frequencia_model");
			//$ultimoCodQualidade = $this->Qualidade_model->selecionarUltimoCodigoQualidade();

			//Soma com mais 1 e seta o novo codigo qualidade
			//$codQualidade = (($ultimoCodQualidade["cod_qualidade"] + 1));
			//-----------------------------------------------------------------------
			//var_dump($this->session->userdata("nome_usuario"). " ". $this->session->userdata("cod_usuario")); exit;
			$frequencia = array(				
				"id_instituicao"	=> $this->input->post("selInstituicao"),
				"id_disciplina"	=> $this->input->post("selDisciplina"),
				"id_aluno"	=> $this->input->post("selAluno"),
				"id_status"	=> $this->input->post("selStatus"),		
				"dt_frequencia"		=> $this->swap_date($this->input->post("txtdtfrequencia")),
				"st_ativo"				=> "S"
			);

			$this->load->model("Frequencia_model");
			$retorno = $this->Frequencia_model->cadastrar($frequencia);

			if($retorno){
				$this->session->set_flashdata("sucesso", "Cadastrado com sucesso!");

				redirect("Frequencia/novo");
			}else{
				$this->session->set_flashdata("erro", "Cadastro não realizado!");
			}
		}

		public function novo(){
			$this->verifica_sessao();

			$this->load->model("Frequencia_model");
			//$lista["listaTipoCliente"] = $this->Cliente_model->listarTipoCliente();
			$lista["listaInstituicoes"] = $this->Frequencia_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Frequencia_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Frequencia_model->listarAluno();
			$lista["listaStatuss"] = $this->Frequencia_model->listarStatus();

						
			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("frequencia/frequencia_cadastrar", $lista);
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