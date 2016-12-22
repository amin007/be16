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
	private function dimanaPOST($myTable)
	{
		//echo '<pre>$_POST->'; print_r($_POST) . '</pre>'; 
		//' WHERE ' . $medan . ' like %:cariID% ', array(':cariID' => $cariID));
		$where = null;
		if($_POST==null || empty($_POST) ):
			$where .= null;
		else:
			foreach ($_POST['pilih'] as $key=>$cari)
			{
				$apa = $_POST['cari'][$key];
				$f = isset($_POST['fix'][$key]) ? $_POST['fix'][$key] : null;
				$atau = isset($_POST['atau'][$key]) ? $_POST['atau'][$key] : 'WHERE';

				//$sql.="\r$key => $f  | ";

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
			}
		endif;

		return $where;
	} # private function dimanaPOST()

	public function cariPOST($myTable, $medan)
	{
		$sql = 'SELECT ' . $medan . "\r" . ' FROM ' . $myTable . "\r"
			 . $this->dimanaPOST($myTable);

		//echo '<pre>$sql->', print_r($sql, 1) . '</pre>';
		//echo json_encode($result);
		return $this->db->selectAll($sql);
	}
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