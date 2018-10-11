<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default id items
|--------------------------------------------------------------------------
|
| This set default items for an id
|
*/
$config['default_prefix'] = 'GCL';
$config['default_suffix'] =  100000;
$config['default_separator'] = '-';

/*
|--------------------------------------------------------------------------
| Gemstone report image path
|--------------------------------------------------------------------------
|
|
*/
$config['img_basepath'] = './assets/images/';
$config['img_folder_a'] = 'Memocard';
$config['img_folder_b'] = 'Certificate';
$config['img_folder_c'] = 'Verbal';
$config['allowed_types'] = 'gif|jpg|png|jpeg';

/*
|--------------------------------------------------------------------------
| Report Date format
|--------------------------------------------------------------------------
|
|
*/
$config['date_format'] = 'Y-m-d';

/*
|--------------------------------------------------------------------------
| Directory Read Write permissions
|--------------------------------------------------------------------------
|
|
*/
$config['dir_permission'] = 0777;
$config['dir_recursive'] = true;

?>
