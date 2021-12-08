<?php 

	namespace Controllers;

	class PageBuilder{
		

		public $template;
		public $title = "Vensle | Your Favourite Online shopping website";
		public $body;
		public $messages;
		public $page;
		public $success;
		public $errors;
		public $link;
		public $scripts;
		public $stylesheets;
		public $stylesheetsBefore;
		public $backgroundImage;
		public $heading;
		public $navLogo;
		public $metaDescription;
		
		public function __construct($templateToBeUsed = NULL){
			$this->template = isset($templateToBeUsed) ? $templateToBeUsed : $_SERVER['DOCUMENT_ROOT']."/src/Views/pageTemplate.php";
			$this->link = "http://localhost/vensle";
			$this->metaDescription = "Vensle.com is an online marketplace that bring buyers and sellers in a neighbourhood together. You can sell or buy new and used items to people around you. With vensle.com buying and selling is very fast and easy.";
		}
		public function buildPage(){
			$this->page = include $this->template;
			return $this->page;
		}

	}