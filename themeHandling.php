<?php 
    include('theme.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $request = json_decode(file_get_contents('php://input'), true);

        if(isset($request['fontType']) && isset($request['fontColor']) && isset($request['backgroundColor']) && isset($request['primaryColor']) && isset($request['secondaryColor'])){
            $theme = new Theme($request['fontType'], $request['fontColor'], $request['backgroundColor'], $request['primaryColor'], $request['secondaryColor']);
            $theme->update();

            echo json_encode(array('status' => 'success', 'message' => 'Theme updated successfully!'));

        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Please fill in all fields'));
        }  
    }


    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $theme = Theme::getTheme();

        echo json_encode($theme);
    }

?>