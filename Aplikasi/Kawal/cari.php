<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Cari extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	public function __construct() 
	{
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();

		$this->_tajukAtas = 'BE16:';
		$this->_folder = 'cari';
	}

	public function index() 
	{	
		# Set pemboleubah utama
		$this->papar->medan = array(1,2,3);
		$this->papar->pegawai = senarai_kakitangan();

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca
		$this->papar->bacaTemplate
		//$this->papar->paparTemplate
			($this->_folder . '/index', $jenis, 0); # $noInclude=0
	}
#==========================================================================================
	public function idnama()
	{
		//echo '<br>Anda berada di class Cari extends Kawal:idnama()<br>';
		//echo '<pre>$_POST=>'; print_r($_POST) . '</pre>';
		/*  $_POST[] => Array ( [cari] => 0000000123456 or [nama] => ABC ) */

		# senaraikan tatasusunan jadual
		$myJadual = array('be16_kawal','be16_rangkabaru','be16_proses');
		$medan = $this->tanya->idNama(); # panggil medan2 tertentu
		$this->papar->cariNama = array();

		# cari id berasaskan newss/ssm/sidap/nama
		$id['nama'] = bersih(isset($_POST['cari']) ? $_POST['cari'] : null);

		if (!empty($id['nama'])) 
		{
			//$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'fe','apa'=>$namaPegawai);
			$carian[] = array('fix'=>'z%like%', # cari x= atau %like%
				'atau'=>'WHERE', # WHERE / OR / AND
				'medan' => 'concat_ws("",newss,nossm,nama)', # cari dalam medan apa
				'apa' => $id['nama']); # benda yang dicari

			# mula cari $cariID dalam $myJadual
			foreach ($myJadual as $key => $myTable)
			{# mula ulang table
				$this->papar->cariNama[$myTable] = 
					$this->tanya->cariSemuaData($myTable, $medan, $carian, null);
					//$this->tanya->cariSql($myTable, $medan, $carian, null);
			}# tamat ulang table

			# isytihar pembolehubah untuk dalam class Papar
			$this->papar->primaryKey = 'newss';	
			$this->papar->carian[] = $id['nama'];

        }
		//elseif (!empty($id['nama'])) {}
		else
        {
            $this->papar->carian[]='[id:0]';
        }
		# semak data $this->papar->cariNama
		//echo '<pre>$this->papar->cariNama::'; print_r($this->papar->cariNama) . '<pre>';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca
		$this->papar->bacaTemplate
		//$this->papar->paparTemplate
			($this->_folder . '/syarikat', $jenis, 0); # $noInclude=0
		//*/
    }

	public function tentang($apa, $bil=1, $mesej=null) 
	{
		/* fungsi ini memaparkan borang
		 * echo 'mana ko pergi daa lokaliti($negeri)<br>';
		 */
		if ($apa=='msic') $jadual = 'pom_dataekonomi.msic2000';
		elseif ($apa=='produk') $jadual = 'pom_dataekonomi.kodproduk_mei2011';
		elseif ($apa=='johor') $jadual = 'pom_lokaliti.johor'; # negeri johor/malaysia
		elseif ($apa=='malaysia') $jadual = 'pom_lokaliti.malaysia'; # negeri johor/malaysia
		elseif ($apa=='prosesan') $jadual = 'pom_dataekonomi.data_mm_prosesan';

		$this->papar->medan = $this->tanya->paparMedan($jadual);
		//echo '<pre>$this->papar->medan:<br>'; print_r($this->papar->medan); 

		# Set pemboleubah utama
		//$this->papar->pegawai = senarai_kakitangan();
		$this->papar->url = dpt_url();
		$this->papar->mesej = $mesej;

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca
		$this->papar->bacaTemplate
		//$this->papar->paparTemplate
			($this->_folder . '/index', $jenis, 0); # $noInclude=0
	}

#==========================================================================================
	function setPembolehUbah($bil, $posmen)
	{
		$had = '0, ' . $bil; # setkan $had untuk sql
		$kira = $this->pecah_post($posmen); // echo '<pre>$kira->'; print_r($kira); echo '</pre>';
		# setkan pembolehubah dulu
		$namajadual = isset($_POST['namajadual']) ? $_POST['namajadual'] : null;
		$susun = isset($_POST['susun']) ? $_POST['susun'] : 1;
		$carian = isset($_POST['cari']) ? $_POST['cari'] : null;
		$pilih = isset($_POST['pilih'][1]) ? $_POST['pilih'][1] : null;
		$semak = isset($_POST['cari'][1]) ? $_POST['cari'][1] : null;
		$semak2 = isset($_POST['cari'][2]) ? $_POST['cari'][2] : null;
		$atau = isset($_POST['atau']) ? $_POST['atau'] : null;
		$this->papar->cariNama = null;
		$this->papar->carian = $carian;
		//echo '<pre>$_POST->', print_r($_POST, 1) . '</pre>';
		//echo '$bil=' . $bil. '<br>$muka=' . $muka . '<br>';
		//echo '$pilih=' . $pilih. '<br>$semak=' . $semak . '<br>';
		//list($had,$kira,$namajadual,$susun,$carian,$pilih,$semak,$semak2,$atau) 
		//list($had,$kira,$namajadual)

		return array($had,$kira,$namajadual,$semak,$semak2);
	}
