<?php
$page = "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <meta name='description' content='{$this->metaDescription}'>

	
	<title>{$this->title}</title>

  <link rel='icon' type='image/gif' sizes='16x16' href='{$this->link}/vensle-assets/images/favicon.gif'>
   <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{$this->link}/vensle-assets/V11/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel='preload' href='{$this->link}/vensle-assets/V11/vendor/fontawesome-free/webfonts/fa-regular-400.woff2' as='font' type='font/woff2'
        crossorigin='anonymous'>
    <link rel='preload' href='{$this->link}/vensle-assets/V11/vendor/fontawesome-free/webfonts/fa-solid-900.woff2' as='font' type='font/woff2'
        crossorigin='anonymous'>
    <link rel='preload' href='{$this->link}/vensle-assets/V11/vendor/fontawesome-free/webfonts/fa-brands-400.woff2' as='font' type='font/woff2'
        crossorigin='anonymous'>
    <link rel='preload' href='{$this->link}/vensle-assets/V11/fonts/wolmart87d5.woff?png09e' as='font' type='font/woff' crossorigin='anonymous'>

    {$this->stylesheetsBefore}
    <!-- Vendor CSS -->
    <link rel='stylesheet' type='text/css' href='{$this->link}/vensle-assets/V11/vendor/fontawesome-free/css/all.min.css'>

    <!-- Plugins CSS -->
    <link rel='stylesheet' type='text/css' href='{$this->link}/vensle-assets/V11/vendor/animate/animate.min.css'> 
    <link rel='stylesheet' type='text/css' href='{$this->link}/vensle-assets/V11/vendor/magnific-popup/magnific-popup.min.css'>
    <!-- Link Swiper's CSS -->
    <link rel='stylesheet' href='{$this->link}/vensle-assets/V11/vendor/swiper/swiper-bundle.min.css'>

    <!-- Default CSS -->
    <link rel='stylesheet' type='text/css' href='{$this->link}/vensle-assets/V11/css/style.min.css'>
  


    {$this->stylesheets}
	



</head>
<body class='home'>
{$this->body}






{$this->scripts}
<script>
      function closePopup(){
        $.magnificPopup.close();
      }
</script>

</body>

</html>
";
return $page;
