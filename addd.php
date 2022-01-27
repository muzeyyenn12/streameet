
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>


    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&family=Barlow+Condensed:wght@100&family=Bebas+Neue&family=Comic+Neue:wght@300&family=Fruktur&family=Mochiy+Pop+One&family=Nunito:wght@200&family=Playfair+Display&family=Source+Sans+3:wght@200;400&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="style.css" />
    <title>StreaMeet</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="ikon" src="ikon.jpeg">
    <a id="baslık" class="navbar-brand" href="bootstrap.html">StreaMeet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a id="home" class="nav-link" href="Uyeol.html">Üye Ol <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a id="link" class="nav-link" href="Uyegirisi.html">Üye Girişi</a>
            </li>
            <li class="nav-item">
                <a id="link" class="nav-link" href="takvim.html">Takvim</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seçenekler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="toplantiolusturma.html">Toplantı Oluşturma</a>
                    <a class="dropdown-item" href="anketolusturma.html">Anket Oluşturma</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Ara" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
        </form>
    </div>
</nav>


<h3>ANKET OLUŞTUR</h3>
<?php
require_once 'config.php';
require_once 'helper.php';
if($_POST) {
    // ankete isim verme
    $name = strip_tags($_POST['name']);
    $yer = strip_tags($_POST["yer"]);
    $bsaati = strip_tags($_POST['bsaati']);
    $btarihi = strip_tags($_POST['btarihi']);
    $bitissaati = strip_tags($_POST['bitissaati']);
    $bitistarihi = strip_tags($_POST['bitistarihi']);

    $yorum = strip_tags($_POST["yorum"]);

    //$name="anket";
    //anket ekleme
    $tarih = date("Y-m-d");



    $db = new PDO ("mysql:host=localhost;dbname=ders;charset=utf8", "root", "");


    if ($name != "" and $yer != "" and $bsaati!="" and $btarihi!="" and $bitissaati!="" and $bitistarihi!="" and $yorum != "") {

        $surveySorgu = $db->prepare("insert into anket(name,yer,bsaati,btarihi,bitissaati,bitistarihi,yorum) values('$name','$yer','$bsaati','$btarihi','$bitissaati','$bitistarihi','$yorum') ");
        $surveySorgu->execute();
       // $surveyId = $db->rowCount();
        if ($surveySorgu) {
            helper::yonlendir('profil.html'); /*Yönledirilecek sayfa seçilmeli*/
        }
    }
}
?>
<form method="post" action="">
    <div class="row">
        <div class="col">
            <label for="formGroupExampleInput6" class="form-label">Anket Adı</label>
            <input type="text" class="form-control" name="name"  id="formGroupExampleInput6" placeholder="Anket adı giriniz" aria-label="Anket Adı">
        </div>

    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput12" class="form-label">Yer</label>
        <input type="text" class="form-control" name="yer"  id="formGroupExampleInput12" placeholder="Yeri giriniz">
        <label for="formGroupExampleInput9" class="form-label">Başlangıç Tarihi</label>
        <input type="date" class="form-control"name="btarihi" id="formGroupExampleInput9" placeholder="Tarihi giriniz">
        <label for="formGroupExampleInput8" class="form-label">Başlangıç Saati</label>
        <input type="time" class="form-control" name="bsaati" id="formGroupExampleInput8" placeholder="Saati giriniz">
        <label for="formGroupExampleInput11" class="form-label">Bitiş Tarihi</label>
        <input type="date" class="form-control" name="bitistarihi" id="formGroupExampleInput11" placeholder="Tarihi giriniz">
        <label for="formGroupExampleInput10" class="form-label">Bitiş Saati</label>
        <input type="time" class="form-control" name="bitissaati" id="formGroupExampleInput10" placeholder="Saati giriniz">
        <label for="formGroupExampleInput15" class="form-label">Not</label>
        <input type="text" class="form-control" name="yorum"  id="formGroupExampleInput15" placeholder="Not ekleyiniz (isteğe bağlı)">
    </div>

    <div class="row mb-3">
        <button type="submit" value="Olustur"  onclick="location.href='bootstrap.html'" class="btn btn-outline-success">Oluştur</button>
    </div>
    <br>
    <br>
</form>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
