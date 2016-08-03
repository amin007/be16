<?php 
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = null;
	$mesej = '::tiada dalam ' . $this->_jadual;
	$html = new Aplikasi\Kitab\Html;
 
if (isset($this->cariApa) ):
	if($this->cariApa == 'sudah wujud dalam jadual'):
		$k1 = URL . 'operasi/batch/' . $this->cariID;
		//$btn =  $merah;
		$a = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Tambah2';

		$nota = ''
			. $this->cariApa . ' ' . $this->_jadual
			. '<br>' . $k1
			//. '<a target="_blank" href="' . $k1 . '">' . $a . '</a>'
			. '';

		echo $nota;
	else:
?>		
<h1 align="center">Rangka Baru<?=$mesej?></h1>
<?php $mencari2 = URL . 'rangkabaru/tambahSimpan/'; ?>
	<form method="POST" action="<?php echo $mencari2 ?>"
	class="form-horizontal"><?php include 'papar_jadual_berulang.php'; ?>
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