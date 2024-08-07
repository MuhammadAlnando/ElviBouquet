<?php
include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Membuat kategori baru
    if(isset($_POST['createCategory'])) {
        $name = $_POST["name"];
        $desc = $_POST["desc"];

        $sql = "INSERT INTO `categories` (`categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES ('$name', '$desc', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $catId = $conn->insert_id;
        if($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newfilename = "card-".$catId.".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/bouquetElviOnline/img/category/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('success');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('failed to upload image');
                            window.location=document.referrer;
                        </script>";
                }

            } else {
                echo '<script>alert("Please select an image file to upload.");
                    </script>';
            }
        }
    }

    // Menghapus kategori
    if(isset($_POST['removeCategory'])) {
        $catId = $_POST["catId"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/bouquetElviOnline/img/category/card-".$catId.".jpg";
        $sql = "DELETE FROM `categories` WHERE `categorieId`='$catId'";   
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (file_exists($filename)) {
                unlink($filename); // Hapus gambar terkait jika ada
            }
            echo "<script>alert('Removed');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    
    // Mengupdate kategori (data dan foto)
    if(isset($_POST['updateCategory'])) {
        $catId = $_POST["catId"];
        $catName = $_POST["name"];
        $catDesc = $_POST["desc"];
        
        $sql = "UPDATE `categories` SET `categorieName`='$catName', `categorieDesc`='$catDesc' WHERE `categorieId`='$catId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if(isset($_FILES["catimage"]["tmp_name"]) && $_FILES["catimage"]["tmp_name"] != "") {
                $check = getimagesize($_FILES["catimage"]["tmp_name"]);
                if($check !== false) {
                    $newfilename = "card-".$catId.".jpg";
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/bouquetElviOnline/img/category/';
                    $uploadfile = $uploaddir . $newfilename;

                    if (move_uploaded_file($_FILES['catimage']['tmp_name'], $uploadfile)) {
                        echo "<script>alert('Update successful');
                                window.location=document.referrer;
                            </script>";
                    } else {
                        echo "<script>alert('Update successful but failed to upload new image');
                                window.location=document.referrer;
                            </script>";
                    }
                } else {
                    echo '<script>alert("Update successful but the uploaded file is not a valid image.");
                            window.location=document.referrer;
                        </script>';
                }
            } else {
                echo "<script>alert('Update successful');
                        window.location=document.referrer;
                    </script>";
            }
        } else {
            echo "<script>alert('Update failed');
                    window.location=document.referrer;
                </script>";
        }
    }
}
?>
