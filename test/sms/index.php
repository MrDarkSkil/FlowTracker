<?php

require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumer_key = "your_consumer_key";

$endpoint = 'ovh-eu';

$conn = new Api(    $applicationKey,
    $applicationSecret,
    $endpoint,
    $consumer_key);

$smsServices = $conn->get('/sms/');

foreach ($smsServices as $smsService) {

    print_r($smsService);
}

$content = (object) array(
    "charset"=> "UTF-8",
    "class"=> "phoneDisplay",
    "coding"=> "7bit",
    "message"=> "Bonjour les SMS OVH par api.ovh.com",
    "noStopClause"=> false,
    "priority"=> "high",
    "receivers"=> [ "+3360000000" ],
    "senderForResponse"=> true,
    "validityPeriod"=> 2880
);

$resultPostJob = $conn->post('/sms/'. $smsServices[0] . '/jobs/', $content); //appel sur le 1er compte SMS

print_r($resultPostJob);

$smsJobs = $conn->get('/sms/'. $smsServices[0] . '/jobs/');
print_r($smsJobs);

?>