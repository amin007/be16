<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Rangkabaru_Tanya extends \Aplikasi\Kitab\Tanya
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
	
	public function binaMedan($jadual, $kira, $data) 
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
	
	public function binaMedan2($jadual, $kira, $data) 
	{ 
		# papar tatasusunan $data
		if (!empty($data)) 
		{ 
			$data['data'][0]['alamat1'] = $data['data'][0]['alamat'];
			//echo '<hr><pre>$data:<br>'; print_r($data) . '</pre>'; 
			unset($data['data'][0]['alamat']);
		}
		else echo '<pre>$data:kosong</pre>'; //*/

		# Set pemboleubah tatasusunan
		$medan = array('newss','nossm','CHECK_DIGIT','nama','operator','alamat1','alamat2','bandar','poskod',
			'kp','msic2008','fe','orang_a','notel_a','nofax_a','esurat_a');

		for ($ulang = 0; $ulang < $kira; $ulang++):
			foreach ($medan as $key2 => $nilai2):	
				$senaraiMedan[$jadual][$ulang][$nilai2] = null;
			endforeach;
		endfor;
		
		# masukkan $data dalam $senaraiMedan berasaskan $jadual
		$senaraiMedan = (!empty($data)) ? $this->binaData($jadual, $data, $senaraiMedan) : $senaraiMedan;
		
		/*# papar tatasusunan $data
		if (!empty($senaraiMedan)) 
		{ echo '<hr><pre>$senaraiMedan Kini:<br>'; print_r($senaraiMedan) . '</pre>'; }
		else echo '<pre>$senaraiMedan:kosong</pre>'; //*/
		
		# pulangkan pemboleubah
		return $senaraiMedan;
	}

	public function binaData($jadual, $data, $senaraiMedan)
	{
		foreach ($data['data'][0] as $kunci => $n):	
			$senaraiMedan[$jadual][0][$kunci] = $data['data'][0][$kunci];
			//echo "<hr> senaraiMedan[$jadual][0][$kunci] = data['data'][0][$kunci] ";
		endforeach;	
		
		# pulangkan pemboleubah
		return $senaraiMedan; //*/
	}
	
	public function cariRangkaBaru() 
	{ 
		# Set pemboleubah tatasusunan
		//$medan = array('newss','nossm','CHECK_DIGIT','nama','operator','alamat1','alamat2','bandar','poskod',
		//	'kp','msic2008','fe','orang_a','notel_a','nofax_a','esurat_a');
		$medan = array('newss','nossm','nama','operator','alamat','bandar','poskod',
			'kp','msic2008');
		
		$senaraiMedan = implode(",", $medan);
		
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
		echo $url . $fail . '<hr>';
		$posmen = (new \Aplikasi\Kitab\Bacafail)->semakfail($url, $fail, array());
		$medan = $this->panggilMedan($posmen);
		$senaraiData = $this->panggilBanyakData($posmen);
		
		# jika null
		$medan2 = $senaraiData2 = null;
		
		# pulangkan pemboleubah
		return array($medan,$senaraiData);
		//return array($medan2,$senaraiData2);
	}

	private function panggilMedan($posmen)
	{
		$medan = '`' . implode("`,`", $posmen[0] ) . '`'; # buat medan
		//echo '$medan = ' . $medan . '<hr>';
		
		# pulangkan pemboleubah
		return $medan;

	}	
	
	private function panggilBanyakData($posmen)
	{	
		$dataS = array(); 
		foreach($posmen as $key=>$data):
			if($key!=0)
				$dataS[$key] = "('" . implode("','", $data ) . "')";
		endforeach; 
		//echo '<pre>$dataS = ' . $dataS . '</pre><hr>';
		
		# pulangkan pemboleubah
		return $dataS;

	}
#==========================================================================================
}
