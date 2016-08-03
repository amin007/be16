<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Rangkabaru extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Crud extends Kawal';
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'kawalan';
	}

	function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=4);
		//$this->papar->baca(
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/index',$jenis,0); # $noInclude=0
	}
#==========================================================================================
	public function masukdatadarirangka($kira = 1, $medanID = 'newss', $cariID = null)
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$this->papar->_jadual = 'be16_kawal';
		
		if (!empty($cariID)) 
		{
			$medan = $this->tanya->cariRangkaBaru();
			$jadual = 'be16_rangkabaru';
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>$medanID,'apa'=>$cariID);
			# 1. mula semak dalam jadual
			$this->papar->senarai['data'] = $this->tanya->
				//tatasusunanUbah2($jadual, $medan, $cari, $susun = null);
				cariSemuaData($jadual, $medan, $cari, $susun = null);
				//cariSql($jadual, $medan, $cari, $susun = null);
					
			$this->papar->cariID = $medanID;
			//$this->papar->cariApa = $cariID;
			$this->papar->cariApa = $this->tanya->binaMedan2($this->papar->_jadual, $kira, 
				$this->papar->senarai);
		}
		else
		{
			$this->papar->senarai = $this->papar->binaMedan = null;
			$this->papar->cariApa = $this->tanya->binaMedan($this->papar->_jadual, $kira, $data = null);
		}
		
		/*echo '<pre>'; # semak data
		echo '$this->papar->senarai:<br>'; print_r($this->papar->senarai); 
		//echo '<br>$this->papar->binaMedan:'; print_r($this->papar->binaMedan); 
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		//echo '<br>$this->papar->_jadual:'; print_r($this->papar->_jadual); 
		echo '</pre>'; //*/

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(//$this->papar->paparTemplate(
			$this->_folder . '/baru',$jenis,0); # $noInclude=0
		//*/
	}

	public function masukdata($kira = 1, $medanID = 'newss', $cariID = null)
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$this->papar->_jadual = 'be16_kawal';
		$this->papar->senarai = $this->papar->binaMedan = null;
		$this->papar->cariApa = $this->tanya->binaMedan($this->papar->_jadual, $kira, $data = null);

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(//$this->papar->paparTemplate(
			$this->_folder . '/baru',$jenis,0); # $noInclude=0
		//*/
	}
	
	public function tambahSimpan()
	{
		# Set pemboleubah utama
		$myTable = 'be16_kawal';
		$senarai = array('be16_kawal');
		$medan = '`newss`,`nossm`,`CHECK_DIGIT`,`nama`,`operator`,`alamat1`,`alamat2`,`bandar`,`poskod`,'
			   . '`kp`,`msic2008`,`fe`,`orang_a`,`notel_a`,`nofax_a`,`esurat_a`'
			   . '';

		# bentuk tatasusunan
		$posmen = $this->tanya->semakPOST($myTable, $senarai, $_POST);
		$senaraiData = $this->tanya->ubahPosmen($posmen);

		# sql insert
		//$this->tanya->tambahSqlBanyakNilai($myTable, $medan, $senaraiData); 
		$this->tanya->tambahBanyakNilai($myTable, $medan, $senaraiData); 
		$this->log_sql($myTable, $medan, $senaraiData);
		
		# semak data
			//echo '<pre>$_POST='; print_r($_POST) . '</pre>';
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
			//echo '<pre>$senaraiData='; print_r($senaraiData) . '</pre>';

        # pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . '/rangkabaru/selesai';
		header('location: ' . URL . $this->_folder . '/rangkabaru/selesai');
		
	}
	
	private function log_sql($myTable, $medan, $senaraiData)
	{
		# semak session
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		$sesi = \Aplikasi\Kitab\Sesi::init();
		//echo '<pre>$_SESSION->', print_r($_SESSION, 1) . '</pre>';

			# log sql
			$jadual2 = 'log_sql'; 
			$pengguna = \Aplikasi\Kitab\Sesi::get('namaPegawai');
			$log['newss'] = 'baru';
			$log['pengguna'] = $pengguna;
			$log['sql'] = $this->tanya->tambahArahanSqlBanyakNilai($myTable, $medan, $senaraiData);
			$log['arahan'] = 'tambah data baru oleh oleh ' . $pengguna;
			$log['tarikhmasa'] = date("Y-m-d H:i:s");
			$this->tanya->tambahData
				//tambahSql
				($jadual2, $log);		

	}
