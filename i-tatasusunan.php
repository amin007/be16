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

# setkan jquery sama ada local atau cdn
$jquery_cdn = 'http://code.jquery.com/jquery-1.8.3.min.js';
$jquery_local = 'http://' . $_SERVER['SERVER_NAME'] . '/private_html/js/jquery/jquery-1.8.3.min.js';
# setkan bootstrap dan font awosome sama ada local atau cdn
$fontawesome_cdn = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
$bootstrap_cdn = 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css';
$fontawesome_local = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
$bootstrap_local = 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css';
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
	define('BOOTSTRAP', $bootstrap_cdn);
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
	define('BOOTSTRAP', $bootstrap_local);
}
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ",," . DB_NAME . "<br>";
############################################################################################