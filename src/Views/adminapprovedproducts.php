<?php

use Models\Functions;

$out = "
<!-- Container fluid  -->
<div class='container-fluid' id='apprv_prods'>
          
                  
          <!-- Start Page Content -->

          <!-- End Page Content -->
          
      </div>
      
      <div class='row card mb-10' id='load_message'></div>
";
$footer_custom_library = "
  <script type=\"text/javascript\">
      $(\"#checkAll\").click(function () {
          $('input:checkbox').not(this).prop('checked', this.checked);
      });

  $(document).ready(function() {
    var limit=10;
    var start=0;
    var action='inactive';
    var link = 'http://localhost/vensle/ajax/async/approve';
    
    function load_products(limit,start){
        $.ajax({
            url: link,
            method: 'POST',
            data:{limit:limit,start:start},
            cache: false,
            success:function(data){
                //console.log('new'+data);
                if(data == ''){
                    $(\"#load_message\").html(\"<button type='button' class='btn btn-info'>No Data Found</button>\");
                    action = 'active';
                }else{
                 $('#load_message').html(\"<button type='button' class='btn btn-warning'>Loading Products....</button>\");
                //  $('#apprv_prods').html('');
                 $('#apprv_prods').append(data);
                 action = 'inactive';
                 start = limit+1
                 limit = limit * 2;
                }
            }
        })
    }
    if(action == 'inactive')
         {
          action = 'active';
          load_products(limit, start);
         }
    
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $('#apprv_prods').height() && action == 'inactive')
      {
       action = 'active';
       start = start + limit;
       setTimeout(function(){
        load_products(limit, start);
       }, 1000);
      }
     });

    /*
    $('#apv_sltd').click(function() {

        var idSelector = function() { return this.id; };
        var prod_sltd = $(':checkbox:checked').map(idSelector).get();

        var sltd_no = prod_sltd.length;
        if(sltd_no != 1 || prod_sltd.toString() != 'checkAll') {
            if(sltd_no) {
                $.post('ajax/authentication.php', {
                    aprv_id: prod_sltd
                }, function(data) {
                    $('.container-fluid').html(data);
                    toastr.success('Product(s) approved successfully','',{
                        'positionClass': 'toast-top-center',
                        timeOut: 5000,
                        'closeButton': true,
                        'debug': false,
                        'newestOnTop': true,
                        'progressBar': true,
                        'preventDuplicates': true,
                        'onclick': null,
                        'showDuration': '300',
                        'hideDuration': '1000',
                        'extendedTimeOut': '1000',
                        'showEasing': 'swing',
                        'hideEasing': 'linear',
                        'showMethod': 'fadeIn',
                        'hideMethod': 'fadeOut',
                        'tapToDismiss': false
                    });
                });
            }
        }

    });*/


});
        </script>
    ";
$out .= include "src/Views/dashboardfooter.php";
$out .= "<script src='".Functions::getBackendAssetsLink()."/js/approved.js'> </script>";
$out .= "
<div class='modal fade' id='r0101'>
      <div class='modal-dialog mt-1'>
      <div class='modal-content'>
        <div class='example-wrap mb-0'>
          <div class='row justify-content-center pb-5' style='z-index: 2; position: relative;'>

            <div class='card-header bg-white'>
                  <div class='text-muted text-center mb-3'>
                    <h1 class=''><small>Contact Us</small></h1>
                  </div>
            </div>

            <div class='card-body px-lg-5 py-lg-5'>
              <form class='form-valide ftrCntForm' role='form' action='' method='post' novalidate='novalidate'>
                
                <div class='form-group focused'>
                  <div class='col-md-12 p-0'>
                    <textarea type='text' id='contctMsg' placeholder='Message *' class='form-control form-control-alternative valid' aria-required='true'></textarea>
                  </div>
                </div>

                <div class='text-center'>
                  <button type='submit' id='subReprt' class='btn btn-primary my-4'>SEND</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal fade -->
";
return $out;