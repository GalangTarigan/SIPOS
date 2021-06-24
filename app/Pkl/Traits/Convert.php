<?php
namespace App\Pkl\Traits;
trait Convert 
{
    public function convertToTimeStamps($input){
        $result = date("Y-m-d", strtotime(str_replace('/', '-', $input)));
        return $result;
    }
}