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

	function pada($bil = 400, $muka = 1) 
	{
		/* fungsi ini memaparkan hasil carian
		 * untuk jadual msic2000 dan msic2008
		 */

		$had = '0, ' . $bil; # setkan $had untuk sql
		$kira = pecah_post($_POST); # echo '<pre>$kira->'; print_r($kira); echo '</pre>';
		# setkan pembolehubah dulu
		$namajadual = isset($_POST['namajadual']) ? $_POST['namajadual'] : null;
		$susun = isset($_POST['susun']) ? $_POST['susun'] : 1;
		$carian = isset($_POST['cari']) ? $_POST['cari'] : null;
		$pilih = isset($_POST['pilih'][1]) ? $_POST['pilih'][1] : null;
		$semak = isset($_POST['cari'][1]) ? $_POST['cari'][1] : null;
		$semak2 = isset($_POST['cari'][2]) ? $_POST['cari'][2] : null;
		$atau = isset($_POST['atau']) ? $_POST['atau'] : null;
		$this->papar->cariNama = null;
		//echo '<pre>$_POST->', print_r($_POST, 1) . '</pre>';
		//echo '$bil=' . $bil. '<br>$muka=' . $muka . '<br>';
		//echo '$pilih=' . $pilih. '<br>$semak=' . $semak . '<br>';

		if (!isset($_POST['atau']) && isset($_POST['pilih'][2]))
		{
			//echo '1)$namajadual=' . $namajadual . '<br>';
			$mesej = 'tak isi atau-dan pada carian';
			$lokasi = ($namajadual=='johor') ? 'lokaliti/' : 'semua/';
		}
		elseif ( (empty($semak) || ( empty($semak2) 
			&& $namajadual=='johor') ) ) 
		{
			//echo '2)$namajadual=' . $namajadual . '<br>';
			$mesej = 'tak isi pada carian';
			$lokasi = ($namajadual=='johor') ? 'lokaliti/' : 'semua/';
		}
		elseif (!empty($namajadual) && $namajadual=='msic') 
		{
			//echo '3)$namajadual=' . $namajadual . '<br>';
			$jadual = dpt_senarai('msicbaru');
			# mula cari $cariID dalam $jadual
			foreach ($jadual as $key => $namaPanjang)
			{# mula ulang table
				$myTable = substr($namaPanjang, 16);
				# senarai nama medan
				$medan = ($myTable=='msic2008') ? 
					'seksyen S,bahagian B,kumpulan Kpl,kelas Kls,' .
					'msic2000,msic,keterangan,notakaki' 
					: '*'; 
				$this->papar->cariNama[$myTable] = $this->tanya
					->cariPOST($namaPanjang, $medan, $kira, $had);

			}# tamat ulang table

			$this->papar->carian=$carian;
			$mesej = null; $lokasi = null;
		}
		elseif (!empty($namajadual) && $namajadual=='produk') 
		{
			$jadual = dpt_senarai('produk');
			# mula cari $cariID dalam $jadual
			foreach ($jadual as $key => $namaPanjang)
			{# mula ulang table
				$myTable = substr($namaPanjang, 16); //echo "<br>4) $myTable";
				# senarai nama medan
				$medan = ($myTable=='kodproduk_aup') ? 
					'bil,substring(kod_produk_lama,1,5) as msic,kod_produk_lama,' .
					'kod_produk,unit_kuantiti unit,keterangan,keterangan_bi,aup,min,max' 
					: '*'; 
				$this->papar->cariNama[$myTable] = $this->tanya
				->cariPOST($namaPanjang, $medan, $kira, $had);
			}# tamat ulang table

			# papar jadual kod unit
			$unitPanjang = 'pom_dataekonomi.kodproduk_unitkuantiti';
			$unit = 'unitkuantiti';
				$this->papar->cariNama[$unit] = $this->tanya->
					cariSemuaData($unitPanjang, '*', null, null);

			$this->papar->carian=$carian;
			$mesej = null; $lokasi = null;
		}
		elseif (!empty($namajadual) && $namajadual=='syarikat') 
		{
			//echo '5)$namajadual=' . $namajadual . '<br>';
			$jadual = dpt_senarai('syarikat');
			# mula cari $cariID dalam $jadual
			foreach ($jadual as $key => $myTable)
			{# mula ulang table
				$this->papar->cariNama[$myTable] = $this->tanya
					->cariPOST($myTable, $medan = '*', $kira, $had);
			}# tamat ulang table

			$this->papar->carian=$carian;
			$mesej = null; $lokasi = null;
		}
		elseif (!empty($namajadual) && $namajadual=='johor') 
		{
			//`KOD NEGERI`, `NEGERI`,
			//echo '6)$namajadual=' . $namajadual . '<br>';
				# senarai nama medan
				$medanAsal = '`KOD NGDBBP 2010`,`PEJABAT OPERASI`,' .
				"\r" . ' concat(`KOD DAERAH BANCI`,"-",`DAERAH BANCI`," | ",`NEGERI`) as DB,' .
				"\r" . ' concat(`KOD STRATA`,"-",`STRATA`) as STRATA,' .
				"\r" . ' concat(`KOD MUKIM`,"-",`MUKIM`) as MUKIM,' .
				"\r" . ' concat(`KOD BP`,"-",`DAERAH PENTADBIRAN`) as DAERAH,' .
				"\r" . ' concat(`KOD PBT`,"-",`PIHAK BERKUASA TEMPATAN`) as PBT,' .
				"\r" . ' concat(`KOD BDR`,"-",`NAMA BANDAR`) as BANDAR,' .
				"\r" . '`DESKRIPSI (LOKALITI STATISTIC KAWKECIL)`, `LOKALITI UNTUK INDEKS`'; 
				# senarai nama medan
				$medanBaru = '`KOD NGDBBP 2010`,' .
				//"\r" . ' concat("01",`no_db`, `no_bp_baru`) as `KodNGDBBP`,' .
				"\r" . ' `kod_strata` as STRATA, NEGERI,' .
				"\r" . ' concat(`KodMukim`,"-",`Mukim`) as MUKIM,' .
				"\r" . ' concat(`KodDP`,"-",`Daerah Pentadbiran`) as DAERAH,' .
				"\r" . ' concat(`KodPBT`,"-",`PBT`) as PBT,' .
				"\r" . ' `catatan`, `kawasan`,' .
				"\r" . ' `LOKALITI UNTUK INDEKS`'; 

			$jadual = dpt_senarai('johor');
			# mula cari $cariID dalam $jadual
			foreach ($jadual as $key => $myTable)
			{# mula ulang table
				
				$medan = ($myTable=='pom_lokaliti.johor') ? 
					$medanAsal : $medanBaru;
				$myJadual = ($myTable=='pom_lokaliti.johor') ? 
					'JOHOR':'LK-JOHOR';
				$this->papar->cariNama[$myJadual] = $this->tanya
					->cariPOST($myTable, $medan, $kira, $had);

			}# tamat ulang table
			
			$this->papar->carian=$carian;
			$mesej = null; $lokasi = null;
		}
		elseif (!empty($namajadual) && $namajadual=='data_mm_prosesan') 
		{
			//echo '7)$namajadual=' . $namajadual . '<br>';
			$jadual = dpt_senarai('prosesan');
			# mula cari $cariID dalam $jadual
			foreach ($jadual as $key => $myTable)
			{# mula ulang table
				$this->papar->cariNama[$myTable] = $this->tanya
					->cariPOST($myTable, $medan = '*', $kira, $had);
			}# tamat ulang table
			
			$this->papar->carian = $carian;
			$mesej = null; $lokasi = null;
		}

		/* echo '<pre>'; # semak output
		//echo 'Patah balik ke ' . $lokasi . $mesej . $namajadual . '<hr>';
		echo '$this->papar->cariNama:'; print_r($this->papar->cariNama);
		//echo '$this->papar->carian : ' . $this->papar->carian . '<br>'
		//	. '$this->papar->apa : ' . $this->papar->apa . '<br>';
		echo '</pre>';
		//*/

		# paparkan ke fail cari/$namajadual.php
		if ($mesej != null ) 
		{
			$_SESSION['mesej'] = $mesej;

			//echo 'Patah balik ke ' . $lokasi . $mesej . '<hr>' . $data;
			header('location:' . URL . 'cari/' . $lokasi . $namajadual . '/2');
		}
		else 
		{
			//echo 'Tak patah balik';
			$this->papar->primaryKey = 'newss';
			$this->papar->baca('cari/cari', 0);	
		}
		//*/
	}

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