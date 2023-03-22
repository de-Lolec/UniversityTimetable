<?php

namespace App\Http\Controllers\Timetable\Admin;

use App\Http\Controllers\Timetable\Admin\BaseController;
use App\Models\Prepods;
use App\Models\Timetable;
use App\Repositories\PrepodRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrepodsController extends BaseController
{

    /**
     * @var Application|mixed
     */
    private $PrepodRepository;

    public function __construct()
    {
        //Общие свойства проинициализировали
        parent::__construct();
        //Частные свойства проинициализируем
        //Создание объекта blogPostRepository
        //Ларавель сам его создает
        //Не все обьекты надо так создавать
        $this->PrepodRepository = app(PrepodRepository::class);
    }

    public function index()
    {
        $date = new Timetable();

        $paginator = $this->PrepodRepository->getAllWithPaginate();

        return view('admin.prepods.indexPrepods',
            compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = new Prepods();

        return view('admin.prepods.createPrepods',
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
        $item = (new Prepods())->create($request->all());
        if($item) {
            return redirect()->route('prepods.create')
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
     * @return \Illuminate\Http\Response
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
        $item = $this->PrepodRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        return view('admin.prepods.editPrepods',
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
        $item = $this->PrepodRepository->getEdit($id);

        $data = $request->all();

        $result = $item->update($data);
        if($item) {
            return redirect()->route('prepods.edit', $item->id)
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
        $result = Prepods::find($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('prepods.index')
                ->with(['success' => "Запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
