<?php
  require_once("config.php");
  //echo dirname("config.php");

//echo $_SERVER['DOCUMENT_ROOT'];
class DBh{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $conn;
    private $result;
    public $sql;

    function __construct() {
        $this->servername = DB_SERVER;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->dbname = DB_DATABASE;
        $this->connect();
      }

    public function connect(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function getConn(){
        return $this->conn;
    }

    function query($sql){
        if (!empty($sql)){
                $this->sql = $sql;
                $this->result = $this->conn->query($sql);

                return $this->result;
        }else{
                return false;
        }
}

    function fetchRow($result=""){
            if (empty($result)){ $result = $this->result; }
            return $result->fetch_assoc();
    }

    function __destruct(){
        $this->conn->close();
    }

}
function customError($errno, $errstr,$error_message,$error_line) {
		 error_log("[$errno] $errstr.$error_line.$error_message",3,"errors.log");
   }
   set_error_handler("customError");

/*function gg(){
   <section id="editemployee" class="contact">
        <div class="container">
          <div class="section-EditContract" data-aos="fade-up">
            <h2 class="editc">Edit Contract</h2>
          </div>
            <div class="containerLogin">

              <div class="col-md-12">
            <div class="col-md-6">
                    <div class="card-body card-block">
             <form class="form-horizontal" method = "post" action = "">
                  Client/Companys Name:<br>
                  <input type="text" class="form-control" value="'.$clientname.'" name ="clientname" required="required">
  				Contract Duration:<br>
                  <input type="date" class="form-control" value="'.$duration.'" name="duration" required="required">
  				Down-Payment%:<br>
                  <input type="percent" class="form-control" value="'.$downpayment.'" name="downpayment" required="required">
  				Tax File number:<br>
                  <input type="text" class="form-control" value="'.$tax.'" name="taxfileno" required="required">
  										  <br>
                  <table id="contracts" style="width:700px">
                        <tr>
                          <th>item name</th>
              			      <th>Quantity</th>
                        </tr>      ';
   foreach($itemsarr as $item){
             $str=$str.'<tr>
             <td>'.$itemname=$item->getname().'</td>
               <td>'.$quantity=$item->getquantity() .'   <input type="text" class="form-control" value="'.$quantity.'" name="taxfileno" required="required"> </td>';
             }
               $str=$str.'    <button type="submit" class="btn btn-success btn-smSubmitEditCC" name = "submitedit"  >
                  <i class="fa fa-dot-circle-o"></i> Submit
                </button>
                <button type="button" onclick="myFunction()"class="btn btn-success btn-smEditItemsCC">
                  <i class="fa fa-ban"></i> Edit Selected Item
                </button>
                <button type="reset" class="btn btn-danger btn-smResetCC2">
                  <i class="fa fa-ban"></i> Reset
                </button><br><br>
                </div>
                </div>
                </div>
                  </div>
                    </div>
  ';
  return $str;

}*/
?>
