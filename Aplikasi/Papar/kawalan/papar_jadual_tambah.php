	<table border="1" class="excel" id="example">
	<?php
	$printed_headers = false; # mula bina jadual
	#-----------------------------------------------------------------
	for ($kira=0; $kira < count($row); $kira++)
	{	
		if ( !$printed_headers ) # papar tajuk medan sekali sahaja: 	
		{
			?><thead><tr><th><?php echo $myTable ?></th><?php
			foreach ( array_keys($row[$kira]) as $tajuk ) 
			{	
				?><th><?php echo $tajuk ?></th><?php
			}
			?></tr></thead>
	<?php	$printed_headers = true; 
		} 
	# papar data $row ------------------------------------------------
	?><tbody><tr><td><?php echo $kira+1 ?></td><?php
		echo $tabline = "\n\t\t";
		foreach ( $row[$kira] as $key=>$data ) 
		{	
			echo $html->tambah1Input(null,$this->_jadual,$kira, $key, $data);
		} 
		?></tr></tbody>
	<?php
	}#-----------------------------------------------------------------
	?>
	</table>
