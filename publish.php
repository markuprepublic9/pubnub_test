<?php

require_once('vendor/autoload.php');

use PubNub\PubNub;
use PubNub\PNConfiguration;

$pnconf = new PNConfiguration();
$pnconf->setSubscribeKey("sub-c-076933e6-9a80-469a-af6d-59525785f1da");
$pnconf->setPublishKey("pub-c-0412442b-5abb-42c5-9705-b6561dbcec8e");
$pnconf->setUuid("gettingStartedSubscriber");


$pubnub = new PubNub($pnconf);



// Use the publish command separately from the Subscribe code shown above.
// Subscribe is not async and will block the execution until complete.
$result = $pubnub->publish()
              ->channel("hello_world")
              ->message("Bundo PubNub")
              ->sync();

print_r($result);