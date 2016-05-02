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
		// //' WHERE ' . $medan . ' like %:cariID% ', array(':cariID' => $cariID));
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
	} // private function dimanaPOST()

	
	public function cariPOST($myTable, $medan)
	{
		$sql = 'SELECT ' . $medan . "\r" . ' FROM ' . $myTable . "\r"
			 . $this->dimanaPOST($myTable);
		
		//echo '<pre>$sql->', print_r($sql, 1) . '</pre>';
		//echo json_encode($result);
		return $this->db->selectAll($sql);
	}
		
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