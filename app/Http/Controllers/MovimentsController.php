<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Entities\Moviment;
use App\Entities\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;

use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class MovimentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovimentsController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(MovimentRepository $repository,
                                MovimentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function index(){
        return view('moviment.index', [
           'product_list' => Product::all(),
        ]);
    }

    public function all(){
        $moviment_list = Auth::user()->moviments;

        return view('moviment.all', [
            'moviment_list' => $moviment_list,
        ]);
    }



    public function application()
    {
        /* Instância do usuário logado, dando assim a possibilidade de acessar métodos desse objeto */
        $user           = Auth::user();

        /* Trazer grupos do usuário logado */
        $group_list     = $user->groups->pluck('name', 'id');

        /* Outra forma de fazer o select, sem usar o repository (SelectBox, que haviamos feito nas outras situações) */
        #$group_list     = Group::all()->pluck('name', 'id');
        $product_list   = Product::all()->pluck('name', 'id');

        return view('moviment.application', [
            'group_list'    => $group_list,
            'product_list'  => $product_list,
        ]);
    }

    public function storeApplication(Request $request)
    {
        /** Sem utilizar a camada de serviço (para efeito de aprendizagem) */
        #dd($request->all());

        $movimento = Moviment::create([
            'user_id'       => Auth::user()->id,
            'group_id'      => $request->get('group_id'),
            'product_id'    => $request->get('product_id'),
            'value'         => $request->get('value'),
            'type'          => 1,
        ]);


        session()->flash('success', [
            'success'   => true,
            'messages'  => 'Sua aplicação de ' . $movimento->value . ', no produto ' . $movimento->product->name . ' foi realizada com sucesso',
        ]);

        return redirect()->route('moviment.application');
    }



    public function withdraw()
    {
        /* Instância do usuário logado, dando assim a possibilidade de acessar métodos desse objeto */
        $user           = Auth::user();

        /* Trazer grupos do usuário logado */
        $group_list     = $user->groups->pluck('name', 'id');

        /* Outra forma de fazer o select, sem usar o repository (SelectBox, que haviamos feito nas outras situações) */
        #$group_list     = Group::all()->pluck('name', 'id');
        $product_list   = Product::all()->pluck('name', 'id');

        return view('moviment.withdraw', [
            'group_list'    => $group_list,
            'product_list'  => $product_list,
        ]);
    }

    public function storeWithdraw(Request $request)
    {
        $filterGroupAndProduct  = ['group_id' => $request['group_id'], 'product_id' => $request['product_id']];

        $movimentInProduct  = Auth::user()->moviments()->where($filterGroupAndProduct)->pluck('value', 'id');


        if($request['value'] === null){
            session()->flash('success', [
                'success'   => false,
                'messages'  => 'Valor não foi informado.',
            ]);
        }

        elseif(count($movimentInProduct) === 0){
            session()->flash('success', [
                'success'   => false,
                'messages'  => 'Neste grupo, você não possui investimentos neste produto.',
            ]);
        }

        else {
            $saldoDisponivel = $this->repository->saldo($filterGroupAndProduct);
            #dd($saldoDisponivel);

            /** É possível realizar o resgate */
            if($request['value'] < $saldoDisponivel['saldo']) {

                /** Sem utilizar a camada de serviço (para efeito de aprendizado) */
                $movimento = Moviment::create([
                    'user_id'   => Auth::user()->id,
                    'group_id'  => $request->get('group_id'),
                    'product_id'=> $request->get('product_id'),
                    'value'     => $request->get('value'),
                    'type'      => 2,
                ]);


                session()->flash('success', [
                    'success'   => true,
                    'messages'  => 'Seu resgate de ' . $movimento->value . ', no produto ' . $movimento->product->name . ' foi realizado com sucesso.',
                ]);
            }
            else{

                session()->flash('success', [
                    'success'   => true,
                    'messages'  => 'Saldo insuficiente.',
                ]);
            }
        }

        return redirect()->route('moviment.withdraw');
    }
}
