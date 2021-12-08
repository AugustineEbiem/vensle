<?php

use Models\Functions;

$out = "
<!-- Container fluid  -->
<div class='container-fluid' id='apprv_prods'>
          <!-- Start Page Content -->
";
if($no_apprv1 > 0 ){
  foreach($find_pending_requests as $product){
    $out .= "
    <div class='row bg-white m-b-8 dshLstWrpRw aprvPrd' style='position: relative;'>
                            
    <div class='message-list' style='position: absolute; left: 6px; align-self: center;z-index: 5;'>
        <!-- <li class='unread'> -->
            <div class='checkbox-wrapper-mail'>
              <input type='checkbox' class='aprv_chk' id='chk{$product['id']}'>
              <label class='toggle' for='chk{$product['id']}'></label>
            </div>
        <!-- </li> -->
    </div>
    <div class='col-md-3 p-l-0 dshLstImgWp'>

                                    <img src='
    ";
    $out .= (isset($product['display'])) ? Functions::getBackendAssetsLink().'/images/requests/'. 
    $product['display'] : Functions::getBackendAssetsLink().'/images/default.gif';
    $out .= "'>

    </div>
    
    <div class='col-md-6 DshlstFts'>
        <a href='#' data-toggle='modal' data-target='#r{$product['id']}'>
        <h3 class='m-b-0 m-t-4'>{$product['title']}</h3>
    </a>
    <p><i class='fa fa-map-marker m-r-4'></i> {$product['item_address']},{$product['state']}</p>
    <div class='row'>
        <div class='col-md-6'>
            <div class='b'>
                <div><i class='fa fa-language e'></i></div>
                <div class='f'>Category: <b>{$product['category_name']}</b></div>
            </div>

            <div class='b'>
            ";
      $out .= "<div><i class='fa fa-level-up e'></i></div>
      <div class='f'>Condition: <b>";
      $out .= $product['item_condition'] == 1 ? "<span class='badge badge-success'>NEW<span>" : "<span class='badge badge-primary'>USED</span>" ;
      $out .= "
      </b> 
      </div>
      </div>
</div>


  <div class='col-md-6'>
<div class='b'>
          <div><i class='fa fa-tag e'></i></div>
          <div class='f'><h5>Min Price:{$currency}".number_format($product['min_price'], 2, '.', ',')."
          </h5> </div>
                                            <div class='f'><h5>Max Price: {$currency}".number_format($product['max_price'], 2, '.', ',')."</h5> </div>
                                        </div>

            							<span class='label label-rouded label-info'>Ref. No.: <i class='fa fa-edit m-r-5'></i>{$product['ref_no']}</span>
                                        <span class='label label-rouded label-warning'><i class='fa fa-book m-r-5'></i>Status: PENDING</span>
            							          <br><br>
                                    </div>
                                </div>
                            </div>


                            <div class='col-lg-3 lstDscp'>
                                <h4 class='m-b-0 m-t-9'>Description</h4>

                                <p class='m-b-20' style='text-overflow: ellipsis;overflow: hidden;white-space: nowrap;max-width: 65%;'>{$product['description']} ...</p>

                                <div class='row lstBtnWrp'>
                                    <div class='lstEdtBtn'>
                                        <a class='btn btn-default btn-rounded mr-3' href='?approve={$product['id']}'><i class='fa fa-edit'></i> Approve</a>
                                    </div>
            						
            						<div class='lstdltBtn ml-0 mr-1'>
                                        <a href='#' class='btn btn-success btn-flat btn-addon btn-xs' data-toggle='modal' data-target='#apv_{$product['id']}'><i class='fa fa-handshake-o'></i> Decline</a>
                                    </div>

            						<div class='lstdltBtn ml-0'>
                                        <button class='btn btn-danger btn-flat btn-addon btn-xs' data-toggle='modal' data-target='#apv_{$product['id']}delete'
                                        ><i class='fa fa-close'></i> Delete</button>

            						</div>
                                </div>
                                
                            </div>


                            <div class='modal fade' id='apv_{$product['id']}'>
      <div class='modal-dialog mt-1'>
          <div class='modal-content'>
            <div class='example-wrap mb-0'>
                <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
          

                    <div class='col-lg-12'>
                          <div class='text-muted text-center mb-3'>
                            <h1 class=''><small>Decline Message</small></h1>
                          </div>
                    </div>

                    <div>
                        <p>Product name: <b>{$product['title']}</b></p>
                    </div>

                    <div class='px-lg-5 py-lg-5 col-lg-12'>
                      <form class='form-valide ftrCntForm' role='form' action='' method='post' novalidate='novalidate'>
                        
                        <input type='hidden' value='{$product['id']}' name='dcln_id'>

                        <div class='form-group focused'>
                          <div class='col-md-12 p-0'>
                            <textarea type='text' name='decline_msg' id='contctMsg' placeholder='Message *' class='form-control form-control-alternative valid' aria-required='true'></textarea>
                          </div>
                        </div>

                        <div class='text-center'>
                          <button type='submit' name='decline' class='btn btn-primary my-4'>SEND</button>
                        </div>

                      </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
    <div class='modal fade' id='apv_{$product['id']}delete'>
      <div class='modal-dialog mt-1'>
          <div class='modal-content'>
            <div class='example-wrap mb-0'>
                <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
          

                    <div class='col-lg-12'>
                          <div class='text-muted text-center mb-3'>
                            <h1 class=''><small>Are you sure you want to delete Request</small></h1>
                          </div>
                    </div>

                    <div>
                        <p>Request name: <b>{$product['title']}</b></p>
                    </div>

                    <div class='px-lg-5 py-lg-5 col-lg-12'>
                    
                        <input type='hidden' value='{$product['id']}' name='dcln_id'>

                        

                        <div class='text-center'>
                          <a href='{$this->page->link}/private/delete-request?hilfe={$product['id']}&eup=rsano3/listing/gs_l=16' name='decline' class='btn btn-danger my-4'>Delete</a>
                          <button type='button' class='btn btn-success' data-dismiss='modal'>Back</button>
                        </div>

                    
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
          

    <div class='modal fade' id='r{$product['id']}'>
    <div class='modal-dialog mt-1'>
        <div class='modal-content'>

            <div class='modal-body'>
          
          ";
          $image_set = Functions::getProductImages($product['id']);
          if($image_set){
            $img_count = count($image_set);
          }else{
            $img_count = 0;
          }
        
          $out .= " <div class='carousel slide carousel-fade ml-5 mr-5 pl-5 pr-5' id='r{$product['id']}_slider' data-ride='carousel'>
          <ol class='carousel-indicators'>";
          for ($i=0; $i < $img_count; $i++) { 
            $out .= "<li data-target='#r{$product['id']}_slider' data-slide-to='{$i}'></li>";
          }
          $out .= "  </ol>
                                              
          <div class='carousel-inner'>";
          
          if($img_count > 1) {
            foreach($image_set as $image){
              $out .= "<div class='carousel-item";
              $out .= ($image['id'] == $product['display']) ? 'active':'' ;
              $out.= "'>
              <img class='d-block w-100' src='".Functions::getBackendAssetsLink()."/images/uploads/{$product['id']}'{$image['id']}.{$image['ext']}' alt='{$product['title']}'>
        </div>
  ";
            }
          }
          $out .= "</div>
          ";
          if($img_count > 1) {
            $out.= "
            <a class='carousel-control-prev' href='#r{$product['id']}_slider'
                role='button' data-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'>
                        <span class='sr-only'>Previous</span>
                    </span>
                </a>
                <a class='carousel-control-next' href='#r{$product['id']}_slider'
                role='button' data-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'>
                        <span class='sr-only'>Next</span>
                    </span>
                </a>
            ";


          }
          $out .= "
          </div>   

          <table class='table table-hover table-responsive'>
            <tbody>
              <tr>
                  <th scope='row'>ITEM</th>
                  <td>{$product['title']}
          ";
          $out .= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW</span>" : "<span class='badge badge-primary'>USED</span>" ;
          $out .= "
          </td>
          </tr>
          <tr><th scope='row'>PRICE</th><td>{$currency}".number_format($product['max_price'], 2, '.', ',')."</td></tr>
          <tr><th scope='row'>SELLER</th><td>{$product['full_name']}</td></tr>
          <tr><th scope='row'>ADDRESS</th><td>{$product['item_address']}</td></tr>
          <tr><th scope='row'>MOBILE</th><td>{$product['item_contact_number']}</td></tr>
        </tbody>
      </table>
      </div><!-- modal-body -->



      <div class='modal-footer'>
      <a href='{$this->page->link}/single-item/{$product['id']}/huioh43940-80' class='btn btn-primary'>View More</a>
      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Back</button>
  </div><!-- modal-header -->
</div><!-- modal-content -->

</div><!-- modal-dialog -->
</div><!-- modal fade -->
</div>
          ";



  }

}else {
  $out .= "There are currently no pending Requests.";
}


$out .= "
<!-- End Page Content -->
</div>
";


$footer_custom_library = "
        <script type=\"text/javascript\">
            $(\"#checkAll\").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>
    ";
$out .= include "src/Views/dashboardfooter.php";
$out .= "<script src='".Functions::getBackendAssetsLink()."/js/approvedrequests.js'> </script>";
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