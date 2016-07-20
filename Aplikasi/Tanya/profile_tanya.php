<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Profile_Tanya extends \Aplikasi\Kitab\Tanya
{
#==========================================================================================
	public function __construct()
	{
		parent::__construct();
	}
#==========================================================================================
	public function medanProfile($pengguna)
	{
		$medan1 = '*';
			
		$medan2 = 'no,namaPegawai,level,Nama_Penuh,'
			. 'email,nohp,Jawatan,Kod,Unit,Tetap,CatatNota';
		
		return $medan2;
	}
#==========================================================================================
}