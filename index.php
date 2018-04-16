<?php

try{
	$pdo = new PDO("mysql:dbname=ordenar;host=127.0.0.1", "root", "");

} catch(PDOException $e){
	echo "ERRO".$e->getMessage();
	exit;
}
if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
		$ordem = addslashes($_GET['ordem']);
		$sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
	} else{
		$ordem ="";
		$sql = "SELECT * FROM usuarios";
	}
?>

<form method="GET">
	<select name="ordem" onchange="this.form.submit()">
		<option></option>
		<option value="nome" <?php echo ($ordem=="nome")?'selected="selected"':''; ?>>Pelo Nome</option>
		<option value="idade" <?php echo ($ordem=="idade")?'selected="selected"':''; ?>>Pela Idade</option>
	</select>
</form>

<table border="1" width="400" />
	<tr>
		<th>Nome</th>
		<th>Idade</th>
	</tr>
	<?php

	$sql = $pdo->query($sql);
	if($sql->rowCount() > 0){
		foreach($sql->fetchAll() as $usuario):
			?>
			<tr>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['idade']; ?></td>
			</tr>
			<?php
		endforeach;
	}
	?>
</table>