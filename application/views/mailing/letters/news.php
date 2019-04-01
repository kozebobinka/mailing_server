<table cellpadding="0" cellspacing="0" align="center" width="100%" style="font-family:‘Open Sans’ Arial,sans-serif;font-size:16px;background:#f4f4f4">			
	<tr>
		<td>
			<table cellpadding="8" cellspacing="0" align="center" style="max-width:600px;">			
				<? if (!$show) : ?>
				<tr bgcolor="0052A3">
					<td align="center" style="color:white;font-size:10px;">
						<p style="margin:0">Виникли проблеми з читанням цього електронного листа? Перегляньте це повідомлення у своєму <a style="color:white;" href=<?=site_url('/letters/site.html')?>>веб-браузері</a>.</p>
					</td>
				</tr>
				<? endif ?>
				<tr style="background-image:url(https://mailing.fru-gkh.com.ua/letters/img/bg-heder.png);color:white;">
					<td>
						<table width="90%" cellpadding="0" cellspacing="0" align="center" style="color:white;">
							<tr>
								<td align="left" style="font-size:18px;font-weight:bold;">
									<p style="margin-top:15px;">Дайджест Федерації роботодавців ЖКГ України</p>
								</td>
								<td align="right" style="padding:10px 0;">
									<a href="https://fru-gkh.com.ua/"><img height="70" src="https://mailing.fru-gkh.com.ua/assets/img/logo.png" alt="ФЕДЕРАЦІЯ РОБОТОДАВЦІВ ЖКГ УКРАЇНИ"></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="FFFFFF">
					<td style="background: linear-gradient(45deg, #fff 25%, #F4F4F4 0, #F4F4F4 50%, #fff 0, #fff 75%, #F4F4F4 0);background-size: 5px 5px;padding-top:20px;">
						<h4 style="color:#606060;margin-left:20px;"><b>НОВИНИ</b></h4>
						<? foreach ($news as $one) : ?>
						<table width="95%" cellpadding="0" cellspacing="0" align="center" style="background:white;margin:15px auto;border-radius:8px;box-shadow: 0 10px 30px #D0D0D0;">
							<tr style="vertical-align:top;">
								<td align="left" style="font-size:16px;font-weight:bold;padding:16px;" colspan="2">
									<a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>" style="color:#0052A3;text-decoration:none"><?=$one['title']?></a>
								</td>
							</tr>
							<tr style="vertical-align:top;">
								<td align="left" width="40%" style="font-size:18px;font-weight:bold;padding:0 0 16px 16px;">
									<a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>"><img src="https://fru-gkh.com.ua/upload/news/<?=$one['image_name']?>" style="width:100%;outline:none;" alt="<?=$one['title']?>"></a>
								</td>
								<td align="left" style="padding:0 16px 16px 16px;">
									<p style="line-height:18px;padding-bottom:10px;"><?=$one['news_anons']?></p>
									<p align="center"><a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>" style="color:#cc0000;border:1px solid #cc0000;border-radius:5px;text-decoration:none;padding:5px 30px;margin-top:20px;">Детальніше</a></p>
								</td>
							</tr>
						</table>
						<? endforeach ?>
						<h4 style="color:#606060;margin-left:20px;padding-top:20px;"><b>БЛОГ</b></h4>
						<? foreach ($blogs as $one) : ?>
						<table width="95%" cellpadding="0" cellspacing="0" align="center" style="background:white;margin:15px auto;border-radius:8px;box-shadow: 0 10px 30px #D0D0D0;">
							<tr style="vertical-align:top;">
								<td align="left" style="font-size:16px;font-weight:bold;padding:16px;" colspan="2">
									<a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>" style="color:#0052A3;text-decoration:none"><?=$one['title']?></a>
								</td>
							</tr>
							<tr style="vertical-align:top;">
								<td align="left" width="40%" style="font-size:18px;font-weight:bold;padding:0 0 16px 16px;">
									<a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>"><img src="https://fru-gkh.com.ua/upload/news/<?=$one['image_name']?>" style="width:100%;outline:none;" alt="<?=$one['title']?>"></a>
								</td>
								<td align="left" style="padding:0 16px 16px 16px;">
									<p style="line-height:18px;padding-bottom:10px;"><?=$one['news_anons']?></p>
									<p align="center"><a href="https://fru-gkh.com.ua/index/news/?id=<?=$one['id']?>" style="color:#cc0000;border:1px solid #cc0000;border-radius:5px;text-decoration:none;padding:5px 30px;margin-top:20px;">Детальніше</a></p>
								</td>
							</tr>
						</table>
						<? endforeach ?>
					</td>
				</tr>
				<tr  align="center" bgcolor="0052A3">
					<td style="padding:20px 0">
						<table cellpadding="0" cellspacing="0" align="center" width="100%">
							<tr>
								<td align="left" style="padding:15px;">
									<a href="https://fru-gkh.com.ua/"><img height="70" src="https://mailing.fru-gkh.com.ua/assets/img/logo.png" alt="ФЕДЕРАЦІЯ РОБОТОДАВЦІВ ЖКГ УКРАЇНИ"></a>
								</td>
								<td align="left" style="color:white;">
									ФЕДЕРАЦІЯ РОБОТОДАВЦІВ ЖКГ УКРАЇНИ
								</td>
								<td align="left" style="color:white;font-size:14px;">
									<p style="margin:3px;">
										<img src="https://mailing.fru-gkh.com.ua/letters/img/email.png" alt="Email">
										<a href="mailto:adamovfrugkh@gmail.com" style="color:white">adamovfrugkh@gmail.com</a>
									</p>
									<p style="margin:2px;">
										<img src="https://mailing.fru-gkh.com.ua/letters/img/phone.png" alt="Телефон">
										<a style="color:white;text-decoration:none;font-weight:bold;" href="tel:0-800-30-69-69">0-800-30-69-69</a>
									</p>
									<p style="margin:2px;">
										<img src="https://mailing.fru-gkh.com.ua/letters/img/address.png" alt="Адреса">
										м. Київ, вул. Михайла Коцюбинського 1, оф. 603
									</p>
								</td>
							</tr>
						</table>
						<? if (!$show) : ?>
						<p align="center" style="color:white;font-size:10px;margin:2px;">Ви підписалися на цю розсилку, використовуючи ел. пошту <a style="color:white;" href="mailto:{{email}}">{{email}}</a></p>
						<p align="center" style="color:white;font-size:10px;margin:2px;">Якщо Ви більше не хочете отримувати такі листи, Ви можете <a style="color:white;" href="<?=site_url('/mailing/unsubscribe/')?>{{encoded_email}}">відмовитися від розсилки</a>.</p>
						<? endif ?>
					</td>
				</tr>
			</table>	
		</td>
	</tr>
</table>			