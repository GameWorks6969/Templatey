<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./login.php");
    exit;
}

mkdir("./imgs/u/" .$_SESSION["username"]);
$target_dir = "./imgs/u/" .$_SESSION["username"]. "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "";
    $uploadOk = 0;
  }
}

// Check wether the file already exists or not
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size (10MB)
if ($_FILES["fileToUpload"]["size"] > 1000000) {
  echo "Sorry, your file is too large. (Maximum file size 10mb)";
  $uploadOk = 0;
}

// See if the file being uploaded is actually a image
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo " ";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    header("Location: "." .$target_dir. "/" .$target_file.");
      exit();
  } else {
    echo " ";
  }
}
?>
