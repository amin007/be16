<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Login_Tanya extends \Aplikasi\Kitab\Tanya
{
#==========================================================================================
	public function __construct()
	{
		parent::__construct();
	}
		
	function dapatid($nama)
	{
		echo '<pre>$_POST->'; print_r($_POST) . '</pre>| ';
		echo '<pre>$nama->'; print_r($nama) . '</pre>| ';
		echo 'Kod:' . \Aplikasi\Kitab\RahsiaHash::rahsia('md5', $nama) . ': ';
		//echo 'Kod:' . RahsiaHash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY) . ': ';
		//*/		
	}
	
	function ujiID($medan = 'Nama_Penuh,namaPegawai,email,kataLaluan,level', $jadual = 'nama_pegawai')
	{
		echo 'class Login_Tanya::ujiID() extends \Aplikasi\Kitab\Tanya<br>';
		$username =  $_POST['username'];
		$password = \Aplikasi\Kitab\RahsiaHash::rahsia('md5', $_POST['password']);

		$cari[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'email','apa'=>$username);
		$cari[] = array('fix'=>'x=','atau'=>'AND','medan'=>'kataLaluan','apa'=>$password);
		# tanya Sql
		$hasil = $this->//tatasusunanUbah2A//cariSemuaData//
			cariSql($jadual, $medan, $cari, $susun = null);
	}
	
	function semakid($medan = 'Nama_Penuh,namaPegawai,email,kataLaluan,level', $jadual = 'nama_pegawai')
	{	
		$semakLogin = $this->db->prepare("
			SELECT  $medan FROM  $jadual WHERE 
			email = :username AND kataLaluan = :password");
		
		$semakLogin->execute(array(
			':username' => $_POST['username'],
			':password' => \Aplikasi\Kitab\RahsiaHash::rahsia('md5', $_POST['password'])
			//':password' => \Aplikasi\Kitab\RahsiaHash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
		));
		
		//$semakLogin->debugDumpParams(); # semak $sth->debugDumpParams()
		$data = $semakLogin->fetch(); # dapatkan medan terlibat
		$kira = $semakLogin->rowCount(); # kira jumlah data
		//echo ' | $kira=' . $kira;
		
		if ($kira == 1) 
		{	# login berjaya
			\Aplikasi\Kitab\Sesi::init(); # setkan $_SESSION utk 
			# Nama_Penuh,namaPegawai,kataLaluan,level 
			\Aplikasi\Kitab\Sesi::set('namaPegawai', $data['namaPegawai']);
			\Aplikasi\Kitab\Sesi::set('namaPenuh', $data['Nama_Penuh']);
			\Aplikasi\Kitab\Sesi::set('levelPegawai', $data['level']);
			\Aplikasi\Kitab\Sesi::set('loggedIn', true);
			//echo '<hr>Berjaya';
			header('location:' . URL . 'ruangtamu');
		} 
		else # login gagal
		{
			//echo '<hr>Tidak Berjaya';
			header('location:' . URL . 'login/salah');
		}
		//*/		
	}
#---------------------------------------------------------------------------------------------------#
}