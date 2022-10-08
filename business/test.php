<?php	

 // echo $_POST['tabla'];
  if(isset($_POST['tabla']) && isset($_POST['buscar']) && isset($_POST['column1']) && isset($_POST['column2'])){
    echo json_encode(array('success' => 1));
  }else{
    echo json_encode(array('success' => 0));
  }


?>