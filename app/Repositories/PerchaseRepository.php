<?php

namespace App\Repositories;

use App\Models\Perchase;
use App\Repositories\BaseRepository;

/**
 * Class PerchaseRepository
 * @package App\Repositories
 * @version November 3, 2020, 8:01 am UTC
*/

class PerchaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'supplier_id',
        'category_id',
        'product_id',
        'purchase_no',
        'date',
        'description',
        'buying_qty',
        'unit_price',
        'buying_price',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Perchase::class;
    }
}
