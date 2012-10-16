<style type="text/css">
.tb_titulos_tabla th{
        text-align:left;
        border-width: 1px;
        padding: 1px;
        border-style: outset;
        border-color: gray;
        background-color: white;
        -moz-border-radius: ;
        color:black;
}

.tb_grid_tabla{
        border-width: 0px;
        border-spacing: 2px;
        border-style: outset;
        border-color: gray;
        border-collapse: separate;
        background-color: white;
}


.tb_grid_tabla th{
        border-width: 1px;
        padding: 1px;
        border-style: outset;
        border-color: gray;
        background-color: gray;
        -moz-border-radius: ;
        color:white;
}

.tb_grid_tabla td{
        border-width: 1px;
        padding: 0px;
        border-style: outset;
        border-color: gray;
        background-color: white;
        -moz-border-radius: ;
}

.celda{
	text-align:center;
}

</style>

<table class="tb_grid_tabla" width="30%" cellspacing="1" cellpadding="3" border="0">
        <tr id="celda" class="celda">
                <th width="4%" height="15" scope="col" rowspan="1"><strong>Banco BCI</strong></th>
        </tr>
</table></br>
<table class="tb_grid_tabla" width="55%" cellspacing="1" cellpadding="3" border="1">
        <tr id="celda" class="celda">
                <th width="4%" height="15" scope="col" rowspan="2"><strong>Registro</strong></th>
                <th width="4%" height="15" scope="col" colspan="3"><strong>Empresa</strong></th>
        </tr>
	<tr id="celda" class="tabla">
		<th width="4%" height="15" scope="col" ><strong>Id</strong></th>
		<th width="4%" height="15" scope="col" ><strong>Rut</strong></th>
		<th width="20%" height="15" scope="col" ><strong>Nombre</strong></th>
	</tr>
	{cabecera}
        <tr>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{ident_registro}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{ident_empresa}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{rut_empresa}-{dig_verificador_emp}</td>
                <td width="20%" height="15" scope="col" align="center">&nbsp;{nombre_empresa}</td>
        </tr>
	{/cabecera}
</table></br>
<table class="tb_grid_tabla" width="85%" cellspacing="1" cellpadding="3" border="1">
        <tr id="celda" class="celda">
                <th width="4%" height="15" scope="col" rowspan="2">Ident. Detalle</th>
                <th width="4%" height="15" scope="col" rowspan="2">Ident. Transaci&oacute;n</th>
                <th width="4%" height="15" scope="col" colspan="2">Pagador</th>
                <th width="4%" height="15" scope="col" colspan="3">Producto</th>
                <th width="4%" height="15" scope="col" rowspan="2">Total</th>
                <th width="4%" height="15" scope="col" rowspan="2">Forma Pago</th>
                <th width="4%" height="15" scope="col" rowspan="2">Comisi&oacute;n</th>
                <th width="4%" height="15" scope="col" rowspan="2">Estado</th>
                <th width="4%" height="15" scope="col" rowspan="2">Cod. Rechazo</th>
        </tr>
	<tr>
		<th width="4%" height="15" scope="col" >Rut</th>
		<th width="4%" height="15" scope="col" >Nombre</th>
		<th width="4%" height="15" scope="col" >Id</th>
		<th width="4%" height="15" scope="col" >Precio</th>
		<th width="4%" height="15" scope="col" >Cantidad</th>
	</tr>
	{detalle}
        <tr>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{ident_reg_detalle}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{ident_transaccion}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{rut_pagador}-{dig_verif_pagador}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{nombre_pagador}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{ident_producto}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{precio}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{cantidad}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{total}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{forma_pago}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{comision_compra}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{estado}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{cod_rechazo}</td>
        </tr>
	{/detalle}
</table></br>
<table class="tb_grid_tabla" width="75%" cellspacing="1" cellpadding="3" border="1">
	<tr id="celda" class="celda">
		<th width="4%" height="15" scope="col" rowspan="2">Ident. Cierre</th>
		<th width="4%" height="15" scope="col" colspan="3">Totales</th>
		<th width="4%" height="15" scope="col" colspan="2">Aceptado</th>
		<th width="4%" height="15" scope="col" colspan="2">Rechazado</th>
	</tr>
	<tr>
		<th width="4%" height="15" scope="col" >Registros</th>
		<th width="4%" height="15" scope="col" >Monto</th>
		<th width="4%" height="15" scope="col" >Comisi&oacute;n</th>
		<th width="4%" height="15" scope="col" >Cantidad</th>
		<th width="4%" height="15" scope="col" >Monto</th>
		<th width="4%" height="15" scope="col" >Cantidad</th>
		<th width="4%" height="15" scope="col" >Monto</th>
	</tr>	
	{cierre}
	<tr>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{ident_reg_control}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{total_reg_archivo}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{total_monto}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{total_comision}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{cant_reg_aceptado}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{monto_reg_aceptado}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{cant_reg_rechazado}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{monto_reg_rechazado}</td>
	</tr>	
	{/cierre}
</table>
