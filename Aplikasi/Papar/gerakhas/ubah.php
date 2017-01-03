<style>
.floating-menu {
padding: 5px;;
width: 300px;
z-index: 100;
position: fixed;
bottom: 0px;
right: 0px;
}
</style>
<?php 
/*echo '<pre>';
echo '$this->senarai:<br>'; print_r($this->senarai); 
echo '<br>$this->cariID:'; print_r($this->cariID); 
echo '<br>$this->cariApa:'; print_r($this->cariApa); 
echo '</pre>'; //*/

if(isset($this->senarai['data'][0]['newss'])):
	# set pembolehubah
	$mencari = URL . 'gerakhas/ubahCari/';
	$carian = $this->cariID;
	$mesej = ''; //$carian .' ada dalam ' . $this->_jadual;
	list($namaSyarikat, $semak1, $semak3) = explode("|", $this->senarai['data'][0]['nama']);
	?><nav class="floating-menu">
	<p class="bg-primary">
	<?php echo "\n&nbsp;" . $namaSyarikat ?>
	</p></nav>
	<?php
else: # set pembolehubah
	$mencari = URL . 'gerakhas/ubahCari/';
	$carian = null;
	$mesej = '::' . $this->cariID . ' tiada dalam ' . $this->_jadual;
endif;
//echo '<div align="center">' . $mencari . '</div>'; ?>
<div align="center">
<form method="GET" action="<?=$mencari;?>" class="form-inline" autocomplete="off">
<div class="form-group">
	<h1>Ubah gerakhas<?=$mesej?>
	<div class="input-group">
		<input type="text" name="cari" class="form-control" value="<?=$carian;?>" 
		id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
		<span class="input-group-addon">
			<input type="submit" value="mencari">
		</span>
	</div>
	</h1>
</div>
<div class="suggestionsBox" id="suggestions" style="display: none;">
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div><br>
<?php 
if ($this->cariApa=='[tiada id diisi]')
    echo 'data kosong<br>';
elseif(!isset($this->senarai['data'][0]['newss']))
	echo 'data kosong juga<br>';
else # $this->carian=='ada' - mula 
{ 	$mencari2 = URL . 'gerakhas/ubahSimpan/' . $this->cariApa; ?>
	<form method="POST" action="<?php echo $mencari2 ?>"
	class="form-horizontal"><?php
	$html = new Aplikasi\Kitab\Html;
	foreach ($this->senarai as $myTable => $row)
	{# mula ulang $row
		for ($kira=0; $kira < count($row); $kira++)
		{# print the data row // <button type="button" class="btn btn-info">Info</button>
		#----------------------------------------------------------------------------
		foreach ($row[$kira] as $key=>$data): echo "\n\t\t";
			?><div class="form-group">
			<label for="input<?php echo $key 
			?>" class="col-sm-2 control-label"><?php echo $key ?></label>
			<div class="col-sm-6">
			<?php echo $html->cariInput($this->_paparSahaja,$this->_jadual,$kira, $key, $data);
			echo "\n\t\t\t"; ?></div>
		</div><?php 
		endforeach;
		}# final print the data row
		#----------------------------------------------------------------------------
	}# tamat ulang $row
	echo "\n\t\t";
	if(isset($this->senarai['data'][0]['newss'])):
	?><div class="form-group">
			<label for="inputSubmit" class="col-sm-3 control-label"><?=$this->_jadual?></label>
			<div class="col-sm-6">
				<input type="hidden" name="jadual" value="<?=$this->_jadual?>">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary btn-large">
				<?php //echo $mencari2 ?>
			</div>
		</div>	
	</form>
	<hr><?php 
	endif;
} # $this->carian=='ada' - tamat 
//*/
?><?php
