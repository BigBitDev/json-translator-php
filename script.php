<?php

// Handle file upload
if(isset($_FILES["fileToUpload"])) {
    //validar si el archivo cargado es un json
    $file_type = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
    if($file_type != "json"){
        echo "Error: the file is not json";
        return;
    }
    $json = json_decode(file_get_contents($_FILES["fileToUpload"]["tmp_name"]), true);

    function translate($text){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-free.deepl.com/v2/translate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "auth_key=8f4ebfbe-1527-843c-1fb2-a9a8b82c5da2:fx&text=$text&target_lang=ES");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $translatedWords = json_decode($result, true); 
        $result = $translatedWords['translations'][0]['text']; 

        return $result;
    }

    function translate_json($json){
        foreach($json as &$element){
            if(isset($element["title"])){
                $element["title"] = translate($element["title"]);
            }
            if(is_array($element)){
                $element = translate_json($element);
            }
        }
        return $json;
    }

    $json = translate_json($json);
    $json = json_encode($json);
    header("Content-disposition: attachment; filename=translated_file.json");
    header("Content-type: application/json");
    echo $json;
}

?>