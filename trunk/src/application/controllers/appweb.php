<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appweb extends CI_Controller {

	var $url_site; //http://{}
	var $url_base; //http://url_site/{}
        public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->library('twig');
                $this->load->library('parser');
                $this->load->helper('form');
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->helper('download');
                $this->load->model('m_aplicacion');
		$this->url_site = base_url();
		$this->url_base = 'appweb';
        }

	public function index($uri = null)
	{
		$this->proceso();
	}

	function navegacion($uri = null, $uri2 = null, $uri3 = null){
		
		if(!$uri)
			$this->proceso();
		else{
			switch($uri){
				case 'prueba':
					$this->prueba();
					break;
				case 'recibe_file':
					$this->recibeFile($uri2);
					break;
				case 'show_rec':
					$this->muestraRegistro($uri2);
					break;
				default:
                                	$this->proceso();
					break;				
			 }
		}
	}

	function prueba(){
		$this->twig->render('base.html', array('url' => $this->url_site.$this->url_base));
		//$this->output->set_output('prueba');
	}

	function proceso(){
		$datos = array(
				'upload' => $this->genera_upload('up_file'),
				'url' => $this->url_site.$this->url_base,
				'selbancos'	=> $this->select_bancos()
			);
	
		$html = $this->parser->parse('vista_proceso', $datos, TRUE);
		$this->output->set_output($html);
	}

	function genera_upload($nombre){
		$data = array(
			'id'	=> $nombre,
			'name'	=> $nombre,
			'value'	=> '',
			'size'	=> '50'
				);
		return form_upload($data); 
	}

	function recibeFile($banco){
		//print_r($_FILES);die();
		//$salida = 'ERR';
		$ext = explode("/", $_FILES['up_file']['type']);
		//print_r($ext);die();
		//log_message('error','[C] files: '.print_r($_FILES, true)); 
		$ruta_tmp = $_FILES['up_file']['tmp_name'];
		//log_message('error','[C] files: '.print_r($ext, true)); 
		switch($ext[1]){
			case 'xml':
				$salida = $this->procesaXmlSantander($ruta_tmp);
				break;
			case 'plain':
				$salida = $this->procesaTxtBci($ruta_tmp);
				break;
			default:
				$salida = 'Error Archivo no soportado';
				break;
		}
		$this->output->set_output($salida);
		
	}
	
	function procesaXmlSantander($ruta_tmp){
		$xmlStr = $this->cadena_xml($ruta_tmp);
                if($xmlStr){
                	$objXml = new SimpleXMLElement($xmlStr);
			if(!$this->validaExistenciaSantander($objXml)){
                        	$insertCabecera = $this->m_aplicacion->insertaTotalSantander($objXml);
                        	if($insertCabecera){
                        		for($i = 0; $i < count($objXml->detallePagos);$i++){
                        	        	//print_r($objXml->detallePagos[$i]->fechahoraOperacion);
                        	                $insertDetalle = $this->m_aplicacion->insertaDetalleSantander($objXml->detallePagos[$i], $insertCabecera);
                        	        }
                        	        if($insertDetalle){
                        	        	//$salida = 'OK '.$insertDetalle;
                        	                $salida = $this->muestraRegistro($insertCabecera, $objXml->totalizadorPagos->numeroPagos, $objXml->totalizadorPagos->montoTotal);
                        	        }
                        	        else
                        	        	$salida = 'Error en tabla detalle';
                        	}
                        	else
                        		$salida = 'Error En tabla totalizador';
			}
			else
				$salida = 'Archivo ya fué cargado';
               }
               else
              		$salida = 'Error en estructura de archivo';
	       return $salida;	
	}

	function validaExistenciaSantander($objXml){
		$i = 0;
		$resp = false;
		//log_message('error', 'count: '.count($objXml->detallePagos));
		While($i < count($objXml->detallePagos)){
			if($objXml->detallePagos[$i]->idCarro != ''){
				$existe = $this->m_aplicacion->getRegistroById($objXml->detallePagos[$i]->idCarro, 'san');
				if($existe){
					$resp = true;
					break;
				}
			}
			$i++;
		}
		return $resp;
	}

        function validaExistenciaBci($lineas){
                $resp = false;
		$contador = count($lineas)-1;
                for($i = 1; $i < $contador; $i++){
                	$transaccion = substr($lineas[$i], 1, 20);
                	if($transaccion != ''){
                		$existe = $this->m_aplicacion->getRegistroById($transaccion, 'bci');
                		//log_message('error', 'existe: '.print_r($existe, true));
                        	if($existe){
                        		$resp = true;
                        	        break;
                        	}
                	}
		}
                return $resp;
        }
	
	function cadena_xml($archivo_tmp){
		$resp = '';
		$lineas = file($archivo_tmp);
		if(count($lineas) == 0)
			$resp = false;
		else{
			foreach ($lineas as $num_linea => $linea)
				$resp .= $linea;
		}
		return $resp;
	}

	function muestraRegistro($id_totalizador, $numPago, $monto){
		$datos = $this->m_aplicacion->getRegistros($id_totalizador);
		$parser = array(
				'listado'	=> $datos,
				'url' 		=> $this->url_site.$this->url_base,
				'numeropago'	=> $numPago,
				'monto'		=> $monto,
			);
		$html = $this->parser->parse('show_detalle', $parser, TRUE);
		//$this->output->set_output($html);
		return $html;	
	}

        function select_bancos(){
                $datos = $this->m_aplicacion->obtieneBancos();
		foreach($datos as $key => $valor){
			$data[$valor['id']] = $valor['nombre'];
		}
		//log_message('error','[C] datos: '.print_r($datos, true)); 
                return form_dropdown('sl_bancos', $data, 1, ' id="sl_bancos" ');
        }

	function procesaTxtBci($rutaTmp){
		$resp = '';
		$lineas = file($rutaTmp);
		if(count($lineas) > 0){
			if(!$this->validaExistenciaBci($lineas)){
				//log_message('error','[C] lineas: '.print_r($lineas, true));
				$datos['cabecera']['ident_registro'] = substr($lineas[0], 0, 1);
				$datos['cabecera']['ident_empresa'] = substr($lineas[0], 1, 10);
				$datos['cabecera']['rut_empresa'] = substr($lineas[0], 14, 12);
				$datos['cabecera']['dig_verificador_emp'] = substr($lineas[0], 26, 1);
				$datos['cabecera']['nombre_empresa'] = substr($lineas[0], 27, 30);
				$contador = count($lineas)-1;
				$j = 0;
				for($i = 1; $i < $contador; $i++){	
					$datos['detalle'][$j]['ident_reg_detalle'] = substr($lineas[$i], 0, 1);
					$datos['detalle'][$j]['ident_transaccion'] = substr($lineas[$i], 1, 20);
					$datos['detalle'][$j]['rut_pagador'] = substr($lineas[$i], 21, 12);
					$datos['detalle'][$j]['dig_verif_pagador'] = substr($lineas[$i], 33, 1);
					$datos['detalle'][$j]['nombre_pagador'] = substr($lineas[$i], 34, 45);
					$datos['detalle'][$j]['ident_producto'] = substr($lineas[$i], 79, 20);
					$datos['detalle'][$j]['precio'] = substr($lineas[$i], 99, 11);
					$datos['detalle'][$j]['cantidad'] = substr($lineas[$i], 110, 4);
					$datos['detalle'][$j]['total'] = substr($lineas[$i], 114, 11);
					$datos['detalle'][$j]['forma_pago'] = substr($lineas[$i], 125, 1);
					$datos['detalle'][$j]['comision_compra'] = substr($lineas[$i], 126, 7);
					$datos['detalle'][$j]['estado'] = substr($lineas[$i], 133, 3);
					$datos['detalle'][$j]['cod_rechazo'] = substr($lineas[$i], 136, 4);
					$j++;
					//log_message('error','[C] datos: '.print_r($datos, true));
				}
				$datos['cierre']['ident_reg_control'] = substr($lineas[$contador], 0, 1);
				$datos['cierre']['total_reg_archivo'] = substr($lineas[$contador], 1, 6);
				$datos['cierre']['total_monto'] = substr($lineas[$contador], 7, 12);
				$datos['cierre']['total_comision'] = substr($lineas[$contador], 19, 9);
				$datos['cierre']['cant_reg_aceptado'] = substr($lineas[$contador], 28, 6);
				$datos['cierre']['monto_reg_aceptado'] = substr($lineas[$contador], 34, 12);
				$datos['cierre']['cant_reg_rechazado'] = substr($lineas[$contador], 46, 6);
				$datos['cierre']['monto_reg_rechazado'] = substr($lineas[$contador], 52, 12);
				$insertCabecera = $this->m_aplicacion->insertaTotalBci($datos['cabecera']);
				if($insertCabecera){
					for($i = 0; $i < count($datos); $i++){
						$datos['detalle'][$i]['id_totalizador'] = $insertCabecera;
						//log_message('error','[C] array_insert: '.print_r($datos['detalle'][$i], true));
						$insertaDetalle = $this->m_aplicacion->insertaDetalleBci($datos['detalle'][$i]);
					}
					$datos['cierre']['id_totalizador'] = $insertCabecera;
					$insertaCierre = $this->m_aplicacion->insertaCierreBci($datos['cierre']);
					$salida = $this->muestraRegistroBci($insertCabecera);	
				}
				else
					$salida = 'Error en Base de Datos';	
			}
			else
				$salida = 'Archivo ya fue Cargado';
		}
		else
			$salida = 'Error en estructura de archivo';
		return $salida;
	}

	function muestraRegistroBci($id_total){
		//log_message('error','[C] datos: '.print_r($datos, true));
                $parser = array(
                                'cabecera'     	=> $this->m_aplicacion->getCabeceraBci($id_total),
                                'detalle'     	=> $this->m_aplicacion->getDetalleBci($id_total),
                                'cierre'     	=> $this->m_aplicacion->getCierreBci($id_total),
                                'url'           => $this->url_site.$this->url_base
                        );
                $html = $this->parser->parse('show_detalle_bci', $parser, TRUE);
                //$this->output->set_output($html);
                return $html;
	}

}
/* Fin clase */
