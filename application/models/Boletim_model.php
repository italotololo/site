<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Boletim_model extends CI_Model{

		public function pesquisar($id_instituicao, $id_disciplina, $id_aluno, $cpf, $idPerfil){
			$this->db->select('*');
			$this->db->from('tb_boletim as boletim');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = boletim.id_instituicao');
			$this->db->join('tb_disciplina as disciplina', 'disciplina.id_disciplina = boletim.id_disciplina');
			$this->db->join('tb_aluno as aluno', 'aluno.id_aluno = boletim.id_aluno');			

			/*
			if($ds_frequencia != ""){
				$this->db->like('LOWER(frequencia.ds_frequencia)', strtoupper($ds_frequencia));
			}
			*/
			
			if($id_instituicao != ""){
				$this->db->where("boletim.id_instituicao", $id_instituicao);
			}

			if($id_disciplina != ""){
				$this->db->where("boletim.id_disciplina", $id_disciplina);
			}
			if($id_aluno != ""){
				$this->db->where("boletim.id_aluno", $id_aluno);
			}
			
			if($idPerfil == 1){
				$this->db->where("aluno.cpf_responsavel", $cpf);
			}

			$this->db->order_by('boletim.dt_cadastro', 'desc');
			return $this->db->get()->result();
		}
				
		public function editar($boletim, $id_boletim){
			$this->db->where("id_boletim", $id_boletim);

			if($this->db->update("tb_boletim", $boletim)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($id_boletim){
			$this->db->where("id_boletim", $id_boletim);
			$data['boletim'] = $this->db->get('tb_boletim')->result();	

			return $data['boletim'];
		}

		public function excluir($id_boletim){
			$this->db->where("id_boletim", $id_boletim);

			return $this->db->delete("tb_boletim");
		}

		public function verificarSeExiste($ds_boletim){
			$this->db->where('LOWER(ds_boletim)', strtoupper($ds_boletim));
			$data['boletim'] = $this->db->get('tb_boletim')->result();	

			return $data['boletim'];
		}
		
		public function listar($cpf, $idPerfil){
			$this->db->select('*');
			$this->db->from('tb_boletim as boletim');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = boletim.id_instituicao');
			$this->db->join('tb_disciplina as disciplina', 'disciplina.id_disciplina = boletim.id_disciplina');
			$this->db->join('tb_aluno as aluno', 'aluno.id_aluno = boletim.id_aluno');

			if($idPerfil == 1){
				$this->db->where("aluno.cpf_responsavel", $cpf);
			}
			
			$this->db->order_by('boletim.dt_cadastro', 'desc');

			return $this->db->get()->result();
		}

		public function listarInstituicao(){
			return $this->db->get('tb_instituicao')->result();
		}

		public function listarDisciplina(){
			return $this->db->get('tb_disciplina')->result();
		}

		public function listarAluno(){
			return $this->db->get('tb_aluno')->result();
		}
		
		public function listarStatus(){
			return $this->db->get('tb_status')->result();
		}

		public function cadastrar($boletim){			
			if($this->db->insert("tb_boletim", $boletim)){
				return true;
			}else{
				return false;
			}
		}
	}
?>