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
#- mula  - untuk tatasusunan Respon ---------------------------------------------------------------------------------
	private function medanResponT()
	{
		$senaraiMedan[] = 'nama';
		$senaraiMedan[] = 'kp';
		$senaraiMedan[] = 'utama';
		$senaraiMedan[] = 'newss';
		$senaraiMedan[] = 'nota';

		return $senaraiMedan; # pulangkan nilai
	}

	private function bentukSqlResponT()
	{
		# ada nilai
		$hasil = array ('A1','A2','A3','A4','A5','A6',
			'A7','A8','A9','A10','A11','A12','A13',
			'B1','B2','B3','B4','B5','B6','B7');

		$hasil2 = array(); # tiada nilai

		return $hasil; # pulangkan nilai 
	}

	public function tatasusunanRespon($item, $ms, $myTable, $carian, $susun)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanRespon();
		# panggil sql pertama
		$hasilRespon = $this->bentukSqlResponT($medanR, $jadualR, $item, $ms);

		# loop over the object directly 
		$hasil2 = array();
		foreach($this->tatasusunanResponData() as $kunci=>$nilai)
		{
			$hasil2[$kunci] = $nilai; 
			foreach($hasilRespon as $key=>$p)
			{
				$hasil2[$kunci][$p] = ($p=='A1') ? 'X':''; 
			} 
		}	//echo '<pre>$hasil2:'; print_r($hasil2) . '</pre>';

		return $hasil2; # pulangkan nilai
		//*/
	}

	private function tatasusunanResponData()
	{
		$hasil[] = array('nama'=>'A', 'kp'=>'101', 'utama'=>'KERJA LUAR', 'newss'=>'1', 'nota'=>'');
		$hasil[] = array('nama'=>'B', 'kp'=>'101', 'utama'=>'KERJA LUAR', 'newss'=>'2', 'nota'=>'');
		$hasil[] = array('nama'=>'C', 'kp'=>'101', 'utama'=>'KERJA LUAR', 'newss'=>'3', 'nota'=>'');
		$hasil[] = array('nama'=>'D', 'kp'=>'102', 'utama'=>'POS', 'newss'=>'4', 'nota'=>'');
		$hasil[] = array('nama'=>'E', 'kp'=>'103', 'utama'=>'POS', 'newss'=>'5', 'nota'=>'');

		return $hasil; # pulangkan nilai
	}
#- tamat - untuk tatasusunan Respon ---------------------------------------------------------------------------------
#- mula  - untuk Sql Respon -----------------------------------------------------------------------------------------
	private function bentukSqlRespon($medanR, $jadualR, $item, $ms)
	{
		$cari[] = array('fix'=>'xin','atau'=>'WHERE','medan'=>$medanR,'apa'=>'("X","5P")');
		$jum2 = array(); // pencamSqlLimit(300, $item, $ms); #
		$susun[] = array_merge($jum2, array('kumpul'=>1,'susun'=>'no') );
		$hasilRespon = $this->//tatasusunan
			cariSemuaData //cariSql
			($jadualR, $medanR, $cari, $susun);

		return $hasilRespon; # pulangkan nilai
	}
