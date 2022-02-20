<?php

// Data Cleaning Function-28/11/2021-----------------
// Last Modified at 28/11/2021

function data_clean($data = null)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// End Data Cleaning Function------------------------

// Database Connection-------------------------------

function db_con()
{

    $sever = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'bit';

    $con = new mysqli($sever, $user, $password, $db);

    if ($con->connect_error) {
        die("Database Connection" . $con->connect_error);
    }

    return $con;
}

// Discount Function-------------------------------

function discount($unit_price = null, $sale_price = null)
{

    if (!empty($sale_price) && !empty($unit_price)) {
        $discount = (($unit_price - $sale_price) * 100) / $unit_price;
    }

    return @$discount;
}

// Error Messages Function----------------------
function show_error($error = null, $error_style = null, $error_style_icon = null)
{

    if (!empty($error)) {

        foreach ($error_style as $key => $value) {
            echo '<div class="alert ' . $value . ' alert-dismissible">';
        }

        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

        foreach ($error_style_icon as $key => $value) {
            echo '<h5>' . $value . ' Alert!</h5>';
        }

        echo '<ul>';

        foreach ($error as $key => $value) {
            echo "<li>" . $value . "</li>";
        }

        echo '</ul>';
        echo '</div>';
    }
}

// Image Upload Function------------------------

function image_upload($image_upload = null, $target_dri = null, $previous_image = null)
{

    if (empty($error) && !empty($_FILES[$image_upload]['name'])) {
        $target_file = $target_dri . basename($_FILES[$image_upload]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES[$image_upload]['tmp_name']);
        if ($check !== false) {
            //Multi-purpose Internet Mail Extensions          
            $upload_ok = 1;
        } else {
            $error[$image_upload] = "File is not an image.";
            $upload_ok = 0;
        }

        if (file_exists($target_file)) {
            //$error[$image_upload] = "Sorry, file already exists.";
            //$upload_ok = 0;
            unlink($target_file);
            $upload_ok = 1;
        }

        if ($_FILES[$image_upload]["size"] > 5000000000) {
            $error[$image_upload] = "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
            $error[$image_upload] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$image_upload]["tmp_name"], $target_file)) {
                $error['photo'] = htmlspecialchars(basename($_FILES[$image_upload]["name"]));
            } else {
                $error[$image_upload] = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
        $error['photo'] = $previous_image;
    }

    return @$error;
    
}
