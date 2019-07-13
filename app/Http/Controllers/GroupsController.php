<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;
use App\Repositories\InstitutionRepository;
use App\Repositories\UserRepository;
use App\Entities\Group;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;
    protected $institutionRepository;
    protected $userRepository;


    public function __construct(GroupRepository $repository,
                                GroupValidator $validator,
                                GroupService $service,
                                InstitutionRepository $institutionRepository,
                                UserRepository $userRepository)
    {
        $this->repository               = $repository;
        $this->validator                = $validator;
        $this->service                  = $service;
        $this->institutionRepository    = $institutionRepository;
        $this->userRepository           = $userRepository;
    }


    public function index()
    {
        $groups = $this->repository->all();


        // $user_list = \App\Entities\User::pluck('name', 'id')->all();
        $user_list = $this->userRepository->selectBoxList('name', 'id');
        $institution_list = $this->institutionRepository->selectBoxList('name', 'id');

        return view('groups.index', [
            'groups'            => $groups,
            'user_list'         => $user_list,
            'institution_list'  => $institution_list,
        ]);
    }


    public function store(GroupCreateRequest $request)
    {
        $request    = $this->service->store($request->all());
        $group      = $request['success'] ? $request['data'] : null;


        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('group.index');
    }


    public function userStore(Request $request, $group_id){
        $request    = $this->service->userStore($group_id, $request->all());


        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('group.show', [
            $group_id
        ]);
    }


    public function show($id)
    {
        $groups = $this->repository->find($id);
        // $groups = $this->repository->where('coluna',$id)->first();       // exemplo, se precisa filtrar por outra coluna

        $user_list = $this->userRepository->selectBoxList('name', 'id');

        return view('groups.show', [
            'group' => $groups,
            'users' => $user_list,
        ]);
    }


    public function edit($id)
    {
        /**
         * Fazendo o uso do model para efeito de aprendizagem
         * (Sem usar o L5 repository, como nos anteriores: $group = $this->repository->find($id);)
         */
        $group = Group::find($id);

        $user_list = $this->userRepository->selectBoxList('name', 'id');
        $institution_list = $this->institutionRepository->selectBoxList('name', 'id');

        return view('groups.edit', [
            'group'             => $group,
            'user_list'         => $user_list,
            'institution_list'  => $institution_list,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request = $this->service->update($request->all(), $id);


        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('group.index');
    }



    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->route('group.index');
    }
}
