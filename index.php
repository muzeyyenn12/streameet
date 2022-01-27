<?php
include 'sessionManager.php';
include 'helper.php';
$sessionManager = new sessionManager();
if(!$sessionManager->kontrol())
{
    helper::yonlendir( "giris.php");

}$kBilgi = $sessionManager->kullaniciBilgi();

?>
<div class ="title">Merhaba <?php echo $kBilgi['isim'];?></div>
<div class="info">Ad Soyad : <?php echo  $kBilgi['isim'];?><?php echo $kBilgi['soyisim'];?></div>
<a href="/islemler/cikis.php">Çıkış</a>