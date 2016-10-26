<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Masukdatabanyak extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Laporan extends Kawal';
		parent::__construct();
        //\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		//\Aplikasi\Kitab\Kebenaran::kawalKeluar();

		$this->_folder = 'laporan';
	}
	
	public function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin Laporan';
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/index', null, 1);
	}
#==========================================================================================	
	public function tarikdata()
	{
		$jadual = 'be16_kawal';
		$jum2 = pencamSqlLimit(100, $item=100, $ms=1);
		$data = $this->tanya->tarikNombor();
		
		echo '<pre>$data:<br>'; print_r($data) . '</pre>';
		
		$medan2 = 'newss,nossm,nama,msic2008,alamat1,alamat2,poskod,bandar,posdaftar,'
			//. 'notel_a,notel,nofax_a,nofax,orang_a,responden,esurat_a,email,'
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," orang",orang_a),' . "\r"
			. ' 	concat_ws("="," notel",notel_a),' . "\r"
			. ' 	concat_ws("="," nofax",nofax_a)' . "\r"
			. ' ) as dataHubungi'
			. '';
		$cari2[] = array('fix'=>'zin','atau'=>'WHERE','medan'=>'newss','apa'=>"($data)");			
		$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'msic2008,nama') );
		$this->papar->cariApa['senarai'] = $this->tanya->//tatasusunanCari//cariSql
			cariSemuaData
			($jadual, $medan2, $cari2, $susun);
		
		echo '<pre>$this->papar->cariApa:<br>'; print_r($this->papar->cariApa) . '</pre>';//*/
		//echo '<pre>$susun:<br>'; print_r($susun) . '</pre>';
	}
#==========================================================================================
}