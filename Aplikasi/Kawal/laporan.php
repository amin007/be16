<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Laporan extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Laporan extends Kawal';
		parent::__construct();
        //\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();

		$this->_folder = 'laporan';
	}
	
	public function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin Laporan';
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/index');
	}
#==========================================================================================
	public function fe($jadual, $cariID, $cariApa, $item = 1000, $ms = 1)
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat = 'Enjin Laporan FE';
		$this->papar->kp = 'BUTAM';
		$this->papar->fe = $cariApa;
		$this->papar->item = $item; 
		$this->papar->ms = $ms = 1;
		# kod asas panggil sql
			//$medan = '*'; # papar semua medan
			$cari[] = array('fix'=>'like%','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			$jum2 = pencamSqlLimit(300, $item, $ms); #
			$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>null) );
			# tanya Sql
			$this->papar->hasil = $this->tanya->tatasusunanRespon
				//kumpulRespon
				($item, $ms, $jadual, $cari, $susun = null);

		# semak data
		/*echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->hasil:<br>'; print_r($this->papar->hasil);
 		echo '</pre>'; //*/

		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/f3all');
	}
#==========================================================================================
# cetak f3 - senarai nama syarikat ikut fe/batchAwal
	public function cetakf3($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'fe','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris(//tatasusunanCari(//cariSql( 
			$jadual, $medan = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'kp,nama ASC') );
		# kumpul respon jadi medan sql
		$medan = $this->tanya->kumpulRespon($item, $ms);
		$hasil = $this->tanya->cariSemuaData($jadual, $medan, $carian, $susun);
		//echo '<pre>$kumpul:'; print_r($kumpul) . '</pre>';
		
		# Set pemboleubah utama
		$this->papar->pegawai = senarai_kakitangan();	
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->hasil = $hasil;
		$this->papar->fe = $namaPegawai;
		$this->papar->kp = 'BE';
	
		# pergi papar kandungan
		$this->papar->baca('laporan/f3all', 1);
	}
#==========================================================================================
	public function cetakresponden($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		# kiraKes dulu
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'fe','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		$bilSemua = $this->tanya->kiraBaris(//tatasusunanCari(//
		//cariSql( 
		$jadual, $medan = '*', $carian, NULL);
		# tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'kp,nama ASC') );
		# kumpul respon jadi medan
		$medan = $this->tanya->kumpulResponden($item, $ms);
		$kumpul = $this->tanya->cariSemuaData($jadual, $medan, $carian, $susun);
		
		//echo '<pre>$kumpul:'; print_r($kumpul) . '</pre>';
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->hasil = $kumpul;
		$this->papar->fe = $namaPegawai;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', 1);
		$this->papar->baca('laporan/f3responden', 1);
	}

#==========================================================================================
}