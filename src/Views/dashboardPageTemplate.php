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

  <link rel='icon' type='image/gif' sizes='16x16' href='images/favicon.gif'>
  <link href='{$this->link}/vensle-assets/backend/css/lib/toastr/toastr.min.css' rel='stylesheet'>
  <link href='{$this->link}/vensle-assets/backend/css/lib/bootstrap/bootstrap.min.css' rel='stylesheet'>
  <link href='{$this->link}/vensle-assets/backend/css/lib/calendar2/semantic.ui.min.css' rel='stylesheet'>
  <link href='{$this->link}/vensle-assets/backend/css/helper.css' rel='stylesheet'>
  <link href='{$this->link}/vensle-assets/backend/css/style.css' rel='stylesheet'>
  <link href='{$this->link}/vensle-assets/backend/css/main.css' rel='stylesheet'>
  {$this->stylesheets}
	



</head>
<body class='fix-header fix-sidebar'>
{$this->body}







{$this->scripts}

</body>

</html>
";
return $page;
