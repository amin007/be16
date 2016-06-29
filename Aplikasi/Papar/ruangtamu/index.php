<div class="container">
<hr><h1>Ruangtamu - Kita Tanya Apa Khabar</h1><hr>
<div class="hero-unit">
<p><?php
$Sesi = new \Aplikasi\Kitab\Sesi();
$Sesi->init();
//echo '<pre>'; print_r($_SESSION) . '</pre>';
echo 'namaPegawai=' . $Sesi->get('namaPegawai') . '<br>';
echo 'namaPenuh=' . $Sesi->get('namaPenuh') . '<br>';
echo 'levelPegawai=' . $Sesi->get('levelPegawai') . '';//*/
?></p>

</div><!-- / class="hero-unit" -->
</div><!-- / class="container" -->

<?php //echo semakDataSesi(); ?>