<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Prosesan extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Crud extends Kawal';
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		//\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'prosesan';
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
					. 'concat_ws(" ",alamat,poskod,bandar) as alamat';
					//. 'concat_ws(" ",alamat1,alamat2,poskod,bandar) as alamat';
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
		else:
			$senaraiJadual = array('be16_proses'); # set senarai jadual yang terlibat
			# cari $cariBatch atau cariID wujud tak
			$this->papar->error = $this->wujudBatchAwal($senaraiJadual, $cariBatch, $cariID);
			//$this->papar->error = 'No ID = ' . $noID;
			# mula carian dalam jadual $myTable
			$this->cariAwal($senaraiJadual, $cariBatch, $cariID, $this->medanData);
			//$this->cariGroup($senaraiJadual, $cariBatch, $cariID, $this->medanData);
		endif;

		# semak pembolehubah $this->papar->cariApa
		//echo '<pre>', print_r($this->papar->cariApa, 1) . '</pre><br>';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca(
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/batch',$jenis,0); # $noInclude=0		
		//*/
	}

	private function cariAwal($senaraiJadual, $cariBatch, $cariID, $medan)
	{
		$item = 1000; $ms = 1; ## set pembolehubah utama
		## tentukan bilangan mukasurat. bilangan jumlah rekod
		//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
		$jum2 = pencamSqlLimit(300, $item, $ms);
		$jadual = $senaraiJadual[0];
			# sql 1			
			$cari1[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'borang','apa'=>$cariBatch);			
			$cari1[] = array('fix'=>'x=','atau'=>'AND','medan'=>'pegawai','apa'=>$namaPegawai);
			$susun1[] = array_merge($jum2, array('kumpul'=>null,'susun'=>'nama') );
			$this->papar->cariApa['senarai'] = $this->tanya->//tatasusunanCari(//cariSql( 
				cariSemuaData(
				$jadual, $medan, $cari1, $susun1);

	}
	
	public function tambahBatchBaru($namaPegawai = null)
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>'; # debug $_GET
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
		echo "\$namaPegawai = $namaPegawai<br>";
		echo "\$asalBatch = $asalBatch<br>";
		$tukarBatch = bersihGET('cari'); # bersihkan data $_POST
		
		# masuk dalam database
			# ubahsuai $posmen
			$jadual = 'be16_proses'; 
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
			$jadual = 'be16_proses'; 
			$medanID = 'newss';
			$posmen[$jadual]['feprosesan'] = $namaPegawai;
			$posmen[$jadual]['nobatch'] = $asalBatch;
			$posmen[$jadual]['respon'] = '11';
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
		$medanUbah = $this->tanya->medanUbah($cariID);
		$medanID = 'newss'; $jadualUbah = 'be16_proses'; # 
	
		if (!empty($cariID)) 
		{
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>$medanID,'apa'=>$cariID);
			# 1. mula semak dalam jadual
			$this->papar->senarai['data'] = $this->tanya->
				//tatasusunanUbah2($jadualUbah, $medanUbah, $cari, $susun = null);
				cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
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

		# semak data
		echo '<pre>';
		echo '$this->papar->senarai:<br>'; print_r($this->papar->senarai); 
		echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '<br>$this->papar->jumpa:'; print_r($this->papar->jumpa); 
		echo '<br>$this->papar->_jadual:'; print_r($this->papar->_jadual); 
		echo '</pre>'; //*/
		
        # pergi papar kandungan
		/*$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/ubah_prosesan', $jenis, 0); # $noInclude=0
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
			$jadual = ''; # setkan nama jadual 
			# valid guna gelung foreach
			foreach ($nilaiRM as $keyRM) # $nilaiRM rujuk line 154
			{# kod php untuk formula matematik
				if(isset($posmen[$jadual][$keyRM])):
					eval( '$data = (' . $posmen[$jadual][$keyRM] . ');' );
					$posmen[$jadual][$keyRM] = $data;
				endif;
			}/*$nilaiTEKS = array('no','batu','jalan','tmn_kg');
			foreach ($nilaiTEKS as $keyTEKS)
			{# kod php untuk besarkan semua huruf aka uppercase
				if(isset($posmen[$jadual][$keyTEKS])):
					$posmen[$jadual][$keyTEKS] = strtoupper($posmen[$jadual][$keyTEKS]);
				endif;
			}//*/ # valid guna if
			if (isset($posmen[$jadual]['email']))
				$posmen[$jadual]['email']=strtolower($posmen[$jadual]['email']);
			//if (isset($posmen[$jadual]['dp_baru']))
			//	$posmen[$jadual]['dp_baru']=ucwords(strtolower($posmen[$jadual]['dp_baru']));
			if (isset($posmen[$jadual]['responden']))
				$posmen[$jadual]['responden']=mb_convert_case($posmen[$jadual]['responden'], MB_CASE_TITLE);
			if (isset($posmen[$jadual]['password']))
			{
				//$pilih = null;
				$pilih = 'md5'; # Hash::rahsia('md5', $posmen[$jadual]['password'])
				//$pilih = 'sha256'; # Hash::create('sha256', $posmen[$jadual]['password'], HASH_PASSWORD_KEY)
				if (empty($posmen[$jadual]['password']))
					unset($posmen[$jadual]['password']);
				elseif ($pilih == 'md5')
					$posmen[$jadual]['password'] = 
						\Aplikasi\Kitab\Hash::rahsia('md5', $posmen[$jadual]['password']);
				elseif ($pilih == 'sha256')
					$posmen[$jadual]['password'] = 
						\Aplikasi\Kitab\Hash::create('sha256', $posmen[$jadual]['password'], HASH_PASSWORD_KEY);
			}
			
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
#==========================================================================================	
}