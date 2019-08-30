<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<body>
	<?php 

	if(isset($_FILES["myFile"])){

		$_FILES["myFile"]['name'] = dropEmpty($_FILES["myFile"]['name']);
		$_FILES["myFile"]['type'] = dropEmpty($_FILES["myFile"]['type']);
		$_FILES["myFile"]['tmp_name'] = dropEmpty($_FILES["myFile"]['tmp_name']);
		$_FILES["myFile"]['size'] = dropEmpty($_FILES["myFile"]['size']);
		unset($_FILES["myFile"]['error']);

		$_FILES["myFile"]["cd_item"] = explode(", ",$_POST['allCodigos']);

		echo "<pre style='color:red; font-size:10px; background-color:#c4c4c4'>";
		print_r(array_filter($_FILES));	
		echo "</pre>";
		echo "<hr>";
	}

	for ($i=0; $i < @count($_FILES["myFile"]["cd_item"]); $i++) { 
		echo $_FILES["myFile"]["cd_item"][$i]."<br>";
		echo $_FILES["myFile"]["name"][$i]."<br>";
		echo $_FILES["myFile"]["tmp_name"][$i]."<br>";
		echo $_FILES["myFile"]["size"][$i]."<br>";
		echo "<hr>";
	}

	function dropEmpty($iFiles){
		return array_values(array_filter($iFiles));
	}


	$aItens = [
	645=>"Fiança",
	423=>"Nota promissória",
	764=>"Vales",
	333=>"Duplicatas",
	783=>"Nota fiscal",
	213=>"Recibo",
	667=>"Documento",
	889=>"Aval",
	332=>"Xerox"];
// print_r($aItens);
	?>
	<a href="index.php">Inicio</a>
	<fieldset><legend>Formulario</legend>
		<form action="#" enctype="multipart/form-data" method="POST">
				
			<?php $i = 0; foreach ($aItens as $keys => $value): ?>

				"<?php echo $i.") ". $value ?>" <input type="file" name="myFile[]" data-cd_item="<?php echo $keys; ?>"> <span data-cd_item="<?php echo $keys; ?>" class="limpar">[x]</span></br>

			<?php $i++; endforeach; ?>
			<input type="hidden" name="allCodigos">

			<input type="submit" value="Enviar">
		</form>
	</fieldset>

	<script>

		var aCodigo = [];	

		$('input[type=file]').change(function(event) {

			let codigo = $(this).data('cd_item');

			if(existCdItem(codigo, aCodigo) == false) aCodigo.push(codigo);

			$('input[name=allCodigos]').val(aCodigo.join(', '));
			
			console.log(aCodigo);
		});

		$('.limpar').click(function(event) {

			let codigo = $(this).data('cd_item');

			$('input[type=file][name="myFile[]"][data-cd_item='+codigo+']').val('')

			if(existCdItem(codigo, aCodigo)) $('input[name=allCodigos]').val(aCodigo.join(', '));		
			
			console.log(aCodigo);
		
		});

		function existCdItem(item, array){
			let posElem = array.indexOf(item);
			if(posElem == -1) return false;
			array.splice(posElem, 1);
			return true;
		}

	</script>
</body>
</html>