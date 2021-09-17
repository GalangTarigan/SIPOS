<?php

namespace App\Repository\Eloquent;

use App\Model\Barang;
use App\Repository\BarangRepositoryInterface;
use Illuminate\Support\Collection;

class BarangRepository extends BaseRepository implements BarangRepositoryInterface
{

    /**
     * BarangRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Barang $model)
    {
        parent::__construct($model);
    }
    public function updateById($id, array $data)
    {
        Barang::where('id_barang', $id)->update($data);
    }
}
