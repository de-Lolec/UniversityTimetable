<?php

namespace App\Repositories;

use App\Models\Timetable as Model;
//use Illuminate\Contracts\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class TimetableRepository extends CoreRepository
{
    /*
     * @return string
     */

    protected function getModelClass()
    {
        return Model::class;
    }

    public function DaysWeek(){
        return [
            '0' => 'Понедельник',
            '1' => 'Вторник',
            '2' => 'Среда',
            '3' => 'Четверг',
            '4' => 'Пятница',
            '5' => 'Суббота',
            '6' => 'Воскресенье',
            '7' => 'Понедельник',
            '8' => 'Вторник',
            '9' => 'Среда',
            '10' => 'Четверг',
            '11' => 'Пятница',
            '12' => 'Суббота',
            '13' => 'Воскресенье',
        ];
    }

    public function timePara(){
        return [
            '1' => '8:30-10:05',
            '2' => '10:15-11:50',
            '3' => '12:00-13:35',
            '4' => '14:15-15:50',
            '5' => '16:00-17:35',
            '6' => '17:45-19:20',
            '7' => '19:30-21:05',
        ];
    }

    public function getAllWithPaginate()
    {

        $columns = [
            'predmets_id',
            'groups_id',
            'day_num',
            'predmets_id',
            'time',
            'week_parity',
            'prepods_id',
            'audience',
        ];

        //startConditions у нас создается экземпляр класса BlogPost

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('day_num', 'ASC')
            ->orderBy('time', 'ASC')
            ->paginate(25);
        //dd();
        return $result;
    }

    public function getAllWithPaginateList($group_id)
    {

        $columns = [
            'id',
            'predmets_id',
            'prepods_id',
            'groups_id',
            'day_num',
            'week_parity',
            'time',
            'audience',
        ];

        //startConditions у нас создается экземпляр класса BlogPost

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('day_num', 'ASC')
            ->orderBy('time', 'ASC')
            ->with([
                //можно так
                'groups' => function ($query){
                    $query->select(['id', 'title']);
                },
                'groups:id,title'
            ])
            ->with([
                'prepods' => function ($query){
                    $query->select(['id', 'name']);
                },
                'prepods:id,name'
            ])
            ->with([
                'predmets' => function ($query){
                    $query->select(['id', 'title']);
                },
                'predmets:id,title'
            ])
            ->where('groups_id', $group_id)
            ->paginate(25);
        //dd();
        return $result;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * Я нихуя не понял, надо разобраться, что то типо клонирования чтоле блять
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

