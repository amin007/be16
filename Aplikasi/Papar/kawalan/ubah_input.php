<?php
// mula untuk kod php+html
function papar_jadual($row, $myTable, $pilih)
{
	if ($pilih == 2 && count($row) != 0)
    {	?><!-- Jadual <?php echo $myTable ?> ########################################### -->
		<span class="label label-success">Jadual <?php echo $myTable ?></span>
        <table class="table table-striped">
        <?php
        $printed_headers = false; ## mula bina jadual
        #-----------------------------------------------------------------
        for ($kira=0; $kira < count($row); $kira++)
        {##print the headers once:  
            if ( !$printed_headers )
            {	?><thead><tr>
        <th>#</th>
        <?php   foreach ( array_keys($row[$kira]) AS $tajuk ):
			?><th><?php echo $tajuk ?></th>
        <?php	endforeach; ?></tr></thead><?php
                $printed_headers = true;
            }#-----------------------------------------------------------------      
            ## print the data row ?>
            <tbody><tr>
            <td><?php echo $kira+1 ?></td>
            <?php foreach ( $row[$kira] as $key=>$data ) : ?>
            <td><?php echo $data ?></td><?php endforeach; ?>
        </tr></tbody>
		<?php
        }#-----------------------------------------------------------------
        ?></table><?php
    } 
}
// tamat untuk kod php+html 
/*
function cariInput($cariMSIC,$bulan,$kira,$key,$data)
{	# istihar pembolehubah 
	$name = 'name="' . $bulan . '[' . $key . ']"';
	$inputText = $name . ' value="' . $data . '"';
	$tabline = "\n\t\t\t\t\t";
	$tabline2 = "\n\t\t\t\t";
	//if ( in_array($key,array(...)) )
	if(in_array($key,array('nota','nota_prosesan')))
	{#kod utk textarea
		//$data2 = (empty($data) && $key == 'nota') ? "SSM | $data" : $data;
	    $input = '<textarea ' . $name . ' rows="1" cols="20"' . $tabline2 
			   . ' class="form-control">' . $data . '</textarea>'
			   . $tabline2 . '<pre>' . $data . '</pre>'
			   . '';
	}
	elseif(in_array($key,array('respon','respon2','msic08','batchAwal','batchProses','dsk','mko',
		'no','batu','jalan','tmn_kg','dp_baru','ngdbbp_baru')))
	{
	    $input = '<div class="input-group input-group-sm">' . $tabline
			   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
			   . '<input type="text" ' . $inputText 
			   . ' class="form-control input-sm">'
			   . $tabline2 . '</div>'
			   . '';
	}
	elseif(in_array($key,array('fe','notel','nofax','orang','esurat')))
	{
	    $input = '<div class="input-group input-group-sm">' . $tabline
			   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
			   . '<input type="text" ' . $inputText 
			   . ' class="form-control">'
			   . $tabline2 . '</div>'
			   . '';
	}
	elseif(in_array($key,array('hasil','belanja','staf','gaji','aset','stok')))
	{
	    $input = '<div class="input-group input-group-sm">' . $tabline
			   . '<span class="input-group-addon">Nilai MKO</span>'		
			   . '<input type="text" ' . $inputText 
			   . ' class="form-control">' . $tabline
			   . '<span class="input-group-addon">' . kira($data) . '</span>'
			   . $tabline2 . '</div>'
			   . '';
	}
	elseif(in_array($key,array('hasil2','belanja2','staf2','gaji2','aset2','stok2')))
	{
	    $input = '<div class="input-group input-group-sm">' . $tabline
			   . '<span class="input-group-addon">Nilai Muktamad</span>'
			   . '<input type="text" ' . $inputText 
			   . ' class="form-control">' . $tabline
			   . '<span class="input-group-addon">' . kira($data) . '</span>'
			   . $tabline2 . '</div>'
			   . '';
	}
	elseif ( in_array($key,array('lawat','terima','hantar','hantar_prosesan')) )
	{//terima - style="font-family:sans-serif;font-size:10px;"
		$tandaX = 'name="' . $bulan . '[' . $key . 'X]"';
		$dataX = ($key=='hantar_prosesan') ?
			'<input type="checkbox" ' . $tandaX . ' value="x">Utk Prosesan : ' . $data
			: '<input type="checkbox" ' . $tandaX . ' value="x">' . $data;
	    $input = '<div class="input-group input-group-sm">' . $tabline
			   . '<span class="input-group-addon">' . $dataX . '</span>' . $tabline
			   . '<input type="date" ' . $inputText //. 'class="input-date tarikh" readonly>'
			   . $tabline . ' class="form-control date-picker"'
			   . $tabline . ' placeholder="Cth: 2014-05-01"'
			   . $tabline . ' id="date' . $key . '" data-date-format="yyyy/mm/dd"/>'
			   . $tabline2 . '</div>'
			   . '';			   
	}	
	// bukan untuk input type
	elseif ( in_array($key,array('keterangan')) )
	{
		foreach ($cariMSIC as $myTable => $bilang)
		{// mula ulang $bilang
			papar_jadual($bilang, $myTable, $pilih=2);
		}// tamat ulang $bilang
		
		$input = null;
	}
	elseif ( in_array($key,array('alamat_baru')) )
	{
	    $input = '<blockquote>'
		       . '<p class="form-control-static text-info">' . $data . '</p>'
			   //. '<small>Alamat <cite title="Source Title">baru</cite></small>'
			   . '</blockquote>';
	}
	else
	{
	    $input = '<p class="form-control-static text-info">' . $data . '</p>';
	}
	
	// medan yang tak perlu dipaparkan
	$lepas = array('ssm','utama');
	echo (in_array($key,$lepas)) ? '' : "\t$input";
}

//*/