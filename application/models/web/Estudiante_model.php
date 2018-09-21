<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }
	public function get_municipios(){

		$this->db->select('*');
		$this->db->from('cat_municipios');
		return $this->db->get()->result();

	}
	public function get_grado_estudios(){

		$this->db->select('*');
		$this->db->from('cat_grado_estudio');
		return $this->db->get()->result();

	}
    public function get_list_estudiantes(){

        $query = $this->db->query("select user.id_usuario,user.codigo_joven, user.nombre,user.ap_pat, user.ap_mat,  user.curp, user.fecha_nacimiento, user.edad,user.sexo,user.correo,user.tel_casa,user.tel_celular,user.lugar_nacimiento,
      							    user.localidad, muni.nombre as municipio, user.colonia, user.domicilio, user.cruzamiento_domicilio, gtds.nombre as grado_estudio, user.escuela, user.turno_horario,
      								user.lengua_indigena, user.status
									from cat_usuarios user, cat_grado_estudio gtds, cat_municipios muni
									where  muni.id_municipio = user.id_municipio and gtds.id_grado_estudio = user.id_grado_estudio");
        if ($query->num_rows() > 0){
           return $query->result();
        }else{
           return false;
        }
    }   

    public function save_estudiante($estudiante){
    	 return $this->db->insert('cat_usuarios', $estudiante);
    }
    public function existeCodigoJoven($cj){

	  	$this->db->select('codigo_joven');
	  	$this->db->from('cat_usuarios');
	  	$this->db->where('codigo_joven', $cj);
		$query = $this->db->get();
	    if ($query->num_rows() > 0){
	       return  $query->result();
	    }else{
	       return false;
	    }
    }
    public function deshabilitarEstudiante($id){

        $deshabilitar = array('status' => 0);
        $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $deshabilitar);

    }
    public function habilitarEstudiante($id){

        $habilitar = array('status' => 1);
        $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $habilitar);
    }
    public function save_edit_estudiante($id, $estudiante){
               $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $estudiante);
    }

    /* metodo que obtiene los datos del estudiante para mostrarlos en el pdf enviado a su correo */
	public function get_estudiante_header_email_pdf($id_estudiante){

		$query = $this->db->query(" SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.correo,
											cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo, rs.fecha, rs.hora, rs.id_h_pago, rs.folio
									FROM cat_usuarios cu 
										  inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) 
										  inner join tab_recargas_de_saldo rs on (cu.id_usuario = rs.id_usuario) 
									where cu.id_usuario = $id_estudiante ORDER BY rs.id_h_pago DESC LIMIT 1 ");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}

	}

	/*se obtienen los datos del usuario del sistema*/
	public function getAdminData($id_user_sistem)
	{
		$this->db->select("cus.nombre, cus.ap_pat, cus.ap_mat");
		$this->db->where("cus.id_user_sistem",$id_user_sistem);
		$this->db->from("cat_user_sistem cus");
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}

	}

}

/* End of file Estudiante_model.php */
/* Location: ./application/models/Estudiante_model.php */
