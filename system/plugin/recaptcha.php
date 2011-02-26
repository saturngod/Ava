<?php
//include recaptchalib
include 'recaptchalib.php';

/**
 * recaptcha
 * 
 * recaptcha plugin
 *
 * @author saturngod
 * @package Nifty
 * @category plugin
 */
class recaptcha
{
		private $private_key;
		private $public_key;
		private $error;
		function __construct()
		{
			$this->private_key=AWConfig::recaptcha_privatekey ;
			$this->public_key=AWConfig::recaptcha_publickey ;
		}
		
		function get()
		{
			return recaptcha_get_html($this->public_key, $this->error);
		}
		
		function check()
		{
			# was there a reCAPTCHA response?
			if ($_POST["recaptcha_response_field"]) {
			        $resp = recaptcha_check_answer ($privatekey,
			                                        $_SERVER["REMOTE_ADDR"],
			                                        $_POST["recaptcha_challenge_field"],
			                                        $_POST["recaptcha_response_field"]);
			
			        if ($resp->is_valid) {
			                return true;
			        } else {
			                # set the error code so that we can display it
			                $this->error = $resp->error;
			                return false;
			        }
			}
		}
}
?>