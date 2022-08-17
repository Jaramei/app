<?php

namespace Application\Core\Http\Controllers;

use Application\Core\Repositories\Users\Interfaces\UserInterface;
use Application\Core\Repositories\Roles\Interfaces\RoleInterface;
use App\Http\Controllers\Controller;
use Application\Core\Http\Requests\UserRequest;
use Hash;

class UsersController extends Controller
{

    /**
     * @var UserInterface
     *
     */

    protected $firm;

    /*
     * @var RulesInterface
     */

    protected $rules;

    public function __construct(UserInterface $user, RoleInterface $roles) {

        $this->user = $user;
        $this->roles = $roles;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('core::users.index')
            ->with('roles',$this->roles->all())
            ->with('data',$this->user->with(['roles'])->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->get('password'))]);
        $user = $this->user->create($request->except('roles'));
        $user->roles()->sync($request->roles);


        return back()->with('success', 'The record was created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        return view('core::users.edit')
            ->with('roles',$this->roles->all())
            ->with('roles_user',$this->user->getById($id)->roles->pluck('id')->toArray())
            ->with('model',$this->user->getById($id))
            ->with('data',$this->user->with(['roles'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        if(!$request->has('active')) {

                $request->merge(['active'=>0]);

        }

        if(!is_null($request->password)) {

            $request->merge(['password' => Hash::make($request->get('password'))]);

            $this->user->update($request->except('upload','_method','_token','roles'),$id);

        } else {

           $this->user->update($request->except('upload','_method','_token','roles','password'),$id);

        }


        $this->user->getById($id)->roles()->sync($request->roles);

        return back()->with('success', 'The record was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->user->destroy($id);
        return redirect()->route('users.index')->with('success', 'The record was deleted');
    }
}
