<?php
use Models\Functions;
$outer = "
<style type='text/css'>
.main-footer {
    background: #cec8c8;
    padding: 15px;
    color: #444;
    border-top: 1px solid #d2d6de;
}
@media (max-width: 767px)
.content-wrapper, .main-footer {
    margin-left: 0;
}
.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
.py-3 {
  padding-top: 1rem !important;
}
.py-3 {
  padding-bottom: 1rem !important;
}
.mt-auto{
    margin-top: auto ! important;
}
</style>
</div>
            <!--<footer class='footer'> © 2020 All rights reserved Vensle.com</footer>-->
            


        </div>
            <footer class='footer main-footer mt-auto py-3'>
                <div class='pull-right hidden-xs'>
                  <b></b> 
                </div>
                <strong> © 2020 All rights reserved <a href='https://vensle.com'>Vensle.com</a>.</strong> 
            </footer>
        <!-- End Page wrapper  -->

    </div>
    <!-- End Wrapper -->
";
$outer .= "
<script src='{$this->page->link}/vensle-assets/backend/js/lib/jquery/jquery.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/bootstrap/js/popper.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/bootstrap/js/bootstrap.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/custom_script.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/jquery.slimscroll.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/sidebarmenu.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/toastr/toastr.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/toastr/toastr.init.js'></script>


    <script src='{$this->page->link}/vensle-assets/backend/js/lib/sweetalert/sweetalert.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/sweetalert/sweetalert.init.js'></script>

";
if(isset($footer_custom_library)) {
    $outer .= $footer_custom_library;
}
$outer .= "
<!--Custom JavaScript -->
    <script src='{$this->page->link}/vensle-assets/backend/js/custom.min.js'></script>

";
$sess_msg = Functions::getSessionMesssage();
if($sess_msg != null) {
    $outer .= "
    <script type='text/javascript'>
    toastr.success('{$sess_msg}','',{
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
    })
</script>
    ";
}
return $outer;