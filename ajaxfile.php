<?php

    include 'conn.php';

    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = (($page - 1) * $limit);

    $query = "SELECT course_name, course_description, professor_name, department_name
              FROM course
              INNER JOIN department ON department.department_id = course.department_id
              INNER JOIN professor ON professor.professor_id = course.professor_id
              ";

    if($_GET["query"] != ''){

        $query .= "WHERE REPLACE(course_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(course_description,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(department_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(professor_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','')";
    }
    $query .= 'LIMIT '.$start.', '.$limit.'';
    $result = mysqli_query($conn,$query);

    $output = '
        <table class="table table-striped table-bordered">
        <tr>
            <th>Course Name</th>
            <th>Course Description</th>
            <th>Department Name</th>
            <th>Professor Name</th>
        </tr>
    ';
    
    while( $row = mysqli_fetch_array($result)){
        foreach($result as $row){
            $output .='
            <tr>
                <td>'.$row["course_name"].'</td>
                <td>'.$row["course_description"].'</td>
                <td>'.$row["department_name"].'</td>
                <td>'.$row["professor_name"].'</td>
            </tr>
            ';
        }
        
    }

    $output .= '
        </table>
        <br />
        <div align="center">
            <ul class="pagination">
    ';
    
    $query = "SELECT course_name, course_description, professor_name, department_name
              FROM course
              INNER JOIN department ON department.department_id = course.department_id
              INNER JOIN professor ON professor.professor_id = course.professor_id
              ";

    if($_GET["query"] != ''){
        $query .= "WHERE REPLACE(course_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(course_description,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(department_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','') 
              OR  REPLACE(professor_name,' ','') LIKE REPLACE('"."%".$_GET["query"]."%"."',' ','')";
    }
    $result1 = mysqli_query($conn,$query);
    $totaldata = mysqli_num_rows($result1);


    $totalPages = ceil($totaldata/$limit);

    $prev ='';
    $next ='';

    $page_link = '';

    for($i = 1 ; $i <= $totalPages ; $i++){
        $page_array[] = $i;
    }
    if(!$totalPages == 0){
        for($i = 0 ; $i < count($page_array) ; $i++){
            if($page == $page_array[$i]){
                $page_link .= '
                    <li class="page-item active">
                    <a class="page-link" href="#">'.$page_array[$i].' <span class="sr-only">
                    (current)</span></a>
                    </li>
                    ';
                $prev_id = $page_array[$i] - 1;
                if($prev_id > 0){
                    $prev = '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                    data-page_number="'.$prev_id.'">Previous</a></li>';
                }
                else{
                    $prev = '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                }
                $next_id = $page_array[$i] + 1;
                
                if($next_id > $totalPages){
                    $next = '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';  
                }
                else{
                    $next = '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                    data-page_number="'.$next_id.'">Next</a></li>';
                }
            }
            else{
                $page_link .= ' <li class="page-item"><a class="page-link" href="javascript:void(0)" 
                data-page_number="'.$page_array[$i].'">'.$page_array[$i].'</a></li>
                ';            
            }
        }
    }
    else{
        $output .= '<p colspan="2" align="center">No Data Found</p>';
    }
    
    $output .= $prev.$page_link.$next;

    echo $output;
?>