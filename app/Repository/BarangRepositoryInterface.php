<?php

namespace App\Repository;


interface BarangRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateById($id, array $data);
}
