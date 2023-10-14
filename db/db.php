<?php
session_start();

function conectarDb()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $conn = '';

  try {
    $conn = new PDO("mysql:host=$servername;dbname=veterinaria", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;

  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  return $conn;
}
?>