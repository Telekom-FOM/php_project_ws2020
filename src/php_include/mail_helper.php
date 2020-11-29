<?php
//DO NOT TOUCH
$GLOBALS['user'] = 'azure_8c7b46e89696d508db898cdba0f133c5@azure.com';
$GLOBALS['pass'] = "eL!@Bv['#,PacW/<3x\`";

//Creates mailcontent of welcome mail and sends
function send_login_mail($email, $firstname, $lastname) {
    $params = array(
        'api_user' => $GLOBALS['user'],
        'api_key' => $GLOBALS['pass'],
        'to' => $email,
        'subject' => 'Herzlich Willkommen bei Jupiter-Store.de!',
        'html' => '<img src="https://jupiter-store.de/php_include/test.jpg" alt="picture"><p>Sehr geehrter Kunde, herzlich Willkommen bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
        'text' => 'Sehr geehrte/r Frau/Herr ' . $firstname . ' ' . $lastname . ' , herzlich Willkommen bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
        'from' => 'benkertmax@web.de',
        'fromname' => 'Jupiter-Store.de'
     );
     sendMail($params);
}

//Creates mailcontent of order mail and sends
function send_order_mail($user) {
    $params = array(
        'api_user' => $GLOBALS['user'],
        'api_key' => $GLOBALS['pass'],
        'to' => $user->email,
        'subject' => 'Vielen Dank für Ihren Einkauf bei Jupiter-Store.de!',
        'html' => '<img src="https://jupiter-store.de/php_include/test.jpg" alt="picture"><p>Sehr geehrter Kunde, vielen Dank für Ihren Einkauf bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
        'text' => 'Sehr geehrte/r ' . $user->firstname . " " . $user->lastname .', vielen Dank für Ihren Einkauf bei Jupiter-Store.de! Dem wahrscheinlich besten Onlineshop der Welt.',
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