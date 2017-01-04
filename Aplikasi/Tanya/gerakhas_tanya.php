<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Gerakhas_Tanya extends \Aplikasi\Kitab\Tanya
{
#==========================================================================================
	public function __construct()
	{
		parent::__construct();
	}

	public function medanUbah2($cariID)
	{
		$senaraiMedan = 'newss,nama,email,nohp';

		return $hasil; # pulangkan pembolehubah
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

		$hasil2 = array(); # tiada nilai

		return $hasil; # pulangkan pembolehubah
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

		$hasil2 = array(); # tiada nilai

		return $hasil; # pulangkan pembolehubah
	}
#==========================================================================================
	public function medanUbah($cariID) 
	{ 
		$news1 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/ckawalan/ubah/' . $cariID;
		$namaS = $cariID . '/2010/2015/cetak/",replace(nama,\' \',\'-\'),"';
		$news2 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/cprosesan/ubah/",kp,"/' . $namaS;
		$news3 = 'http://' . $_SERVER['SERVER_NAME'] . '/ekonomi/semakan/ubah/",kp,"/' . $cariID . '/2010/2015/';
		$url1 = '" <a target=_blank href=' . $news1 . '>SEMAK 1</a>"';
		//$url2 = '" <a target=_blank href=' . $news2 . '>SEMAK 2</a>"';
		$url2 = 'concat("<a target=_blank href=' . $news2 . '>SEMAK 2</a>")';
		$url3 = 'concat("<a target=_blank href=' . $news3 . '>SEMAK 3</a>")';
        $medanKawalan = 'newss,'
			. 'concat_ws("|",nama,operator,' . $url1 . ',' . $url2 . ',' . $url3 . ') nama,'
			. 'concat_ws(" | ",nossm,kp,subsektor) as nossm,' . "\r"
			. 'concat_ws(" | ",borang,fe,pegawai) as pegawai,fe,' . "\r"
			. 'respon,nota,'
			. 'lawat,terima,hantar,' . "\r" 
			. 'concat_ws(" ",alamat1,alamat2,poskod,bandar, NGDBBP_CODE_A) as alamat,' . "\r"
			//. 'no,batu,jalan,tmn_kg,dp_baru,' . "\r"
			//. 'concat_ws(" ",no,batu,( if (jalan is null, "", concat("JALAN ",jalan) ) ),tmn_kg,poskod,dp_baru) alamat_baru,' . "\r"
			. 'concat_ws("-",kp,msic2008) msic2008,' 
			//. 'concat_ws("-",kp,msic2008) keterangan,' 
			//. 'concat_ws("=>ngdbbp baru=",ngdbbp,ngdbbp_baru) ngdbbp,ngdbbp_baru,' . "\r"
			//. 'batchAwal,dsk,mko,batchProses,'
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
			. '"" as pecah5P,hasil,belanja,gaji,aset,staf,stok,'
			. '';

		# buang koma di akhir string
		$medanKawalan = substr($medanKawalan, 0, -1);
		//$medanKawalan = rtrim($medanKawalan,',');;

		# pulangkan pemboleubah
		return $medanKawalan;
	}

	public function semakPosmen($rangka, $posmen)
	{
		$nilaiRM = array('hasil','belanja','gaji','aset','staf','stok');
		# valid guna gelung foreach
		foreach ($nilaiRM as $keyRM) # $nilaiRM rujuk line 154
		{# kod php untuk formula matematik
			$data = null;
			if(isset($posmen[$rangka][$keyRM])):
				@eval( '$data = (' . $posmen[$rangka][$keyRM] . ');' );
				$posmen[$rangka][$keyRM] = $data;
			endif;
		}//*/
		$nilaiTEKS = array('no','batu','jalan','tmn_kg','respon','posdaftar');
		foreach ($nilaiTEKS as $keyTEKS)
		{# kod php untuk besarkan semua huruf aka uppercase
			if(isset($posmen[$rangka][$keyTEKS])):
				$posmen[$rangka][$keyTEKS] = strtoupper($posmen[$rangka][$keyTEKS]);
			endif;
		}//*/ # valid guna if
		if (isset($posmen[$rangka]['fe']))
		{
			$posmen[$rangka]['fe'] = str_replace(' ', '-', $posmen[$rangka]['fe']);
			$posmen[$rangka]['fe'] = strtolower($posmen[$rangka]['fe']);
		}
		if (isset($posmen[$rangka]['email']))
			$posmen[$rangka]['email'] = strtolower($posmen[$rangka]['email']);
		if (isset($posmen[$rangka]['responden']))
			$posmen[$rangka]['responden'] = mb_convert_case($posmen[$rangka]['responden'], MB_CASE_TITLE);
		/*if (isset($posmen[$rangka]['dp_baru']))
			$posmen[$rangka]['dp_baru']=ucwords(strtolower($posmen[$rangka]['dp_baru']));//*/

		# pulangkan pemboleubah
		return $posmen;
	}
#==========================================================================================
	public function binaPOST() 
	{ 
		# Set pemboleubah tatasusunan
		$medan[] = array('newss'=>'000123456',
			'nossm'=>null,
			'CHECK_DIGIT'=>null,
			'nama'=>'Biar Rahsia',
			'operator'=>'',
			'alamat1'=>'',
			'alamat2'=>'',
			'bandar'=>'',
			'poskod'=>'',
			'kp'=>'328',
			'msic2008'=>'56107',
			'fe'=>'x');

		# pulangkan pemboleubah
		return $medan;
	}

	public function binaMedan($jadual, $kira) 
	{ 
		# Set pemboleubah tatasusunan
		$medan = array('newss','nossm','CHECK_DIGIT','nama','operator','alamat1','alamat2','bandar','poskod',
			'kp','msic2008','fe','orang_a','notel_a','nofax_a','esurat_a');

		for ($ulang = 0; $ulang < $kira; $ulang++):
			foreach ($medan as $key2 => $nilai2):
				$senaraiMedan[$jadual][$ulang][$nilai2] = null;
			endforeach;
		endfor;

		# pulangkan pemboleubah
		return $senaraiMedan;
	}

	public function semakPost($myTable, $senarai, $post)
	{
		# validasi data $_POST, masuk dalam $posmen, validasi awal
		foreach ($post as $myTable => $value)
			if ( in_array($myTable,$senarai) )
				foreach ($value as $key => $value2)
					foreach ($value2 as $kekunci => $papar)
						$posmen[$myTable][$key][$kekunci] = bersih($papar);

		# pulangkan pemboleubah
		return $posmen;
	}

	public function ubahPosmen($posmen)
	{
		$senaraiData = array();
		foreach ($posmen as $key => $value1):
			foreach ($value1 as $key2 => $dataS):
				$senaraiData[] = "('" 
					. ($dataS['newss']) . "', '" 
					. huruf('Besar',$dataS['nossm']) . "', '" 
					. huruf('Besar',$dataS['CHECK_DIGIT']) . "', '" 
					. huruf('Besar',$dataS['nama']) . "', '" 
					. huruf('Besar',$dataS['operator']) . "', '" 
					. huruf('Besar',$dataS['alamat1']) . "', '" 
					. huruf('Besar',$dataS['alamat2']) . "', '" 
					. huruf('Besar',$dataS['bandar']) . "', '" 
					. ($dataS['poskod']) . "', '" 
					. ($dataS['kp']) . "', '" 
					. ($dataS['msic2008']) . "', '" 
					. huruf('kecil',$dataS['fe']) . "', '" 
					. huruf('Besar',$dataS['orang_a']) . "', '" 
					. huruf('Besar',$dataS['notel_a']) . "', '" 
					. huruf('Besar',$dataS['nofax_a']) . "', '" 
					. huruf('Besar',$dataS['esurat_a'])// . "', '"
					. "')";
			endforeach;
		endforeach;

		# pulangkan pemboleubah
		return $senaraiData;
	}

	public function panggilFail($url, $fail)
	{
		# Set pemboleubah utama
		//echo $url . $fail . '<hr>';
		$posmen = (new \Aplikasi\Kitab\Bacafail)->semakfail($url, $fail, array());
		$medan = $this->panggilMedan($posmen);
		list($dataProksi,$dataAsal) = $this->panggilPDOData($posmen);

		//echo '<pre>$medan = '; print_r($medan); echo '</pre><hr>';
		//echo '<pre>$dataAsal = '; print_r($dataAsal); echo '</pre><hr>';
		//echo '<pre>$dataProksi = '; print_r($dataProksi); echo '</pre><hr>';

		# jika null
		$medan2 = $senaraiData1 = $senaraiData2 = null;

		# pulangkan pemboleubah
		return array($medan,$dataProksi,$dataAsal);
		//return array($medan2,$senaraiData1,$senaraiData2);
	}

	private function panggilMedan($posmen)
	{
		$medan = '`' . implode("`,`", $posmen[0]) . '`'; # buat medan
		//echo '$medan = ' . $medan . '<hr>';

		return $medan; # pulangkan pembolehubah
	}

	private function panggilBanyakData($posmen, $dataS = array())
	{
		foreach($posmen as $key=>$key1):
				if($key!=0)
					$dataS[$key] = '(`' . implode("`,`", $posmen[$key]) . '`)';
		endforeach;//endforeach;

		$dataAsal = implode(",\r", $dataS); # cantum dataS
		//echo '<pre>$posmen = '; print_r($posmen); echo '</pre><hr>';
		//echo '<pre>$dataS = '; print_r($dataS); echo '</pre><hr>';

		return $dataAsal; # pulangkan pembolehubah
	}

	private function panggilPDOData($posmen)
	{
		$dataK = $dataS = array();

		foreach($posmen as $key=>$key1):
			foreach($key1 as $kunci=>$data):
				$namaMedanDaa = $posmen[0][$kunci] . '' . $key;
				if($key!=0)
				{
					$dataK1[] = ':' . $namaMedanDaa;
					$dataS[$namaMedanDaa] = '' . $posmen[$key][$kunci];
				}
			endforeach;
				if($key!=0)
					$dataK2[] = '(' . implode(',', $dataK1) . ')'; # cantum dataK
				$dataK1 = array();
		endforeach;

		//echo '<pre>$dataK2 = '; print_r($dataK2); echo '</pre><hr>';
		//echo '<pre>$dataS = '; print_r($dataS); echo '</pre><hr>';

		return array($dataK2,$dataS); # pulangkan pembolehubah
	}
#==========================================================================================
}