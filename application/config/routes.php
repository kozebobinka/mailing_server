<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';

$route['letters/news'] = 'mailing/get_news_html/1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
