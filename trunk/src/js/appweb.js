function enviaFile(){
	myFrame = $('zona_tabla');
	//alert(myFrame.src);	
	objForm = $('frm_file');
	//banco = $('sl_bancos').options[$('sl_bancos').selectedIndex].value;
	if($('up_file').value == ''){
		alert('Debe seleccionar Archivo');
		return false;
	}	
	objForm.action = $('site_url').value+'/recibe_file/'
	objForm.submit();
	myFrame.setStyle('display', 'block');	
}	 