##============================================================================================
	function pecah_post()
	{
		$papar['pilih'] = isset($_POST['pilih']) ? $_POST['pilih'] : null;
		$papar['cari'] = isset($_POST['cari']) ? $_POST['cari'] : null;
		$papar['fix'] = isset($_POST['fix']) ? $_POST['fix'] : null;
		$papar['atau'] = isset($_POST['atau']) ? $_POST['atau'] : null;

		$kira['pilih'] = count($papar['pilih']);
		$kira['cari'] = count($papar['cari']);
		$kira['fix'] = count($papar['fix']);
		$kira['atau'] = count($papar['atau']);

		return $kira;
	}
##============================================================================================
	function pada($bil = 400, $muka = 1) 
	{
		# fungsi ini memaparkan hasil carian untuk jadual msic2000 dan msic2008
		list($had,$kira,$namajadual,$semak,$semak2) = $this->setPembolehUbah($bil, $_POST);

		if (!isset($_POST['atau']) && isset($_POST['pilih'][2]))
			$mesej = 'tak isi atau-dan pada carian';
		elseif ( (empty($semak) || ( empty($semak2) 
			&& $namajadual=='johor') ) ) 
			$mesej = 'tak isi pada carian';
		elseif (!empty($namajadual)) 
			$mesej = $this->paparJadual($namajadual,$kira,$had);//*/

		//$this->semakOutput(); 
		# pergi papar kandungan
		$this->paparOutput($mesej, $namajadual);
	}
##============================================================================================
	private function semakOutput()
	{
		echo '<pre>'; # semak output
		//echo 'Patah balik ke ' . $lokasi . $mesej . $namajadual . '<hr>';
		echo '$this->papar->cariNama:'; print_r($this->papar->cariNama);
		//echo '$this->papar->carian : ' . $this->papar->carian . '<br>'
		//	. '$this->papar->apa : ' . $this->papar->apa . '<br>';
		echo '</pre>';//*/
	}
##============================================================================================
	private function paparOutput($mesej, $namajadual)
	{
		if ($mesej != null ) 
		{
			$_SESSION['mesej'] = $mesej;
			$lokasi = ($namajadual=='johor') ? 'lokaliti/' : 'semua/';

			//echo 'Patah balik ke ' . $lokasi . $mesej . '<hr>' . $data;
			header('location:' . URL . 'cari/' . $lokasi . $namajadual . '/2');
		}
		else 
		{
			$this->papar->primaryKey = 'newss';
			//$this->papar->baca('cari/cari', 0);
			# pergi papar kandungan
			$jenis = $this->papar->pilihTemplate($template=0);
			//$this->papar->baca
			$this->papar->bacaTemplate
			//$this->papar->paparTemplate
				($this->_folder . '/jumpaCari', $jenis, 0); # $noInclude=0
		}
	}
##============================================================================================
	private function pilihJadual($namajadual)
	{
		if ($namajadual=='msic')
			$jadual = dpt_senarai('msicbaru');
		elseif($namajadual=='produk')
			$jadual = dpt_senarai('produk');
		elseif($namajadual=='johor')
			$jadual = dpt_senarai('johor');
		elseif($namajadual=='syarikat')
			$jadual = dpt_senarai('syarikat');
		elseif($namajadual=='data_mm_prosesan')
			$jadual = dpt_senarai('prosesan');

		//echo "\$namajadual = '$namajadual' <hr>";
		//echo '<pre>$jadual::'; print_r($jadual); echo '<pre>';

		return $jadual;
	}
##============================================================================================
	private function paparJadual($namajadual,$kira,$had)
	{
		$jadual = $this->pilihJadual($namajadual);

		# mula cari $cariID dalam $jadual
		foreach ($jadual as $key => $namaPanjang)
		{# mula ulang table
			# jika untuk msic dan produk sahaja
			$myTable = $this->keratNamaPanjang($namajadual,$namaPanjang);
			//echo "\$namaPanjang = $namaPanjang <hr>";
			//echo "\$myTable = $myTable <hr>";
			# pilih nama medan berasaskan $myTable 
			$medan = $this->pilihNamaMedan($myTable);
			$this->papar->cariNama[$myTable] = $this->tanya
				->cariPOST($namaPanjang, $medan, $kira, $had);
		}# tamat ulang table

		if($namajadual=='produk')
			$this->tambahJadualLagi();

		return $mesej = null; # pulangkan nilai
	}
