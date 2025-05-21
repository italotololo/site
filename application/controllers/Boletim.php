<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Boletim extends CI_Controller {
		
		public function pesquisar(){
			$this->verifica_sessao();

			$idInstituicao	= $this->input->post("selInstituicao");
			$idDisciplina	= $this->input->post("selDisciplina");
			$idAluno	= $this->input->post("selAluno");
			$idStatus	= $this->input->post("selStatus");
			$cpf = $this->session->userdata("cpf");
			$idPerfil = $this->session->userdata("id_perfil");
		
			$this->load->model("Boletim_model");

			//Pega o resultado da pesquisa do banco
			$lista["listaBoletims"] = $this->Boletim_model->pesquisar($idInstituicao, $idDisciplina, $idAluno, $cpf, $idPerfil); 

			$lista["listaInstituicoes"] = $this->Boletim_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Boletim_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Boletim_model->listarAluno();
			$lista["listaStatuss"] = $this->Boletim_model->listarStatus();

			//var_dump($lista); exit;

			//Seta em variavel na sessao o resultado da pesquisa
			$this->session->set_userdata($lista);
			
			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("boletim/boletim_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function editar(){
			$this->verifica_sessao();

			$idBoletim 			= $this->input->post("hdnIdBoletim");
			$boletim = array(
				
				"id_instituicao"	=> $this->input->post("selInstituicao"),
				"id_disciplina"	=> $this->input->post("selDisciplina"),
				"id_aluno"	=> $this->input->post("selAluno"),
				"nota"				    => str_replace(",", ".", $this->input->post("txtnota"))
			);

			$this->load->model("Boletim_model");
			$resultadoBanco = $this->Boletim_model->editar($boletim, $idBoletim);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Boletim alterado com sucesso!");

				redirect("Boletim/pesquisar");
			}else{
				$this->session->set_flashdata("erro", "Boletim não alterado!");

				redirect("Boletim/pesquisar");
			}
		}

		public function selecionar($idBoletim=null){
			$this->verifica_sessao();

			if($idBoletim == null){
				redirect("Boletim/pesquisar");
			}

			$this->load->model("Boletim_model");
			$resultadoBanco = $this->Boletim_model->selecionar($idBoletim);
			
			$parametro["listaInstituicoes"] = $this->Boletim_model->listarInstituicao();
			$parametro["listaDisciplinas"] = $this->Boletim_model->listarDisciplina();
			$parametro["listaAlunos"] = $this->Boletim_model->listarAluno();
			$parametro["listaStatuss"] = $this->Boletim_model->listarStatus();

			if(count($resultadoBanco) == 1){
				
				$parametro["dadosBoletim"] = $resultadoBanco;
				
				/*
				$this->load->model("Usuario_model");
				$parametro["listaUsuarioPerfis"] = $this->Usuario_perfil_model->listarUsuarioPerfil();
				*/	
				//var_dump($parametro); exit;

				$this->load->view("dashboard/include/html_header");
				$this->load->view("dashboard/include/menu");
				$this->load->view("boletim/boletim_editar", $parametro);
				$this->load->view("dashboard/include/footer");
				$this->load->view("dashboard/include/html_footer");
			}
			else{

				$this->session->set_flashdata("erro", "Erro tentando selecionar boletim: ". $idBoletim);

				redirect("Boletim/editar");
			}
		}

		public function excluir($idBoletim=null){
			$this->verifica_sessao();

			//Para descubrir se vem dados do array debugando
			//var_dump($codUsuarioPerfil);
			//exit;

			if($idBoletim == null){
				redirect("Boletim/listar");
			}

			$this->load->model("Boletim_model");
			$resultadoBanco = $this->Boletim_model->excluir($idBoletim);

			if($resultadoBanco){
				$this->session->set_flashdata("sucesso", "Boletim excluído com sucesso!");

				redirect("Boletim/listar");
			}else{
				$this->session->set_flashdata("erro", "Boletim não excluído!");

				redirect("Boletim/listar");
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
			
			$this->load->model("Boletim_model");
			$lista["listaBoletims"] = $this->Boletim_model->listar($cpf, $idPerfil);
			
			$lista["listaInstituicoes"] = $this->Boletim_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Boletim_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Boletim_model->listarAluno();
			$lista["listaStatuss"] = $this->Boletim_model->listarStatus();


			$this->load->view('dashboard/include/html_header');
			$this->load->view('dashboard/include/menu');
			$this->load->view("boletim/boletim_listar", $lista);
			$this->load->view('dashboard/include/footer');
			$this->load->view('dashboard/include/html_footer');
		}

		public function cadastrar(){
			$this->verifica_sessao();
			//$this->verificarSeExiste();

			//---GERA CODIGO DO TIPO QUALIDADE--- 	

			//Pega do banco o ultimo codigo
			$this->load->model("Boletim_model");
			//$ultimoCodQualidade = $this->Qualidade_model->selecionarUltimoCodigoQualidade();

			//Soma com mais 1 e seta o novo codigo qualidade
			//$codQualidade = (($ultimoCodQualidade["cod_qualidade"] + 1));
			//-----------------------------------------------------------------------
			//var_dump($this->session->userdata("nome_usuario"). " ". $this->session->userdata("cod_usuario")); exit;
			$boletim = array(				
				"id_instituicao"	=> $this->input->post("selInstituicao"),
				"id_disciplina"	=> $this->input->post("selDisciplina"),
				"id_aluno"	=> $this->input->post("selAluno"),
				"id_usuario" => $this->session->userdata("id_usuario"),
				"nota"				    => str_replace(",", ".", $this->input->post("txtnota")),				
				"st_ativo"				=> "S"
			);

			$this->load->model("Boletim_model");
			$retorno = $this->Boletim_model->cadastrar($boletim);

			if($retorno){
				$this->session->set_flashdata("sucesso", "Cadastrado com sucesso!");

				redirect("Boletim/novo");
			}else{
				$this->session->set_flashdata("erro", "Cadastro não realizado!");
			}
		}

		public function novo(){
			$this->verifica_sessao();

			$this->load->model("Boletim_model");
			//$lista["listaTipoCliente"] = $this->Cliente_model->listarTipoCliente();
			$lista["listaInstituicoes"] = $this->Boletim_model->listarInstituicao();
			$lista["listaDisciplinas"] = $this->Boletim_model->listarDisciplina();
			$lista["listaAlunos"] = $this->Boletim_model->listarAluno();
			$lista["listaStatuss"] = $this->Boletim_model->listarStatus();
						
			$this->load->view("dashboard/include/html_header");
			$this->load->view("dashboard/include/menu");
			$this->load->view("boletim/boletim_cadastrar", $lista);
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