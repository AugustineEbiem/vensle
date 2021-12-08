<?php
	//test mode , so diplays errors 
	ini_set('display_startup_errors',1); 
	ini_set('display_errors',1);
	error_reporting(-1);
	
	require "vendor/autoload.php";
	require "config.php";
	
	use Intervention\Image\ImageManager;

	$manager = new ImageManager(array('driver' => 'gd'));

	

	$sql = "SELECT id,product_id,ext FROM images WHERE product_id != 0 AND product_id < 676 ORDER BY id DESC";
	$res = $db->prepare($sql);
	$res->execute();
	$res1 = $res->fetchAll();

	$cnt = 1;
	foreach ($res1 as $key ) {
		
		$size = filesize('vensle-assets/backend/images/uploads/'. $key['product_id'] .'/'. $key['id'] .'.'.$key['ext']);
		echo '|';
		
		if ($size > 0 ) {
			$image = $manager->make('vensle-assets/backend/images/uploads/'. $key['product_id'] .'/'. $key['id'] .'.'.$key['ext']);
			$width = $image->width();
            $height = $image->height();
            if ($width > 400 || $height > 400 ) {
                $image->resize($width/4,$height/4);
            }elseif ($width > 900 || $height > 900 ) {
                $image->resize($width/8,$height/8);
            }
            elseif ($width > 1500 || $height > 1500 ) {
                $image->resize($width/12,$height/12);
            }else{
                $image->resize($width/2,$height/2);
            }

			$image->save('vensle-assets/backend/images/uploads/'. $key['product_id'] .'/thumb_'. $key['id'] .'.'.$key['ext'],80);
			echo $key['product_id'].'-'.$key['id'].',';
		}
        
        
        $cnt++;

	}

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;

	$uri = '/vensle';
	$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));
	$_SERVER['DOCUMENT_ROOT'] .= $uri;

	$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
	    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
	);

	require "dependencies.php";

	$strategy = (new League\Route\Strategy\ApplicationStrategy)->setContainer($container);

	$router   = (new League\Route\Router)->setStrategy($strategy);
	/*
	require "routes.php";
		try{
		$response = $router->dispatch($request);
		(new Zend\Diactoros\Response\SapiEmitter)->emit($response);
	}catch(Exception $e){
		if($e->getMessage() === "Not Found"){
			$error404Page = include "src/Views/404.php";
			echo $error404Page;
		}else{
			echo $e->getMessage();
		}
	} catch(Error $error){
		echo $error;
	}
	*/
	



