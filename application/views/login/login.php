<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta charset="utf-8">
		<title>ЖКГ: Розсилка листів</title>
		<link rel="icon" href="<?=site_url('favicon.ico')?>" type="image/x-icon" />
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<link href="<?=site_url('assets/css/main.css')?>" rel="stylesheet" />
		<link href="<?=site_url('assets/css/login.css')?>" rel="stylesheet" />
	</head>
	<body>
		<div id="login">
			<h4 class="text-center pt-5 text-yellow">Федерація роботодавців ЖКГ України</h4>
			<h2 class="text-center text-yellow">Розсилка листів</h2>
			<div class="container">
				<div id="login-row" class="row justify-content-center align-items-center">
					<div id="login-column" class="col-md-6">
						<div class="login-box col-md-12">
							<?=form_open('', array('id' => 'login-form', 'class' => 'form'))?>
								<h3 class="text-center text-blue">Введіть дані користувача</h3>
								<div class="form-group">
									<label for="login" class="text-blue">Логін:</label><br>
									<input type="text" name="login" id="login" class="form-control" value="<?=set_value('login')?>">
									<small class="text-danger"><?=form_error('login'); ?></small>
								</div>
								<div class="form-group">
									<label for="password" class="text-blue">Пароль:</label><br>
									<input type="password" name="password" id="password" class="form-control" value="<?=set_value('password')?>">
									<small class="text-danger"><?=form_error('password'); ?></small>
								</div>
								<div class="form-group pt-3 text-center">
									<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Увійти">
								</div>
							<?=form_close()?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>