<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Question';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

// insert faq
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $question =  data_clean($question);
    $video_url =  data_clean($video_url);
    $answer =  data_clean($answer);

    // basic validation
    if (empty($question)) {
        $error['question'] = "Question Should Not Be Empty";
    }

    if (empty($video_url)) {
        $error['video_url'] = "Video URL Should Not Be Empty";
    }

    if (empty($answer)) {
        $error['answer'] = "Answer Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($question)) {

        $sql = "SELECT * FROM `troubleshoots` WHERE trub_name = '$question'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['question'] = "Status <b> $question </b> Already Exists";
        }
    }

    if (!empty($video_url)) {

        $sql = "SELECT * FROM `troubleshoots` WHERE trub_video = '$video_url'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['video_url'] = "<b> $video_url </b> Already Exists";
        }
    }

    // url validation
    if (!filter_var($video_url, FILTER_VALIDATE_URL)) {

        $error['video_url'] = "<b> $video_url </b> URL not valid";
    }

    if (empty($error)) {

        // short the url video to embed
        $short_video_url = substr($video_url, 32);

        $sql = "INSERT INTO `troubleshoots` (`troub_id`, `trub_name`, `trub_description`, `trub_video`) VALUES (NULL, '$question', '$answer', '$short_video_url');";

        // run database query
        $query = $db->query($sql);

        $question = null;
        $video_url = null;
        $answer = null;

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "Successfully Insert";
    }
}

// edit faq
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Question";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM `troubleshoots` WHERE troub_id = $troub_id;";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $question =  $row['trub_name'];
        $short_video_url = $row['trub_video'];
        $answer =  $row['trub_description'];

        $video_url = "https://www.youtube.com/watch?v=" . $short_video_url;
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $question =  data_clean($question);
    $video_url =  data_clean($video_url);
    $answer =  data_clean($answer);

    // basic validation
    if (empty($question)) {
        $error['question'] = "Question Should Not Be Empty";
    }

    if (empty($video_url)) {
        $error['video_url'] = "Video URL Should Not Be Empty";
    }

    if (empty($answer)) {
        $error['answer'] = "Answer Should Not Be Empty";
    }

    // url validation
    if (!filter_var($video_url, FILTER_VALIDATE_URL)) {

        $error['video_url'] = "<b> $video_url </b> URL not valid";
    }

    // update query
    if (empty($error)) {

        // short the url video to embed
        $short_video_url = substr($video_url, 32);

        $sql = "UPDATE `troubleshoots` SET trub_name = '$question', trub_description = '$answer', trub_video = '$short_video_url' WHERE `troubleshoots`.`troub_id` = $troub_id;";

        // run database query
        $query = $db->query($sql);

        $question = null;
        $video_url = null;
        $answer = null;

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "Successfully Updated";
    }
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `troubleshoots` WHERE `troub_id` = '$troub_id'";
    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Troubleshooting FAQ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Troubleshooting FAQ</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">

        <!-- Insert / update / delete / blank / already exist alerts-->
        <?php show_error($error, $error_style, $error_style_icon); ?>

        <!-- Delete -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {

            $sql = "SELECT * FROM `troubleshoots` WHERE troub_id = $troub_id;";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                $troub_id = $row['troub_id'];
                $question =  $row['trub_name'];
                $short_video_url = $row['trub_video'];
                $answer =  $row['trub_description'];


        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $question ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="troub_id" value="<?php echo $troub_id ?>"><br>
                            <button type="submit" name="action" value="confirm_delete" class="btn btn-danger btn-s">Yes</button>
                            <button type="submit" name="action" value="cancel_delete" class="btn btn-primary btn-s">No</button>
                        </form>

                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Qutions" name="question" value="<?php echo @$question ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Video URL</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Qutions" name="video_url" value="<?php echo @$video_url ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Answer</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="answer"><?php echo @$answer ?></textarea>
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="troub_id" value="<?php echo @$troub_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo $btn_value ?>"><?php echo $btn_icon ?> <?php echo $btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <!-- Table Data Fletch -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Available Brands</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Search Data" name="cus_search" value="<?php echo @$cus_search ?>">
                                </div>
                                <div class="col-1" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form>
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // crate variable for store dynamic query
                                $where = null;

                                // date range check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search 
                                    if (!empty($cus_search)) {

                                        $where .= "CONCAT(trub_name) LIKE '%$cus_search%' AND ";
                                    }

                                    // remove the last 4 digits of the $where part "AND "
                                    if (!empty($where)) {

                                        $where = substr($where, 0, -4);

                                        // take Mysql WHERE and take $where query parts 
                                        $where = "WHERE $where";
                                    }
                                }


                                // sql query
                                $sql = "SELECT * FROM `troubleshoots` $where";

                                // fletch data
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['trub_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="troub_id" value="<?php echo $row['troub_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="troub_id" value="<?php echo $row['troub_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        $('#brand_list').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>