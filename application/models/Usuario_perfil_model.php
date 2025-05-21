<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuario_perfil_model extends CI_Model{

		public function selecionarUltimoCodigoUsuarioPerfil(){
			$this->db->select('cod_usuario_perfil');
			$this->db->from('tb_usuario_perfil');
			$this->db->order_by('cod_usuario_perfil', 'desc');	       
			return $this->db->get()->row_array();
		}
				
		public function editar($usuarioPerfil, $cod_usuario_perfil){
			$this->db->where("cod_usuario_perfil", $cod_usuario_perfil);

			if($this->db->update("tb_usuario_perfil",$usuarioPerfil)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($cod_usuario_perfil){
			$this->db->where("cod_usuario_perfil", $cod_usuario_perfil);
			$data['usuarioPerfil'] = $this->db->get('tb_usuario_perfil')->result();	

			return $data['usuarioPerfil'];
		}

		public function excluir($cod_usuario_perfil){
			$this->db->where("cod_usuario_perfil", $cod_usuario_perfil);

			return $this->db->delete("tb_usuario_perfil");
		}

		public function verificarSeExiste($des_usuario_perfil){
			$this->db->where("des_usuario_perfil", $des_usuario_perfil);
			$data['usuarioPerfil'] = $this->db->get('tb_usuario_perfil')->result();	

			return $data['usuarioPerfil'];
		}

		public function listar(){
			return $this->db->get('tb_usuario_perfil')->result();

		}
		
		public function cadastrar($usuarioPerfil){			
			if($this->db->insert("tb_usuario_perfil",$usuarioPerfil)){
				return true;
			}else{
				return false;
			}
		}
	}
?>