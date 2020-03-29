<?php
namespace Output;
use Interfaces\LogOutPutInterface;

class JsonOutput implements LogOutPutInterface {
    /**
     * @param string $data
     */
    public static function output($data) {
        $jsonData = json_encode($data);
        echo $jsonData;
    }
}