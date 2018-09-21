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
									inner join cat_usuarios  on (cat_usuarios.id_usuario = tab_cobros.id_usuario) where tab_cobros.fecha =  '".$now."' ");
		return $query->result();

	}
	public function get_estadisticas_operador_dia(){

		date_default_timezone_set('America/Cancun');
		$now = date('Y-m-d');

		$query = $this->db->query("select cto.id_operador, cto.nombre, cto.ap_pat,cto.ap_mat, sum(tbc.cobro) as importe, count(tbc.id_usuario) as estudiantes
 									from tab_cobros tbc
  									inner join cat_operadores cto on (cto.id_operador = tbc.id_operador) where tbc.fecha = '".$now."' group by  cto.id_operador ");
		return $query->result();

	}
}
