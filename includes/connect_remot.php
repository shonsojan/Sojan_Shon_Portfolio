<?php
$dsn = "mysql:host=localhost:8889;dbname=lmkxq389_shon_portfolio;charset=utf8mb4";
try {
$connection = new PDO($dsn, 'lmkxq389_shonsojan', 'dN(3y!FZN;_^');
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('unable to connect');
}
?>