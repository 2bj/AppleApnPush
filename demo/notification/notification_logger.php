<?php

include_once __DIR__ . '/../include_config.php';

if (!interface_exists('Psr\Log\LoggerInterface')) {
    print <<<TXT
Please install "psr/log" for run this demo (Notification with logger system).


TXT;

    exit();
}

use Psr\Log\AbstractLogger;
use Apple\ApnPush\Notification\Notification;
use Apple\ApnPush\Notification\Connection;
use Apple\ApnPush\Notification\SendException;

/**
 * Override abstract logger for write records to console
 */
class CustomLogger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        print sprintf("%s: %s %s\n", $level, $message, json_encode($context));
    }

}

// Create connection
$connection = new Connection(CERTIFICATE_FILE, PASS_PHRASE, SANDBOX_MODE);

// Create custom logger
$logger = new CustomLogger();

// Create notification
$notification = new Notification();
$notification
    ->setLogger($logger)
    ->setConnection($connection);

// Send to correct device token
$notification->sendMessage(DEVICE_TOKEN, '[Correct] Hello');

try {
    // Send to incorrect device token
    $notification->sendMessage(str_repeat('a', 64), '[Incorrect] Hello');
} catch (SendException $e) {
}

$notification->sendMessage(DEVICE_TOKEN, '[Correct] Hello 2 ;)');
