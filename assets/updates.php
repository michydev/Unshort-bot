<?php
require_once dirname(__FILE__, 2). "/classes/telegram_class.php";

$telegram = new Telegram();
$text 		= $telegram->getUpdate()->message->text;
$chat_id 	= $telegram->getUpdate()->message->chat->id;	
$message_id = $telegram->getUpdate()->message->message_id;
$chat_type 	= $telegram->getUpdate()->message->chat->type;
$user_id 	= $telegram->getUpdate()->message->from->id;
$firstname 	= $telegram->getUpdate()->message->chat->first_name;
$username 	= $telegram->getUpdate()->message->chat->username;
$message 	= $telegram->getUpdate()->message;
$language_code 	= $telegram->getUpdate()->message->from->language_code;
// Update de petición de Callbacks (Bótones, entre otros)
$callback_query			 	= $telegram->getUpdate()->callback_query;
$callback_query_id		 	= $telegram->getUpdate()->callback_query->id;
$callback_query_user_id		= $telegram->getUpdate()->callback_query->from->id;
$callback_query_username	= $telegram->getUpdate()->callback_query->from->username;
$callback_query_firstname 	= $telegram->getUpdate()->callback_query->from->first_name;
$callback_query_last_name 	= $telegram->getUpdate()->callback_query->from->last_name;
$callback_query_message_id 	= $telegram->getUpdate()->callback_query->message->message_id;
$callback_query_data	 	= $telegram->getUpdate()->callback_query->data;
// Update para obtener los archivos
$document               = $telegram->getUpdate()->message->document;
$document_file_id       = $telegram->getUpdate()->message->document->file_id;
$document_file_name     = $telegram->getUpdate()->message->document->file_name;
$document_file_mimetype = $telegram->getUpdate()->message->document->mime_type;
// Update de petición de contenido de imagenes
$photo              = $telegram->getUpdate()->message->photo[0]->file_id;
$photo_caption      = $telegram->getUpdate()->message->caption;
// Update de petición de inlines
$inline_query                   = $telegram->getUpdate()->inline_query;
$inline_query_id                = $telegram->getUpdate()->inline_query->id;
$inline_query_user_id           = $telegram->getUpdate()->inline_query->from->id;
$inline_query_data              = $telegram->getUpdate()->inline_query->query;

// Update de petición de nuevos miembros
$new_member                 = $telegram->getUpdate()->message->new_chat_member;
$new_member_username        = $telegram->getUpdate()->message->new_chat_member->username;
$new_member_firstname       = $telegram->getUpdate()->message->new_chat_member->first_name;
$new_member_user_id         = $telegram->getUpdate()->message->new_chat_member->id;

// Uso exclusivo de recepción de comandos
$text = isset($text) ? $text : "";
$text = trim($text);
$arr = explode(' ',trim($text));
$command = $arr[0];
?>