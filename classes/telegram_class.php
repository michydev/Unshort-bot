<?php
/**
 * @author @michyaraque
 */

require_once dirname(__FILE__, 2). "/config.php";

class Telegram {

	const API_URL = 'https://api.telegram.org/bot';

	/**
	 * @param [String] $token
	 */
	public function setToken($token)
	{
		$this->token = $token;
	}

	/**
	 * @return [Object] $update
	 */
	public function getUpdate()
	{
		$update = json_decode(file_get_contents('php://input'));
		return $update;
	}

	/**
	 * @param [String] $url
	 */
	public function setWebhook($url)
	{
		$this->request('setWebhook', [
			'url' => $url
		]);
	}

	/**
	 * @param  [String] $method
	 * @param  [Array]  $data
	 * @return [Object] $result
	 */
	public function request($method, $data = null)
	{
		$ch = curl_init();
		$url = self::API_URL . BOT_TOKEN . "/" . $method; 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}

	public function requestcontent($method, $data = null) {
		
		$url = self::API_URL . BOT_TOKEN . "/" . $method."?".http_build_query($data); 
		$results = file_get_contents($url);
		return $result;
	}

	// Metodos

	/**
	 * @param  [Int] 			$chatid
	 * @param  [String] 		$text
	 * @param  [String]			$preview
	 * @param  [Array]			$keyboard
	 * @return [Object]
	 */
	public function sendMessage($chatid, $text, $preview = FALSE, $keyboard = NULL) {
		/* if(isset($keyboard)) {
			$keyboard = json_encode($keyboard);
		} */
		return $this->request('sendMessage', [
			'chat_id'  					=> $chatid,
			'parse_mode'				=> 'html',
			'text' 						=> $text,
			'disable_notification' 		=> TRUE,
			'disable_web_page_preview' 	=> $preview,
			'reply_markup' 				=> $keyboard
		]);
	}

	/**
	* @param [Int]				$chatid
	* @param [Int]				$messageid
	* @return [Object]
	*/
	
	public function deleteMessage($chatid, $messageid) {
		return $this->request('deleteMessage', [
			'chat_id'  					=> $chatid,
			'message_id'				=> $messageid
		]);
	}

	/**
	* @param [Int]				$chatid
	* @param [Int]				$messageid
	* @param [String]			$newtext
	* @param [Array]			$keyboard
	* @return [Object]	
	*/
	
	public function editMessageText($chatid, $messageid, $newtext, $keyboard = NULL) {

		return $this->request('editMessageText', [
			'chat_id'  					=> $chatid,
			'message_id'				=> $messageid,
			'reply_markup' 				=> $keyboard,
			'parse_mode' 				=> 'html',
			'disable_web_page_preview'	=> TRUE,
			'text'						=> $newtext
		]);
	}

	/**
	* @param [Int]				$chatid
	* @param [Int]				$messageid
	* @param [Array]			$keyboard (REQUIRED)
	* @return [Object]	
	*/
	
	public function editMessageReplyMarkup($chatid, $messageid, $keyboard) {

		return $this->request('editMessageReplyMarkup', [
			'chat_id'  					=> $chatid,
			'message_id'				=> $messageid,
			'reply_markup' 				=> $keyboard
		]);
	}
	
	/**
	* @param [Int]				$chatid
	* @param [String]			$photo
	* @param [String]			$text
	* @param [Array]			$keyboard
	* @return [Object]	
	*/

	public function sendPhoto($chatid, $photo, $text = NULL, $keyboard = NULL) {

		return $this->request('sendPhoto', [
			'chat_id'  					=> $chatid,
			'photo' 					=> $photo,
			'caption'					=> $text,
			'parse_mode'				=> 'html',
			'reply_markup' 				=> $keyboard
		]);
	}

	/**
	* @param [Int]				$chatid
	* @param [String]			$action = 'typing' - 'upload_photo' - 'record_video ' - 'upload_video ' - 'record_audio' - 'upload_audio' - 'upload_document' - 'find_location' - 'record_video_note' - 'upload_video_note '
	* @return [Object]	
	*/
	
	public function sendChatAction($chatid, $action = 'typing') {

		return $this->request('sendChatAction', [
			'chat_id'  					=> $chatid,
			'action' 					=> $action
		]);
	}

	/**
	* @param [Int]				$callbackid
	* @param [String]			$text
	* @param [String]			$alert
	* @return [Object]	
	*/

	public function answerCallbackQuery($callbackid, $text, $alert) {

		return $this->request('answerCallbackQuery', [
			'callback_query_id' 	=> $callbackid,
			'text' 					=> $text,
			'show_alert'			=> $alert
		]);
	}
	
	/**
	* @param [Int]				$callbackid
	* @param [String]			$text
	* @param [String]			$alert
	* @return [Object]	
	*/

	public function answerinlineQuery($inlineid, $results, $cache = 0, $sw_text = NULL, $sw_parameter = NULL) {

		return $this->request('answerinlineQuery', [
			'inline_query_id' 	=> $inlineid,
			'results' 			=> $results,
			'cache_time'		=> $cache,
			'switch_pm_text'	=> $sw_text,
			'switch_pm_parameter' => $sw_parameter
		]);
    }

    /**
	* @param [Int]				$chatid
	* @param [String]			$document
	* @param [String]			$text
	* @return [Object]	
	*/
    
    public function sendDocument($chatid, $document, $text) {

        return $this->request('sendDocument', [
                'chat_id'    => $chatid,
                'document' => $document,
                'caption' => $text,
                'parse_mode' => 'html'
            ]);
	}
	
	/**
	* @param [Int]				$chatid
	* @param [String]			$document
	* @param [String]			$text
	* @return [Object]	
	*/
    
    public function getFile($fileid) {

        return $this->request('getFile', [
                'file_id'    => $fileid
            ]);
	}
	
	public function sendStatusOwner() {
		$testupdate = json_encode($this->getUpdate(),JSON_PRETTY_PRINT);
		$this->sendMessage(234985422, $testupdate, TRUE);
	}

}

class TelegramStatic extends Telegram{
		/**
	 * @param  [Int] 			$chatid
	 * @param  [String] 		$text
	 * @param  [String]			$preview
	 * @param  [Array]			$keyboard
	 * @return [Object]
	 */
	public static function sendMessageStatic($chatid, $text, $preview = FALSE, $keyboard = NULL) {

		return self::request('sendMessage', [
			'chat_id'  					=> $chatid,
			'parse_mode'				=> 'html',
			'text' 						=> $text,
			'disable_notification' 		=> TRUE,
			'disable_web_page_preview' 	=> $preview,
			'reply_markup' 				=> $keyboard
		]);
	}
}
