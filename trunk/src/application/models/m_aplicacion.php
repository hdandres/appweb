<?php
ini_set ('display_errors', '1');  
class M_aplicacion extends CI_Model{
	
	var $conexion;
        public function __construct(){

		parent::__construct();
		//$this->load->database();
        }

	function insertaTotalSantander($objXml){
		$salida = false;
                $this->load->database();
                $data = array(
                        'numero_pago'   => $objXml->totalizadorPagos->numeroPagos,
                        'monto_total'    => $objXml->totalizadorPagos->montoTotal
                	);
                $result = $this->db->insert('totalizador', $data);
                if($result )
                        $salida = $this->db->insert_id();

                $this->db->close();
		return $salida;
	}

        function insertaDetalleSantander($datos_det, $id_total){
                $this->load->database();
		$id_atributo = ($datos_det->idAtributo == '')?'':$datos_det->idAtributo;
		$operacion = ($datos_det->numeroOperacion == '')?'':$datos_det->numeroOperacion;
		$query = "insert into detalle_pago (id_carro, id_convenio, numero_producto, numero_cliente, expiracion_producto, desc_producto, monto_producto, 
			id_atributo, numero_operacion, fecha_operacion, id_totalizador) values ('".$datos_det->idCarro."','".$datos_det->idConvenio."','".
			$datos_det->numeroProducto."','".$datos_det->numeroCliente."','".$datos_det->expiracionProducto."','".$datos_det->descProducto."','".
			$datos_det->montoProducto."','".$id_atributo."','".$operacion."','".$datos_det->fechahoraOperacion."',".$id_total.")";	

		$result = $this->db->query($query);	
                $this->db->close();
                if($result == FALSE)
                        return 0;
                else
                        return 1;
        }

	function getRegistros($id_totalizador){
		$this->load->database();
		$result = $this->db->query("SELECT p. * , t. * FROM detalle_pago p JOIN totalizador t ON ( p.id_totalizador = t.id ) AND t.id = ".$id_totalizador." LIMIT 0 , 30");
		$result = $result->result_array();
		$this->db->close();
		if(count($result) > 0)
			return $result;
		else
			return false;	
	}

	function obtieneBancos(){
		$this->load->database();
		$result = $this->db->query("SELECT id, nombre from banco ");
		$result = $result->result_array();
		$this->db->close();	
		if(count($result) > 0)
			return $result;
		else
			return false;
	}

	function insertaTotalBci($data){
		$salida = false;
		$this->load->database();
		$result = $this->db->insert('totalizador', $data);
                if($result )
                        $salida = $this->db->insert_id();

                $this->db->close();
                return $salida;
	}

        function insertaDetalleBci($data){
                $salida = false;
                $this->load->database();
                $result = $this->db->insert('detalle_pago', $data);
                if($result)
                        $salida = $this->db->insert_id();

                $this->db->close();
                return $salida;
        }

	function insertaCierreBci($data){
		$salida = false;
		$this->load->database();
		$result = $this->db->insert('cierre_control', $data);
		if($result)
			$salida = $this->db->insert_id();
		$this->db->close();
		return $salida;
	}

        function getCabeceraBci($id){
                $this->load->database();
                $result = $this->db->query("SELECT ident_registro, ident_empresa, rut_empresa, dig_verificador_emp, nombre_empresa from totalizador where id=".$id);
                $result = $result->result_array();
                $this->db->close();
                if(count($result) > 0)
                        return $result;
                else
                        return false;
        }

	function getDetalleBci($id){
		$this->load->database();
		$result = $this->db->query("SELECT ident_reg_detalle, ident_transaccion, rut_pagador, dig_verif_pagador, nombre_pagador, ident_producto, precio, cantidad, total, forma_pago, comision_compra, estado, cod_rechazo from detalle_pago where id_totalizador = ".$id);
		$result = $result->result_array();
		$this->db->close();
		if(count($result) > 0)
			return $result;
		else
			return false;
	}

        function getCierreBci($id){
                $this->load->database();
                $result = $this->db->query("SELECT ident_reg_control, total_reg_archivo, total_monto, total_comision, cant_reg_aceptado, monto_reg_aceptado, cant_reg_rechazado, monto_reg_rechazado from cierre_control where id_totalizador = ".$id);
                $result = $result->result_array();
                $this->db->close();
                if(count($result) > 0)
                        return $result;
                else
                        return false;
        }

	function getRegistroById($id, $banco){
		$this->load->database();
		if($banco == 'san')
			$result = $this->db->query("SELECT id_convenio from detalle_pago where id_carro = '".$id."'");
		else
			$result = $this->db->query("SELECT rut_pagador from detalle_pago where ident_transaccion = '".$id."'");
			
		$result = $result->result_array();
		//log_message('error', 'result: '.print_r($result));
		$this->db->close();
		if(count($result) > 0)
			return $result;
		else
			return false;
	}


  } //fin clase
?>
