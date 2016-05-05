<?php 
/*echo '<pre>';
echo '$this->kawalan:<br>'; print_r($this->kawalan); 
echo '$this->cariIndustri:<br>'; print_r($this->cariIndustri); 
echo '$this->cari:<br>'; print_r($this->cari); 
echo '</pre>'; //*/

if(isset($this->kawalan['kes'][0]['newss'])):
	// set pembolehubah
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = $this->cari;
	$mesej = '';//$carian .' ada dalam ' . $this->_jadual;
else:	// set pembolehubah
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = null;
	$mesej = '::' . $this->cari .' tiada dalam ' . $this->_jadual;
endif;?>
<h1>Ubah Kawalan<?=$mesej?></h1>
<div align="center"><form method="GET" action="<?=$mencari;?>" class="form-inline" autocomplete="off">
<div class="form-group"><div class="input-group">
	<input type="text" name="cari" class="form-control" value="<?=$carian;?>" 
	id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
	<span class="input-group-addon">
	<input type="submit" value="mencari">
	</span>
</div></div>
<div class="suggestionsBox" id="suggestions" style="display: none;">
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div><br>
<?php 
if ($this->carian=='[tiada id diisi]')
{
    echo 'data kosong<br>';
}
else
{ # $this->carian=='sidap' - mula ?>
	<form method="POST" action="<?php echo URL ?>kawalan/ubahSimpan/<?php echo $this->cari; ?>"
	class="form-horizontal"><?php
	$html = new Aplikasi\Kitab\Html;
	foreach ($this->kawalan as $myTable => $row)
	{# mula ulang $row
		for ($kira=0; $kira < count($row); $kira++)
		{# print the data row // <button type="button" class="btn btn-info">Info</button>
		#----------------------------------------------------------------------------
		foreach ($row[$kira] as $key=>$data): echo "\n\t\t";
			if (in_array($key,array('no','batu','jalan','tmn_kg','dp_baru','respon3')) 
				&& Sesi::get('namaPegawai')!='amin'): echo '';
			else:?><div class="form-group">
			<label for="input<?php echo $key 
			?>" class="col-sm-2 control-label"><?php echo $key ?></label>
			<div class="col-sm-6">
			<?php echo $html->cariInput($this->_cariIndustri,$this->_jadual,$kira, $key, $data);
			echo "\n\t\t\t"; ?></div>
		</div><?php 
			endif;
		endforeach;
		}# final print the data row
		#----------------------------------------------------------------------------
	}# tamat ulang $row
	echo "\n\t\t";
	if(isset($this->kawalan['kes'][0]['newss'])):
	?><div class="form-group">
			<label for="inputSubmit" class="col-sm-3 control-label"><?=$this->_jadual?></label>
			<div class="col-sm-6">
				<input type="hidden" name="jadual" value="<?=$this->_jadual?>">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary btn-large">
			</div>
		</div>	
	</form>
	<hr><?php 
	endif;
} // $this->carian=='sidap' - tamat ?><?php
/*
    $s1 = '<span class="label">';
    $s2 = '</span>'; 
    # isytihar pembolehubah untuk sistem sms
	if(isset($this->kawalan['kes'][0]['newss'])):
		$newss = $this->kawalan['kes'][0]['newss'];
		$sykt  = urlencode($this->kawalan['kes'][0]['nama']);
		$kawan = urlencode($this->kawalan['kes'][0]['fe']);
		$hantar_sms = URL . 'pengguna/smskes/' . $kawan . '/' . $sykt;
	endif;
*/