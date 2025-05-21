<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Comunicado_model extends CI_Model{

		public function pesquisar($ds_comunicado, $id_instituicao){
			$this->db->select('*');
			$this->db->from('tb_comunicado as comunicado');

			if($ds_comunicado != ""){
				$this->db->like('LOWER(comunicado.ds_comunicado)', strtoupper($ds_comunicado));
			}
									
			if($id_instituicao != ""){
				$this->db->where("id_instituicao", $id_instituicao);
			}

			$this->db->order_by('comunicado.ds_comunicado', 'asc');
			return $this->db->get()->result();
		}
				
		public function editar($comunicado, $id_comunicado){
			$this->db->where("id_comunicado", $id_comunicado);

			if($this->db->update("tb_comunicado",$comunicado)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($id_comunicado){
			$this->db->where("id_comunicado", $id_comunicado);
			$data['comunicado'] = $this->db->get('tb_comunicado')->result();	

			return $data['comunicado'];
		}

		public function excluir($id_comunicado){
			$this->db->where("id_comunicado", $id_comunicado);

			return $this->db->delete("tb_comunicado");
		}

		public function verificarSeExiste($ds_comunicado){
			$this->db->where('LOWER(ds_comunicado)', strtoupper($ds_comunicado));
			$data['comunicado'] = $this->db->get('tb_comunicado')->result();	

			return $data['comunicado'];
		}
		
		public function listar(){
			$this->db->select('*');
			$this->db->from('tb_comunicado as comunicado');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = comunicado.id_instituicao');
			$this->db->order_by('comunicado.dt_cadastro', 'desc');

			return $this->db->get()->result();
		}

		public function listarInstituicao(){
			return $this->db->get('tb_instituicao')->result();
		}

		public function cadastrar($comunicado){			
			if($this->db->insert("tb_comunicado", $comunicado)){
				return true;
			}else{
				return false;
			}
		}
	}
?>