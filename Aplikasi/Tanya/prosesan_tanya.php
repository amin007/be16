<?php
namespace Aplikasi\Tanya; //echo __NAMESPACE__; 
class Prosesan_Tanya extends \Aplikasi\Kitab\Tanya
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
	
	public function tatasusunanCariID($jadual, $medan, $cari, $susun) 
	{
		# ada nilai
		$hasil = array ( '0' => array (
				'newss' => '000000123654',
				'ssm' => 'fulan@mail.com',
				'nama' => 'Fulan Bin Fulan',
				'operator' => 'Fulan2 Bin Fulan2',
				'alamat' => 'no 1000, ' . "\r" 
					. 'jalan 2000, ' . "\r" 
					. 'taman 3000 ' . "\r" 
					. 'poskod 40000',
				));
		
		# tiada nilai
		$hasil2 = array();
		
		# pulangkan pemboleubah
		return $hasil;
	}

	public function tatasusunanCariMFG($jadual, $medan, $cari, $susun) 
	{
		# ada nilai
		$hasil = array ( '0' => array (
				'newss' => '000000123654',
				'ssm' => 'fulan@mail.com',
				'nama' => 'Fulan Bin Fulan',
				'operator' => 'Fulan2 Bin Fulan2',
				'kumpulanIndustri' => 'MFG',
				'terimaProsesan' => 'J001',
				));
		
		# tiada nilai
		$hasil2 = array();
		
		# pulangkan pemboleubah
		return $hasil;
	}

	public function tatasusunanCariPPT($jadual, $medan, $cari, $susun) 
	{
		# ada nilai
		$hasil = array ( '0' => array (
				'newss' => '000000123654',
				'ssm' => 'fulan@mail.com',
				'nama' => 'Fulan Bin Fulan',
				'operator' => 'Fulan2 Bin Fulan2',
				'kumpulanIndustri' => 'PPT',
				'hantar_prosesan' => 'J001',
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
			. 'concat_ws(" ",alamat,poskod,bandar) as alamat,' . "\r"
			//. 'concat_ws(" ",no,batu,( if (jalan is null, "", concat("JALAN ",jalan) ) ),tmn_kg,poskod,dp_baru) alamat_baru,' . "\r"
			. 'tel,notel,fax,nofax,responden,orang,email,esurat,'
			. 'hasil,belanja,gaji,aset,staf,stok' . "\r" 
			. '';
		
		# pulangkan pemboleubah
		return $senaraiMedan;
	}	
#==========================================================================================
	public function medanProsesan($cariID) 
	{ 
		$news1 = 'http://sidapmuar/ekonomi/ckawalan/ubah/' . $cariID;
		$news2 = 'http://sidapmuar/ekonomi/cprosesan/ubah/000/'  . $cariID . '/2010/2015/'; 
		$news3 = 'http://sidapmuar/ekonomi/semakan/ubah/",kp,"/' . $cariID . '/2010/2015/'; 
		$url1 = '" <a target=_blank href=' . $news1 . '>SEMAK 1</a>"';
		$url2 = '" <a target=_blank href=' . $news2 . '>SEMAK 2</a>"';
		$url3 = 'concat("<a target=_blank href=' . $news3 . '>SEMAK 3</a>")';
        $medanKawalan = 'newss,'
			. 'concat_ws("|",nama,operator,' . $url1 . ',' . $url3 .') nama,'
			. 'concat_ws(" | ",nossm,kp,subsektor) as nossm,' . "\r"
			. 'concat_ws(" | ",nobatch,feprosesan) as pegawai,' . "\r"
			//. 'mko,respon,nota,nota_prosesan,batchProses,'
			//. 'lawat,terima,hantar,hantar_prosesan,' . "\r" 
			. 'concat_ws(" ",alamat,poskod,bandar) as alamat,' . "\r"
			//. 'no,batu,jalan,tmn_kg,dp_baru,' . "\r"
			//. 'concat_ws(" ",no,batu,( if (jalan is null, "", concat("JALAN ",jalan) ) ),tmn_kg,poskod,dp_baru) alamat_baru,' . "\r"
			. 'concat_ws("-",kp,msic2008) msic2008,' 
			. 'concat_ws("-",kp,msic2008) keterangan,' 
			//. 'concat_ws("=>ngdbbp baru=",ngdbbp,ngdbbp_baru) ngdbbp,ngdbbp_baru,' . "\r"
			//. 'batchAwal,dsk,mko,batchProses,'
			/*. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," orang",orang_a),' . "\r"			
			. ' 	concat_ws("="," tel",notel_a),' . "\r"
			. ' 	concat_ws("="," fax",nofax_a),' . "\r"
			. ' 	concat_ws("="," responden",responden),' . "\r"
			. ' 	concat_ws("="," notel",notel),' . "\r"
			. ' 	concat_ws("="," nofax",nofax)' . "\r"
 			. ' ) as dataHubungi,'			
			. 'notel_a,notel,nofax_a,nofax,orang_a,responden,esurat_a,email,'//*/
			. 'respon,nobatch,feprosesan,'
			. 'if (hasil is null, "", '
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," hasil",format(hasil,0)),' . "\r"
			. ' 	concat_ws("="," belanja",format(belanja,0)),' . "\r"
			. ' 	concat_ws("="," gaji",format(gajiupah,0)),' . "\r"
			. ' 	concat_ws("="," aset",format(hartatetap,0)),' . "\r"
			. ' 	concat_ws("="," staf",format(bilpekerja,0)),' . "\r"
			. ' 	concat_ws("="," stok akhir",format(stokakhir,0))' . "\r"
 			. ' )) as data5P,'
			. 'hasil,belanja,gajiupah,bilpekerja,bilpekerja,stokakhir,'
			. '';	
	
		# buang koma di akhir string
		$medanKawalan = substr($medanKawalan, 0, -1);
		//$medanKawalan = rtrim($medanKawalan,',');;
		
		# pulangkan pemboleubah		
		return $medanKawalan;
	}
#==========================================================================================
}