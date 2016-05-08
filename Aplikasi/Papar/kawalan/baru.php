<?php 
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = null;
	$mesej = '::tiada dalam ' . $this->_jadual;
	$html = new Aplikasi\Kitab\Html;
?>
<h1 align="center">Rangka Baru<?=$mesej?></h1>
<?php $mencari2 = URL . 'rangkabaru/tambahSimpan/'; ?>
	<form method="POST" action="<?php echo $mencari2 ?>"
	class="form-horizontal">
<?php 
if (isset($this->cariApa) ):
	include 'papar_jadual_berulang.php'; ?>
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
endif; ?>