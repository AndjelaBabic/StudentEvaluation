
<?php
session_start();

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/FilesRepository.php";

use Repository\FilesRepository as FilesRepository;

$filesRepos = new FilesRepository();

    if (is_uploaded_file($_FILES['my-file']['tmp_name']) && $_FILES['my-file']['error'] == 0) {
        $path = '../uploads/' . $_FILES['my-file']['name'];
        if (!file_exists($path)) {
            if (move_uploaded_file($_FILES['my-file']['tmp_name'], $path)) {
                $myFile = $_FILES['my-file'];
                $id_student = $_SESSION['login_user-student'];
                $result = $filesRepos->insertFile($myFile['name'], $myFile['type'], $myFile['size'], $id_student);

                $file = $filesRepos->getFileByID($id_student);
                $_SESSION['file'] =  $file->getName();
                $_SESSION['upload-success'] = "The file was uploaded successfully.";

            } else {
                $_SESSION['upload-error'] = "The file was not uploaded successfully.";
            }
        } else {
            $_SESSION['upload-error'] = "File already exists. Please upload another file.";
        }
    } else {
        $_SESSION['upload-error'] = "The file was not uploaded successfully.";
//      echo "(Error Code:" . $_FILES['my-file']['error'] . ")";
    }


    header("Location: ../index.php");


//    $files = scandir("uploads");
//    for ($a = 2; $a < count($files); $a++){
//                ?>
<!--        <p>-->
<!--        <a download="--><?php //echo $files[$a] ?><!--" href="uploads/--><?php //echo $files[$a] ?><!--"> --><?php //echo $files[$a]?><!--  </a>-->
<!--        </p>-->
<!--    --><?php
//}
?>