<?php
	namespace Models;
	class Users extends Model{

		private $db;
		public $errors;
		public $success;
		public $full_name;
		public $business_name;
		public $email;
		public $phone;
		public $address;
		public $hashed_password;

		public function __construct(){
			$this->db = parent::getConnection();
		}

		public function save(){
			$sql = "INSERT INTO users (full_name, business_name, email, phone, address, hashed_password) VALUES (?,?,?,?,?,?)";
			$prepared = $this->db->prepare($sql);
			return $prepared->execute([$this->full_name, $this->business_name, $this->email, $this->phone,$this->address,$this->hashed_password]);
		}

		public static function checkIfEmailExists($email){
			$true = self::checkUnique("email",$email);
			return $true;
		}

		public static function checkUnique($field,$parameter){
			$db = parent::getConnection();
			$sql = "SELECT $field from users WHERE $field = ?";
			$prepared = $db->prepare($sql);
			$prepared->execute([$parameter]);
			if( $prepared->fetchObject() ){
				// $this->errors->addError(" Oops. This $field already exists in our database.");
				return true;
			}else{
				return false;	
				
			}
		}

		public function activateUser(){
			return $this->checkUserToBeActivated();
		}

		public function checkUserToBeActivated(){
			$sql = "SELECT phone,confirmed FROM users WHERE phone= ? ";
			$prepared=$this->db->prepare($sql);
			$prepared->execute([$this->phone]);
			$user = $prepared->fetchObject();
			if(!isset($user->phone)){
				$this->errors->addError("<p> Oops! This account doesn't exist in our database  </p>");
				return false;
			}
			if($user->confirmed == 1){
				$this->errors->addError("<p> Oops! This account has already been activated  </p>");
				return false;
			}elseif($user->confirmed == 0){
				
				return $this->updateActivatedColumn($user->phone);
			}
		}

		public static function getAllUsers(){
			$db = parent::getConnection();
			$sql = "SELECT * FROM users";
			$prepared = $db->prepare($sql);
			$prepared->execute();
			return $prepared->fetchAll();
		}

		public function updateActivatedColumn($phone){
			$sql = "UPDATE users SET confirmed = 1 WHERE conf_code = ? AND phone = ?";
			
			$prepared = $this->db->prepare($sql);
			return $prepared->execute([$this->confCode,$phone]);
		}

		public function confirmUser($email,$plan){
			$sql = "UPDATE users SET confirmed =1 , subscription ='" .$plan."' WHERE email = ? ";
			
			$prepared = $this->db->prepare($sql);
			return $prepared->execute([$email]);	
		}
		

		public static function logIn($email,$password){
			$db = parent::getConnection();
			$sql ="SELECT * FROM users WHERE email = ? LIMIT 1";
			$prepared= $db->prepare($sql);
			$prepared->execute([$email]);
			$obj = $prepared->fetchObject();
			if( $prepared->rowCount() > 0 && Functions::passwordVerify($password, $obj->hashed_password) ){
				session_regenerate_id();
				$_SESSION['user']= array(
					"id"=> $obj->id,
					"full_name"=> $obj->full_name,
					"profile_img"=> $obj->profile_img,
					"email" => $obj->email,
					 );
					$loginId = $email;
					$loginPass = $password;
					if(!empty($_POST['remember'])){
						setcookie ("loginId", $loginId, time()+ (10 * 365 * 24 * 60 * 60));  
						setcookie ("loginPass",	$password,	time()+ (10 * 365 * 24 * 60 * 60));
					}
					else{
						setcookie ("loginId",""); 
						setcookie ("loginPass","");
					}
					return true;
			}else{
				Functions::addError("login","email/Password wrong");
				return false;
			}

		}

		
		public static function getUserById($id){
			$db = parent::getConnection();
			$id = (int)$id;
			$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
			$prepared = $db->prepare($sql);
			$prepared->execute([$id]);
			$output = $prepared->fetch();
			return $output;
		}
		public static function adminDeleteUser($id){
			$db = parent::getConnection();
			$id = (int)$id;
			$sql = "DELETE * FROM users WHERE id = ?";
			$prepared = $db->prepare($sql);
			return $prepared->execute([$id]);
		}
		public static function deleteUser(){
			$db = parent::getConnection();
			$sql = "DELETE * FROM users WHERE id = ?";
			$prepared = $db->prepare($sql);
			return $prepared->execute([$_SESSION['user']['id']]);
		}
		public static function changeProfileImage($safe_file_name){
			$db = parent::getConnection();
			$sql = "UPDATE users SET profile_img = ?  WHERE id = ?";
			$prepared = $db->prepare($sql);
			$executed = $prepared->execute([$safe_file_name,$_SESSION['user']['id']]);
			if($executed){
				$_SESSION['user']['profile_img'] = $safe_file_name;
			}
			return $executed;
		}

		public static function updateUser($full_name, $email, $phone, $address){
			$db = parent::getConnection();
			$sql = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ?  WHERE id = ?";
			$prepared = $db->prepare($sql);
			$executed = $prepared->execute([$full_name,$email,$phone,$address,$_SESSION['user']['id']]);
			if($executed){
				$_SESSION['user']['full_name'] = $full_name;
			}
			return $executed;
		}

		public static function updatePassword($hashed_password){
			$db = parent::getConnection();
			$sql = "UPDATE users SET `hashed_password` = ? WHERE id = ?";
			$prepared = $db->prepare($sql);
			return $prepared->execute([$hashed_password,$_SESSION['user']['id']]);
			
		}


		public static function updatePasswordRecovery($hashed_password, $email){
			$db = parent::getConnection();
			$sql = "UPDATE users SET `hashed_password` = ? WHERE email = ?";
			$prepared = $db->prepare($sql);
			return $prepared->execute([$hashed_password,$email]);
			
		}

		public static function checkIfUserIsAdmin(){
			$db = parent::getConnection();
			$sql = "SELECT * FROM users WHERE id = ? AND is_admin = 1";
			$prepared = $db->prepare($sql);
			if(isset($_SESSION["user"]["id"])){
				$prepared->execute([$_SESSION["user"]["id"]]);
				$output = $prepared->fetchAll();
				return $output;
			}else{
				return false;
			}
			
		}


		
	}