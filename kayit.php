<?php
include 'header.php';
include 'helper.php';
include 'config.php';
include 'sessionManager.php';
if($_POST)
{
    $isim = strip_tags($_POST['isim']);
    $soyisim = strip_tags($_POST['soyisim']);
    $email = strip_tags($_POST['email']);
    $sifre = strip_tags($_POST['sifre']);
    $cinsiyet = strip_tags($_POST['cinsiyet']);
    if($isim !="" and $soyisim!="" and $email!="" and $sifre!="")
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
       {
            if (!empty($connection)) {
                $control=$connection->prepare(" select * from kullanici where email=:email");
            }
            $control->bindParam(":email",$email, PDO::PARAM_STR);
            $control->execute();
            $sayi= $control->rowCount();
            if($sayi==0){
                $sorgu=$connection->prepare("insert into kullanici(isim,soyisim,email,sifre,cinsiyet)values('$isim','$soyisim','$email','$sifre','$cinsiyet')");
                $ekle=$sorgu->execute();
                if($ekle){
                    $dizi = ["email"=>$email,"sifre"=>md5($sifre)];
                    sessionManager::sessionOlustur($dizi);
                    helper::yonlendir("http://streameet.epizy.com/Uyegirisi.html"); /*Yönledirilecek sayfa seçilmeli*/
                }
                else{

                    echo "üzgünüm kayıt olamadın";
                }
            }
           else{
                echo 'Bu kullanıcı veritabanında mevcut';
           }
         echo 'Email formatı dogru';

        }
        else
        {
            echo 'Email formati hatalı';
        }
    }
    else
    {
        echo 'Lütfen tüm Alanları Doldur';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&family=Barlow+Condensed:wght@100&family=Bebas+Neue&family=Comic+Neue:wght@300&family=Fruktur&family=Mochiy+Pop+One&family=Nunito:wght@200&family=Playfair+Display&family=Source+Sans+3:wght@200;400&display=swap" rel="stylesheet">

    <title>Üye Ol</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<link rel="stylesheet" href="style.css" />
<title>StreaMeet</title>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="ikon" src="ikon.jpeg">
    <a id="baslık" class="navbar-brand" href="bootstrap.html">StreaMeet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a id="home"class="nav-link" href="Uyeol.html">Üye Ol <span class="sr-only">(current)</span></a>
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
<h2>ÜYE OL</h2>
<form method="post" action="kayit.php">
    <div class="row">
        <div class="col">
            <label for="formGroupExampleInput1" class="form-label">İsim</label>
            <input type="text" class="form-control" name="isim" id="formGroupExampleInput1" placeholder="İsim" aria-label="isim">
        </div>
        <div class="col">
            <label for="formGroupExampleInput2" class="form-label">Soyisim</label>
            <input type="text" class="form-control" name="soyisim" id="formGroupExampleInput2" placeholder="Soyisim" aria-label="soyisim">
        </div>
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput3" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="formGroupExampleInput3" placeholder="Email">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput4" class="form-label">Şifre</label>
        <input type="password" class="form-control" name="sifre" id="formGroupExampleInput4" placeholder="Şifre">
    </div>

    <label for="formGroupExampleInput5" class="form-labelcinsiyet">Cinsiyet</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="cinsiyet" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
            Kadın
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="cinsiyet" id="flexRadioDefault2" checked>
        <label class="form-check-label" for="flexRadioDefault2">
            Erkek
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="cinsiyet" id="flexRadioDefault3" checked>
        <label class="form-check-label" for="flexRadioDefault2">
            Diğer
        </label>
    </div>


    <div class="row mb-3">
        <button type="submit" class="btn btn-outline-success">Kayıt Ol</button>
    </div>
    <br>
    <br>
</form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
