<?php

function user_exists($userEmail) {

    global $con;

    $query = $con->query("SELECT 1 FROM `users` WHERE `email`='$userEmail' LIMIT 1");

    return (mysqli_num_rows($query) == 1) ? true : false;
}

function getUserId($userID) {

    global $con;

    $query = $con->query("SELECT * FROM `users` WHERE `id`='$userID' LIMIT 1");
    $row_select = mysqli_fetch_array($query);

    $user_email = $row_select['email'];
    return $user_email;
}

function userName($userID) {

    global $con;

    $query = $con->query("SELECT * FROM `users` WHERE `id`='$userID' LIMIT 1");
    $row_select = mysqli_fetch_array($query);

    $user_name = $row_select['user_name'];
    return $user_name;
}

function add_user($clients, $setting, $users, $userName, $userEmail, $userPassword, $userPhone, $userType, $photo_name, $date_added) {
    global $con;
    $con->query("INSERT INTO `users` VALUES (Null,'$userName','$userPassword','$userEmail','$userPhone','$photo_name','$userType','$setting','$clients', '$users', '$date_added')");
    return mysqli_insert_id($con);
}

function user_count() {

    global $con;

    $query = $con->query("SELECT * FROM `users`  ORDER BY `id` ASC");

    $user_count = mysqli_num_rows($query);

    return $user_count;
}

function view_users() {

    global $con;

    $query = $con->query("SELECT * FROM `users`  ORDER BY `id` DESC");

    $x = 1;

    while ($row = mysqli_fetch_assoc($query)) {
        $user_id = $row['id'];
        $user_name = $row['name'];
        $user_email = $row['email'];
        $user_phone = $row['phone'];
        $user_type = $row['type'];
        $user_image = $row['image'];
        $date = $row['date_added'];
        $get_image_ext = explode('.', $user_image);
        $image_ext = strtolower(end($get_image_ext));
        ?>
        <tr class="gradeX <?php echo $user_id;?>">
            <td><?php echo $x; ?></td>
            <td><?php echo $user_name; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_phone; ?></td>

            <td>
                <a href="uploads/users/<?php echo $user_id . "." . $image_ext; ?>" class="image-popup" title="<?php echo $user_name; ?>">
                    <img src="uploads/users/<?php echo $user_id . "." . $image_ext; ?>" class="thumb-img" alt="<?php echo $user_name; ?>" height="100" style="width:100px;">
                </a>			
            </td>
            <td>
                <?php
                if ($user_type == 1) {
                    echo "Manager";
                } else if ($user_type == 2) {
                    echo "Employee ";
                }
                ?>
            </td>


            <td>
                <?php
                echo $date;
                ?>
            </td>
            <td>
                <a href="user_edit.php?userID=<?php echo $user_id; ?>" class="on-default"><i class="fa fa-pencil"></i></a>
            </td>
            <td>
                <a href="#" data-id="<?php echo $user_id; ?>" class="on-default remove-row remove"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>		
        <?php
        $x++;
    }

    return mysqli_insert_id($con);
}

if (isset($_POST['user_id'])) {

    include("../connection.php");

    $user = $_POST['user_id'];
    $query = $con->query("DELETE FROM `users` WHERE `user_id`='$user' ");
    if ($query) {
        $img_path = dirname(__FILE__) . "/../uploads/users/" . $user . '.jpg';
        $img_path_thumb = dirname(__FILE__) . "/../uploads/users/thumbs/" . $user . '.jpg';
        if (file_exists($img_path)) {
            unlink($img_path);
        }
        if (file_exists($img_path_thumb)) {
            unlink($img_path_thumb);
        }
        echo get_success("Deleted Successfully");
    }
}
?>