##============================================================================================
	private function tambahJadualLagi()
	{# papar jadual kod unit
		$namaPanjang = 'pom_dataekonomi.kodproduk_unitkuantiti';
		$myTable = 'unitkuantiti';
		$this->papar->cariNama[$myTable] = $this->tanya->
			cariSemuaData($namaPanjang, '*', null, null);
	}
##============================================================================================
	private function keratNamaPanjang($namajadual,$namaPanjang)
	{
		if( in_array($namajadual,array('msic','produk') ) )
				$myTable = substr($namaPanjang, 16);
		else	$myTable = $namaPanjang;
		
		return $myTable;
	}
##============================================================================================
	private function pilihNamaMedan($myTable)
	{
		if ($myTable=='msic2008') 
		{
			$medan = 'seksyen S,bahagian B,kumpulan Kpl,kelas Kls,'
			. 'msic2000,msic,keterangan,notakaki'; 
		}
		elseif ($myTable=='kodproduk_aup') 
		{
			$medan = 'bil,substring(kod_produk_lama,1,5) as msic,kod_produk_lama,'
			. 'kod_produk,unit_kuantiti unit,keterangan,keterangan_bi,aup,min,max' 
			. ''; 
		}
		elseif ($myTable=='pom_lokaliti.johor') 
		{
			$medan = '`KOD NGDBBP 2010`,`PEJABAT OPERASI`,'
			. "\r" . ' concat(`KOD DAERAH BANCI`,"-",`DAERAH BANCI`," | ",`NEGERI`) as DB,'
			. "\r" . ' concat(`KOD STRATA`,"-",`STRATA`) as STRATA,'
			. "\r" . ' concat(`KOD MUKIM`,"-",`MUKIM`) as MUKIM,'
			. "\r" . ' concat(`KOD BP`,"-",`DAERAH PENTADBIRAN`) as DAERAH,'
			. "\r" . ' concat(`KOD PBT`,"-",`PIHAK BERKUASA TEMPATAN`) as PBT,'
			. "\r" . ' concat(`KOD BDR`,"-",`NAMA BANDAR`) as BANDAR,'
			. "\r" . '`DESKRIPSI (LOKALITI STATISTIC KAWKECIL)`, `LOKALITI UNTUK INDEKS`'; 
		}
		elseif ($myTable=='pom_lokaliti.lk-johor') 
		{
			$medan = '`KOD NGDBBP 2010`,'
			//. "\r" . ' concat("01",`no_db`, `no_bp_baru`) as `KodNGDBBP`,'
			. "\r" . ' `kod_strata` as STRATA, NEGERI,'
			. "\r" . ' concat(`KodMukim`,"-",`Mukim`) as MUKIM,'
			. "\r" . ' concat(`KodDP`,"-",`Daerah Pentadbiran`) as DAERAH,'
			. "\r" . ' concat(`KodPBT`,"-",`PBT`) as PBT,'
			. "\r" . ' `catatan`, `kawasan`,'
			. "\r" . ' `LOKALITI UNTUK INDEKS`'; 
		}
		else 
		{
			$medan = '*';
		}

		return $medan; # pulangkan nilai
	}
##============================================================================================
	public function syarikat($carilah = null)
	{
		$cari = bersih($_GET['cari']); //echo "URL \$cari = $cari <br> GET \$cari = $carilah";
		if($cari == null) echo '<li>Kosong Laa</li>';
		elseif (isset($cari)) 
		{
			if(strlen($cari) > 0) 
			{
				$myTable = 'be16_kawal';
				$medan = 'newss,nama,nossm,operator,kp';
				$carian[] = array('fix'=>'z%like%','atau'=>'WHERE','medan'=>'concat_ws(" ",newss,nossm,nama)','apa'=>$cari);
				$susun['dari'] = 10;

				$paparKes = //$this->tanya->cariSql($myTable, $medan, $carian, $susun);
					$this->tanya->cariSemuaData($myTable, $medan, $carian, $susun);
				$bilKes = count($paparKes); //echo $bilKes . '=>'; //print_r($paparKes) . '<pre></pre>';

				if($bilKes==0) {echo '<li>Takde Laa</li>';}
				else
				{	echo '<li>Jumpa ' . $bilKes . '</li>';
					foreach($paparKes as $key => $data)
					{
						echo '<li onClick="fill(\'' . $data['newss'] . '\');">' 
							. ($key+1) . '-' . $data['nama'] . '-' . $data['newss'] 
							. '-SSM ' . $data['nossm'] . '-' . $data['operator'] 
							. '-KP' . $data['kp'] . '</li>';
					}# tamat - foreach($paparKes as $key => $data)
				}# tamat - $bilKes ==0
			}# tamat - strlen($cari) > 0
		}# tamat - isset($cari)//*/
	}
#==========================================================================================
}