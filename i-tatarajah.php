<?php
# 4 folder utama
define('KAWAL', 'Aplikasi/Kawal');
define('PAPAR', 'Aplikasi/Papar');
define('TANYA', 'Aplikasi/Tanya');
define('KITAB', 'Aplikasi/Kitab');

# Fungsi Global
require KITAB . '/Fungsi.php';

# Sentiasa menyediakan garis condong di belakang (/) pada hujung jalan
define('URL', dirname('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']) . '/');
define('Tajuk_Muka_Surat', '***');

# setkan jquery, bootstrap dan font awesome sama ada local atau cdn
## cdn
      $jquery_cdn = 'https://code.jquery.com/jquery-2.2.3.min.js';
 $bootstrapJS_cdn = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';
$bootstrapCSS_cdn = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
 $fontawesome_cdn = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css';
## local
            $sumber = 'sumber/utama/';
      $jquery_local = $sumber . 'jquery/jquery-2.2.3.min.js';
 $bootstrapJS_local = $sumber . 'bootstrap/3.3.6/js/bootstrap.min.js';
$bootstrapCSS_local = $sumber . 'bootstrap/3.3.6/css/bootstrap.min.css'; 
 $fontawesome_local = $sumber . 'font-awesome/4.4.0/css/font-awesome.min.css';
############################################################################################
## isytihar konsan MYSQL dan GAMBAR ikut lokasi $server
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$server = $_SERVER['SERVER_NAME'];

/*
echo "<br>Alamat IP : <font color='red'>" . $ip . "</font> |
\r<br>Nama PC : <font color='red'>" . $hostname . "</font> | 
\r<br>Server : <font color='red'>" . $server . "</font>\r";
//*/

if ($server == 'laman.web.anda')
{	# isytihar tatarajah mysql
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', '***');
	define('DB_USER', '***');
	define('DB_PASS', '***');
	# isytihar lokasi folder js
	define('JQUERY', $jquery_cdn);
	define('FONTAWESOME', $fontawesome_cdn);
	define('BOOTSTRAP-JS', $bootstrapJS_cdn);
	define('BOOTSTRAP-CSS', $bootstrapCSS_cdn);
}
else 
{	# isytihar tatarajah mysql
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', '***');
	define('DB_USER', '***');
	define('DB_PASS', '***');
	# isytihar lokasi folder js
	define('JQUERY', $jquery_local);
	define('FONTAWESOME', $fontawesome_local);
	define('BOOTSTRAP-JS', $bootstrapJS_local);
	define('BOOTSTRAP-CSS', $bootstrapCSS_local);
}
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ",," . DB_NAME . "<br>";
############################################################################################
# buat tatasusunan ikut serialize
define('PROSESAN', serialize( 
	array ('abu','bakar','umar','osman','ali','hasan')
	));