<?php

class MailSender extends CI_Model {

    public function __construct()
    {
        $this->init_mail_function();
    }

    private function init_mail_function() {
        require APPPATH.'/third_party/mailer/class.phpmailer.php';
        require APPPATH.'/third_party/mailer/class.smtp.php';
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();

        //$this->mailer->Host = 'mail.softinventsolutions.com'; // Which SMTP server to use.
        $this->mailer->Host = 'us2.smtp.mailhostbox.com'; // Which SMTP server to use.
        //$this->mailer->Port = 587; // 465Which port to use, 587 is the default port for TLS security.
        $this->mailer->Port = 25; // Which port to use, 587 is the default port for TLS security.
        //$this->mailer->SMTPSecure = 'ssl'; // Which security method to use. TLS is most secure.
        $this->mailer->SMTPAuth = true; // Whether you need to login. This is almost always required.
       /* $this->mailer->Username = "info@softinventsolutions.com"; // Your Email address.
        $this->mailer->Password = "@S0f71nv#nt12"; */// Your Email login password or App Specific Password.
		$this->mailer->Username = "no-reply@paysmosmo.com"; // Your Email address.
        $this->mailer->Password = 'I:mu54xdx{$Z'; // Your Email login password or App Specific Password.
    }

    private function init_message($tos, $msg, $type) {
        // $this->init_mail_function();
        $this->mailer->setFrom('no-reply@paysmosmo.com', 'Paysmosmo'); // Set the sender of the message.
        if (isset($tos[0]) && is_array($tos[0])) {
            foreach ($tos as $key => $to) {
            	$this->mailer->addAddress($to['email'], $to['name']);
            }
        } else {
            $this->mailer->addAddress($tos['email'], $tos['name']);
        }

        // Set the recipient of the message.
        $this->mailer->Subject = $msg['subject']; // The subject of the message.
        if ($type == 'html') {
            $this->mailer->msgHTML($msg['message']);
        } else {
            $this->mailer->Body = $msg['message'];
        }
        return $this;
    }

    public function send_mail($tos, $msg, $type) {
        // $this->init_message($to, $msg, $type);
        $this->mailer->setFrom('no-reply@paysmosmo.com', 'Paysmosmo'); // Set the sender of the message.
        if (isset($tos[0]) && is_array($tos[0])) {
            foreach ($tos as $key => $to) {
            	$this->mailer->addAddress($to['email'], $to['name']);
            }
        } else {
            $this->mailer->addAddress($tos['email'], $tos['name']);
        }

        // Set the recipient of the message.
        $this->mailer->Subject = $msg['subject']; // The subject of the message.
        if ($type == 'html') {
            $this->mailer->msgHTML($msg['message']);
        } else {
            $this->mailer->Body = $msg['message'];
        }
        
		try {
			$this->mailer->send();
			return true;
		} catch (Exception $e) {
			echo json_encode($this->mailer->ErrorInfo);
			exit();
		}
        // if ($this->mailer->send()) {
		// 	echo "mail sent";
        //     return true;
        // } else {
        //     echo json_encode($this->mail->ErrorInfo);
        //     return false;
        // }
    }
}
