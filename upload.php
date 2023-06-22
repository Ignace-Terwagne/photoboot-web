<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check if file was uploaded without errors
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $tokens_data = json_decode(file_get_contents('secure/tokens.json'), true);
    // Get file info
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    // Define allowed image extensions
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    // Check if the file extension is allowed
    if (in_array(strtolower($extension), $allowed_extensions)) {
      // Move file to desired location
      $random_filename = uniqid('', true) . '.' . md5($file_name) . '.jpg';
      $token = bin2hex(random_bytes(8));
      $upload_path = "uploads/" . $random_filename;
      if (move_uploaded_file($file_tmp, $upload_path)) {
        $tokens_data[$token]["timestamp"] = time();
        $tokens_data[$token]["path"] = $upload_path;
        $updated_data = json_encode($tokens_data);
        file_put_contents('secure/tokens.json',$updated_data);
        // Display success message
        echo $token;
      } else {
        // Display error message
        echo "Error uploading file: " . $_FILES["image"]["error"];
      }
    } else {
      // Display error message for invalid file type
      echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
  } else {
    // Display error message
    if (!isset($_FILES["image"])) {
      echo "first error";
    } else {
      echo "Error uploading file: " . $_FILES["image"]["error"];
    }
  }
}
?>