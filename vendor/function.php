<?php 
    require_once('../config/connect.php');

    $name_table = $_POST['name-table'];
    $name_col = $_POST['name-col'];
    $type_col = $_POST['type-col'];

    //$script
    //for($i = 1; $i++){
    //    if(i==0){
    //        $script = $script.$name_col[$i].' '.$type_col[$i]; 
    //        
    //    }else{
    //        $script = $script.'';
    //        $script = $script.$name_col[$i].' '.$type_col[$i]; 
    //    }
    //}
//
    //for ($i = 0; $i < count($name_col); $i++) { 
    //    if ($i == 0) { 
    //        $script = $script . $name_col[$i] . ' ' . $type_col;  
    //    } else { 
    //        $script = $script . ', ' . $name_col[$i] . ' ' . $type_col;  
    //    } 
    //}
    print($name_table);
    print($name_col);
    print($type_col);
?>