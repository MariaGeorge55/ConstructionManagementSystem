<?php
define('__ROOT__', "../app/");
require_once"Header.php";
require_once(__ROOT__ . "View/ViewUser.php");
require_once(__ROOT__ . "Model/usersmodel.php");
require_once(__ROOT__ . "Controller/Usercontroller.php");
$model= new usersmodel();
$controller=new UsersController($model);
$view = new ViewUser($controller,$model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
	$controller->{$_GET['action']}();
}

if(isset($_POST['login']))	{

	$name=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	echo $name;

	$controller->login();

	}

?>

<?php echo $view->loginForm();
require_once"Footer.php";
?>
