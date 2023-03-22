<?php

namespace App\Http\Controllers\Timetable\User;

use App\Http\Controllers\Timetable\Admin\BaseController;
use App\Models\Prepods;
use App\Models\User;
use App\Repositories\TimetableRepository;
use App\Models\Timetable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index()
    {
        $user = Auth::user();

        return view('users.profile',
        compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = new Timetable();

        return view('users.createTimetable',
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
        $data = $request->input();
        $item = (new Timetable())->create($data);

        $prepod = (new Prepods())-> create($data);
        dd($prepod);
        if($item) {
            return redirect()->route('user.timetable.create', ['id' => Auth::user()->id, 'name' => Auth::user()->name]);
        }
//        foreach($request->get('categories') as $categoryId){
//            $category = Categories::find($categoryId);
//            $post->categories()->save($category);
//        }

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
       // $item = $this->TimetableRepository->getEdit($id);

        $user = Auth::user();

        if(empty($user)){
            abort(404);
        }



        return view('users.editProfile',
            compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
