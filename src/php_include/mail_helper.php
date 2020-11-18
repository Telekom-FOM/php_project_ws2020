<?php
//DO NOT TOUCH
$GLOBALS['user'] = 'azure_998ff1414574dfc286422689c66c64ae@azure.com';
$GLOBALS['pass'] = 'DjkklhhNF898&&=2KLmdaska';

//Creates mailcontent of welcome mail and sends
function send_login_mail($email) {
    $params = array(
        'api_user' => $GLOBALS['user'],
        'api_key' => $GLOBALS['pass'],
        'to' => $email,
        'subject' => 'Herzlich Willkommen bei Jupiter-Store.de!',
        'html' => 'Sehr geehrter Kunde, herzlich Willkommen bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
        'text' => 'Sehr geehrter Kunde, herzlich Willkommen bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
        'from' => 'benkertmax@web.de',
        'fromname' => 'Jupiter-Store.de'
     );
     sendMail($params);
}

//Sends Mail
function sendMail($params) {
 $url = 'https://api.sendgrid.com/';

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);
}

?>