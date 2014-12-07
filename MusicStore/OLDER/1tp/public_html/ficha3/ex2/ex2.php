<!--exercicio 2-->

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Ex2: Pass Info</title>
	</head>
	<body>
		<table border="1px">
			<tr>
				<th>Nome</th>
				<th>Idade</th>
				<th>Distrito</th>
				<th>Codigo Postal</th>
				<th>Sexo</th>
				<th>Interesses</th>
				<th>Email</th>
				<th>Observações</th>
			</tr>
			<tr>
				<?php 
				echo '<td>'. $_GET["tnome"].'<br></td>';
				echo '<td>'. $_GET["tidade"].'<br></td>';
				echo '<td>'. $_GET["sdistrito"].'<br></td>';
				echo '<td>'. $_GET["cpostal4"].'-'. $_GET["cpostal3"]. '<br></td>';
				echo '<td>'. $_GET["tsexo"].'<br></td>';
				echo '<td>'. $_GET["interesses"].'<br></td>';
				echo '<td>'. $_GET["temail"].'<br></td>';
				echo '<td>'. $_GET["tarea"].'<br></td>';
			</tr>
		</table>

	</body>
</html>