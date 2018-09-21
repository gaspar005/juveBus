<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_estadisticas(){

		date_default_timezone_set('America/Cancun');
		$now = date('Y-m-d');

		$query = $this->db->query("SELECT sum(tab_cobros.cobro) as cantidad, count(cat_usuarios.id_usuario) as estudiantes, tab_cobros.fecha 
									from tab_cobros 
									inner join cat_usuarios  on (cat_usuarios.id_usuario = tab_cobros.id_usuario) where tab_cobros.fecha =  '2018-05-18' ");
		return $query->result();

	}
	public function get_estadisticas_operador_dia(){

		date_default_timezone_set('America/Cancun');
		$now = date('Y-m-d');

		$query = $this->db->query("select cto.id_operador, cto.nombre, cto.ap_pat,cto.ap_mat, sum(tbc.cobro) as importe, count(tbc.id_usuario) as estudiantes, cto.correo,  tbc.cobro
 									from tab_cobros tbc
  									inner join cat_operadores cto on (cto.id_operador = tbc.id_operador) where tbc.fecha = '2018-05-18' group by  cto.id_operador ");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	/*PDF PARA IMPRIMIR O ENVIO A CORREOS */
	public function get_operador_header_pdf($id_operador){
		date_default_timezone_set('America/Cancun');
		$now = date('Y-m-d');
		$query = $this->db->query(" SELECT cto.id_operador, cto.nombre, cto.ap_pat,cto.ap_mat, cto.rfc, cto.telefono, cto.colonia, cto.domicilio, cto.cruzamientos, tbc.fecha
 									from tab_cobros tbc
  									inner join cat_operadores cto on (cto.id_operador = tbc.id_operador) where tbc.id_operador ='".$id_operador." '  and tbc.fecha = '2018-05-18'  order by  tbc.id_operador limit 1  ");
		return $query->result();

	}
	public function get_operador_contenido_pdf($id_operador){
		date_default_timezone_set('America/Cancun');
		$now = date('Y-m-d');
		$query = $this->db->query(" SELECT  tbc.cobro,  count(tbc.id_usuario) as estudiantes ,sum(tbc.cobro) as importe , cto.nombre, cto.ap_pat, cto.ap_mat, cto.rfc, cto.correo
 									from tab_cobros tbc
  									inner join cat_operadores cto on (cto.id_operador = tbc.id_operador) where tbc.fecha = '2018-05-18' and cto.id_operador = '".$id_operador."'  ");
		return $query->result();

	}


}
