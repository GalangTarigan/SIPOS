<?php

namespace App\Repository\Eloquent;

use App\Model\Dokumentasi_barang;
use App\Repository\DokumentasiBarangRepositoryInterface;

class DokumentasiBarangRepository extends BaseRepository implements DokumentasiBarangRepositoryInterface
{

    /**
     * BarangRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Dokumentasi_barang $model)
    {
        parent::__construct($model);
    }
}
