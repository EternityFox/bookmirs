<?php
session_start();
if ($_POST) { // если передан массив POST
     $phone = htmlspecialchars($_POST["phone_number"]);
	 $vacancy = htmlspecialchars($_POST["vacancy"]);
	 $vid = htmlspecialchars($_POST["vid"]);
     $json = array(); // подготовим массив ответа
     if (!$phone) { // если хоть одно поле оказалось пустым
         $json['error'] = 'Вы всё таки не указали номер телефона!'; // пишем ошибку в массив
         echo json_encode($json); // выводим массив ответа 
         die(); // умираем
     }
	 $message = 'Вакансия: ' .  $vacancy . ', телефон: ' .  $phone;
	
     function mime_header_encode($str, $data_charset, $send_charset) { // функция преобразования заголовков в верную кодировку 
         if($data_charset != $send_charset)
         $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
         return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
     }
     /* супер класс для отправки письма в нужной кодировке */
     class TEmail {
     public $from_email;
     public $from_name;
     public $to_email;
     public $to_name;
     public $subject;
     public $data_charset='UTF-8';
     public $send_charset='windows-1251';
     public $body='';
     public $type='text/plain';

     function send(){
         $dc=$this->data_charset;
         $sc=$this->send_charset;
         $enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
         $enc_subject=mime_header_encode($this->subject,$dc,$sc);
         $enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';
         $enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
         $headers='';
         $headers.="Mime-Version: 1.0\r\n";
         $headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";
         $headers.="From: ".$enc_from."\r\n";
         return mail($enc_to,$enc_subject,$enc_body,$headers);
     }

     }

     $emailgo= new TEmail; // инициализируем супер класс отправки
     $emailgo->from_email= 'robot@bookmirs.ru'; // от кого
     $emailgo->from_name= 'Администрация сайта bookmirs.ru';
     $emailgo->to_email= 'web@bookmirs.ru'; // кому
     $emailgo->to_name= $name;
     $emailgo->subject= 'Оставлен запрос'; // тема
     $emailgo->body= $message; // сообщение
     $emailgo->send(); // отправляем

     $json['error'] = 0; // ошибок не было
	 if(!in_array($vid,$_SESSION['vacancies_send']))
	 {
	 	$_SESSION['vacancies_send'][] = $vid;
	 }
     echo json_encode($json); // выводим массив ответа
} else { // если массив POST не был передан
     echo 'GET LOST!'; // высылаем
}
?>