<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}
//*****************************************************************************************************************************
//REPORTES DE VIAJES POR MES
//*****************************************************************************************************************************
	public function getRepPorMes($id_user, $year, $month){
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as viajes, sum(tab_cobros.cobro) as ganancias
							FROM tab_cobros
							where tab_cobros.id_usuario = ".$id_user." AND YEAR(tab_cobros.fecha) = ".$year." AND MONTH(tab_cobros.fecha) = ".$month);

		if ($queryTotales->num_rows() === 1) {
			$queryTotales = $queryTotales->result();

			if ( intval($queryTotales[0]->viajes) > 0) {
				$tarifa = floatval($queryTotales[0]->ganancias) / intval($queryTotales[0]->viajes);
				$data = array('huboViajes' => TRUE,
							  'viajes' => $queryTotales[0]->viajes,
							  'gastos' => $queryTotales[0]->ganancias,
							  'tarifa' => $tarifa);
				
				return $data;
			}else{
				$data = array('huboViajes' => false,
							'viajes' => 'No hubo viajes en esta fecha',
						  	'gastos' => 0,
						  	'tarifa' => '0');
				return $data;
			}
		}

		return null;
	}
	public function getHPorMes($id_user, $year, $month,$created){

		if ($created == false) {
			$query = $this->db->query("SELECT tc.id_cobro, tc.cobro, tc.saldo, tc.fecha, tc.hora, tc.created, co.nombre, co.ap_pat, co.ap_mat, tc.latitud, tc.longitud
							from tab_cobros tc
							inner join cat_operadores co on tc.id_operador = co.id_operador
							where tc.id_usuario = ".$id_user." AND YEAR(tc.fecha) = ".$year." AND MONTH(tc.fecha) = ".$month."
							order by tc.id_cobro desc
							limit 10");
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}

		}else{
			$query = $this->db->query("SELECT tc.id_cobro, tc.cobro, tc.saldo, tc.fecha, tc.hora, tc.created, co.nombre, co.ap_pat, co.ap_mat
							from tab_cobros tc
							inner join cat_operadores co on tc.id_operador = co.id_operador
							where tc.created < '".$created."' AND tc.id_usuario = ".$id_user." AND YEAR(tc.fecha) = ".$year." AND MONTH(tc.fecha) = ".$month."
							order by tc.id_cobro desc
							limit 10");
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
			
		}

	}
//*****************************************************************************************************************************
//REPORTES DE RECARGAS DE SALDO POR MES
//*****************************************************************************************************************************
	//SE OBTIENE EL REPORTE DE LAS RECARGAS DE SALDO REALIZADAS EN EL MES SELECCIONADO
	public function recargasSaldoMes($id_user, $year, $month){

		$this->db->select("COUNT(tab_recargas_de_saldo.importe) as numRecargas, SUM(tab_recargas_de_saldo.importe) as totalRecargas");
		$this->db->from("tab_recargas_de_saldo");
		$this->db->where("tab_recargas_de_saldo.id_usuario", $id_user);
		$this->db->where("YEAR(tab_recargas_de_saldo.fecha)", $year);
		$this->db->where("MONTH(tab_recargas_de_saldo.fecha)", $month);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}

	}

	// HISTORIAL DE RECARGAS DE SALDO POR MES
	public function historialRecargasSaldoMes($id_user, $year, $month, $created){
		
		if ($created == false) {
			$this->db->select("trds.id_h_pago, trds.importe, trds.fecha, trds.hora");
			$this->db->from("tab_recargas_de_saldo trds");
			$this->db->where("trds.id_usuario",$id_user);
			$this->db->where("year(trds.fecha)", $year);
			$this->db->where("month(trds.fecha)",$month);
			$this->db->order_by("trds.id_h_pago","desc");
			$this->db->limit(10);

			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}

		}else{
			$this->db->select("trds.id_h_pago, trds.importe, trds.fecha, trds.hora");
			$this->db->from("tab_recargas_de_saldo trds");
			$this->db->where("trds.fecha_creacion < '".$created."'");
			$this->db->where("trds.id_usuario",$id_user);
			$this->db->where("year(trds.fecha)",$year);
			$this->db->where("month(trds.fecha)",$month);
			$this->db->order_by("trds.id_h_pago","desc");
			$this->db->limit(10);

			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
		}

	}

	//SE OBTIENE EL SALDO ACTUAL DEL USUARIO
	public function getSaldoActual($idUser){

		$this->db->select("cat_saldos.saldo");
		$this->db->from("cat_saldos");
		$this->db->where("cat_saldos.id_usuario",$idUser);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}

	//SE OBTIENE LA LISTA DE NIVELES DE ESTUDIOS
	public function getListLevelOfStudy(){
		$query = $this->db->get("cat_grado_estudio");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}

	//SE OBTIENE LA LISTA DE LOS MUNICIPIOS DEL ESTADO
	public function getListMunicipios(){
		$query = $this->db->get("cat_municipios");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}

	//SE OBTIENE LA LISTA DE SEXO
	public function getListSexo(){
		$query = $this->db->get("cat_sexo");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}

	//ACTUALIZACIÓN DE LA INFORMACIÓN DEL PERFIL
	public function updateProfile($data,$id_user){
		$this->db->where('id_usuario',$id_user);
		$query = $this->db->update('cat_usuarios',$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return null;
		}

	}
	//ACTUALIZAR FOTO DE PERFIL
	public function updateImage($data,$id_user){
		$this->db->where('id_usuario',$id_user);
		$query = $this->db->update('cat_usuarios',$data);
	}

	//SE OBTENE LA LATITUD Y LA LONGINTUD DE LOS CAMIONES REGISTRADOS (OPERADORES)
	public function getPosCamiones(){
		$this->db->select("cb.id_bus, cb.latitud, cb.longitud");
		$this->db->from("cat_buses cb");
		$this->db->where("cb.status",1);
		$this->db->order_by("cb.id_bus",'ASC');
		
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}
	/*
		OBTENER EL LA INFORMACIÓN DEL USUARIO
	*/
	public function getInfoUser($codjoven){
	    $this->db->select("*");
		$this->db->from("cat_usuarios cu");
	    $this->db->where("cu.codigo_joven",$codjoven);

	    $query = $this->db->get();
	    if ($query->num_rows() > 0) {
	        return $query->result();
	    } else {
	        return false;
	    }
	}

	

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */