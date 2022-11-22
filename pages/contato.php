<div class="container text">
    <h1 class="text-center" >Contato</h1>

   <?php
        
        if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
            Painel::alert('sucesso','Sua mensagem foi envada com sucesso! Responderemos em breve.');
        }
        ?>
    <div class="bkg2-bg row form-contato py-3 my-3 rounded  fs-5">
    
        <div class="col"></div>
        
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input name="nome" required type="text" class="form-control" placeholder="Seu nome">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" required type="email" class="form-control"  placeholder="nome@email.com">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input id="telefone" name="telefone"  type="text" class="form-control" placeholder="Seu telefone">
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea name="mensagem" required class="form-control" rows="3" placeholder="Sua mensagem"></textarea>
                </div>

                <div class="mb-3 text-center d-grid gap-2">

                <input type="hidden" name="identificador" value="form_contato" />
			    <button type="submit" name="acao" class="btn btn-primary cor-padrao">Enviar mensagem</button>
                
                </div>

            </form>
        </div>
    </div>
</div>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

if(isset($_POST['acao'])) {
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'testes@coretobrazil.com.br';                     //SMTP username
    $mail->Password   = 'Luanflpimentel1!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet = "UTF-8";
    //Recipients
    $mail->setFrom('testes@coretobrazil.com.br', 'Geolibras');
    $mail->addAddress('contato@coretobrazil.com.br', 'Joe User');     //Add a recipient
   
    $mail->addReplyTo('contato@coretobrazil.com.br', 'Information');
   

    $body = "Mensagem enviada através do site Geolibras, segue informações abaixo: <hr />
            Nome: ".$_POST['nome']."  <hr />
            Email: ".$_POST['email']."  <hr />
            Telefone: ".$_POST['telefone']." <hr />
            Mensagem: <br> ".$_POST['mensagem']." <hr />"; 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Geolibras - Nova mensagem do site.';
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    Painel::redirect(INCLUDE_PATH.'contato?sucesso');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}



?>