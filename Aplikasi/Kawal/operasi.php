<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Operasi extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Crud extends Kawal';
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		//\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'operasi';
		$this->medanData = '*';
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
		//*/
	}
#==========================================================================================	
	private function wujudBatchAwal($senaraiJadual, $cariBatch = null, $cariID = null) 
	{
		if (!isset($cariBatch) || empty($cariBatch) ):
			$paparError = 'Tiada batch<br>';
		elseif((!isset($cariID) || empty($cariID) )):
				$paparError = 'Tiada id<br>';
		else: #------------------------------------------------------------------------------
				$medan = 'newss,nossm,nama,operator,'
					. 'concat_ws(" ",alamat1,alamat2,poskod,bandar) as alamat';
				$carian[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'newss','apa'=>$cariID);
				$dataKes = $this->tanya->//tatasusunanCariID(//cariSql( 
					cariSemuaData(
					$senaraiJadual[0], $medan, $carian, $susun = null);
				//echo '<pre>', print_r($dataKes, 1) . '</pre><br>';
				$paparError = (!isset($dataKes[0]['newss'])) ? 
					'Tiada id dalam rangka. <br>Mana kau orang jumpa kes ini daa.' 
					. '<br>Jumpa amin jika mahu masuk rangka ya'
					: # jika jumpa
					'Ada id:' . $dataKes[0]['newss'] 
					. '| ssm:' . $dataKes[0]['nossm']
					. '<br> nama:' . $dataKes[0]['nama'] 
					. '| operator:' . $dataKes[0]['operator']
					. '<br> alamat:' . $dataKes[0]['alamat']; //*/
			#------------------------------------------------------------------------------
		endif;
	
		return $paparError;
	}

	public function batch($namaPegawai = null, $cariBatch = null, $cariID = null) 
	{
		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->noBatch = $cariBatch;
		# mencari dalam database
		if ($cariID == null):
			$this->papar->error = 'Kosong';
			$senaraiJadual = array('be16_kawal'); # set senarai jadual yang terlibat
			# mula carian dalam jadual $myTable
			$this->cariAwal($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $this->medanData);
			$this->cariGroup($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $this->medanData);			
		else:
			$senaraiJadual = array('be16_kawal'); # set senarai jadual yang terlibat
			# cari $cariBatch atau cariID wujud tak
			$this->papar->error = $this->wujudBatchAwal($senaraiJadual, $cariBatch, $cariID);
			# mula carian dalam jadual $myTable
			$this->cariAwal($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $this->medanData);
			$this->cariGroup($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $this->medanData);			
		endif;

		# semak pembolehubah $this->papar->cariApa
		//echo '<pre>', print_r($this->papar->cariApa, 1) . '</pre><br>';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/batch',$jenis,0); # $noInclude=0		
		//*/
	}

	private function cariAwal($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $medan)
	{
		$item = 100; $ms = 1; ## set pembolehubah utama
		## tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum2 = pencamSqlLimit(100, $item, $ms);
		$jadual = $senaraiJadual[0];
			# sql 1
			$cari1[] = ($namaPegawai==null) ? 
				array('fix'=>'x=','atau'=>'WHERE','medan'=>'pegawai','apa'=>'')
				: array('fix'=>'x=','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
			$jum = pencamSqlLimit($item, $item, $ms);
			$cantumSusun[] = array_merge($jum, array('kumpul'=>null,'susun'=>'newss') );
			foreach ($senaraiJadual as $key => $myTable)
			{# mula ulang table
				# sql guna limit //$this->papar->cariApa = array();
					$this->papar->cariApa['semua'] = $this->tanya->//tatasusunanCari(//cariSql( 
						cariSemuaData(
						$myTable, $medan, $cari1, $cantumSusun);
			}# tamat ulang table
			# sql 2
			$cari2[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'borang','apa'=>$cariBatch);			
			$cari2[] = array('fix'=>'x=','atau'=>'AND','medan'=>'pegawai','apa'=>$namaPegawai);
			$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'nama') );
			$this->papar->cariApa['senarai'] = $this->tanya->//tatasusunanCari(//cariSql( 
				cariSemuaData(
				$jadual, $medan, $cari2, $susun);
			/*# contoh sql
			$cariMFG[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'fe','apa'=>$cariBatch);
			$cariMFG[] = array('fix'=>'zin','atau'=>'AND','medan'=>'kp','apa'=>'("205","800")');
					$susunMfg[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'respon,nama') );
			$this->papar->cariApa['mfg'] = $this->tanya->
				tatasusunanCariMFG(//cariSql( cariSemuaData(
				$jadual, $medan, $cariMFG, $susunMfg);//*/
	}

	private function cariGroup($senaraiJadual, $namaPegawai, $cariBatch, $cariID, $medan)
	{
		$item = 1000; $ms = 1; ## set pembolehubah utama
		## tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum2 = pencamSqlLimit(300, $item, $ms);
		$jadual = $senaraiJadual[0];
			# sql 1 
			$medan1 = 'borang,pegawai,count(*) as kira,concat_ws("/",pegawai,borang) as pegawaiborang';
			$susun1[] = array_merge($jum2, array('kumpul'=>'borang,pegawai','susun'=>'nama') );
			$this->papar->cariApa['groupBorangFe'] = $this->tanya->
				//tatasusunanCariMFG(//	cariSql( 
				cariSemuaData(
				$jadual, $medan1 , $cari = null, $susun1);
			/*# sql 2
			$susun2[] = array_merge($jum2, array('kumpul'=>'fe','susun'=>'nama') );
			$this->papar->cariApa['groupFe'] = $this->tanya->
				//tatasusunanCariMFG(//	cariSql( 
				cariSemuaData(
				$jadual, $medan = 'fe,count(*) as kira', $cari2, $susun2);
			# sql 3
			$susun3[] = array_merge($jum2, array('kumpul'=>'borang','susun'=>'nama') );
			$this->papar->cariApa['groupBorang'] = $this->tanya->
				//tatasusunanCariMFG(//	cariSql( 
				cariSemuaData(
				$jadual, $medan = 'borang,count(*) as kira', $cari3, $susun3); //*/
	}
	
	public function tambahNamaStaf()
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>'; # debug $_GET
		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai = bersihGET_nama('cari'); # bersihkan data $_GET
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/batch/$namaPegawai" . '';
		header('location: ' . URL . $this->_folder . "/batch/$namaPegawai");
	}

	public function tambahBatchBaru($namaPegawai = null)
	{
		echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>'; # debug $_GET
		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->noBatch = $noBatch = bersihGET('cari'); # bersihkan data $_GET
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/batch/$namaPegawai/$noBatch" . '';
		header('location: ' . URL . $this->_folder . "/batch/$namaPegawai/$noBatch");
	}

	public function tukarBatchProses($namaPegawai,$asalBatch)
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		//echo "\$namaPegawai = $namaPegawai<br>";
		//echo "\$asalBatch = $asalBatch<br>";
		$tukarBatch = bersihGET('cari'); # bersihkan data $_POST
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_kawal'; 
			$medanID = 'nobatch';
			//$posmen[$jadual]['nama_pegawai'] = $namaPegawai;
			$posmen[$jadual][$medanID] = $tukarBatch;
			$dimana[$jadual][$medanID] = $asalBatch;
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
        
			//$this->tanya->ubahSimpanSemua(
			$this->tanya->ubahSqlSimpanSemua(
				$posmen[$jadual], $jadual, $medanID, $dimana[$jadual]);

		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->noBatch = $tukarBatch; 
		
		# pergi papar kandungan
		echo '<br>location: ' . URL . $this->_folder . "/batch/$namaPegawai/$tukarBatch" . '';
		//header('location: ' . URL . $this->_folder . "/batch/$namaPegawai/$tukarBatch");
	}

	public function ubahBatchProses($namaPegawai,$asalBatch)
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		//echo "\$namaPegawai = $namaPegawai<br>";
		//echo "\$asalBatch = $asalBatch<br>";
		$dataID = bersihGET('cari'); # bersihkan data $_POST
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_kawal'; 
			$medanID = 'newss';
			$posmen[$jadual]['pegawai'] = $namaPegawai;
			$posmen[$jadual]['borang'] = $asalBatch;
			$posmen[$jadual][$medanID] = $dataID;
			//$dimana[$jadual][$medanID] = $asalBatch;
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
        
			$this->tanya->ubahSimpan(
			//$this->tanya->ubahSqlSimpan(
				$posmen[$jadual], $jadual, $medanID);

		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->noBatch = $asalBatch; 
		$this->papar->noID = $dataID; 
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/batch/$namaPegawai/$asalBatch/$dataID" . '';
		header('location: ' . URL . $this->_folder . "/batch/$namaPegawai/$asalBatch/$dataID");
	}

	public function buangID($namaPegawai,$cariBatch,$dataID)
	{
		# semak session
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		$sesi = \Aplikasi\Kitab\Sesi::init();
		//echo '<pre>$_SESSION->', print_r($_SESSION, 1) . '</pre>';
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_kawal'; 
			$medanID = 'newss';
			$posmen[$jadual]['pegawai'] = null;
			$posmen[$jadual]['borang'] = null;
			$posmen[$jadual][$medanID] = $dataID;
			//$dimana[$jadual][$medanID] = $asalBatch;
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
        
			$this->tanya->ubahSimpan
			//$this->tanya->ubahSqlSimpan
				($posmen[$jadual], $jadual, $medanID);

			# log sql
			$jadual2 = 'log_sql'; 
			$pengguna = \Aplikasi\Kitab\Sesi::get('namaPegawai');
			$log[$medanID] = $dataID;
			$log['pengguna'] = $pengguna;
			$log['sql'] = $this->tanya->ubahArahanSqlSimpan($posmen[$jadual], $jadual, $medanID);
			$log['arahan'] = 'buang medan pegawai(' . $namaPegawai 
				. ') dan borang(' . $cariBatch . ') oleh ' . $pengguna;
			$log['tarikhmasa'] = date("Y-m-d H:i:s");
			$this->tanya->tambahData
				//tambahSql
				($jadual2, $log);		
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/batch/$namaPegawai/$cariBatch/?id=$dataID&mesej=data sudah dikosongkan" . '';
		header('location: ' . URL . $this->_folder . "/batch/$namaPegawai/$cariBatch/?id=$dataID&mesej=data sudah dikosongkan" . '');
	}
	
	public function paparxlimit($cariID = null, $cariApa = null) 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$item = 1000; $ms = 1;
		# kod asas panggil sql
			$medan = '*'; # papar semua medan
			$carian[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			#foreach ($senaraiJadual as $key => $myTable)
			#{# mula ulang table
				/*# dapatkan bilangan jumlah rekod
				$bilSemua = $this->tanya->tatasusunanP
					//cariSemuaData //cariSql //kiraKes
					($myTable, $medan, $carian);
				# tentukan bilangan mukasurat. bilangan jumlah rekod
				//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
				$jum = pencamSqlLimit($bilSemua, $item, $ms);
				$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>null) );
				$this->papar->bilSemua[$myTable] = $bilSemua;//*/
				# sql guna limit //$this->papar->senaraiApa = array();
				$this->papar->senaraiApa['data'] = $this->tanya->tatasusunanUbah2A
					//cariSemuaData //cariSql
					($myTable, $medan, $carian, $susun);
				# halaman
				$this->papar->halaman[$myTable] = halaman($jum);
			#}# tamat ulang table

		# semak data
		echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->senaraiApa:<br>'; print_r($this->papar->senaraiApa);
 		echo '</pre>'; //*/
		
		# pergi papar kandungan
		$jenis = $this->pilihTemplate($template);
		//$this->papar->baca($this->_folder . '/papar');
		//$this->papar->bacaTemplate($this->_folder . '/index',
		$this->papar->paparTemplate($this->_folder . '/index',
			$jenis,0); # $noInclude=0
		//*/
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
		//*/
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
		$posmen = $this->tanya->semakPost($senarai, $nilaiRM, $medanID, $dataID);
		# ubahsuai $posmen, valiadi terperinci
			$this->tanya->semakPosmen($posmen, $jadual = ''); # setkan nama jadual 
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
		//*/
    }

	function buang($id) 
	{
		# Set pemboleubah utama	
        if (!empty($id)) 
        {
			# $carian, $susun
			$this->tanya->cariSemuaData($myTable, $medan, $carian, $susun);
		}
		else
		{
			$this->papar->carian='[tiada id diisi]';
		}

		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/buang', 1);

    }
	
	public function salinjadual($myTableNew, $myTableOld)
	{
		# setkan nama medan
		$medan = '*';
		$this->tanya->salinJadual($myTableNew, $medan, $myTableOld);
	}
#==========================================================================================		
	private function wujudHantar($senaraiJadual, $cariTarikh = null, $cariID = null) 
	{
		if (!isset($cariTarikh) || empty($cariTarikh) ):
			$paparError = 'Tiada tarikh<br>';
		elseif((!isset($cariID) || empty($cariID) )):
				$paparError = 'Tiada id<br>';
		else: #------------------------------------------------------------------------------
				$medan = 'newss,nossm,nama,operator,'
					. 'concat_ws(" ",alamat1,alamat2,poskod,bandar) as alamat';
				$carian[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'newss','apa'=>$cariID);
				$dataKes = $this->tanya->//tatasusunanCariID(//cariSql( 
					cariSemuaData(
					$senaraiJadual[0], $medan, $carian, $susun = null);
				//echo '<pre>', print_r($dataKes, 1) . '</pre><br>';
				$paparError = (!isset($dataKes[0]['newss'])) ? 
					'Tiada id dalam rangka. <br>Mana kau orang jumpa kes ini daa.' 
					. '<br>Jumpa amin jika mahu masuk rangka ya'
					: # jika jumpa
					'Ada id:' . $dataKes[0]['newss'] 
					. '| ssm:' . $dataKes[0]['nossm']
					. '<br> nama:' . $dataKes[0]['nama'] 
					. '| operator:' . $dataKes[0]['operator']
					. '<br> alamat:' . $dataKes[0]['alamat']; //*/
			#------------------------------------------------------------------------------
		endif;
	
		return $paparError;
	}
	
	public function hantar($namaPegawai = null, $cariTarikh = null, $cariID = null) 
	{
		# Set pemboleubah utama
		$this->papar->namaPegawai  = $namaPegawai;
		$this->papar->tarikhHantar = $cariTarikh;
		# mencari dalam database
		if ($cariID == null):
			$this->papar->error = 'Kosong';
			$senaraiJadual = array('be16_kawal'); # set senarai jadual yang terlibat
			# mula carian dalam jadual $myTable
			$this->cariHantar($senaraiJadual, $namaPegawai, $cariTarikh, $cariID, $this->medanData);
		else:
			$senaraiJadual = array('be16_kawal'); # set senarai jadual yang terlibat
			# cari $cariBatch atau cariID wujud tak
			$this->papar->error = $this->wujudHantar($senaraiJadual, $cariTarikh, $cariID);
			# mula carian dalam jadual $myTable
			$this->cariHantar($senaraiJadual, $namaPegawai, $cariTarikh, $cariID, $this->medanData);
		endif;

		# semak pembolehubah $this->papar->cariApa
		//echo '<pre>', print_r($this->papar->cariApa, 1) . '</pre><br>';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/hantar',$jenis,0); # $noInclude=0		
		//*/
	}

	private function cariHantar($senaraiJadual, $namaPegawai, $cariTarikh, $cariID, $medan)
	{
		$item = 50; $ms = 1; ## set pembolehubah utama
		## tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum2 = pencamSqlLimit(50, $item, $ms);
		$jadual = $senaraiJadual[0];
			# sql 1
			$cari1[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'hantar','apa'=>$cariTarikh);			
			$cari1[] = array('fix'=>'x=','atau'=>'AND','medan'=>'fe','apa'=>$namaPegawai);
			$susun1[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'nama') );
			$this->papar->cariApa['senarai'] = $this->tanya->//tatasusunanCari(//cariSql( 
				cariSemuaData(
				$jadual, $medan, $cari1, $susun1);
			/*# contoh sql
			$cariMFG[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'fe','apa'=>$cariBatch);
			$cariMFG[] = array('fix'=>'zin','atau'=>'AND','medan'=>'kp','apa'=>'("205","800")');
					$susunMfg[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'respon,nama') );
			$this->papar->cariApa['mfg'] = $this->tanya->
				tatasusunanCariMFG(//cariSql( cariSemuaData(
				$jadual, $medan, $cariMFG, $susunMfg);//*/
	}

	public function hantarNamaStaf()
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>'; # debug $_GET
		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai = bersihGET_nama('cari'); # bersihkan data $_GET
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/hantar/$namaPegawai" . '';
		header('location: ' . URL . $this->_folder . "/hantar/$namaPegawai");
	}

	public function hantarBatchBaru($namaPegawai = null)
	{
		echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>'; # debug $_GET
		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->tarikhHantar = $tarikhHantar = bersihGET('cari'); # bersihkan data $_GET
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar" . '';
		header('location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar");
	}

	public function tukarHantarProses($namaPegawai,$asalBatch)
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		//echo "\$namaPegawai = $namaPegawai<br>";
		//echo "\$asalBatch = $asalBatch<br>";
		$tarikhHantar = bersihGET('cari'); # bersihkan data $_POST
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_kawal'; 
			$medanID = 'hantar';
			//$posmen[$jadual]['nama_pegawai'] = $namaPegawai;
			$posmen[$jadual][$medanID] = $tarikhHantar;
			$dimana[$jadual][$medanID] = $asalBatch;
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
        
			//$this->tanya->ubahSimpanSemua(
			$this->tanya->ubahSqlSimpanSemua(
				$posmen[$jadual], $jadual, $medanID, $dimana[$jadual]);

		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->tarikhHantar = $tarikhHantar; 
		
		# pergi papar kandungan
		echo '<br>location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar" . '';
		//header('location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar");
	}

	public function ubahHantarProses($namaPegawai,$tarikhHantar)
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		//echo "\$namaPegawai = $namaPegawai<br>";
		//echo "\$tarikhHantar = $tarikhHantar<br>";
		$dataID = bersihGET('cari'); # bersihkan data $_POST
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_kawal'; 
			$medanID = 'newss';
			//$posmen[$jadual]['pegawai'] = $namaPegawai;
			$posmen[$jadual]['hantar'] = $tarikhHantar;
			$posmen[$jadual][$medanID] = $dataID;
			//$dimana[$jadual][$medanID] = $asalBatch;
			//echo '<pre>$posmen='; print_r($posmen) . '</pre>';
        
			$this->tanya->ubahSimpan(
			//$this->tanya->ubahSqlSimpan(
				$posmen[$jadual], $jadual, $medanID);

		# Set pemboleubah utama
		$this->papar->namaPegawai = $namaPegawai;
		$this->papar->tarikhHantar = $tarikhHantar; 
		$this->papar->noID = $dataID; 
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar/$dataID" . '';
		header('location: ' . URL . $this->_folder . "/hantar/$namaPegawai/$tarikhHantar/$dataID");
	}
	
#==========================================================================================	
}