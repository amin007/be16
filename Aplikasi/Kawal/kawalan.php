<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Kawalan extends \Aplikasi\Kitab\Kawal
{
#==================================================================================================================
	public function __construct() 
	{
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'kawalan';

		$this->papar->js = array(
		/*'bootstrap-transition.js','bootstrap-alert.js','bootstrap-modal.js','bootstrap-dropdown.js',
			'bootstrap-scrollspy.js','bootstrap-tab.js','bootstrap-tooltip.js','bootstrap-popover.js',
			'bootstrap-button.js','bootstrap-collapse.js','bootstrap-carousel.js','bootstrap-typeahead.js',
			'bootstrap-affix.js',*/
			'bootstrap-datepicker.js','bootstrap-datepicker.min.js',
			'bootstrap-datepicker.ms.js','bootstrap-editable.min.js');
		$this->papar->css = array(
			'bootstrap-datepicker.css',
			'bootstrap-editable.css');
	}

	public function index() { echo '<br>class Kawalan::index() extend Kawal<br>'; }
	public function rangkabaru($selesai) 
	{ 
		echo '<h1>Selesai Tambah Kes</h1>'; 
		echo '<br><a href="' . URL. 'rangkabaru/masukdata/3">Tambah Lagi</a>';
		echo '<br><a href="' . URL. 'ruangtamu">Menu Utama</a>';
	}
#==================================================================================================================
#---------------------------------------------------------------------------------------------------
	private function cariIndustri($jadualMSIC, $msic)
	{
		#326-46312  substr("abcdef", 0, -1);  // returns "abcde"
		$msic08 = substr($msic, 4);  // returns "46312"
		$cariM6[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>'msic','apa'=>$msic08);

		# mula cari $cariID dalam $jadual
		foreach ($jadualMSIC as $m6 => $msic)
		{# mula ulang table
			$jadualPendek = substr($msic, 16); //echo "\$msic=$msic|\$jadualPendek=$jadualPendek<br>";
			# senarai nama medan
			if($jadualPendek=='msic2008') /*bahagian B,kumpulan K,kelas Kls,*/
				$medanM6 = 'seksyen S,msic2000,msic,keterangan,notakaki';
			elseif($jadualPendek=='msic2008_asas') 
				$medanM6 = 'msic,survey kp,keterangan,keterangan_en';
			elseif($jadualPendek=='msic_v1') 
				$medanM6 = 'msic,survey kp,bil_pekerja staf,keterangan,notakaki';
			else $medanM6 = '*'; 
			//echo "cariMSIC($msic, $medanM6,<pre>"; print_r($cariM6) . "</pre>)<br>";

			$this->papar->_cariIndustri[$jadualPendek] = $this->tanya->//cariSql
				cariSemuaData($msic, $medanM6, $cariM6, null);
		}# tamat ulang table

	}
	#---------------------------------------------------------------------------------------------------
	public function ubah($cariID = null) 
	{//echo '<br>Anda berada di class Imej extends Kawal:ubah($cari)<br>';

		if (!empty($cariID)) 
		{	//echo '<pre>';
			# senaraikan tatasusunan jadual dan setkan pembolehubah
			$this->papar->_jadual = 'be16_kawal';
			$this->papar->carian = 'newss';
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'newss','apa'=>$cariID);

			# 1. mula semak dalam rangka 
			$this->papar->kawalan['kes'] = $this->tanya->//cariSql
				cariSemuaData
				($this->papar->_jadual, $this->tanya->medanKawalan($cariID), 
				$cari, $susun = null);

			if(isset($this->papar->kawalan['kes'][0]['newss'])):
				# 1.1 ambil nilai newss
				$newss = $this->papar->kawalan['kes'][0]['newss'];

				# 1.2 cari nilai msic & msic08 dalam jadual msic2008
				$jadualMSIC = dpt_senarai('msicbaru');
				$this->cariIndustri($jadualMSIC, $this->papar->kawalan['kes'][0]['msic2008']);
			endif;
		}
		else
		{
			$this->papar->carian = '[tiada id diisi]';
			$this->papar->_jadual = 'be16_kawal';
		}
        
		# isytihar pemboleubah
		$this->papar->pegawai = senarai_kakitangan();
		$this->papar->lokasi = 'BE16 - Ubah';
		$this->papar->cariID = (isset($this->papar->kawalan['kes'][0]['newss'])) ? $newss : $cariID;

		/*echo '<pre>'; # semak data
		echo '$this->papar->kawalan:<br>'; print_r($this->papar->kawalan); 
		echo '$this->papar->cariIndustri:<br>'; var_export($this->papar->_cariIndustri); 
		echo '<br>$this->papar->cari:'; print_r($this->papar->cari); 
		echo '</pre>'; //*/

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate
		//$this->papar->paparTemplate
			($this->_folder . '/ubah',$jenis,0); # $noInclude=0
		//*/
	}
