<?php


function index($dsn, $username, $password, $driver_options) {
  try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
  } catch (PDOException $e) {
    print('Connection failed:' . $e->getMessage());
    die();
  }


  $sql = 'SELECT * FROM users';
  if ($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }

  $sql = 'SELECT * FROM todos';
  if ($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }

  return [
    'users' => $users,
    'todos' => $todos;
}
