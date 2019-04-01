<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta charset="utf-8">
		<title>ЖКГ: Лист підприємствам</title>
		<link rel="icon" href="<?=site_url('assets/img/logo.svg')?>" type="image/x-icon" />
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<link href="<?=site_url('assets/css/main.css')?>" rel="stylesheet" />

	</head>
	<body>
		<div class="container my-5">
			<? if ($done) : ?>
			<h2 class="text-center text-success py-2"><?=$email?> виключено зі списку розсилок!</h2>
			<? else : ?>
			<h3>Ви дійсно бажаєте відмовитися від розсилки на адресу</h3>
			<h3><span class="text-danger"><?=$email?></span>?</h3>
			<?=form_open('/mailing/unsubscribe/')?>
				<input hidden name="email" value=<?=$email?>>
				<button type="subscribe" class="btn btn-lg btn-warning mt-4">Відписатися</button>
			<?=form_close()?>
			<? endif ?>
		</div>
	</body>
</html>		