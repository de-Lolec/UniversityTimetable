<?php

namespace App\Http\Controllers\Timetable\Admin;

use App\Models\Timetable;
use App\Repositories\GroupsRepository;
use App\Repositories\PredmetRepository;
use App\Repositories\PrepodRepository;
use App\Repositories\TimetableRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class TimetableController extends BaseController
{

    /**
     * @var TimetableRepository|Application|mixed
     */
    private $TimetableRepository;
    private $PredmetRepository;
    private $GroupsRepository;
    private $PrepodRepository;

    public function __construct()
    {
        //Общие свойства проинициализировали
        parent::__construct();
        //Частные свойства проинициализируем
        //Создание объекта blogPostRepository
        //Ларавель сам его создает
        //Не все обьекты надо так создавать
        $this->PredmetRepository = app(PredmetRepository::class);
        $this->TimetableRepository = app(TimetableRepository::class);
        $this->GroupsRepository = app(GroupsRepository::class);
        $this->PrepodRepository = app(PrepodRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function indexMainPage()
    {
        $date = new Timetable();

        $days_week = $this->TimetableRepository->DaysWeek();

        $timePara = $this->TimetableRepository->timePara();

        $paginator = $this->TimetableRepository->getAllWithPaginate();

        return view('timetable',
            compact('paginator', 'days_week', 'date', 'timePara'));
    }

    public function index($group_id)
    {
        $date = new Timetable();

        $paginator = $this->TimetableRepository->getAllWithPaginateList($group_id);

        return view('admin.timetable.indexTimetable',
            compact('paginator', 'date', 'group_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($group_id)
    {
        $item = new Timetable();

        $groupList = $this->GroupsRepository->getForComboBox();
        $prepodList = $this->PrepodRepository->getForComboBox();
        $predmetList = $this->PredmetRepository->getForComboBox($group_id);

        return view('admin.timetable.createTimetable',
            compact('item', 'predmetList', 'groupList', 'prepodList', 'group_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $group_id)
    {
        $item = (new Timetable())->create($request->all());

        if($item) {
            return redirect()->route('timetable.create', ['group_id' => $group_id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($group_id, $id)
    {
        $item = $this->TimetableRepository->getEdit($id);
        $groupList = $this->GroupsRepository->getForComboBox();
        $prepodList = $this->PrepodRepository->getForComboBox();
        $predmetList = $this->PredmetRepository->getForComboBox($group_id);

        if(empty($id)){
            abort(404);
        }

        return view('admin.timetable.editTimetable',
            compact('item', 'predmetList', 'groupList', 'prepodList', 'group_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $group_id)
    {
        $item = $this->TimetableRepository->getEdit($id);

        $data = $request->all();

        $result = $item->update($data);
        if($item) {
            return redirect()->route('timetable.edit', ['group_id' => $group_id, 'predmet' => $item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($group_id, $id)
    {

        //софт-удаление, в бд остается
        //$result = Timetable::destroy($id);

        // полное удаление из бд
         $result = Timetable::find($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('timetable.index', ['group_id' => $group_id])
                ->with(['success' => "Запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
