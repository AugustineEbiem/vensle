<?php

use Models\Functions;

$out = "<div class='container-fluid uPrpWrp'>";
$out .= $errors;
$out .= Functions::getSessionMesssage();
$out .= "
<form action='".Functions::getPageUrl("/backend/place-request")."' method='post' enctype='multipart/form-data'>
<div class='row bg-white m-l-0 m-r-0 box-shadow pb-5'>
        <div class='col-lg-6'>
            <div class='card m-b-0'>
                <div class='card-body'>
                    <div class='basic-form'>
                        <div class='upPrAdWrp form-group'>
                            <div class='upPrAdrs upPrice'>

                                <input type='text' class='form-control input-default' placeholder='Name of Item*' name='title' value='{$title}'>

                            </div>
                        </div>

                        <!-- Item Condtition -->
                                        <div class='row form-group'>
                                                <div class='col-md-12 mb-1'>                                                    
                                                    <b>ITEM CONDITION :</b> 
                                                </div>
                                                <div class='col-md-3'>
                                                    <input type='radio' value='1'";
                                                    $out .= ($item_condition == 1) ? 'checked=checked ':'';
                                                    $out .= " id='new_condition' name='item_condition' > 
                                                    <label for='new_condition'>NEW</label>
                                                </div>
                                                <div class='col-md-3'>
                                                    <input type='radio' value='2'";
                                                    $out .= ($item_condition == 2) ? 'checked=checked ':'';
                                                    $out .= " id='old_condition' name='item_condition' > 
                                                    <label for='old_condition'>USED</label> 
                                                </div>
                                                <div class='col-md-6'>
                                                    <input type='radio' value='3'";
                                                    $out .= ($item_condition == 3) ? 'checked=checked ':'';
                                                    $out .=" id='none' name='item_condition' > 
                                                    <label for='none'>Not Applicable</label> 
                                                </div>
                                        </div>
                                        <!-- Item Condition ends-->
                                        <!-- One time seller -->
                                        <div class='upPrYrs mb-3'>

                                            <select class='upPYSlct' class='upPrSlct' id='status'  name='sale_status'>
                                                <option>";
                                                $out .= ($sale_status == 1) ? 'selected ':'' ;
                                                $out .= "<value='1'>I'm a one time Buyer*</option>
                                                <option>";
                                                $out .= ($sale_status == 2) ? 'selected ':'' ;
                                                $out .= "<value='2'>I'm a dealer and will buy more</option>
                                            </select>


                                        </div>
                                        <!-- One time seller ends -->
                                        <!-- Price Range -->
                                        <div class='row form-group'>
                                        
                                            <div class='col-md-6'>
                                                <div class='input-group'>
                                                  <span class='input-group-addon'>{$currency}</span>
                                                    <input type='number' id='uPrTxtbx' class='form-control input-default' placeholder='Min Price' name='min_price' value='{$min_price}'>
                                                </div>
                                                
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='input-group'>
                                                  <span class='input-group-addon'>{$currency}</span>
                                                    <input type='number' id='uPrTxtbx' class='form-control input-default' placeholder='Max Price' name='max_price' value='{$max_price}'>

                                                </div>
                                                
                                            </div>
                                        </div>

                                        <!-- Price Range Ends -->
                                        <div class='row mb-3'>

                                            <div class='col-md-6 upPrYrs'>
                                                <select name='item_group' id='upld_grp' class='upPrSlct'>
                                                    <option value=''>Select Group*</option>
";
$all_groups = Functions::getGroups();
foreach($all_groups as $groups){
    $out .= "  <option value='{$groups['id']}'>{$groups['name']}</option> ";
}
$out .= "
</select>
</div>

<div class='col-md-6 upPrYrs'>

    <select name='category' id='upl_catgry' class='upPrSlct'>

        <option value=''>Select Category</option>

    </select>
</div>
</div>
<div class='form-group'>
<textarea name='description' class='dscrptn form-control' name='description' rows='15' placeholder='Description'>{$description}</textarea>
</div>


</div>
</div>
</div>
</div>
<div class='col-lg-6'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='basic-form'>

                                        <div class='upPrAdWrp form-group'>
                                            <div class='upPrAdrs upPrice'>
                                                <input class='form-control input-default' name='item_contact_number' value='{$item_contact_number}' type='tel' placeholder='Contact phone number*' required>
                                            </div>
                                        </div>
                                        </div>
";
if($is_admin){
    $out .= "
    <div class='form-group' >
                                                
    <select name='country' class='upPrSlct crs-country' data-region-id='one' id='country_select'>
        <option value='{$country}'> {$country}</option>
    </select>
    
</div>
    ";
}else{
    $out .= "<div class='form-group'  style='display:none'>
    <select name='country' class='upPrSlct crs-country' data-region-id='two' id='country_select' required>
        <option value='{$country}'>{$country}</option>
    </select>
    </div>
    ";
}
if($is_admin){
    $out .= "
    <div class='form-group'>
    <select name='state' id='one' class='upPrSlct'>
        <option value='{$state}'></option>
        </select>
    </div>
    ";
}else{
    $out .= "<div class='form-group'>
    <select name='state' id='two' class='upPrSlct' required></select>
</div>";
}
$out .= "
<div class='upPrAdWrp form-group'>
<div class='upPrAdrs upPrice'>

    <input type='text' class='form-control input-default' placeholder='Enter Address here*' name='item_address' value='{$item_address}'>


</div>
<div class='row' style='margin-top: 20px;'>
    <div class='form-group col-md-12 m-t-4' >
        <div class=' upLtFlDv'>
            <p>Drag & drop pictures here <br>or</p>


            <input type='hidden' name='MAX_FILE_SIZE' value='902400'>
            <input type='file' class='upLstFl dropzone p-t-145 p-b-85' id='photo' name='files[]' accept='image/*' multiple required>

        </div>
    </div>
</div>
<div class='row upPrPbls m-t-42'>
                                            <div class='col-md-6 lft'>
                                                <p>Status: <b>Unpublished</b></p>
                                            </div>
                                            <div class='col-md-6 rght'>
                                                <input type='button' class='btn btn-info btn-xs' value='Save as draft' name=''>
                                            </div>
                                        </div>


                                        

                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-12'>
                            <div class='row'>
                                <div class='col-md-6 text-center'>
                                    
                                    <input type='submit' name='submit' class='btn btn-primary btn-md m-b-10 m-l-5' value='Upload Request'>

                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
";
$out .= include "src/Views/dashboardfooter.php";
$out .= "
<script type='text/javascript'>
$(document).ready(function() {
    $('#upld_grp').change(function() {
        var id = $(this).val();

        $.post('{$this->page->link}/ajax/async/groups-cat', {
            group_id: id
        }, function(data) {
            //console.log(data);
            $('#upl_catgry').html(data);
        });
    });


});
</script>

";
if(!$is_admin){
    $out .= "<script src='{$this->page->link}/vensle-assets/backend/js/country.js'></script>";
}



return $out;