<?
require 'class/googlenotification.php';
$pusher = new AndroidPusher\Pusher('AIzaSyAPsonwjCoIh2HrTAlhTSoZTyMl10wT0wg');
$id = 'APA91bHgyzwZ4bJq-VnFZLxADd5aACoQ7mTFnxxHVMEbGJAY5Yu-muWWgmMMjHl_6KrWtJFAeq4stKdlZ0KLZPKNnqBkwnlHlEvR-VPNmMrt-GtYkaF3QPu1c0B3PrR1oQ9O03uO9m0JX4sFuGSkeK';
$pusher->notify($id, "Oi", 'Já conferiu as ofertas deste feriadão?');
$x = $pusher->getOutputAsArray();
print_r($x);
?>