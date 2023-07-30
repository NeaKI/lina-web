<?php 

class DATABASE {
  private $PDO;
  private $dberror = false;



  /**
   * construct
   */
  function __construct(){
    $this->db_connect();
    if($this->dberror){
      return false;
    }
  }



  /**
   * db connect
   */
  private function db_connect() {
    require_once(__DIR__ . "/conf.inc.php");
    try {
      $__pdo = new PDO('mysql:host='._DB_HOST.';dbname='._DB_DBNAME.'', ''._DB_USER, ''._DB_PASS);
      #$__pdo = new PDO('mysql:unix_socket=/run/mysqld/mysqld.sock;dbname='._DB_DBNAME.'', ''._DB_USER, ''._DB_PASS);
      $this->PDO = $__pdo;
    }catch(PDOException $e) {
      $this->dberror = true;
      echo "Connection to Database failed!";
      #echo "Connection to Database failed! " . $e->getMessage();
      exit;
    } 
  }



  /**
   * check web-admin login
   */
  public function webadmin_login($argUsername, $argPassword){
    $statement = $this->PDO->prepare("SELECT * FROM web_admin WHERE name=? AND password=? AND active='1' LIMIT 1 ");
    $statement->execute(array($argUsername, $argPassword));   
    $countRows = $statement->rowCount();

    if($countRows === 1){
      return $argPassword . "true";
    }

    return $argPassword . "false";
  }




  /**
   * select
   */
  private function select($argPrepare, $argValue){
      try {
        $statement = $this->PDO->prepare("SELECT * " . $argPrepare);
        $statement->execute($argValue);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        return $ex;
      }
  }






  /**
   * ############################################
   * ############################################
   * sql methods
   */




  /**
   * select all admins
   */
  public function select_webadmin_getAll(){
    $prepare = "FROM web_admin";
    $value = [];

    return $this->select($prepare, $value);
  }


  /**
   * select all from table
   */
  public function selectAllFromTable(string $argTable = "", int $argLimit = 0, string $argSortColumn = "id", string $argSortDirection = "ASC"){
    $prepare = "FROM ";
    $value = [];

    if(trim($argTable) != ""){
      $prepare .= $argTable;

      if(trim($argSortColumn) != "" && trim($argSortDirection) != ""){
        $prepare .= " ORDER BY ".trim($argSortColumn)." ".strtoupper(trim($argSortDirection))." ";
      }

      if(trim($argLimit) != "" && $argLimit > 0){
        $prepare .= " LIMIT " . $argLimit;
      }

      return $this->select($prepare, $value);
    }

    return null;
  }


  /**
   * new admin
   */
  public function new_admin(string $argName = "", string $argFullname = "", string $argEmail = "", string $argPassword = "", int $argActive = 1){

    $statement = $this->PDO->prepare("INSERT INTO web_admin (name, fullname, email, password, active) VALUES (?,?,?,?,?)");
    $value = [$argName, $argFullname, $argEmail, $argPassword, $argActive];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }

  /**
   * change admin value
   */
  public function change_admin_value(int $argId = 0, string $argKey = "", string $argVal = ""){
    switch($argKey){
      case "password":
        $statement = $this->PDO->prepare("UPDATE web_admin SET password = ? WHERE name != 'sysadmin' AND id = ?");
      break;
      case "active":
        $statement = $this->PDO->prepare("UPDATE web_admin SET active = ? WHERE name != 'sysadmin' AND id = ?");
      break;
      case "candelete":
        $statement = $this->PDO->prepare("UPDATE web_admin SET candelete = ? WHERE name != 'sysadmin' AND id = ?");
      break;
      case "role":
        $statement = $this->PDO->prepare("UPDATE web_admin SET role = ? WHERE name != 'sysadmin' AND id = ?");
      break;
    }
    $value = [$argVal, $argId];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }


  /**
   * delete admin
   */
  public function delete_admin(int $argId = 0){

    $statement = $this->PDO->prepare("DELETE FROM web_admin WHERE name != 'sysadmin' AND candelete != 0 AND id=?");
    $value = [$argId];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }












  /**
   * select by where
   */
  public function selectQuery(string $argQuery){
      try {
        $statement = $this->PDO->query("SELECT * FROM " . $argQuery);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        return $ex;
      }
  }

  /**
   * select by where
   */
  public function deleteQuery(string $argTable, string $argQuery){
      try {
        $statement = $this->PDO->query("DELETE FROM " . $argTable . " WHERE " . $argQuery);
        return $statement->execute();
      }catch(PDOException $ex){
        return $ex;
      }
  }

  /**
   * select by where
   */
  public function selectSingleWhere(string $argTable, string $argWhereKey = "id", string $argWhereComparison = "=", string $argWhereVal = "0", string $argOrderKey = "id", string $argWhereDirection = "DESC"){
      try {
        $statement = $this->PDO->prepare("SELECT * FROM $argTable WHERE $argWhereKey $argWhereComparison ? ORDER BY $argOrderKey $argWhereDirection");
        $statement->execute([$argWhereComparison]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        return $ex;
      }
  }

  /**
   * insert row multi-values
   */
  public function insertMultiValue(string $argTable = "", string $argKey = "", string $argKeyVal = "", array $argRows = [], array $argValues = []){
    $statement = $this->PDO->prepare("INSERT INTO $argTable ($argKey) VALUES (?)");
    $value = [$argKeyVal];

    try {
      $statement->execute($value);
      $insertId = $this->PDO->lastInsertId();
      if($insertId > 0){
          for($i = 0; $i <= (count($argRows)-1); $i++) {
              $arrRow = $argRows[$i];
              $arrVal = $argValues[$i];
              $this->update_tuple($argTable, $arrRow, $arrVal, "id", $insertId);
          }
      }
      return $insertId;
    }catch(PDOException $ex){
      return $ex;
    }
  }



  /**
   * insert row
   */
  public function insertSingleValue(string $argTable = "", string $argKey = "", string $argKeyVal = ""){
    $statement = $this->PDO->prepare("INSERT INTO $argTable ($argKey) VALUES (?)");
    $value = [$argKeyVal];

    try {
      return $statement->execute($value);
    }catch(PDOException $ex){
      return $ex;
    }
  }



  /**
   * update tuple
   */
  public function update_tuple(string $argTable = "", string $argColumn = "", string $argValue = "", string $argRowKey = "", string $argKey = ""){
    $statement = $this->PDO->prepare("UPDATE $argTable SET $argColumn = ? WHERE $argRowKey = ?");
    $value = [$argValue, $argKey];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }



  /**
   * update tuple by id and one value
   */
  public function update_tuple_by_id(string $argTable = "", int $argId = 0, string $argColumn = "", string $argValue = ""){
    $statement = $this->PDO->prepare("UPDATE $argTable SET $argColumn = ? WHERE id = ?");
    $value = [$argValue, $argId];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }



  /**
   * delete tuple
   */
  public function delete_by_id(string $argTable = "", int $argId = 0){

    $statement = $this->PDO->prepare("DELETE FROM $argTable WHERE id=?");
    $value = [$argId];

    try {
      return $statement->execute($value);
      #return true;
    }catch(PDOException $ex){
      return $ex;
    }
  }



}

$DATABASE = new DATABASE();