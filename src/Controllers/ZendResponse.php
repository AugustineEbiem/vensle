<?php
namespace Controllers;
class ZendResponse{
    protected $paramErrorArray = [];
    public function getResponse(){
		$response = new \Zend\Diactoros\Response;
		$response->getBody()->write($this->page->buildPage());
		return $response;
	}
	public function checkIfUserIsLoggedIn($reason=NULL){
        if(!isset($_SESSION['user'])){
            // $redirectTo = "Location:".$this->page->link."/signin?n=".$reason;
            $redirectTo = "Location:".$this->page->link."/";
            header($redirectTo);
            echo "sd";
        }
    }
	public function checkIfAdminIsLoggedIn($reason=NULL){
        if(!isset($_SESSION['admin'])){
            $redirectTo = "Location:".$this->page->link."/admin?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }
    public function checkIfParameterEmpty($parameter){
        if(empty($_POST[$parameter])){
            switch($parameter){
                case "holy-ghost":
                    $parameter = "Holy Ghost baptism";
                break;
                case "born-again":
                    $parameter = "Are you Born Again";
                break;
                case "education":
                    $parameter = "Level of education";
                break;
                case "track":
                    $parameter = "Learning Track";
                break;
            }
            $this->paramErrorArray[] = $parameter;
        }else{
            return $_POST[strtolower($parameter)];
        }
    }
	public function checkIfUserIsResellerBasic($reason=NULL){
        $this->checkIfUserIsLoggedIn("You need to be logged in to access reseller features");
        if(!($_SESSION['reseller'][0] == "basic" || $_SESSION['reseller'][0] == "pro") ){
            $reason = "You are not on the Reseller Basic or Pro plan. Please subscribe to the plan to access that feature";
            $redirectTo = "Location:".$this->page->link."/dashboard?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }
	public function checkIfUserIsPureResellerBasic($reason=NULL){
        $this->checkIfUserIsLoggedIn("You need to be logged in to access reseller features");
        if(($_SESSION['reseller'][0] == "basic") ){
            $redirectTo = "Location:".$this->page->link."/dashboard?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }
	public function checkIfUserIsNotPureResellerBasic($reason=NULL){
        $this->checkIfUserIsLoggedIn("You need to be logged in to access reseller features");
        if(($_SESSION['reseller'][0] != "basic") ){
            $redirectTo = "Location:".$this->page->link."/dashboard?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }
	public function checkIfUserIsPureResellerPro($reason=NULL){
        $this->checkIfUserIsLoggedIn("You need to be logged in to access reseller features");
        if(($_SESSION['reseller'][0] == "pro") ){
            $redirectTo = "Location:".$this->page->link."/dashboard?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }
	public function checkIfUserIsResellerPro($reason=NULL){
        $this->checkIfUserIsLoggedIn("You need to be logged in to access reseller features");
        if($_SESSION['reseller'][0] != "pro"){
            $reason = "You are not on the Reseller Pro plan. Please subscribe to the plan to access that feature";
            $redirectTo = "Location:".$this->page->link."/dashboard?n=".$reason;
            header($redirectTo);
            echo "sd";
        }
    }

    public function redirectTo($page,$join="",$extension=""){
        $redirectTo = "Location:".$this->page->link."/$page".$join.urlencode($extension);
        header($redirectTo); 
        echo "sd";
    }

    public function addPopupAlert(){
        if(isset($_GET['o'])){
              $message = $_GET['o'];
              $dataAlert = "<p class='data_success' style='display:none;'>";
              $dataAlert .= " {$message} </p>";
        }elseif(isset($_GET['n'])){
              $message = $_GET['n'];
              $dataAlert = "<p class='data_error' style='display:none;'>";
              $dataAlert .= " {$message} </p>";
        }
        return !empty($dataAlert)? $dataAlert :"";
    }

    public function addEasysubAlert($array){
        $easysubAlert = "";
        foreach($array as $alert){
            if($alert['type'] == 'error'){
                $easysubAlert .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h4 class='alert-heading mb-5'>{$alert['subject']}</h4> {$alert['message']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>";
            }elseif($alert['type'] == 'success'){
                $easysubAlert .= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <h4 class='alert-heading mb-5'>{$alert['subject']}</h4> {$alert['message']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>";
            }
            elseif($alert['type'] == 'info'){
                $easysubAlert .= "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                <h4 class='alert-heading mb-5'>{$alert['subject']}</h4> {$alert['message']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>";
            }
        }
        return !empty($easysubAlert)? $easysubAlert :"";
    }

    public function redirectIfNetworkError($network,$page,$networkErrorArray){
        $networkError = "Dear customer, unfortunately, The ". ucfirst($network). " order cannot go through right now due to the following reasons :  ";
        foreach($networkErrorArray as $error){
           $networkError .= $error['message'].". ";
        }
        $redirectTo = "Location:".$this->page->link."/$page"."?n=".urlencode($networkError);
        header($redirectTo); 
        echo "yh";
    }

    
}