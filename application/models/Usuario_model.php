<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuario_model extends CI_Model{

		public function selecionarUltimoCodigoUsuario(){
			$this->db->select('id_usuario');
			$this->db->from('tb_usuario');
			$this->db->order_by('id_usuario', 'desc');	       
			return $this->db->get()->row_array();
		}
				
		public function editar($usuario, $id_usuario){
			$this->db->where("id_usuario", $id_usuario);

			if($this->db->update("tb_usuario",$usuario)){
				return true;
			}else{
				return false;
			}
		}

		public function selecionar($id_usuario){
			$this->db->where("id_usuario", $id_usuario);
			$data['usuario'] = $this->db->get('tb_usuario')->result();	

			return $data['usuario'];
		}

		public function excluir($id_usuario){
			$this->db->where("id_usuario", $id_usuario);

			return $this->db->delete("tb_usuario");
		}

		public function listar(){
			$this->db->select('*');
			$this->db->join('tb_perfil','id_perfil','inner');
			$this->db->order_by('id_usuario', 'desc');
			return $this->db->get('tb_usuario')->result();
		}

		public function verificarSeExiste($usuario){
			$this->db->where("usuario", $usuario);
			$data['usuario'] = $this->db->get('tb_usuario')->result();	

			return $data['usuario'];
		}

		public function listarUsuarioPerfil(){
			//return $this->db->get('tb_perfil')->result();

			$this->db->select('*');
			$this->db->from('tb_perfil');
			$this->db->where("st_ativo", "S");			

			return $this->db->get()->result();

		}

		public function listarInstituicao(){
			return $this->db->get('tb_instituicao')->result();
		}

		public function autenticar($usuario, $senha){			
			$this->db->select('*');
			$this->db->join('tb_perfil','id_perfil','inner');
			$this->db->where("usuario", $usuario);
			$this->db->where("senha", $senha);
			$data['usuario'] = $this->db->get('tb_usuario')->result();	

			return $data['usuario'];
		}
		
		public function cadastrar($usuario){			
			if($this->db->insert("tb_usuario",$usuario)){
				return true;
			}else{
				return false;
			}
		}
	}
?>