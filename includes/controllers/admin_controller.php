<?php
include("../../config/config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DELETE 
if(isset($_POST['delete_admin']))
{
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);

    $query = "DELETE FROM admin WHERE ic='$admin_id'";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Admin Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Admin Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

// Get Data when clicked the edit button
if(isset($_GET['admin_id']))
{
    $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);

    $query = "SELECT * FROM admin WHERE ic='$admin_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $admin = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Admin Fetch Successfully by id',
            'data' => $admin
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Admin Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>
