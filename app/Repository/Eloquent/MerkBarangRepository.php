<?php

namespace App\Repository\Eloquent;

use App\Model\Merk_Barang;
use App\Repository\MerkBarangRepositoryInterface;

class MerkBarangRepository extends BaseRepository implements MerkBarangRepositoryInterface
{

    /**
     * BarangRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Merk_Barang $model)
    {
        parent::__construct($model);
    }
}
