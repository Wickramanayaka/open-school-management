<?php

namespace App;

use File;

class DataImport {

    private $file;
    private $file_name;

    public function __construct($file)
    {
        $this->file = $file;
    }
    public function upload()
    {
        $file_name = str_random(16) . "_" . $this->file->getClientOriginalName();
        $this->file->move(storage_path('app\upload_templates'),$file_name);
        $this->file_name = $file_name;
        
    }
    public function parseCSV()
    {
        $handle = fopen(storage_path('app\upload_templates' . DIRECTORY_SEPARATOR . $this->file_name),'r');
        $header = NULL;
        $data_array = [];
        while(($row = fgetcsv($handle,1000,',')) !== FALSE){
            if(!$header)
                $header = $row;
            else {
                $data_array[] = array_combine($header,$row);
            }
        }
        fclose($handle);
        return $data_array;
    }

    public function invalidFile($data, $field, $count)
    {
        if(count($data[0])<>$count){
            return true;
        }    

        foreach ($field as $value) {
            if(!array_key_exists($value, $data[0])){
                return true;
            }
            
        }
        return false;
    }
}