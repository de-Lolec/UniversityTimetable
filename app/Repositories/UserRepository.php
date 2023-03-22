<?php

namespace App\Repositories;

use App\Models\User as Model;
//use Illuminate\Contracts\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class UserRepository extends CoreRepository
{
    /*
     * @return string
     */

    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * @return string[]
     */


    public function getAll()
    {
        $columns = [
            'group',
            'day_num',
            'num_para',
            'time',
            'title',
            'prepod',
            'audience',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('day_num', 'ASC')
            ->orderBy('num_para', 'ASC')
            ->paginate(25);
        //dd();
        return $result;
    }

    /**
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}

