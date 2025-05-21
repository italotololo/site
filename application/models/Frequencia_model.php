<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Frequencia_model extends CI_Model{

		public function pesquisar($id_instituicao, $id_disciplina, $id_aluno, $id_status, $dt_frequencia, $cpf, $idPerfil){
			$this->db->select('*');
			$this->db->from('tb_frequencia as frequencia');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = frequencia.id_instituicao');
			$this->db->join('tb_disciplina as disciplina', 'disciplina.id_disciplina = frequencia.id_disciplina');
			$this->db->join('tb_aluno as aluno', 'aluno.id_aluno = frequencia.id_aluno');
			$this->db->join('tb_status as status', 'status.id_status = frequencia.id_status');

			/*
			if($ds_frequencia != ""){
				$this->db->like('LOWER(frequencia.ds_frequencia)', strtoupper($ds_frequencia));
			}
			*/

			if($id_instituicao != ""){
				$this->db->where("frequencia.id_instituicao", $id_instituicao);
			}
						
			if($id_disciplina != ""){
				$this->db->where("frequencia.id_disciplina", $id_disciplina);
			}
			if($id_aluno != ""){
				$this->db->where("frequencia.id_aluno", $id_aluno);
			}
			if($id_status != ""){
				$this->db->where("frequencia.id_status", $id_status);
			}			
			if($dt_frequencia != ""){
				$this->db->where('frequencia.dt_frequencia >=', $dt_frequencia);
			}

			if($idPerfil == 1){
				$this->db->where("aluno.cpf_responsavel", $cpf);
			}

			$this->db->order_by('frequencia.dt_cadastro', 'desc');
			return $this->db->get()->result();
		}
				
		public function editar($frequencia, $id_frequencia){
			$this->db->where("id_frequencia", $id_frequencia);

			if($this->db->update("tb_frequencia", $frequencia)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($id_frequencia){
			$this->db->where("id_frequencia", $id_frequencia);
			$data['frequencia'] = $this->db->get('tb_frequencia')->result();	

			return $data['frequencia'];
		}

		public function excluir($id_frequencia){
			$this->db->where("id_frequencia", $id_frequencia);

			return $this->db->delete("tb_frequencia");
		}

		public function verificarSeExiste($ds_frequencia){
			$this->db->where('LOWER(ds_frequencia)', strtoupper($ds_frequencia));
			$data['frequencia'] = $this->db->get('tb_frequencia')->result();	

			return $data['frequencia'];
		}
		
		public function listar($cpf, $idPerfil){
			$this->db->select('*');
			$this->db->from('tb_frequencia as frequencia');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = frequencia.id_instituicao');
			$this->db->join('tb_disciplina as disciplina', 'disciplina.id_disciplina = frequencia.id_disciplina');
			$this->db->join('tb_aluno as aluno', 'aluno.id_aluno = frequencia.id_aluno');
			$this->db->join('tb_status as status', 'status.id_status = frequencia.id_status');

			if($idPerfil == 1){
				$this->db->where("aluno.cpf_responsavel", $cpf);
			}


			$this->db->order_by('frequencia.dt_cadastro', 'desc');

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

		public function cadastrar($frequencia){			
			if($this->db->insert("tb_frequencia", $frequencia)){
				return true;
			}else{
				return false;
			}
		}
	}
?>