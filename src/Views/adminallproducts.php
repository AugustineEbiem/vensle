<?php

use Models\Functions;
$countries = ['Australia','Canada','Ireland','New Zealand','Nigeria', 'Romania','Singapore','United Kingdom','United States'];
$cnt = count($countries);
$out = "
<div class='container-fluid'>
    <div class='row ft_lst_wrp'>
        <div class='row '>
            <div class='col-md-3'>
                
                <select name='item_group' id='select_country' class='upPrSlct' required>
                    <option value=''>Select Country*</option>";
                        for ($i=0; $i < 9 ; $i++) { 
                            $out .= "<option value='{$countries[$i]}'>{$countries[$i]}</option>";
                        }
                    $out .= "
                </select>
            </div>
            <div class='col-md-4'>
                <select name='item_group' id='upld_grp' class='upPrSlct' required disabled>
                    <option value=''>Select Group*</option>";
                        $all_groups = Functions::getGroups();
                        foreach($all_groups as $groups) {
                            $out .= "<option value='{$groups['id']}'>{$groups['name']}</option>";
                        }
                $out .= "
                </select>
            </div>
            <div class='col-md-4'>    
                <select name='category' id='upl_catgry' oninput='cat_input(this.value)' class='upPrSlct' >
                    <option value=''>Select Category</option>

                </select>
            </div> 
            <div class='col-md-1'>    
                <div class='col-md-12 '>
                    <button class='btn btn-dark' onclick='findProducts()'>Find</button>
                    <center><img id=\"spinner_1\" style=\"height:50px; width:inherit; padding:0px; display:none;\" src=\"https://th.bing.com/th/id/R.03ef35f24c6e162a04af782a3f1ee227?rik=Dx7uXS1aCiulrQ&riu=http%3a%2f%2frekhta.org%2fContent%2fImages%2fprocessing.gif&ehk=TvwBM0DiwNmHU9uHV0BLiRa%2fG4p8tpMkZRqEBz6mEeE%3d&risl=&pid=ImgRaw&r=0\"></center>
                            </tbody>
                    
                </div>
            </div>       
            
        </div>
        
    </div>

    <div class='row' >
        <div class='col-lg-12'>
            <div class='card p-t-0'>
                <div class='card-body'>
                    <div class='table-responsive'>
                        <table id='myTable' class='table table-bordered table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>#Image</th>
                                    <th>Item</th>
                                    <!--<th>Price({$currency})</th> -->
                                    <th>seller</th>
                                    <!--<th>Phone Number</th>--> 
                                    <th>Country</th>
                                    <th>&nbsp;&nbsp;Category</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='sectionedproducts'>
                            
                        </table>
                    </div>
                </div>

            </div>
        </div>
</div>
</div>";
    
$footer_custom_library = "
<script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables.min.js'></script>
<!--<script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables-init.js'></script>-->
";
$out .= include "src/Views/dashboardfooter.php";
$out .= "
<script type='text/javascript'>
var country ;
var g_id ;
var c_id ;
$(document).ready(function() {
    
    $('#select_country').change(function() {
        $('#upld_grp').prop('disabled',false);
        var id = $(this).val();
        country = id; 
    
        /*$.post('{$this->page->link}/ajax/async/groups-cat', {
            group_id: id
        }, function(data) {
            //console.log(data);
            $('#upl_catgry').html(data);
        });*/
    });

    $('#upld_grp').change(function() {
        var id = $(this).val();
        $('#upld_catgry').prop('disabled',false);
        g_id = id;

        $.post('{$this->page->link}/ajax/async/groups-cat', {
            group_id: id
        }, function(data) {
            //console.log(data);
            $('#upl_catgry').html(data);
            


        });
    });

    

    


});

function cat_input(id) {
    c_id = id;

};
function findProducts() {
    //alert(country+', '+g_id+', '+c_id);
    $('#spinner_1').css({'display':'block'});
    $('#myTable').css({'display':'none'});
    console.log(country+', '+g_id+', '+c_id);

    $.post('{$this->page->link}/ajax/async/products', {
        group_id: g_id,
        country: country,
        cat_id : c_id
    }, function(data) {
        console.log('Request Completed');
        //console.log(data);
        //alert(data);
        $('#spinner_1').css({'display':'none'});
        $('#myTable').css({'display':'block'});
        $('#sectionedproducts').html(data);
        $('#myTable').DataTable();
    });
};


function featureProduct(id){
    $.get('{$this->page->link}/private/make-featured?verste='+id+'&eup=rsano3/listing/gs_l=16', {
        
    }, function(data) {
        
        var resp = JSON.stringify(data);
        alert(resp);
        console.log(data);
        if(resp == '1'){
            alert('Product Set as Featured Succesfully');
        }
        $('#feat'+id).html(\"<a href='javascript:void(0)' onclick='unfeatureProduct(\"+id+\")' class='btn btn-warning btn-outline btn-rounded ' ><i class='fa fa-tag'></i> Unfeature </a>\");

    });
    //

}
function unfeatureProduct(id){
    $.get('{$this->page->link}/private/unfeature-product?verste='+id+'&eup=rsano3/listing/gs_l=16', {
        
    }, function(data) {
        var resp = JSON.stringify(data);
        alert(resp);
        console.log(data);
        if(resp == '1'){
            alert('Product Set as Featured Succesfully');
        }
        $('#feat'+id).html(\"<a href='javascript:void(0)' onclick='featureProduct(\"+id+\")' class='btn btn-dark btn-outline btn-rounded ' ><i class='fa fa-tag'></i> Feature </a>\");
    });
}

</script>
";
return $out;