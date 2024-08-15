<?php

function get_records($tbl_name)
{ 
  global $conn;
  $num_per_pages = 4;
  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  $start_from = ($page - 1) * $num_per_pages;

  $sql = "SELECT COUNT(*) AS total FROM $tbl_name";
  $result = mysqli_query($conn, $sql);
  $total_records = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_records / $num_per_pages);
  $_SESSION['total_pages'] = $total_pages;
  
  $query = "SELECT * FROM $tbl_name LIMIT $num_per_pages OFFSET $start_from";
  $result = $conn->query($query);
  $rows = [];
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
  }
  return $rows;
}


function edit_record($tbl_name, $fields, $id_column)
{
  global $conn;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST[$id_column];

    $set_clause = [];
    $params = [];
    $param_types = '';

    foreach ($fields as $field => $value) {
      $set_clause[] = "$field = ?";
      $params[] = $_POST[$value];
      $param_types .= 's';
    }

    $params[] = $id;
    $param_types .= 'i';

    $set_clause_str = implode(', ', $set_clause);
    $query = "UPDATE $tbl_name SET $set_clause_str WHERE $id_column = ?";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
      die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param($param_types, ...$params);

    $result = $stmt->execute();

    if ($result) {
      header("Location: {$_POST['redirect_url']}");
      exit;
    } else {
      $error = "Update failed: (" . $stmt->errno . ") " . $stmt->error;
      echo $error;
    }

  }
}


function insert_record($tbl_name, $fields)
{
  global $conn;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $columns = [];
    $placeholders = [];
    $params = [];
    $param_types = '';

    foreach ($fields as $field => $value) {
      $columns[] = $field;
      $placeholders[] = '?';
      $params[] = $_POST[$value];
      $param_types .= 's'; // Adjust as necessary based on field types
    }

    $columns_str = implode(', ', $columns);
    $placeholders_str = implode(', ', $placeholders);
    $query = "INSERT INTO $tbl_name ($columns_str) VALUES ($placeholders_str)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
      die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param($param_types, ...$params);

    $result = $stmt->execute();

    if ($result) {
      header("Location: {$_POST['redirect_url']}");
      exit;
    } else {
      $error = "Insert failed: (" . $stmt->errno . ") " . $stmt->error;
      echo $error;
    }
  }
}

function fetch_edit_record($tbl_name)
{
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    global $conn;
    $query = "SELECT * FROM $tbl_name WHERE id=$id";
    $result = $conn->query($query);
    if ($result) {
      $row = $result->fetch_assoc();
    }
    return $row;
  }
}






function delete_record($tbl_name)
{
  global $conn;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM $tbl_name WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
      header("Location: {$_SERVER['HTTP_REFERER']}");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}


function get_product($tbl_name)
{ 
  global $conn;
  $query = "SELECT * FROM $tbl_name limit 4";
  $result = $conn->query($query);
  $rows = [];
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
  }
  return $rows;
}

function get_images($tbl_name) {
  // Assuming you have a database connection $conn
  global $conn;
  
  $sql = "SELECT * FROM $tbl_name";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
      error_log("Error fetching images: " . mysqli_error($conn));
      return [];
  }

  $images = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $images[] = $row;
  }

  return $images;
}


function get_image_by_id($tbl_name, $id) {
    // Assuming you have a database connection $conn
    global $conn;
    
    $sql = "SELECT * FROM $tbl_name WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        error_log("Error fetching images: " . mysqli_error($conn));
        return [];
    }

    $row = mysqli_fetch_assoc($result);
    return $row;
}




function get_Settingz($setting_key)
{
    global $conn;
    $query = "SELECT setting_value FROM tbl_site_settings WHERE setting_key = '$setting_key'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['setting_value'];
    } else {
        return null; // or handle error accordingly
    }
}


