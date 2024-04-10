<?php
session_start();
include_once "config.php";

$target_dir = "konyvKepek/";
$target_file = $target_dir . basename($_FILES["kep"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
  $check = getimagesize($_FILES["kep"]["tmp_name"]);
  if($check !== false) 
  {
    echo "A fájl egy kép - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else 
  {
    echo "A fájl nem egy kép.";
    $uploadOk = 0;
  }
}

    if (file_exists($target_file)) 
    {
    echo "Ez a fájl már használatba van.";
    $uploadOk = 0;
    }

    if ($_FILES["kep"]["size"] > 500000) 
    {
    echo "A fájlod túl nagy.";
    $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) 
    {
    echo "Csak JPG, JPEG, PNG fájlok engedélyezettek.";
    $uploadOk = 0;
    }

    if ($uploadOk == 0) 
    {
        echo "A fájlod nem lett feltöltve.";
    } 
    else
    {
        if (move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) 
        {
          echo "A fájl ". htmlspecialchars( basename( $_FILES["kep"]["kep"])). " fel lett töltve.";
        }
        else
        {
            echo "Volt egy hiba a fájl feltöltés alatt.";
        }
    };