<?php

require_once('vendor/autoload.php');

use PubNub\PubNub;
use PubNub\Enums\PNStatusCategory;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\PNConfiguration;



$pnconf = new PNConfiguration();
$pnconf->setSubscribeKey("sub-c-076933e6-9a80-469a-af6d-59525785f1da");
$pnconf->setPublishKey("pub-c-0412442b-5abb-42c5-9705-b6561dbcec8e");
$pnconf->setUuid("gettingStartedSubscriber");


$pubnub = new PubNub($pnconf);





// print_r($pubnub);

class MySubscribeCallback extends SubscribeCallback {
    function status($pubnub, $status) {
        if ($status->getCategory() === PNStatusCategory::PNUnexpectedDisconnectCategory) {
            // This event happens when radio / connectivity is lost
        } else if ($status->getCategory() === PNStatusCategory::PNConnectedCategory) {
            // Connect event. You can do stuff like publish, and know you'll get it
            // Or just use the connected event to confirm you are subscribed for
            // UI / internal notifications, etc
        } else if ($status->getCategory() === PNStatusCategory::PNDecryptionErrorCategory) {
            // Handle message decryption error. Probably client configured to
            // encrypt messages and on live data feed it received plain text.
        }
    } 

    function message($pubnub, $message) {
        // Handle new message stored in message.message
        print_r($message->getMessage() . PHP_EOL );
        //print_r($message->getPublisher() . PHP_EOL);
    }

    function presence($pubnub, $presence) {
        // handle incoming presence data
    }
}

$subscribeCallback = new MySubscribeCallback();
$pubnub->addListener($subscribeCallback);

// Subscribe to a channel, this is not async.
$pubnub->subscribe()
    ->channels("hello_world")
    ->execute();