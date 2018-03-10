<?php
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Models/User.php";
require_once $siteRoot . "Repository/StudentRepository.php";
require_once  $siteRoot . "Repository/FilesRepository.php";
require_once $siteRoot . "Models/Files.php";

use Repository\FilesRepository as FilesRepository;
use Models\Files as Models;
use Models\User as User;
use Repository\StudentRepository as StudentRepository;


$studentRepository = new StudentRepository();
$filesRepository = new FilesRepository();


if (isset($_GET['name'])) {
    $inputValue = $_GET['name'] . '%';
    $result = $studentRepository->partialSearch($inputValue);
} else {
    $result = $studentRepository->selectAllStudents();
}


$html_to_show = '
<div class="container">
    <div class="row showBack">
        <div class="col-md-12">
            <h4> Students </h4>
            <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                        <th></th>
                        <th> First and Last Name</th>
                        <th> Student_id</th>
                        <th> Year of study</th>
                        <th> Assignment status</th>
                        <th> Grade</th>
                        <th> Edit</th>

                        <th> Delete</th>
                        </thead>
                        <tbody>';
                        for ($x = 0; $x < sizeof($result); $x++) {
                            $file= $filesRepository->getFileByID($result[$x]['id']);
                        $html_to_show .= ' <tr>
                            <td>
                               
                                <input type="hidden" class="form-control" name="id" value="' . $result[$x]['id'] . '">
                            </td>

                            <td> '. $result[$x]['name'] . ' ' . $result[$x]['surname'] . '</td>
                            <td> ' . $result[$x]['student_id'] . '</td>
                            <td> ' . $result[$x]['year'] . '</td> ';
                            if ($file==null){

                                $html_to_show .='
                            <td> ' . $result[$x]['assignment_status'] . '</td> ';
                            }else {

                                $html_to_show .= '<td> <a download="'.$file->getName().'" href="uploads/'.$file->getName().'"> '. $file->getName() . '  </a> </td>';
                            }
                            $html_to_show .= ' <td><input type="text" id="insert_grade'. $result[$x]['id'] .'" value="' . $result[$x]['grade'] . '"></td>
                                                       
                            <td>
                            <button name ="update" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"
                             onclick = "update_click(' . $result[$x]['id'] . ', this.parentNode.parentNode.rowIndex)">
                            <span class="glyphicon glyphicon-pencil"></span></button>
                            </td>
                            <td>
                            <button name = "delete" class="btn btn-danger btn-xs delete" data-title="Delete" data-toggle="modal" data-target="#delete" 
                            onclick="reply_click(' . $result[$x]['id'] . ', this.parentNode.parentNode.rowIndex)">
                            <span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>

                        ';
                            }

                        $html_to_show .= '
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                   

            </div>

        </div>
    </div>
    
</div> 

	

    ';


echo $html_to_show;

