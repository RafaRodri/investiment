<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    // protected $validator;

    /**
     *
     */
    protected $service;



    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository   = $repository;
        $this->service      = $service;
    }


    public function index()
    {
        $users = $this->repository->all();

        return view('user.index', [
            'users' => $users,
        ]);
    }




    public function store(UserCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        $usuario = $request['success'] ? $request['data'] : null;
        // $users = $this->repository->all();

        /**
         * enviar a sessão (uma única vez) para a view, ou seja, se atualizar a página, será perdida
         * nome e dados armazenados na sessão
         */
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


//        return view('user.index', [
//            'usuario' => $usuario,
//            // 'users' => $users,
//        ]);
        return redirect()->route('user.index');
    }




    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }





    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit', [
            'user' => $user,
        ]);
    }




    public function update(Request $request, $id)
    {
        $request = $this->service->update($request->all(), $id);

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('user.index');
    }




    public function destroy($id)
    {
        $request = $this->service->destroy($id);


        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        // return view('user.index');
        return redirect()->route('user.index');
    }
}
