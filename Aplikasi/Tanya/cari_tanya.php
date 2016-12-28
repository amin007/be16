<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Cari_Tanya extends \Aplikasi\Kitab\Tanya
{
#==========================================================================================
	public function __construct() 
	{
		parent::__construct();
	}
########################################################################################################
	private function cariApaPOST($myTable, $where = null, $atau, $cari, $f, $apa)
	{
		//' WHERE ' . $medan . ' like %:cariID% ', array(':cariID' => $cariID));
			if ($apa==null) 
				$where .= " $atau `$cari` is null\r";
			elseif ($myTable=='msic2008') 
			{
				if ($cari=='msic') $where .= ($f=='x') ?
				" $atau (`$cari`='$apa' or msic2000='$apa')\r" :
				" $atau (`$cari` like '%$apa%' or msic2000 like '%$apa%')\r";
				else $where .= ($f=='x') ?
				" $atau (`$cari`='$apa' or notakaki='$apa')\r" :
				" $atau (`$cari` like '%$apa%' or notakaki like '%$apa%')\r";
			}
			else 
				$where .= ($f=='x') ? " $atau `$cari`='$apa'\r" : 
				" $atau `$cari` like '%$apa%'\r";

		return $where;
	}
	
	private function dimanaPOST($myTable)
	{
		//echo '<pre>$_POST->'; print_r($_POST) . '</pre>';
		$where = null;
		if($_POST==null || empty($_POST) ):
			$where .= null;
		else:
			foreach ($_POST['pilih'] as $key=>$cari)
			{
				$apa = $_POST['cari'][$key];
				$f = isset($_POST['fix'][$key]) ? $_POST['fix'][$key] : null;
				$atau = isset($_POST['atau'][$key]) ? $_POST['atau'][$key] : 'WHERE';
				//echo "\r$key => $f  | ";

				$where .= $this->cariApaPOST($myTable, $where, $atau, $cari, $f, $apa);
			}
		endif;

		return $where;
	} # private function dimanaPOST()

	public function cariPOST($myTable, $medan)
	{
		$sql = 'SELECT ' . $medan . "\r" . ' FROM ' . $myTable . "\r"
			 . $this->dimanaPOST($myTable);

		//echo '<pre>$sql->'; print_r($sql); echo '</pre>';
		//echo json_encode($result);
		return $this->db->selectAll($sql);
	}
########################################################################################################
##============================================================================================
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
		//echo '<pre>$_POST->', print_r($_POST, 1) . '</pre>';
		//echo '$bil=' . $bil. '<br>$muka=' . $muka . '<br>';
		//echo '$pilih=' . $pilih. '<br>$semak=' . $semak . '<br>';
		//list($had,$kira,$namajadual,$susun,$carian,$pilih,$semak,$semak2,$atau) 
		//list($had,$kira,$namajadual)

		return array($carian,$had,$kira,$namajadual,$semak,$semak2);
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
	public function pilihJadual($namajadual)
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
	function keratNamaPanjang($namajadual,$namaPanjang)
	{
		if( in_array($namajadual,array('msic','produk') ) )
				$myTable = substr($namaPanjang, 16);
		else	$myTable = $namaPanjang;
		
		return $myTable;
	}
##============================================================================================
	function pilihNamaMedan($myTable)
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
########################################################################################################
	public function idNama()
	{
        $medanKawalan = 'newss,'
			. 'concat_ws("|",nama,operator) nama,'
			. 'concat_ws(" | ",nossm,kp,subsektor) as nossm,' . "\r"
			. 'concat_ws(" | ",borang,fe,pegawai) as pegawai,' . "\r"
			. 'concat_ws(" | ",respon,nota) as respon,' . "\r"
			. 'lawat,terima,hantar,' . "\r" 
			. 'concat_ws(" ",alamat1,alamat2,poskod,bandar, NGDBBP_CODE_A) as alamat,' . "\r"
			. 'concat_ws("-",kp,msic2008) msic2008,' 
			. ' concat_ws(" ",' . "\r"
			. '		if (orang_a is null, "", concat_ws("="," orang", concat(orang_a," |") ) ),' . "\r"
			. '		if (notel_a is null, "", concat_ws("="," tel", concat(notel_a," |") ) ),' . "\r"
			. '		if (nofax_a is null, "", concat_ws("="," fax", concat(nofax_a," |") ) ),' . "\r"
			. '		if (responden is null, "", concat_ws("="," responden", concat(responden," |") ) ),' . "\r"
			. '		if (notel is null, "", concat_ws("="," notel", concat(notel," |") ) ),' . "\r"
			. '		if (nofax is null, "", concat_ws("="," nofax", concat(nofax," |") ) )' . "\r"
 			. ' ) as dataHubungi,'
			. 'concat_ws(" ",' . "\r"
			. '		if (hasil is null, "", concat_ws("="," hasil", concat(format(hasil,0)," |") ) ),' . "\r"
			. '		if (belanja is null, "", concat_ws("="," belanja", concat(format(belanja,0)," |") ) ),' . "\r"
			. '		if (gaji is null, "", concat_ws("="," gaji", concat(format(gaji,0)," |") ) ),' . "\r"
			. '		if (aset is null, "", concat_ws("="," aset", concat(format(aset,0)," |") ) ),' . "\r"
			. '		if (staf is null, "", concat_ws("="," staf", concat(format(staf,0)," |") ) ),' . "\r"
			. '		if (stok is null, "", concat_ws("="," stok akhir", concat(format(stok,0)," |") ) )' . "\r"
 			. ' ) as data5P,'
			. 'notel_a,notel,nofax_a,nofax,'
			. 'concat_ws(" ",orang_a,"[Pengurus] [Pemilik]") as orang_a,' 
			. 'responden,esurat_a,email,'
			. 'hasil,belanja,gaji,aset,staf,stok,'
			. '';

		# buang koma di akhir string
		$medanKawalan = substr($medanKawalan, 0, -1);
		
		$medanKawalan2 = '*'; # pilihan lain untuk papar semua medan

		return $medanKawalan; # pulangkan pemboleubah
	}
########################################################################################################
	/*public function tambahSimpanBanyak($myTable, $namaMedan, $posmen)
	{
		$sql2 = null;
		# mula bentuk sql dari array
		foreach ($posmen as $kunci => $nilai):
			foreach ($nilai as $medan => $data):
				$sql2 .= ($data == null) ? "null," : "'$data',";
			endforeach;
			$senarai[] = '(' . substr($sql2, 0, -1) . ")";
		endforeach;
		# cantumkan array
		$senaraiData = implode(",\r",$senarai);
		## $sql = "INSERT INTO $table (`$namaMedan`) VALUES ($fieldValues),($fieldValues),");
		# set sql
		$sql = 'INSERT INTO ' . $myTable 
			. ' (' . $namaMedan  . ') VALUES ' 
			. "\r" . $senaraiData;

		//echo '<pre>$sql->', print_r($sql, 1) . '</pre>';
		$this->db->insert($sql);
	}*/
#==========================================================================================
}