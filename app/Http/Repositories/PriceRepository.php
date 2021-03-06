<?php

namespace App\Repositories;

use App\Models\Price;
use App\Repositories\BaseRepository;

/**
 * Class PriceRepository
 * @package App\Repositories
 * @version September 21, 2020, 8:07 pm WIB
*/

class PriceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price'
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
        return Price::class;
    }
}
