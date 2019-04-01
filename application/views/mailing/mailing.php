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
		
		<script src="<?=site_url('assets/js/nicedit/nicEdit.js')?>"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		
		<link href="<?=site_url('assets/css/main.css')?>" rel="stylesheet" />
		<script src="<?=site_url('assets/js/mailing.js')?>"></script>
		
	</head>
	<body>
		<div class="container my-5">
			<?=form_open_multipart('/mailing/', array('id' => 'mailing_form'))?>	
			<div class="custom-control custom-radio mb-2">
				<input type="radio" id="target1" name="target" class="custom-control-input" value="1" checked>
				<label class="custom-control-label" for="target1">Підприємства</label>
			</div>
			<div id="target1_div">
				<div class="form-group">
					<select class="form-control col-lg-4" name="region" id="region">
						<option value="0">Оберіть регіон</option>
						<? foreach ($regions as $name) : ?>
						<option value="<?=$name->region?>"><?=$name->region?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control col-lg-6" name="sfera">
						<option value="0">Оберіть сферу діяльності</option>
						<? foreach ($sferas as $id => $name) : ?>
						<option value="<?=$id?>"><?=$name?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<input id="city" type="text" name="city" size="30" autocomplete="off" placeholder="Населений пункт" class="form-control col-lg-4" value="<?=set_value('city')?>">
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="member" name="member">
					<label class="custom-control-label" for="member"><h5>Членство</h5></label>
				</div>
			</div>
			
			<hr>
			
			<div class="custom-control custom-radio">
				<input type="radio" id="target2" name="target" class="custom-control-input" value="2">
				<label class="custom-control-label" for="target2">Органи місцевого самоврядування</label>
			</div>
			
			<hr>
			<h3 class="text-center">Відправка повідомлень підприємствам</h3>
			<h2 class="text-center text-success py-2"><?=$this->session->flashdata('success')?></h2>
			
			<div class="alert alert-dark" role="alert">
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Тема:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="subject" value="<?=set_value('subject')?>">
						<small class="text-danger"><?=form_error('subject'); ?></small>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label">Прикріпити файл:</label>
					<div class="col-sm-10">
						<input type="file" class="form-control attachment" name="attachment[1]">
					</div>
				</div>	
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="message">Повідомлення:</label>
						<button type="button" id="gen_news" class="float-right btn btn-sm btn-warning">Згенерувати новини</button>
						<div class="btn-group float-right mr-2" role="group">
							<button id="btnGroupDrop1" type="button" class="tn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Реклама</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item ads" href="javascript:void(0);" id="site">ЖКГ:САЙТ</a>
								<a class="dropdown-item ads" href="javascript:void(0);" id="ads">ЖКГ:ДИСПЕТЧЕРСЬКА</a>
							</div>
						</div>
					</div>
					<div class="col-sm-12" id="simple_mail">
						<textarea name="message" id="message" class="w-100">
							<?=(set_value('message')) ? set_value('message') : $sign?>
						</textarea>
					</div>
					<div class="col-sm-12" id="news_mail">
						
					</div>
				</div>	
				<div class="form-group text-right">
					<button type="submit" class="btn btn-lg btn-primary">Відправити</button>
				</div>
			</div>
			<?=form_close()?>
		</div>
	</body>
</html>				