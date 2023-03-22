<?php

namespace App\Repositories;

use App\Models\University as Model;
//use Illuminate\Contracts\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class UniversityRepository extends CoreRepository
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
        $columns = ['id', 'title', 'groups_id', 'info'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                //можно так
                'groups' => function ($query){
                    $query->select(['id', 'title']);
                },
                'groups:id,title'
                ])
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
    public function getForComboBox($group_id)
    {
        $columns = implode(', ', [
            'id',
            'title',
            'groups_id',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->where('groups_id', $group_id)
            ->toBase()
            ->get();

        // dd($result);

        return $result;
    }
}

