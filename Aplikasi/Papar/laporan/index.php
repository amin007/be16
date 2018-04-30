<style type="text/css">
table.librecalc {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:11px;
}
table.librecalc thead th, table.librecalc tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align: top;
}
table.librecalc tbody th { text-align:center; vertical-align: top; }
table.librecalc tbody td { vertical-align:bottom; }
table.librecalc tbody td 
{ 
	padding: 0 3px; border: 1px solid #aaaaaa;
	background:#ffffff;
}
</style>
<?php
//echo '$this->cariNama:'; print_r($this->cariNama);
//echo '$fungsi=>' . $this->fungsi '<br>$url=>'. print_r($this->url);
?>
<ul class="nav nav-tabs">
<?php 
$url = URL . 'laporan/';
?>
<li><a href="<?php echo $url ?>bulanan" >bulanan</a></li>
<li><a href="<?php echo $url ?>daerah" >daerah</a></li>
<li><a href="<?php echo $url ?>fe" >fe</a></li>
<li><a href="<?php echo $url ?>a8" >a8</a></li>
<li><a href="<?php echo $url ?>limaUtama/murad" >limaUtama</a></li>
<li class="dropdown active">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->fungsi?> <b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li class="active"><a href="<?php echo $url ?>bulanan" data-toggle="tab">bulanan</a></li>
	<li><a href="<?php echo $url ?>daerah" data-toggle="tab">daerah</a></li>
	<li><a href="<?php echo $url ?>fe" data-toggle="tab">fe</a></li>
	<li><a href="<?php echo $url ?>a8" data-toggle="tab">a8</a></li>
	<li><a href="<?php echo $url ?>limaUtama/murad" data-toggle="tab">limaUtama</a></li>
	</ul>
</li>
</ul>
<!-- h1><span style="background-color:black;color:white">Laporan Operasi <?php //echo $myTable ?></span></h1 -->
<?php
foreach ($this->cariNama as $myTable => $row)
{// mula ulang $row
?>
<table border="1" class="librecalc" id="example">
<?php
// mula bina jadual
$printed_headers = false; 
#-----------------------------------------------------------------
for ($kira=0; $kira < count($row); $kira++)
{   //print the headers once:   
    if ( !$printed_headers ) : ?><thead><tr>
<th>#</th>
<?php    foreach ( array_keys($row[$kira]) AS $tajuk ) : 
        // anda mempunyai kunci integer serta kunci rentetan
        // kerana cara PHP mengendalikan tatasusunan.
            if ( !is_int($tajuk) ) :
                ?><th><?php echo $tajuk ?></th>
<?php       endif;
        endforeach; ?>
</tr></thead><?php
        $printed_headers = true; 
    endif;
#-----------------------------------------------------------------       
    //print the data row ?>
<tbody><tr>
<td><?php echo $kira+1 ?></td><?php
    foreach ( $row[$kira] AS $key=>$data ) : ?>
<td align="right"><?php echo $data ?></td><?php
    endforeach; ?>
</tr></tbody><?php
}#-----------------------------------------------------------------?>
</table>
<?php
}// tamat ulang $row
?>

<?php include 'jurujual_tengah_1.php'; ?>
