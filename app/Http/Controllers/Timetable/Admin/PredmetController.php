<?php

namespace App\Http\Controllers\Timetable\Admin;

use App\Http\Controllers\Timetable\Admin\BaseController;
use App\Models\Groups;
use App\Models\Predmets;
use App\Models\Timetable;
use App\Repositories\GroupsRepository;
use App\Repositories\PredmetRepository;
use App\Repositories\TimetableRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class PredmetController extends BaseController
{

    /**
     * @var TimetableRepository|Application|mixed
     */
    private $TimetableRepository;
    private $PredmetRepository;
    private $GroupsRepository;

    public function __construct()
    {
        //Общие свойства проинициализировали
        parent::__construct();
        //Частные свойства проинициализируем
        //Создание объекта blogPostRepository
        //Ларавель сам его создает
        //Не все обьекты надо так создавать
        $this->TimetableRepository = app(TimetableRepository::class);
        $this->PredmetRepository = app(PredmetRepository::class);
        $this->GroupsRepository = app(GroupsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($group_id)
    {
        $date = new Timetable();

        $paginator = $this->PredmetRepository->getAllWithPaginate($group_id);

        return view('admin.predmets.indexPredmet',
            compact('paginator', 'group_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($group_id)
    {
        $item = new Predmets();

        $groupList = $this->GroupsRepository->getForComboBox();

        return view('admin.predmets.createPredmet',
            compact('item', 'groupList', 'group_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, $group_id)
    {
        $item = (new Predmets())->create($request->all());

        if($item) {
            return redirect()->route('predmet.create', ['group_id' => $group_id])
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
        $item = $this->PredmetRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        return view('admin.predmets.editPredmet',
            compact('item', 'group_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $item = $this->PredmetRepository->getEdit($id);

        $data = $request->all();

        $result = $item->update($data);
        if($item) {
            return redirect()->route('predmet.edit', ['group_id' => $group_id, 'predmet' => $item->id])
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
     * @return RedirectResponse
     */
    public function destroy($group_id, $id)
    {
        //софт-удаление, в бд остается
        //$result = Timetable::destroy($id);

        // полное удаление из бд
        $result = Predmets::find($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('predmet.index', ['group_id' => $group_id])
                ->with(['success' => "Запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
