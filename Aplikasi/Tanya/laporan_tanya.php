<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Laporan_Tanya extends \Aplikasi\Kitab\Tanya
{
#==========================================================================================
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function medanUbah2($cariID)
	{
		$senaraiMedan = 'no,Nama_Penuh nama,email,nohp';
		
		# pulangkan pemboleubah
		return $senaraiMedan;
	}
	
	public function tatasusunanUbah2($jadual, $medan, $cari, $susun) 
	{
		# ada nilai
		$hasil = array ( '0' => array (
				        'no' => '2',
				      'nama' => 'Fulan Bin Fulan',
				     'email' => 'fulan@mail.com',
				      'nohp' => '0123456789',
				'keterangan' => '',					  
				   'jantina' => 'lelaki',
				  'password' => '123abd456',
				    'terima' => '2016-03-30',
				     'hasil' => '123654',
				   'belanja' => '223654',
				      'gaji' => '323654',
				      'aset' => '423654',
				      'staf' => '523654',
				      'stok' => '623654',
				));
		
		# tiada nilai
		$hasil2 = array();
		
		# pulangkan pemboleubah
		return $hasil;
	}

	public function tatasusunanUbah2A($jadual, $medan, $cari, $susun) 
	{
		# ada nilai - cantum semua tatasusunan dalam satu
		$hasil = array (
			'msic2008' => array (
				0 => array (
						'S' => 'S',
						'msic2000' => '93099p',
						'msic' => '96094',
						'keterangan' => 'Perkhidmatan jagaan haiwan(2)',
						'notakaki' => '(2) Termasuk: penumpangan, perapian, mendudukkan dan melatih binatang peliharaan',
					),
				),
			'msic_v1' => array (
				0 => array (
						'msic' => '96094',
						'kp' => '85',
						'staf' => NULL,
						'keterangan' => 'Perkhidmatan jagaan haiwan',
						'notakaki' => 'Pet care services INCLUDE boarding, grooming, sitting and training pets '
								. 'NOT INCLUDE veterinary activities, see 7500 activities of fitness centres, see 93118',
					),
			),
			'msic_bandingan' => array (
				0 => array (
						'sv_newss' => '332',
						'sv_sidap' => '85',
						'msic2000p' => '93099p',
						'msic2000' => '93099',
						'msic' => '96094',
						'keterangan' => 'Aktiviti Perkhidmatan Persendirian',
						'Sektor' => 'Perkhidmatan (Lain-lain)',
					),
			),
			'msic2000' => array (),
			'msic2000_notakaki' => array (),
		);
		
		# ada nilai - pecah tatasusunan kepada beberapa bahagian
		$hasil1['satu'] = array ( 
			'0' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'1' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'2' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1')
			);
		$hasil1['dua'] = array ( 
			'0' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'1' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'2' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1')
			);
		$hasil1['tiga'] = array ( 
			'0' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'1' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1'),
			'2' => array ('kira' => '1', 'A' => 'A1', 'B' => 'B1')
			);
		
		# tiada nilai
		$hasil2 = array();
		
		# pulangkan pemboleubah
		return $hasil;
	}
	
	
	public function medanUbah($cariID) 
	{ 
		# Set pemboleubah
		# buat link
		$alamat1 = 'http://xxx/crud/ubah2/",kp,"/'.$cariID.'/2010/2015/'; 
		$url1 = '" <a target=_blank href=' . $alamat1 . '>SEMAK 1</a>"';
		$url2 = 'concat("<a target=_blank href=' . $alamat1 . '>SEMAK 2</a>")';
		# Set pemboleubah untuk sql
        $senaraiMedan = 'id,'
			. 'concat_ws("|",nama,operator,' . $url1 . ',' . $url2 . ') nama,'
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," hasil",format(hasil,0)),' . "\r"
			. ' 	concat_ws("="," belanja",format(belanja,0)),' . "\r"
			. ' 	concat_ws("="," gaji",format(gaji,0)),' . "\r"
			. ' 	concat_ws("="," aset",format(aset,0)),' . "\r"
			. ' 	concat_ws("="," staf",format(staf,0)),' . "\r"
			. ' 	concat_ws("="," stok akhir",format(stok,0))' . "\r"
 			. ' ) as data5P,'
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," tel",tel),' . "\r"
			. ' 	concat_ws("="," fax",fax),' . "\r"
			. ' 	concat_ws("="," orang",orang),' . "\r"
			. ' 	concat_ws("="," notel",notel),' . "\r"
			. ' 	concat_ws("="," nofax",nofax)' . "\r"
 			. ' ) as dataHubungi,'
			. 'concat_ws(" ",alamat1,alamat2,poskod,bandar) as alamat,' . "\r"
			//. 'concat_ws(" ",no,batu,( if (jalan is null, "", concat("JALAN ",jalan) ) ),tmn_kg,poskod,dp_baru) alamat_baru,' . "\r"
			. 'tel,notel,fax,nofax,responden,orang,email,esurat,'
			. 'hasil,belanja,gaji,aset,staf,stok' . "\r" 
			. '';
		
		# pulangkan pemboleubah
		return $senaraiMedan;
	}	

	private function medanRespon()
	{
		$senaraiMedan[] = 'kod';
		$senaraiMedan[] = 'f2';
		$senaraiMedan[] = 'respon';
		$senaraiMedan[] = '`NAMA PEMILIK` as nama, '
			. 'concat_ws("-",`KOD PENYIASATAN`,`KOD INDUSTRI`,`JENIS TANAMAN/TERNAKAN/PERIKANAN`) as kp,'
			. '`Status` as utama, concat_ws("-",`ID`,`NO KAD PENGENALAN`) as newss,'
			//. 'concat_ws("-",`TINDAKAN`) as nota'
			. '"" as nota'
			. '';
		
		# semak pembolehubah
		list($medanR, $jadualR, $r, $medan) = $senaraiMedan;
		echo "\$medanR = $medanR,<br> \$jadualR = $jadualR,<br> "
			. "\$r = $r,<br> \$medan = $medan,<br>";
		
		return $senaraiMedan; # pulangkan nilai
	}

	private function bentukSqlRespon($medanR, $jadualR, $item, $ms)
	{
		//$sql = 'SELECT ' . $medan . ' FROM ' . $jadual
		//	 . ' WHERE kod not in ("X","5P") GROUP BY 1 ORDER BY no';
		$cari[] = array('fix'=>'xin','atau'=>'WHERE','medan'=>$medanR,'apa'=>'("X","5P")');
		$jum2 = array(); // pencamSqlLimit(300, $item, $ms); #
		$susun[] = array_merge($jum2, array('kumpul'=>1,'susun'=>'no') );
		$hasil = $this->//tatasusunanUbah2A 
			//cariSemuaData //
			cariSql
			($jadualR, $medanR, $cari, $susun);
		return $hasil;
	}
	
	public function kumpulRespon($item, $ms, $myTable, $carian, $susun)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanRespon()
		//echo '<pre>$papar->'; print_r($this->medanRespon()) . '</pre><br>';
		# panggil sql pertama
		$hasil = $this->bentukSqlRespon($medanR, $jadualR, $item, $ms);
		/*$r = $p['r'];
		$medan = $p['medan'];
		# loop over the object directly 
		$kumpul = null;
		foreach($hasil as $key=>$val)
		{
			foreach($val as $key2=>$p)
			{
				//$kumpul .= ",\r '' as '" . $p . "'";
				$kumpul .= ",\r if($r='".$p."','X','&nbsp;') as '" . $p . "'";
				//$jumlah_kumpul.="+count(if($r='".$papar[0]."' and b.terima is not null,$r,null))\r";
			}
		} //echo '<pre>$kumpul:'; print_r($kumpul) . '</pre>';
		
		# sql kedua, khas untuk cetak F3 : senarai kes pegawai kerja luar
		$hasil2 = $this->//tatasusunanUbah2A 
			cariSemuaData //cariSql
			($myTable, "$medan$kumpul\r", $carian, $susun);

		//$result['kiraData'] = $this->db->selectAll($sql2);
		
		return $hasil2;
		//*/
	}
#==========================================================================================
}