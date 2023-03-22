<?php

namespace App\Http\Controllers\Timetable\Admin;

use App\Http\Controllers\Timetable\Admin\BaseController;
use App\Models\Groups;
use App\Models\Timetable;
use App\Repositories\GroupsRepository;
use App\Repositories\PredmetRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GroupsController extends BaseController
{
    /**
     * @var Application|mixed
     */
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

        $this->PredmetRepository = app(PredmetRepository::class);
        $this->GroupsRepository = app(GroupsRepository::class);
    }

    public function index()
    {
        $paginator = $this->GroupsRepository->getAllWithPaginate(20);

        return view('admin.groups.indexGroups',
            compact('paginator'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = new Groups();

        return view('admin.groups.createGroups',
            compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $item = (new Groups())->create($request->all());
        if($item) {
            return redirect()->route('groups.create')
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
    public function edit($id)
    {
        $item = $this->GroupsRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        return view('admin.groups.editGroups',
            compact('item'));
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
        $item = $this->GroupsRepository->getEdit($id);

        $data = $request->all();

        $result = $item->update($data);
        if($item) {
            return redirect()->route('groups.edit', $item->id)
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
    public function destroy($id)
    {
        //софт-удаление, в бд остается
        //$result = Timetable::destroy($id);

        // полное удаление из бд
        $result = Groups::find($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('groups.index')
                ->with(['success' => "Запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
