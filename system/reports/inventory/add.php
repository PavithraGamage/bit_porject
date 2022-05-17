<?php 

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// update notification
if (!empty($notification_item_id)) {

    $sql = "UPDATE `items` SET `item_notification` = '2' WHERE `items`.`item_id` = $notification_item_id;";
    $db->query($sql);
}

// update notification
if (!empty($notification_item_id_low_stock)) {

    $sql = "UPDATE `items` SET `item_notification` = '0' WHERE `items`.`item_id` = $notification_item_id_low_stock;";
    $db->query($sql);
}

?>