#---------------------------------------------------------------------------------------------------
	public function ubahCari()
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		# bersihkan data $_POST
		$input = bersih($_GET['cari']);
		$dataID = str_pad($input, 12, "0", STR_PAD_LEFT);

		# Set pemboleubah utama
		$this->papar->pegawai = senarai_kakitangan();
		$this->papar->lokasi = Tajuk_Muka_Surat . ' - Ubah';

		# pergi papar kandungan
		//echo '<br>location: ' . URL . 'kawalan/ubah/' . $dataID . '';
		header('location: ' . URL . 'kawalan/ubah/' . $dataID);
	}

	public function ubahSimpan($dataID)
	{
		$posmen = array();
		$medanID = 'newss';
		$senaraiJadual = array('be16_kawal');

		foreach ($_POST as $myTable => $value)
			if ( in_array($myTable,$senaraiJadual) )
				foreach ($value as $kekunci => $papar)
				{
					$posmen[$myTable][$kekunci] = bersih($papar);
					$posmen[$myTable][$medanID] = $dataID;
				}

		# ubahsuai $posmen
		$posmen = $this->pecah5P($senaraiJadual[0], $posmen);
		$posmen = $this->tanya->semakPosmen($senaraiJadual[0], $posmen);
		//echo '<br>$dataID=' . $dataID . '<br>';
		//echo '<pre>$_POST='; print_r($_POST) . '</pre>';
		//echo '<pre>$posmen='; print_r($posmen) . '</pre>';

		# mula ulang $senaraiJadual
		foreach ($senaraiJadual as $kunci => $jadual)
		{# mula ulang table
			$this->tanya->//ubahSqlSimpan
			ubahSimpan
			($posmen[$jadual], $jadual, $medanID);
		}# tamat ulang table

		# pergi papar kandungan
		//echo 'location: ' . URL . 'kawalan/ubah/' . $dataID;
		header('location: ' . URL . 'kawalan/ubah/' . $dataID); //*/
	}

	function pecah5P($myTable, $posmen) 
	{
		$pecah5P = $posmen[$myTable]['pecah5P']; 

		if (!empty($pecah5P))
		{
			$pos = explode(" ", $pecah5P);
			  $posmen[$myTable]['hasil'] = str_replace( ',', '', bersih($pos[0]) );
			$posmen[$myTable]['belanja'] = str_replace( ',', '', bersih($pos[1]) );
			   $posmen[$myTable]['gaji'] = str_replace( ',', '', bersih($pos[2]) );
			   $posmen[$myTable]['aset'] = str_replace( ',', '', bersih($pos[3]) );
			   $posmen[$myTable]['staf'] = str_replace( ',', '', bersih($pos[4]) );
			   $posmen[$myTable]['stok'] = str_replace( ',', '', bersih($pos[5]) );
		}
		else
		{
			foreach ($posmen as $jadual => $value)
			foreach ($value as $kekunci => $papar)
				$posmen[$myTable][$kekunci]= 
					( in_array($kekunci,array('hasil','belanja','gaji','aset','staf','stok')) ) ?
					str_replace( ',', '', bersih($papar) )# buang koma	
					: bersih($papar);			
		}

		unset($posmen[$myTable]['pecah5P']);

		/*# debug
		echo '<pre>$hasil='; print_r($hasil); echo '</pre>';
		echo '<pre>$pos='; print_r($pos); echo '</pre>';
		echo '<pre>$posmen2='; print_r($posmen); echo '</pre>';//*/

		return $posmen; # pulangkan nilai
	}

	function buang($id) 
	{
		if (!empty($id)) 
		{
			#mula cari $cariID dalam $bulanan
			foreach ($bulanan as $key => $myTable)
			{# mula ulang table
				$this->papar->kesID[$myTable] = 
				$this->tanya->cariSemuaMedan($sv . $myTable, 
				$medanData, $cari);
			}# tamat ulang table
		}
		else
		{
			$this->papar->carian='[tiada id diisi]';
		}

		# pergi papar kandungan
		$this->papar->baca('kawalan/buang', 1);

	}
#==================================================================================================================
}