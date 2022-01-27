<?php
include 'config.php';
class sessionManager 
{
    /* 1. session olusturma
     * 2. session silme
     * 3. session giris kontrol
     * 4. kullanici bilgilerini
     */
    static function sessionOlustur($array=[])
    {
        if(count($array)!=0)
        {
            foreach ($array as $key => $value)
            {
                $_SESSION[$key]=$value;
            }
        }

    }

    static function sessionSil()
    {
        session_destroy();
    }

    public function kontrol()
    {
        if(isset($_SESSION['email']) and isset($_SESSION['sifre']))
        {
            $email = strip_tags($_SESSION['email']);
            $sifre = strip_tags($_SESSION['sifre']);
            /*
            $control = $this->db->prepare(statement:"select * from kullanici where email=: email and sifre =: sifre " );
            $control->bindParam(':email',$email,PDO::PARAM_STR);
            $control->bindParam('sifre',$sifre, PDO::PARAM_STR);
            */

            /*$connection = new PDO("mysql:host=localhost;dbname=projeeee", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

            /*$control = $connection->prepare("SELECT * FROM kullanici WHERE email = :email AND sifre = :sifre ");*/
            if (!empty($connection)) {
                $control = $connection->prepare("select * from kullanici where email = :email and sifre = :sifre");
            }
            $control->bindParam(":email",$email,PDO::PARAM_STR);
            $control->bindParam(":sifre",$sifre, PDO::PARAM_STR);
            $control->execute();
            $sayi = $control->rowCount();
            if($sayi ==0)
            {
                return false;
            }
            else
            {
                return true;
            }

        }
        else
        {
            return false;
        }
    }

    public function kullaniciBilgi()
    {
        if($this->kontrol())
        {
            /*
            $sorgu=this->db->prepare(statement: " select * from kullanici where email=: email and sifre=:sifre");
            */

            /*
            $dbhost = "localhost";
            $dbusername = "DataBase Username";
            $dbpassword = "DataBase Password";
            $dbname = "veritabaniadi";
            */

            /*$connection = new PDO("mysql:host=localhost;dbname=projeeee", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

            //$sorgu = $connection->prepare("SELECT * FROM `kullanici` WHERE `email` = :email AND `sifre` = :sifre ; ");
            if (!empty($connection)) {
                $sorgu = $connection->prepare("select * from kullanici where email = :email and sifre = :sifre");
            }
            $sorgu->bindParam('email',$_SESSION["email"], PDO::PARAM_STR);
            $sorgu->bindParam('sifre',$_SESSION["sifre"], PDO::PARAM_STR);
            $sorgu->execute();
            return $sorgu->fetch(PDO:: FETCH_ASSOC);


        }
        else
        {
            return false;
        }
    }
}
