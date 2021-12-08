<?php
use Models\Functions;
$out = "
<div class='container-fluid'>

			
<div class='row'>
    <div class='col-lg-12'>
        <div class='card p-t-0'>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table id='myTable' class='table table-bordered table-hover table-striped mt-3'>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Min({$currency}</th>
                                <th>Max({$currency})</th>
                                <th>Buyer</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Condition</th>
                                <th>Category</th>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
                            </tr>
                        </thead>
                        <tbody>
";

$get_all_request = Functions::getAllRequestsAdmin();
foreach($get_all_request as $all_request){
    $out .= "
    <tr>
                                    
    <td><span>{$all_request['title']}</span></td>
    <td><span>{$all_request['min_price']}</span></td>
    <td><span>{$all_request['max_price']}</span></td>
    <td><span>{$all_request['full_name']}</span></td>
    <td><span>{$all_request['item_contact_number']}</span></td>
    <td><span>{$all_request['item_address']},{$all_request['item_contact_number']}</span></td>
    <td>
    ";
    $out .= ($all_request['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>" : "<span class='badge badge-primary'>USED</span>";
    $out .= "</td>
    <td><span>{$all_request['category_name']}</span></td>
    <td><span>{$all_request['date_sent']}</span></td>
</tr>
    " ;
}
$out .= "
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
<!-- End Page Content -->
";
$out .= include "src/Views/dashboardfooter.php";
return $out;