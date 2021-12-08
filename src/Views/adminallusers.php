<?php

use Models\Functions;

$out = "
<div class='container-fluid'>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <div class='table-responsive'>
                                    <table id='myTable' class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</small></th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <!--<th>Address</th>
                                                <th>Role</th>-->
                                                <!--<th>No. of Products</th>-->
                                                <!--<th>Online</th>-->
                                                <th>Action</th>
                                                <!--<th>Sold</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>

";
$user_set = Functions::getAllUsers();
if(count($user_set) > 0){
    foreach($user_set as $user){
        $user_products = Functions::getAllProductsByUserId($user['id']);
        $out .= " <tr ";
        $out .= ($user['id'] == $_SESSION['user']['id']) ? "style='background: antiquewhite;'":"";
        $out .= ">
        <td style='text-align: center;'>
            <div class='round-img'>
                <a href='#'>";
        $out .= ($user['profile_img'] != '') ? "<img src='".Functions::getBackendAssetsLink()."/images/profile/{$user['profile_img']}'>":"<i class='fa fa-user-circle-o f-s-30' style='vertical-align: middle;'></i>" ;
        $out .= "      
        </a>
    </div>
</td>
<td>{$user['full_name']}</td>
<td>{$user['email']}</td>
<td>{$user['phone']}</td>
<td><div class='col-md-4'><button class='btn btn-sm btn-success'><i class='fas fa-eye'></i> View</button> <button class='btn btn-sm btn-danger' data-id='{$user['id']}'><i class='fas fa-trash'>Delete</i></button></div></td>
                                                        </tr>

";

    }
}
$out .= "</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>

<!-- End Page Content -->
<!--
</div>-->";
$footer_custom_library = "
        <script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables.min.js'></script>
        <script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables-init.js'></script>
    ";
$out .= include "src/Views/dashboardfooter.php";
$out .= "<script src='".Functions::getBackendAssetsLink()."/js/allusers.js' ></script>";
return $out;