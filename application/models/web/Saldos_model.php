<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldos_model extends CI_Model {

	public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function buscar($status, $nombre, $ap_pat, $ap_mat = FALSE, $inicio = FALSE, $cantidadregistro = FALSE){

	$query = "SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo
 			  FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) 
 			  where cu.nombre  COLLATE utf8_unicode_ci LIKE '%".$nombre."%'  AND cu.ap_pat COLLATE utf8_unicode_ci LIKE '%".$ap_pat."%' AND cu.status = $status ";

    if ($ap_mat != FALSE) {
    	$cardena = "AND cu.ap_mat COLLATE utf8_unicode_ci LIKE '%".$ap_mat."%' ";
    	$query = $query.$cardena;
    }

    if ($inicio != FALSE && $cantidadregistro != FALSE) {
    	$limite = "LIMIT $cantidadregistro";
    	$query = $query.$limite;
    }

    $consulta =  $this->db->query($query);

	if ($consulta->num_rows() > 0){
		return $consulta->result();
	}else{
		return false;
	}
  }
  public function buscarCantidad($status, $nombre, $ap_pat, $ap_mat){
	  $query = "SELECT count(cu.nombre) as totalregistros
 			    FROM cat_usuarios cu
 			    where  cu.nombre COLLATE utf8_unicode_ci  LIKE '%".$nombre."%'  AND cu.ap_pat COLLATE utf8_unicode_ci LIKE '%".$ap_pat."%' AND cu.status = $status ";

	  $consulta =  $this->db->query($query);
	  if ($consulta->num_rows() > 0){
		  return $consulta->result();
	  }else{
		  return false;
	  }

  }
  	public function buscarNomApMate($buscador_nombre,$buscador_paterno,$buscador_materno ,$inicio = FALSE, $mostrarpor = FALSE ){
		$query = "SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento,sd.saldo, cu.curp, cu.sexo, cu.edad,cu.correo, cu.status,
					cu.colonia,cu.cruzamiento_domicilio,cu.domicilio, cu.lengua_indigena,cu.lugar_nacimiento,cu.localidad,cu.turno_horario,cu.tel_celular,cu.lugar_residencia,
					  cu.escuela,cu.tel_casa,
					  cm.nombre as municipio, 
					  cgs.nombre as grado_estudio
					FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) 
					 inner join cat_municipios cm on (cu.id_municipio = cm.id_municipio) 
					 inner join cat_grado_estudio cgs on (cu.id_grado_estudio = cgs.id_grado_estudio) 
 			  where cu.nombre  COLLATE utf8_unicode_ci LIKE '%".$buscador_nombre."%' and cu.ap_pat COLLATE utf8_unicode_ci LIKE '%".$buscador_paterno."%' and cu.ap_mat COLLATE utf8_unicode_ci LIKE '%".$buscador_materno."%'  LIMIT $inicio, $mostrarpor  ";

		$consulta =  $this->db->query($query);

		if ($consulta->num_rows() > 0){
			return $consulta->result();
		}else{
			return false;
		}
	}

	public function cantidadEstudiantesNPM($buscador_nombre = FALSE, $buscador_paterno = FALSE, $buscador_materno = FALSE){
		$query = "SELECT count(cu.nombre) as totalregistros
 			    FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) where cu.nombre  COLLATE utf8_unicode_ci LIKE '%".$buscador_nombre."%'  and cu.ap_pat COLLATE utf8_unicode_ci LIKE '%".$buscador_paterno."%' and cu.ap_mat COLLATE utf8_unicode_ci LIKE '%".$buscador_materno."%' ";

		$consulta =  $this->db->query($query);

		if ($consulta->num_rows() > 0){
			return $consulta->result();
		}else{
			return false;
		}
	}

  public function inserta_saldo_estudiante($id_user_sistem, $id_usuario, $saldo,  $date, $now){
		$recarga_saldo = array(
			'id_user_sistem' => $id_user_sistem,
			'id_usuario' => $id_usuario,
			'importe' => $saldo,
			'fecha' => $now,
			'hora' => $date
		);
		return $this->db->insert('tab_recargas_de_saldo', $recarga_saldo);
  }
  public function body_info_send_email_estudiante($id_estudiante){

	$query = $this->db->query("SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) where cu.id_usuario = $id_estudiante ");
	  if ($query->num_rows() > 0){
		  return $query->result();
	  }else{
		  return false;
	  }
  }
  public function get_ultimo_elemento(){

	  $query =$this->db->query("SELECT tab_recargas_de_saldo.id_h_pago, tab_recargas_de_saldo.folio from tab_recargas_de_saldo order by tab_recargas_de_saldo.id_h_pago desc limit 1");
	  $ultimoValor =$query->result();

	  if ($query->num_rows() <= 0 ){
		 return 1;
	  }else{
		 return $ultimoValor[0]->folio + 1;
	  }

  }
  public function altaSaldo($idUsuario,$importe,$dataRecargas,$currentDateTime){

		$this->db->trans_start();
		$this->db->insert('tab_recargas_de_saldo', $dataRecargas);
		$query = $this->db->query("SELECT * FROM cat_saldos WHERE cat_saldos.id_usuario = ".$idUsuario);
		//si se encontraron registros en la tabla cat_saldos se actualiza el saldo
		if ($query->num_rows() > 0) {
			$queryCat_saldo = $query->result();
			$saldo = $queryCat_saldo[0]->saldo;
			$nuevoSaldo = floatval($saldo) + floatval($importe);
			$this->db->set('saldo', $nuevoSaldo);
			$this->db->where('id_usuario', $idUsuario);
			$this->db->update('cat_saldos');
		}else{
			$dataCatSaldos = $this->_dataFormatCatSaldos($idUsuario,$importe,$currentDateTime);
			$this->db->insert('cat_saldos', $dataCatSaldos);
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}else{
			return true;
		}

	}

	private function _dataFormatCatSaldos($idUsuario,$importe,$currentDateTime){
		return array('id_usuario' => $idUsuario,
			'saldo'=>$importe,
			'fecha_creacion' =>$currentDateTime['created']);
	}

}

/* End of file Saldos_model.php */
/* Location: ./application/models/web/Saldos_model.php */
