<?php
class DB {
  private static function connect() {
      $pdo = new PDO('mysql:host=127.0.0.1;dbname=loginsystem;charset=utf8mb4', 'root', '');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
  }
  public static function query($query, $params = array()) {
    $statement = self::connect()->prepare($query);
    $statement->execute($params);

    if(preg_split("[\s]", $query)[0] == 'SELECT') {
      $data = $statement->fetchAll();
      return $data;
    }
  }
}
