<?php
$dsn = "mysql:host=localhost;dbname=lmkxq389_shon_portfolio;charset=utf8mb4";
try {
$connection = new PDO($dsn, 'lmkxq389_general', '4qo%_tg^3#v)');
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('unable to connect');
}
?>