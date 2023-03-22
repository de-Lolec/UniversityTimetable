<?php

namespace App\Repositories;

use App\Models\Groups as Model;
//use Illuminate\Contracts\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class GroupsRepository extends CoreRepository
{
    /*
     * @return string
     */

    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * Получить список статей для вывода в списке
     * (Админка)
     *
     * @return string[]
     */

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage = 10)
    {
        $columns = ['id', 'title'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * Я нихуя не понял, надо разобраться, что то типо клонирования чтоле блять
     *
     * @param $group_id
     * @return Model
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }
}