#==========================================================================================	
	function tambah()
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca(
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/tambah',$jenis,0); # $noInclude=0
	}

	function tambahSimpan2()
	{
		# Set pemboleubah utama
		$posmen = array();
		$senarai = array('');

		# validasi data $_POST, masuk dalam $posmen, validasi awal
		foreach ($_POST as $myTable => $value)
		   if ( in_array($myTable,$senarai) )
			   foreach ($value as $kekunci => $papar)
					$posmen[$myTable][$kekunci] = bersih($papar);
		
		# ubahsuai $posmen, valiadi terperinci
		$posmen = $this->tanya->semakData($posmen, $jadual);			
			# semak data
			//echo '<pre>$_POST='; print_r($_POST) . '</pre>';
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
 
		# mula ulang $senarai
		foreach ($senarai as $kunci => $jadual)
		{# tanya sql sama ada papar atau simpan
			$this->tanya->//tambahSqlSimpan//
			tambahSimpanBanyak
			($posmen[$jadual], $jadual);
		}# tamat ulang $senarai
        
        # pergi papar kandungan
		//$this->papar->baca($this->_folder . '/ubah/' . $dataID);
		//header('location: ' . URL . $this->_folder . '/ubah/' . $dataID);
 
	}
	
	public function paparlimit($cariID = null, $cariApa = null) 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$item = 1000; $ms = 1;
		# kod asas panggil sql
			$medan = '*'; # papar semua medan
			$jadual = '{jadual}';
			$cari[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			$jum2 = pencamSqlLimit(300, $item, $ms); #
			$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>null) );
			# tanya Sql
			$this->papar->senaraiApa = $this->tanya->tatasusunanUbah2A
				//cariSemuaData //cariSql
				($jadual, $medan, $cari, $susun = null);

		/*# semak data
		echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->senaraiApa:<br>'; print_r($this->papar->senaraiApa);
 		echo '</pre>'; //*/
		
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/papar');
}

	public function ubah($cariID = null, $medanID = null, $jadualUbah = null) 
	{//echo '<br>Anda berada di class Crud:ubah($cariID) extends \Aplikasi\Kitab\Kawal<br>';
                
		# senaraikan tatasusunan jadual dan setkan pembolehubah
		$this->papar->lokasi = 'Enjin - Ubah';
		$this->papar->_jadual = $jadualUbah;
		$medanUbah = $this->tanya->medanUbah2($cariID);
		//$medanID = ''; $jadualUbah = ''; # 
	
		if (!empty($cariID)) 
		{
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>$medanID,'apa'=>$cariID);
			# 1. mula semak dalam jadual
			$this->papar->senarai['data'] = $this->tanya->
				tatasusunanUbah2($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSql($jadualUbah, $medanUbah, $cari, $susun = null);

			if(isset($this->papar->senarai['data'][0][$medanID])):
				$this->papar->jumpa = $this->papar->senarai['data'][0][$medanID];
				# cari data lain jika jumpa
				$this->papar->_paparSahaja = $this->tanya->
					tatasusunanUbah2A($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSql($jadualUbah, $medanUbah, $cari, $susun = null);
			else:
				$this->papar->jumpa = '[tiada jumpa apa2]';
			endif;
					
			$this->papar->cariID  = $medanID;
			$this->papar->cariApa = $cariID;
		}
		else
		{
			$this->papar->senarai['data'] = array();
			$this->papar->cariID  = '[mahu cari apa]';
			$this->papar->cariApa = '[tiada id diisi]';
			$this->papar->jumpa   = '[hendak cari apa kalau id tiada]';
		}
		
		/*# semak data
		echo '<pre>';
		echo '$this->papar->senarai:<br>'; print_r($this->papar->senarai); 
		echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '<br>$this->papar->jumpa:'; print_r($this->papar->jumpa); 
		echo '<br>$this->papar->_jadual:'; print_r($this->papar->_jadual); 
		echo '</pre>'; //*/
		
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/ubah', 0);
		
	}
    
	public function ubahCari()
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		# bersihkan data $_POST
		$input = bersih($_GET['cari']);
		$dataID = str_pad($input, 12, "0", STR_PAD_LEFT);
		
		# Set pemboleubah utama
        $this->papar->lokasi = 'Enjin - Ubah';
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . '/ubah/' . $dataID . '';
		header('location: ' . URL . $this->_folder . '/ubah/' . $dataID);

	}

	public function ubahSimpan($dataID)
	{
		# Set pemboleubah utama
		$posmen = array();
		$nilaiRM = array('hasil','belanja','gaji','aset','staf','stok');
		$medanID = '';
		$senarai = array('');
    
    	# masuk dalam $posmen, validasi awal
		foreach ($_POST as $myTable => $value)
		{   if ( in_array($myTable,$senarai) )
			{   foreach ($value as $kekunci => $papar)
				{	$posmen[$myTable][$kekunci]= 
					( in_array($kekunci,$nilaiRM) ) ? # $nilaiRM rujuk line 154
						str_replace( ',', '', bersih($papar) ) # buang koma	
						: bersih($papar);
				}	$posmen[$myTable][$medanID] = $dataID;
			}
		}
        
		# ubahsuai $posmen, valiadi terperinci
			$posmen = $this->tanya->semakData($posmen, $jadual);			
			# semak data
			echo '<pre>$_POST='; print_r($_POST) . '</pre>';
			echo '<pre>$posmen='; print_r($posmen) . '</pre>';
 
		# mula ulang $senarai
		foreach ($senarai as $kunci => $jadual)
		{# tanya sql sama ada papar atau simpan
			$this->tanya->ubahSqlSimpan//ubahSimpan
			($posmen[$jadual], $jadual, $medanID);
		}# tamat ulang $senarai
        
        # pergi papar kandungan
		//$this->papar->baca($this->_folder . '/ubah/' . $dataID);
		//header('location: ' . URL . $this->_folder . '/ubah/' . $dataID);
	}
	
	function buang($id) 
	{
		# Set pemboleubah utama	
		if (!empty($id))
			# $carian, $susun
			$this->tanya->cariSemuaData($myTable, $medan, $carian, $susun);
		else
			$this->papar->carian='[tiada id diisi]';

		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/buang', 1);

	}
#==========================================================================================	
	public function semakfail()
	{	
		//echo 'class gerakhas::semakfail()<br>';
		# Set pemboleubah utama
		$url = URL . 'sumber/fail/csv/';
		$fail = 'odebe2016.csv'; //echo $url . $fail . '<hr>';
		$myTable = 'nama_pegawai';
		list($medan,$senaraiData) = $this->tanya->panggilFail($url, $fail);
		# sql insert
		$this->tanya->tambahSqlBanyakNilai($myTable, $medan, $senaraiData); 
		//$this->tanya->tambahBanyakNilai($myTable, $medan, $senaraiData); 

		# pergi papar kandungan
		echo '<br>location: ' . URL . $this->_folder . '/rangkabaru/selesai';
		//header('location: ' . URL . $this->_folder . '/rangkabaru/selesai');
		//*/
	}
#==========================================================================================
}