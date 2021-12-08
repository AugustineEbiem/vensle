<?php
/***
		***********************************
		***********************************
		
		Application Routes ... Finally 😅

		***********************************
		***********************************
		***********************************



	***/


	//dashboard related routes

	$router->get("/backend","Controllers\DashboardController::showDashboard");
	$router->get("/backend/","Controllers\DashboardController::showDashboard");
	$router->get("/backend/dashboard","Controllers\DashboardController::showDashboard");
	$router->get("/backend/dashboard/","Controllers\DashboardController::showDashboard");

	$router->get("/backend/upload-item","Controllers\DashboardController::userUpload");
	$router->get("/backend/upload-item/","Controllers\DashboardController::userUpload");
	$router->post("/backend/upload-item","Controllers\DashboardController::performuserUpload");
	$router->post("/backend/upload-item/","Controllers\DashboardController::performUserUpload");


	$router->get("/backend/my-products","Controllers\DashboardController::showUsersProducts");
	$router->get("/backend/my-products/","Controllers\DashboardController::showUsersProducts");


	$router->get("/backend/sold-items","Controllers\DashboardController::showSoldItems");
	$router->get("/backend/sold-items/","Controllers\DashboardController::showSoldItems");


	$router->get("/backend/place-request","Controllers\DashboardController::showPlaceRequest");
	$router->get("/backend/place-request/","Controllers\DashboardController::showPlaceRequest");


	$router->post("/backend/place-request","Controllers\DashboardController::performPlaceRequest");
	$router->post("/backend/place-request/","Controllers\DashboardController::performPlaceRequest");



	$router->get("/backend/my-requests","Controllers\DashboardController::showMyRequests");
	$router->get("/backend/my-requests/","Controllers\DashboardController::showMyRequests");


	$router->get("/backend/bought-items","Controllers\DashboardController::showBoughtItems");
	$router->get("/backend/bought-items/","Controllers\DashboardController::showBoughtItems");


	$router->get("/backend/update-profile","Controllers\DashboardController::showUpdateProfile");
	$router->get("/backend/update-profile/","Controllers\DashboardController::showUpdateProfile");
	$router->post("/backend/update-profile","Controllers\DashboardController::performUpdateProfile");
	$router->post("/backend/update-profile/","Controllers\DashboardController::performUpdateProfile");



	$router->get("/backend/change-password","Controllers\DashboardController::showChangePassword");
	$router->get("/backend/change-password/","Controllers\DashboardController::showChangePassword");
	$router->post("/backend/change-password","Controllers\DashboardController::performChangePassword");
	$router->post("/backend/change-password/","Controllers\DashboardController::performChangePassword");


	$router->get("/backend/message-compose","Controllers\DashboardController::showMessageCompose");
	$router->get("/backend/message-compose/","Controllers\DashboardController::showMessageCompose");
	$router->post("/backend/message-compose","Controllers\DashboardController::performMessageCompose");
	$router->post("/backend/message-compose/","Controllers\DashboardController::performMessageCompose");


	$router->get("/backend/message-inbox","Controllers\DashboardController::showMessageInbox");
	$router->get("/backend/message-inbox/","Controllers\DashboardController::showMessageInbox");


	$router->get("/backend/message-draft","Controllers\DashboardController::showMessageDraft");
	$router->get("/backend/message-draft/","Controllers\DashboardController::showMessageDraft");


	$router->get("/backend/message-sent","Controllers\DashboardController::showMessageSent");
	$router->get("/backend/message-sent/","Controllers\DashboardController::showMessageSent");


	$router->get("/backend/read-message","Controllers\DashboardController::showReadMessage");
	$router->get("/backend/read-message/","Controllers\DashboardController::showReadMessage");


	$router->post("/backend/read-message","Controllers\DashboardController::showReadMessage");
	$router->post("/backend/read-message/","Controllers\DashboardController::showReadMessage");


	$router->get("/backend/all-requests","Controllers\DashboardController::showAllRequests");
	$router->get("/backend/all-requests/","Controllers\DashboardController::showAllRequests");


	$router->get("/backend/all-products","Controllers\DashboardController::showAllProducts");
	$router->get("/backend/all-products/","Controllers\DashboardController::showAllProducts");


	$router->get("/backend/featured-products","Controllers\DashboardController::showFeaturedProducts");
	$router->get("/backend/featured-products/","Controllers\DashboardController::showFeaturedProducts");


	$router->get("/guide/buy-sell","Controllers\HomeController::showBuySellTutorial");
	$router->get("/guide/sell-buy","Controllers\HomeController::showBuySellTutorial");


	$router->get("/faq","Controllers\HomeController::showFaq");
	$router->get("/policy/terms-conditions","Controllers\HomeController::showTerms");
	$router->get("/policy/privacy-policy","Controllers\HomeController::showPrivacyPolicy");
	$router->get("/policy/product-listing","Controllers\HomeController::showProductListing");

	$router->get("/contact","Controllers\HomeController::showContactForm");
	$router->post("/contact","Controllers\HomeController::performContact");


	$router->get("/private/delete-request","Controllers\DashboardController::deleteRequest");
	$router->get("/private/delete-request/","Controllers\DashboardController::deleteRequest");


	$router->get("/private/delete-product","Controllers\DashboardController::deleteProduct");
	$router->get("/private/delete-product/","Controllers\DashboardController::deleteProduct");

	$router->get("/private/make-featured","Controllers\DashboardController::featureProduct");
	$router->get("/private/make-featured/","Controllers\DashboardController::featureProduct");
	$router->post("/private/position-featured/","Controllers\DashboardController::setProductPosition");
	$router->post("/private/position-featured","Controllers\DashboardController::setProductPosition");

	$router->get("/private/unfeature-product","Controllers\DashboardController::unfeatureProduct");
	$router->get("/private/unfeature-product/","Controllers\DashboardController::unfeatureProduct");

	
	$router->get("/backend/approve-product","Controllers\DashboardController::showApproveProduct");
	$router->get("/backend/approve-product/","Controllers\DashboardController::showApproveProduct");

	$router->post("/backend/approve-product","Controllers\DashboardController::performApproveProduct");
	$router->post("/backend/approve-product/","Controllers\DashboardController::performApproveProduct");


	$router->get("/backend/approve-request","Controllers\DashboardController::showApproveRequest");
	$router->get("/backend/approve-request/","Controllers\DashboardController::showApproveRequest");

	
	$router->get("/backend/category-display","Controllers\DashboardController::showCategoryDisplay");
	$router->get("/backend/category-display/","Controllers\DashboardController::showCategoryDisplay");


	$router->get("/backend/users","Controllers\DashboardController::showUsers");
	$router->get("/backend/users/","Controllers\DashboardController::showUsers");


	



	$router->get("/backend/logout","Controllers\DashboardController::logUserOut");
	$router->get("/backend/logout/","Controllers\DashboardController::logUserOut");



	
	$router->get('/','Controllers\HomeController::showHomePage');
	$router->get('/{keywords}/{category}','Controllers\HomeController::showHomePage');
	$router->get('/home','Controllers\Home::showHomePage');



	//ajax related routes.
	$router->group("/ajax",function(\League\Route\RouteGroup $route){
		$route->map("POST","/register","Controllers\AjaxController::registerUser");
		$route->map("POST","/login","Controllers\AjaxController::signUserIn");
		$route->map("POST","/async/groups-cat","Controllers\AjaxController::getCategoriesByGroup");
		$route->map("POST","/async/approve","Controllers\AjaxController::getApprovedProductsPage");
		$route->map("POST","/async/feature","Controllers\AjaxController::getApprovedProductsPage");
		$route->map("POST","/async/products","Controllers\AjaxController::getProducts");
	});

	$router->get("/product-view/{bibchen}/{psy}","Controllers\HomeController::showProductView");

	$router->get("/login","Controllers\HomeController::showSignInForm");
	$router->post("/login","Controllers\HomeController::signUserIn");

	$router->get('/register','Controllers\HomeController::showSignUpForm');
	$router->post('/register','Controllers\HomeController::signUserUp');


	$router->get('/recovery','Controllers\HomeController::showPasswordRecovery');
	$router->post('/recovery','Controllers\HomeController::performPasswordRecovery');


	$router->get('/password-reset','Controllers\HomeController::showPasswordReset');
	$router->post('/password-reset','Controllers\HomeController::performPasswordReset');


	$router->get('/single-item/{bibchen}','Controllers\HomeController::showProductPage');
	$router->get('/single-item/{bibchen}/{psy}','Controllers\HomeController::showProductPage');

	$router->get('/customers-profile/y_in/{bibchen}/{psy}/{data}','Controllers\HomeController::showProfilePage');
	$router->get('/customers-profile/y_in/{bibchen}/{psy}/{data}/','Controllers\HomeController::showProfilePage');


	$router->get("/search","Controllers\SearchController::showSearch");
	$router->get("/search/","Controllers\SearchController::showSearch");
	// $router->post("/login","Controllers\HomeController::signUserIn");

	



    