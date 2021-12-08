<?php

use Models\Functions;

$output = "
<div class='row'>
                        <div class='col-lg-3 dshSmr1 p-r-0'>

                            <div class='lstSmWp'>
                                <div class='lwTl'>
                                    <h3>Total Items</h3>
                                </div>
                                <div class='lSBtmWp'>
                                    <div class='lstSm'>
                                        <h1>{$number_of_all_products}</h1>
                                    </div>
                                    <div class='lstSmBtm'>
                                        <p>(inc. sold items)</p> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class='col-lg-3 dshSmr1 p-r-0'>

                            <div class='lstSmWp sm2'>
                                <div class='lwTl'>
                                    <h3>Sold Items</h3>
                                </div>
                                <div class='lSBtmWp'>
                                    <div class='lstSm'>
                                        <h1>{$currency}

";
$output .= number_format($sold_sum['prod_sum'], 0, '.', ',');
$output .= "
</h1>
</div>
</div>
</div>
</div>

<div class='col-lg-6 dsChtWrp'>
<div class='bg-white dsCht'>
<h4 style='visibility: hidden;' class='card-title'>Extra Area Chart</h4>
<div id='extra-area-chart'></div>
</div>
</div>
</div>
<div class='row'>
<div class='col-lg-12'>
<div class='row p-t-12 p-b-10'>
<div class='col-8'>
<h4 class='lsTrtl'>All Users</h4>
</div>
<div class='col-4'>
<a href='{$this->page->link}/backend/users' class='lsTVwAl'>View all</a>
</div>
</div>

<div class='row'>
<div class='col-lg-12'>
<div class='card p-t-0'>
<div class='card-body'>
    <div class='table-responsive'>
        <table id='myTable' class='table table-bordered table-hover table-striped'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Price({$currency})</th>
                    <th>seller</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Condition</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
";
if($number_of_all_products > 0){
    $count = 1;
    foreach($all_products as $product){
        $output .= "
        <tr>
        <td>{$count}</td>
        <td>
        <div class='rect-img'>
            <a href='#'><img src='";
        $output .= (isset($product['image_id'])) ? Functions::getBackendAssetsLink()."/images/uploads/{$product['id']}/{$product['image_id']}.{$product['ext']}" :Functions::getBackendAssetsLink()."/images/default.gif";
        $output .= "'></a>
        </div>
    </td>
    <td><span style='max-width:90px !important; overflow-wrap:break-word;'>{$product['title']}</span></td>
    <td><span>".number_format($product['price'], 2, '.', ',')."</span></td>
    <td><span>{$product['full_name']}</span></td>
    <td><span>{$product['item_contact_number']}</span></td>
    <td>
        {$product['state']}
    </td>
    <td>";
    $output .= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>" : "<span class='badge badge-primary'>USED</span>" ;
    $output .= "</td>
    <td><span>".date('d-m-Y', strtotime($product['upload_date']))."</span></td>
    <td><span>".$product['category_name']."</span></td>
</tr>
        ";
        $count++;
        if($count == 20){
        break;
        }
    }
}else {
   $output .= "There are currently no users";
}

$output .= "
</tbody>
<tfoot>
    <tr>
        <th>#</th>
        <th>Image</th>
        <th>Item</th>
        <th>Price(<?php echo $currency; ?>)</th>
        <th>seller</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Condition</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
        <th>Category</th>
    </tr>
</tfoot>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
";




return $output;