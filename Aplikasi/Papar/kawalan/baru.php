<?php 
if (isset($this->cariApa) ): 
	if($this->cariApa == 'sudah wujud dalam jadual'):
?><h1 align="center"><?php echo $this->cariApa . ' ' . $this->_jadual ?></h1>
<h2 align="center">Tutup dan kembali ke menu batch tadi</h2><?php
	else:
		$mencari = URL . 'kawalan/ubahCari/';
		$carian = null;
		$mesej = '::tiada dalam ' . $this->_jadual;
		$html = new Aplikasi\Kitab\Html;
		
		echo "\n";?><h1 align="center">Rangka Baru<?=$mesej?></h1>
<?php $mencari2 = URL . 'rangkabaru/tambahSimpan/'; ?>
<form method="POST" action="<?php echo $mencari2 ?>"
class="form-horizontal">
<?php include 'papar_jadual_berulang.php'; ?>
	<div class="form-group">
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
endif; ?>