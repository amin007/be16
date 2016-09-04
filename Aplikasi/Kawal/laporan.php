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
		$this->papar->baca($this->_folder . '/index', null, 1);
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

		/*echo '<pre>'; # semak data
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->hasil:<br>'; print_r($this->papar->hasil);
 		echo '</pre>'; //*/

		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/f3all', null, 1);
	}
#==========================================================================================
# cetak f3 - senarai nama syarikat ikut fe/batchAwal
	public function cetakf3($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		$medan = $this->tanya->kumpulRespon($item, $ms); # kumpul respon jadi medan sql
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'kp,nama ASC') );
		# tanya dalam sql 	
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
		$this->papar->pegawai = senarai_kakitangan();	
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
	
		# pergi papar kandungan
		$this->papar->baca('laporan/f3all', null, 1);
	}
#===============================================================================================
	public function cetakresponden($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		$medan = $this->tanya->kumpulResponden($item, $ms);# kumpul respon jadi medan sql
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'nama ASC') );
		# tanya dalam sql 	
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', null, 1);
		$this->papar->baca('laporan/f3responden', null, 1);
	}
#===============================================================================================
	public function calamat($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		$medan = $this->tanya->kumpulAlamat($item, $ms);# kumpul respon jadi medan sql
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'jalan ASC, nama ASC') );
		# tanya dalam sql 	
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', null, 1);
		$this->papar->baca('laporan/f3responden', null, 1);
	}
#===============================================================================================
	public function cdaerah($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		# set pembolehubah utama untuk sql
		list($medan, $jadual, $carian, $susunkan) = $this->tanya->
			kumpulDaerah($namaPegawai, $cariBatch, $item, $ms);
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$kumpulkan[] = array_merge($jum, $susunkan);
		# tanya dalam sql 	
		$this->papar->hasil[] = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $kumpulkan);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', null, 1);
		//$this->papar->baca('laporan/f3responden', null, 1);
		$this->papar->baca('laporan/fetnt', null, 1);
	}
#===============================================================================================
	public function cetakA1($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		$medan = $this->tanya->kumpulA1($item, $ms);# kumpul respon jadi medan sql
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'respon','apa'=>'A1');
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'respon,kp,nama ASC') );
		# tanya dalam sql 	
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', null, 1);
		$this->papar->baca('laporan/f10', null, 1);//*/
	}
#===============================================================================================
	public function cetakNonA1($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		$medan = $this->tanya->kumpulNonA1($item, $ms);# kumpul respon jadi medan sql
		# set pembolehubah utama untuk sql
		$jadual = 'be16_kawal';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		$carian[] = array('fix'=>'xlike','atau'=>'AND','medan'=>'respon','apa'=>'A1');
		# tentukan bilangan mukasurat & jumlah rekod
			$bilSemua = $this->tanya->kiraBaris//tatasusunanCari//cariSql
			($jadual, $medan2 = '*', $carian, NULL);
			# semak bilangan mukasurat & jumlah rekod
			//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
			$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'respon,kp,nama ASC') );
		# tanya dalam sql 	
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data
		
		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
				
		# pergi papar kandungan
		//$this->papar->baca('laporan/f3all', null, 1);
		$this->papar->baca('laporan/f10', null, 1);//*/
	}
#==========================================================================================
	# cetakTerimaProses
	public function cetakTerimaProses($namaPegawai, $cariBatch, $item = 30, $ms = 1, $baris = 30)
	{
		# kiraKes dulu
		$ms = 1;
		$tarikh = null;
		$jadual = 'be16_proses';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'feprosesan','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'nobatch','apa'=>$cariBatch);
		$bilSemua = $this->tanya->kiraBaris($jadual, $medan = '*', $carian, $susun = null);
		# tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum = pencamSqlLimit($bilSemua, $item, $ms);
		$susun[] = array_merge($jum, array('kumpul'=>'1,2 WITH ROLLUP','susun'=> NULL) );
		//$medan='concat_ws("/",`kp terkini`,tarikh) as terimaProsesan,';
		# kumpul respon
		//$mencari = "respon='11' AND tarikh <= '$tarikh' "; 
		$mencari = "respon='11' "; 
		//$medan = $this->tanya->laporanProsesan($jadual, $medan = "kelaskes,`kp terkini`,\r", $mencari, $susun);
		$medan = $this->tanya->laporanProsesan($jadual, $medan = "po,kp,", $mencari, $susun);
		$this->papar->hasil = $this->tanya->cariSemuaData//cariSql
			($jadual, $medan, $carian, $susun);
		//echo '<pre>$hasil:'; print_r($this->papar->hasil) . '</pre>'; # semak data

		# Set pemboleubah utama
        $this->papar->pegawai = senarai_kakitangan();
		$this->papar->kiraSemuaBaris = $bilSemua;
		$this->papar->item = $item;
		$this->papar->ms = $ms;
		$this->papar->baris = $baris;
		$this->papar->fe = $namaPegawai . '-' . $cariBatch;
		$this->papar->kp = 'BE';
		$this->papar->tarikh = ($tarikh==null) ? date("Y-m-d h:i:s") : $tarikh;
			
		# pergi papar kandungan
		$this->papar->baca('laporan/terimaProsesan', null, 1);//*/
	}
#==========================================================================================
}