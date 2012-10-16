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
		<th width="4%" height="15" scope="col" rowspan="1"><strong>Banco Santander</strong></th>
	</tr>
</table></br>
<table class="tb_grid_tabla" width="45%" cellspacing="1" cellpadding="3" border="1">
	<tr id="celda" class="celda">
		<th width="4%" height="15" scope="col" rowspan="1"><strong>N&uacute;mero Pagos</strong></th>	
		<th width="4%" height="15" scope="col" rowspan="1"><strong>Monto Total</strong></th>	
	</tr>
	<tr>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{numeropago}</td>
		<td width="4%" height="15" scope="col" align="center">&nbsp;{monto}</td>
	</tr>	
</table>
<table class="tb_grid_tabla" width="95%" cellspacing="1" cellpadding="3" border="1">
        <tr id="celda" class="celda">
                <th width="4%" height="15" scope="col" rowspan="2"><strong>Id Carro</strong></th>
                <th width="4%" height="15" scope="col" rowspan="2"><strong>Id Convenio</strong></th>
                <th width="3%" height="15" scope="col" rowspan="2"><strong>Num. Cliente</strong></th>
                <th width="4%" height="15" scope="col" colspan="4"><strong>Producto</strong></th>
                <th width="4%" height="15" scope="col" colspan="2"><strong>Operaci&oacute;n</strong></th>
                <th width="4%" height="15" scope="col" rowspan="2"><strong>Id Atributo</strong></th>
        </tr>
        <tr>
                <th width="2%" height="15" scope="col" ><strong>N&uacute;mero</strong></th>
                <th width="2%" height="15" scope="col" ><strong>Expiraci&oacute;n</strong></th>
                <th width="3%" height="15" scope="col" ><strong>Descripci&oacute;n</strong></th>
                <th width="3%" height="15" scope="col" ><strong>Monto</strong></th>
                <th width="3%" height="15" scope="col" ><strong>N&uacute;mero</strong></th>
                <th width="3%" height="15" scope="col" ><strong>Fecha</strong></th>
        </tr>
{listado}
        <tr>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{id_carro}</td>
                <td width="4%" height="15" scope="col" align="center">&nbsp;{id_convenio}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{numero_cliente}</td>
                <td width="2%" height="15" scope="col" align="center">&nbsp;{numero_producto}</td>
                <td width="2%" height="15" scope="col" align="center">&nbsp;{expiracion_producto}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{desc_producto}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{monto_producto}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{numero_operacion}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{fecha_operacion}</td>
                <td width="3%" height="15" scope="col" align="center">&nbsp;{id_atributo}</td>
        </tr>
{/listado}
</table>