#- tamat  - untuk Sql Respon -----------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------------------------
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

		return $senaraiMedan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanRespon2()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => 'respon',
			3 => 'nama, '
			. 'concat_ws("-",`kp`) as kp,'
			. '"" as utama, concat_ws("-",`newss`) as newss,'
			//. 'concat_ws("|",ATTENTION_NAME_A,TEL_NO_A,FAX_NO_A,EMAIL_A) as nota'
			. 'nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulRespon($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = //$this->medanRespon(); # untuk BUTAM
			$this->medanRespon2(); # untuk BE16
		# panggil sql pertama
		$hasilRespon = $this->bentukSqlRespon($medanR, $jadualR, $item, $ms);
		# loop over the object directly 
		foreach($hasilRespon as $key=>$val)
		{
			foreach($val as $key2=>$p)
			{
				//$medan .= ",\r '' as '" . $p . "'";
				$medan .= ",\r if($r='" . $p . "','X','&nbsp;') as '" . $p . "'";
				//$jumlah_kumpul.="+count(if($r='".$papar[0]."' and b.terima is not null,$r,null))\r";
			}
		} //echo '<pre>$medan:'; print_r($medan) . '</pre>';

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanResponden()
	{
			//. 'concat_ws("|",ATTENTION_NAME_A,TEL_NO_A,FAX_NO_A,EMAIL_A,'
			//. 'ATTENTION_NAME_B,TEL_NO_B,FAX_NO_B,EMAIL_B,'
			//. 'ATTENTION_NAME_C,TEL_NO_C,FAX_NO_C,EMAIL_C'
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => 'concat_ws(" | ",`respon`,`nota`) as respon',
			//2 => 'concat_ws(" | ",`posdaftar`,`posdaftar_terima`) as respon';
			3 => 'concat_ws("-",nama,operator) as nama,'
			. 'concat_ws("<br>",kp,msic2008) as kp,'
			. 'concat_ws(" ","<input type=\"checkbox\">",alamat1,alamat2) as utama,'
			. 'concat_ws("",newss) as newss,'
			. 'concat_ws(" ","(",jalan,")<br>",orang_a,notel_a,nofax_a,esurat_a'
			. ') as nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulResponden($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanResponden();
		# bentuk medan yang ingin diulang
		$medan .= ",\r $r ";

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanAlamat()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => 'concat_ws(" | ",`respon`,`nota`) as respon',
			//2 => 'concat_ws(" | ",`posdaftar`,`posdaftar_terima`) as respon',
			3 => 'concat_ws("-",nama,operator) as nama,'
			. 'concat_ws("<br>",kp,msic2008) as kp,'
			. 'concat_ws(" ","<input type=\"checkbox\">",alamat1,alamat2) as utama,'
			. 'concat_ws("",newss) as newss,'
			. 'concat_ws(" ","(",jalan,")<br>",orang_a,notel_a,nofax_a,esurat_a'
			. ') as nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	private function medanAlamat2()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => 'concat_ws("","<input type=\"checkbox\">",`respon`,`nota`) as respon',
			//2 => 'concat_ws(" | ",`posdaftar`,`posdaftar_terima`) as respon',
			3 => 'concat_ws("-",nama,operator) as nama,'
			. 'concat_ws("-",kp,msic2008) as kp,'
			. ' concat_ws("",' . "\r"
			. '		if (respon is null, "", concat_ws("="," respon", concat(respon," |") ) ),' . "\r"
			. '		if (hantar is null, "", concat_ws("="," hantar", concat(hantar," |") ) ),' . "\r"
			. '		if (orang_a is null, "", concat_ws("="," orang", concat(lower(orang_a)," |") ) ),' . "\r"
			. '		if (notel_a is null, "", concat_ws("="," tel", concat(notel_a," |") ) ),' . "\r"
			. '		if (nofax_a is null, "", concat_ws("="," fax", concat(nofax_a," |") ) ),' . "\r"
			. '		if (responden is null, "", concat_ws("="," responden", concat(lower(responden)," |") ) ),' . "\r"
			. '		if (notel is null, "", concat_ws("="," notel", concat(notel," |") ) ),' . "\r"
			. '		if (nofax is null, "", concat_ws("="," nofax", concat(nofax," |") ) )' . "\r"
 			. ' ) as utama,'
			. 'concat_ws("",newss) as newss,'
			. 'concat_ws(" ",' . "\r"
			. '		if (hasil is null, "", concat_ws("="," hasil", concat(format(hasil,0)," |") ) ),' . "\r"
			. '		if (belanja is null, "", concat_ws("="," belanja", concat(format(belanja,0)," |") ) ),' . "\r"
			. '		if (gaji is null, "", concat_ws("="," gaji", concat(format(gaji,0)," |") ) ),' . "\r"
			. '		if (aset is null, "", concat_ws("="," aset", concat(format(aset,0)," |") ) ),' . "\r"
			. '		if (staf is null, "", concat_ws("="," staf", concat(format(staf,0)," |") ) ),' . "\r"
			. '		if (stok is null, "", concat_ws("="," stok akhir", concat(format(stok,0)," |") ) )' . "\r"
 			. ' ) as nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulAlamat($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanAlamat2();
		# bentuk medan yang ingin diulang
		$medan .= ",\r $r ";

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanDaerah()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'be16_kawal', //'f2',
			2 => 'concat_ws(" | ",`respon`,`nota`) as respon',
			//2 => 'concat_ws(" | ",`posdaftar`,`posdaftar_terima`) as respon',
			3 => 'concat_ws("-",nama,operator) as nama,'
			. 'concat_ws(" ",alamat1,alamat2) as alamat,'
			. 'concat_ws("","(",jalan,")",orang_a,notel_a,nofax_a,esurat_a) as utama,'
			. 'concat_ws("",newss) as newss,'
			. 'concat_ws(" ",kp,msic2008'
			. ') as nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulDaerah($namaPegawai, $cariBatch, $item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanU, $jadualU, $r, $medan) = $this->medanDaerah();
		# bentuk medan yang ingin diulang
		$medan .= ",\r $r ";
		//$cariBatch = 'segamat';
		$carian[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'pegawai','apa'=>$namaPegawai);
		$carian[] = array('fix'=>'%like%','atau'=>'AND','medan'=>'borang','apa'=>$cariBatch);
		//$carian[] = array('fix'=>'like','atau'=>'AND','medan'=>'kp','apa'=>'');	
		$susunkan[] = array('kumpul'=>null,'susun'=>'jalan ASC, nama ASC');	

		return array($medan, $jadualU, $carian, $susunkan); # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function paparLinkA1()
	{
		$cariID = '",newss,"';
		$news1 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/ckawalan/ubah/' . $cariID;
		$namaS = $cariID . '/2010/2015/cetak/",replace(nama,\' \',\'-\'),"';
		$news2 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/cprosesan101/ubah/",kp,"/' . $namaS;
		$news3 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/semakan/ubah/",kp,"/' . $cariID . '/2010/2015/';
		//$url1 = '" <a target=_blank href=' . $news1 . '>SEMAK 1</a>"';
		$url1 = 'concat("<a target=_blank href=' . $news1 . '>SEMAK 1</a>")';
		$url2 = 'concat("<a target=_blank href=' . $news2 . '>SEMAK 2</a>")';
		$url3 = 'concat("<a target=_blank href=' . $news3 . '>SEMAK 3</a>")';

		return array($url1, $url2, $url3);
	}

	private function paparMedanA1()
	{
		list($url1, $url2, $url3) = $this->paparLinkA1();
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => null,
			3 => 'newss, ' //concat_ws("<br>",nama,operator) nama
			. 'concat_ws("|",nama,operator,' . $url1 . ',' . $url2 . ',' . $url3 . ') nama,'
			. ' concat_ws(" ",' . "\r"
			. '		if (hasil is null, "", concat_ws("="," hasil", concat(format(hasil,0)," |<br>") ) ),' . "\r"
			. '		if (belanja is null, "", concat_ws("="," belanja", concat(format(belanja,0)," |<br>") ) ),' . "\r"
			. '		if (gaji is null, "", concat_ws("="," gaji", concat(format(gaji,0)," |<br>") ) ),' . "\r"
			. '		if (aset is null, "", concat_ws("="," aset", concat(format(aset,0)," |<br>") ) ),' . "\r"
			. '		if (staf is null, "", concat_ws("="," staf", concat(format(staf,0)," |<br>") ) ),' . "\r"
			. '		if (stok is null, "", concat_ws("="," stok akhir", concat(format(stok,0)," |<br>") ) )' . "\r"
 			. ' ) as nota,'
			. ' concat_ws("",' . "\r"
			. '		if (orang_a is null, "", concat_ws("="," orang", concat(lower(orang_a)," |<br>") ) ),' . "\r"
			. '		if (notel_a is null, "", concat_ws("="," tel", concat(notel_a," |<br>") ) ),' . "\r"
			. '		if (nofax_a is null, "", concat_ws("="," fax", concat(nofax_a," |<br>") ) ),' . "\r"
			. '		if (responden is null, "", concat_ws("="," responden", concat(lower(responden)," |<br>") ) ),' . "\r"
			. '		if (notel is null, "", concat_ws("="," notel", concat(notel," |<br>") ) ),' . "\r"
			. '		if (nofax is null, "", concat_ws("="," nofax", concat(nofax," |<br>") ) )' . "\r"
 			. ' ) as utama,'
			. ' concat_ws("|",kp) kp,'
			. ' if(respon="A1",respon,"&nbsp;") A1'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function paparA1($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->paparMedanA1();
		//echo '<pre>$this->medanA1():'; print_r($this->medanA1()) . '</pre>';
		//echo '<pre>$medan:'; print_r($medan) . '</pre>';

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanA1()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => null,
			3 => 'newss, concat_ws("<br>",nama,operator) nama,'
			. ' concat_ws("|",kp) kp,'
			. ' if(respon="A1",respon,"&nbsp;") A1,'
			. ' if(respon!="A1",respon,"&nbsp;") NONA1, '
			//. ' CONCAT(UPPER(SUBSTRING(orang_a,1,1)),LOWER(SUBSTRING(orang_a,1,100)))'
			//. ' LOWER(orang_a)'
			. ' concat_ws("",' . "\r"
			. '		if (orang_a is null, "", concat_ws("="," orang", concat(lower(orang_a)," |") ) ),' . "\r"
			. '		if (notel_a is null or notel_a = 0, "", concat_ws("="," tel", concat(notel_a," |") ) ),' . "\r"
			. '		if (nofax_a is null, "", concat_ws("="," fax", concat(nofax_a," |") ) ),' . "\r"
			. '		if (responden is null, "", concat_ws("="," responden", concat(lower(responden)," |") ) ),' . "\r"
			. '		if (notel is null, "", concat_ws("="," notel", concat(notel," |") ) ),' . "\r"
			. '		if (nofax is null, "", concat_ws("="," nofax", concat(nofax," |") ) )' . "\r"
 			. ' ) as nota'
			//. 'concat_ws("|",concat("hasil=",hasil),concat("belanja=",belanja),' 
			//. 'concat("gaji=",gaji),concat("aset=",aset),concat("staf=",staf),'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulA1($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanA1();
		//echo '<pre>$this->medanA1():'; print_r($this->medanA1()) . '</pre>';
		//echo '<pre>$medan:'; print_r($medan) . '</pre>';

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	private function medanNonA1()
	{
		$senaraiMedan = array(
			0 => 'kod',
			1 => 'f2',
			2 => null,
			3 => 'newss, concat_ws("<br>",nama,operator) nama,'
				. ' concat_ws("|",kp) kp,'
				. ' if(respon="A1",respon,"&nbsp;") A1,'
				. ' if(respon!="A1",respon,"&nbsp;") NONA1, '
				. 'concat_ws("|",nota,"<br>",orang_a,notel_a,nofax_a,esurat_a) as nota'
				//. 'concat_ws("|",nota,"<br>",responden,notel,nofax,email,nota) as nota'
		);

		return $senaraiMedan; # pulangkan nilai
	}

	public function kumpulNonA1($item, $ms)
	{
		# set pembolehubah untuk sql pertama
		list($medanR, $jadualR, $r, $medan) = $this->medanNonA1();
		//echo '<pre>$this->medanNonA1():'; print_r($this->medanNonA1()) . '</pre>';
		//echo '<pre>$medan:'; print_r($medan) . '</pre>';

		return $medan; # pulangkan nilai
	}
#----------------------------------------------------------------------------------------------------------------------
	public function laporanProsesan($myTable, $medan, $respon, $susun)
	{
		# pembolehubah yg terlibat // berasaskan kp dan tarikh
		/*
		01	Batu Pahat	02	Johor Bahru		03	Kluang
		06	Muar		04	Kota Tinggi		05	Mersing
		10	Ledang		07	Pontian
		08	Segamat		09	KulaiJaya
		*/
		## medan
		$po = "po";
		## Pejabat Operasi
		$pjb = "$po='PJB'";
		$kiraPjb = "count(if($pjb,'PJB',null))";
		$pok = "$po='POK'";
		$kiraPok = "count(if($pok,'POK',null))";
		$pom = "$po='POM'";
		$kiraPom = "count(if($pom,'POM',null))";
		## rangka
		$rangka = "$kiraPjb `PJB`,\r"
			 . "$kiraPok `POK`,\r"
			 . "$kiraPom `POM`,\r";
		## kod 11 mko
		$mko = "count(if($pjb AND $respon,'PJB11',null)) `PJB11`,\r"
			 . "count(if($pok AND $respon,'POK11',null)) `POK11`,\r"
			 . "count(if($pom AND $respon,'POM11',null)) `POM11`,\r";
		## penerimaan borang
		$terima = "count(if($pjb AND $respon,'PJB1',null)) `tPJB`,\r"
			 . "(format ((count(if($pjb AND $respon,'PJB1',null)) / count(*)) * 100, 2))`t%PJB`,\r"
			 . "count(if($pok AND $respon,'POK1',null)) `tPOK`,\r"
			 . "(format ((count(if($pok AND $respon,'POK1',null)) / count(*)) * 100, 2))`t%POK`,\r"
			 . "count(if($pom AND $respon,'POM1',null)) `tPOM`,\r"
			 . "(format ((count(if($pom AND $respon,'POM1',null)) / count(*)) * 100, 2))`t%POM`,\r";
		## baki borang 
		$baki = "(format ( \r"
			 . "	count(if($pjb,'PJB',null)) -\r"
			 . "	count(if($pjb AND $respon,'xPJB',null)),0)\r"
			 . ")`bPJB`,\r"
			 . "(format ( \r"
			 . "	((count(if($pjb,'PJB',null)) -\r"
			 . "	count(if($pjb AND $respon,'xPJB',null)))\r"
			 . "	/ count(*)) * 100,2)\r"
			 . ")`b%PJB`,\r"
			 . "(format ( \r"
			 . "	count(if($pok,'POK',null)) -\r"
			 . "	count(if($pok AND $respon,'xPOK',null)), 0)\r"
			 . ")`bPOK`,\r"
			 . "(format ( \r"
			 . "	((count(if($pok,'POK',null)) -\r"
			 . "	count(if($pok AND $respon,'xPOK',null)))\r"
			 . "	/ count(*)) * 100,2)\r"
			 . ")`b%POK`,\r"
			 . "(format ( \r"
			 . "	count(if($pom,'POM',null)) -\r"
			 . "	count(if($pom AND $respon,'xPOM',null)), 0)\r"
			 . ")`bPOM`,\r"
			 . "(format ( \r"
			 . "	((count(if($pom,'POM',null)) -\r"
			 . "	count(if($pom AND $respon,'xPOM',null)))\r"
			 . "	/ count(*)) * 100,2)\r"
			 . ")`b%POM`\r";

		return $medan . $rangka . $mko . $terima . $baki;
	}
#----------------------------------------------------------------------------------------------------------------------
#==========================================================================================
}