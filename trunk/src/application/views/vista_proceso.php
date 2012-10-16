<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Apps Online</title>
        <link rel="stylesheet" href="{url}/css/style.css" type="text/css" media="all">
        <script language="javascript" type="text/javascript" src="{url}/js/appweb.js"></script>
        <script language="javascript" type="text/javascript" src="{url}/js/mootools.js"></script>
        <script language="javascript" type="text/javascript" src="{url}/js/submodal/common.js"></script>
</head>

<body>
	Archivo </br>
	<input type="hidden" id="site_url" name="site_url" value="{url}"/>
	<form id="frm_file" name="frm_file" method="post" action="" enctype="multipart/form-data" target="zona_tabla">
		{upload}
		<!--Banco: {selbancos}-->
	</form>
	<input type="button" id="btn_envio" name="btn_envio" value="Enviar" onclick="enviaFile()"/>
	</br></br></br>
	<iframe id="zona_tabla" name="zona_tabla" scrolling="auto" src="{url}/recibe_file" frameborder="0" height="500px" width="100%" style="display:none"></iframe>
</body>
</html>
