<?php
require 'classes/telegram_class.php';
require 'classes/utils.php';
require 'assets/updates.php';
require 'assets/language.php';

if(!empty($url = Utils::getUrl($arr[0]))) {
	$http_contains = $url;	
}

if ($chat_type == "private") {
	switch($text) {
		case strpos($text, ($creator[$language_code] ? $creator[$language_code] : $creator['en'])) !== FALSE:
			TelegramStatic::sendMessageStatic($chat_id, ($my_creator[$language_code] ? $my_creator[$language_code] : $my_creator['en']), TRUE);
			exit();
		break;
	}
	switch ($command) {
		case '/start':
			$response = sprintf(($welcome_msg[$language_code] ? $welcome_msg[$language_code] : $welcome_msg['en']), "<b>".ucfirst($firstname)."</b>");
			TelegramStatic::sendMessageStatic($chat_id, $response, TRUE);
		break;
		case strpos($http_contains, 'http') !== FALSE:
			$unshort = Utils::unshort($http_contains);
			if(!empty($unshort)) {
				$response = sprintf(($first_message[$language_code] ? $first_message[$language_code] : $first_message['en']), $arr[0], $unshort);
				TelegramStatic::sendMessageStatic($chat_id, $response, TRUE);
			} else {
				$response = sprintf(($unshort_msg[$language_code] ? $unshort_msg[$language_code] : $unshort_msg['en']), $arr[0]); 
				TelegramStatic::sendMessageStatic($chat_id, $response, TRUE); 
			}
			exit();
		break;
		default:
			TelegramStatic::sendMessageStatic($chat_id, ($try_again[$language_code] ? $try_again[$language_code] : $try_again['en']), TRUE); 
        break;
	}
}