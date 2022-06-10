<?php


		
    $filenameee =  $_FILES['file']['name'];
    $fileName = $_FILES['file']['tmp_name']; 
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $cetatenie = $_POST['cetatenie'];
    $localitate = $_POST['localitate'];
    $numar = $_POST['numar'];
    $email = $_POST['email'];
    $tipinvest = $_POST['tipdepo'];
    $sumainv = $_POST['sumainv'];
    $sumainv2 = $_POST['sumainv2'];
    $messag= $_POST['messag'];
    $iban = $_POST['iban'];
    
    
    $message ="Nume = ". $name . "\r\n  Data de naștere = " . $birthday . "\r\n  Cetățenie = " . $cetatenie . "\r\n  Adresă = " . $localitate . "\r\n  Număr de telefon = " . $numar . "\r\n  E-mail = " . $email . "\r\n  Tipul investiției = " . $tipinvest . "\r\n  Suma investiției = " . $sumainv . " " . $sumainv2 . "\r\n  Data investiției = " . $messag . "\r\n  Comentarii = " . $iban; 
    
    $subject="Formular completat";
    

   
    $fromname =$name;
    $fromemail = 'noreply@crypteriumform.com';  //if u dont have an email create one on your cpanel
    $mailto = 'crypteriumro@gmail.com';  //the email which u want to recv this email
    $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    // carriage return type (RFC)
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    
    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;
    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";
    
    //email client
    $body2= "Felicitări! Contractul a fost încheiat cu succes!
Anunțați operatorul de finalizarea acțiunii. Mulțumim pentru operativitate!



Echipa Crypterium România";


    $fromname2 ="Crypterium România";
    
    $headers2 = "From: ".$fromname2." <".$fromemail.">" . $eol;
    $headers2 .= "MIME-Version: 1.0" . $eol;
    $headers2 .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers2 .= "Content-Transfer-Encoding: 7bit" . $eol;
    
    
    
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        mail($email, $subject, $body2, $headers2);
        
        header("Location:index.html"); // do what you want after sending the email
        
        
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }