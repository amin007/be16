	<table border="1" class="excel" id="example">
	<?php
	// mula bina jadual
	$printed_headers = false; 
	#-----------------------------------------------------------------
	for ($kira=0; $kira < count($row); $kira++)
	{	//print the headers once: 	
		if ( !$printed_headers ) 
		{
			?><thead><tr><th><?php echo $myTable ?></th><?php
			foreach ( array_keys($row[$kira]) as $tajuk ) 
			{	// anda mempunyai kunci integer serta kunci rentetan
				// kerana cara PHP mengendalikan tatasusunan.

				if ($tajuk=='newss')  
				{	?><th>Tindakan</th><th><?php echo $tajuk ?></th><?php }
				else
				{	?><th><?php echo $tajuk ?></th><?php 	}
			}
			?></tr></thead>
	<?php
			$printed_headers = true; 
		} 
	#-----------------------------------------------------------------		 
		//print the data row 
		?><tbody><tr><td><?php echo $kira+1 ?></td><?php
		$html = new \Aplikasi\Kitab\Html;
		foreach ( $row[$kira] as $key=>$data ) 
		{	
			$html->paparURL($key, $data, $cariBatch);
		} 

		?></tr></tbody>
	<?php
	}
	#-----------------------------------------------------------------
	?>
	</table>
