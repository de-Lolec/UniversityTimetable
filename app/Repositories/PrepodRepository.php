<?php

namespace App\Repositories;

use App\Models\Prepods as Model;
//use Illuminate\Contracts\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class PrepodRepository extends CoreRepository
{
    /*
     * @return string
     */

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage = 10)
    {
        $columns = ['id', 'name', 'university_id', 'email', 'info'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'university:id,title'
                ])
            ->paginate($perPage);

        return $result;
    }

    /**
     *
     * @param $group_id
     * @return Model
     */
    public function getForComboBox()
    {
        // return $this->startConditions()->all();

        $columns = implode(', ', [
            'id',
            'name',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        // dd($result);

        return $result;
    }
}

