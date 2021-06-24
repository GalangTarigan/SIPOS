<?php
namespace App\Pkl\Traits;
use App\Model\Provinces;
use App\Model\Regencies;
trait WilayahIndonesia
{
    /**
     * Get the name of given provinces id
     * 
     * @param integer $id
     * @return string
     */
    public function getProvinceName($id){
        $provinceName = Provinces::select('name')->find($id);
        return $provinceName->name;
    }

    /**
     * Get the name of given regency id
     * 
     * @param integer $id
     * @return string
     */
    public function getRegencyName($id){
        $regencyName = Regencies::select('name')->find($id);
        return $regencyName->name;
    }
}