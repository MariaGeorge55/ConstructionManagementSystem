<?php
define('__ROOT__', "../app/");
require_once"header.php";
require_once(__ROOT__ . "View/viewuser.php");
require_once(__ROOT__ . "Model/adminmodel.php");
require_once(__ROOT__ . "Controller/admincontroller.php");
$model= new usersmodel();
$controller=new admincontroller($model);
$view = new viewuser($controller,$model);

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
require_once"footer.php";
?>
