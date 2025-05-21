<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Agenda_model extends CI_Model{

		public function pesquisar($ds_agenda, $id_instituicao){
			$this->db->select('*');
			$this->db->from('tb_agenda as agenda');

			if($ds_agenda != ""){
				$this->db->like('LOWER(agenda.ds_agenda)', strtoupper($ds_agenda));
			}
						
			if($id_instituicao != ""){
				$this->db->where("id_instituicao", $id_instituicao);
			}
			
			$this->db->order_by('agenda.ds_agenda', 'asc');
			return $this->db->get()->result();
		}
				
		public function editar($agenda, $id_agenda){
			$this->db->where("id_agenda", $id_agenda);

			if($this->db->update("tb_agenda",$agenda)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($id_agenda){
			$this->db->where("id_agenda", $id_agenda);
			$data['agenda'] = $this->db->get('tb_agenda')->result();	

			return $data['agenda'];
		}

		public function excluir($id_agenda){
			$this->db->where("id_agenda", $id_agenda);

			return $this->db->delete("tb_agenda");
		}

		public function verificarSeExiste($ds_agenda){
			$this->db->where('LOWER(ds_agenda)', strtoupper($ds_agenda));
			$data['agenda'] = $this->db->get('tb_agenda')->result();	

			return $data['agenda'];
		}
		
		public function listar(){
			$this->db->select('*');
			$this->db->from('tb_agenda as agenda');
			$this->db->join('tb_instituicao as instituicao', 'instituicao.id_instituicao = agenda.id_instituicao');
			$this->db->order_by('agenda.dt_cadastro', 'desc');

			return $this->db->get()->result();
		}

		public function listarInstituicao(){
			return $this->db->get('tb_instituicao')->result();
		}

		public function cadastrar($agenda){			
			if($this->db->insert("tb_agenda", $agenda)){
				return true;
			}else{
				return false;
			}
		}
	}
?>