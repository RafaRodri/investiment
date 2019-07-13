<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use App\Entities\Institution;


class ProductsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;


    public function __construct(ProductRepository $repository,
                                ProductValidator $validator, ProductService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    public function index($institution_id)
    {
        #$products = $this->repository->findWhere(['institution_id' => $institution_id]);

        /** Sem usar o L5 repository, para efeito de aprendizagem */
        $institution = Institution::find($institution_id);
        #$products = $institution->products;

        return view('institutions.product.index', [
            'institution' => $institution,
        ]);
    }


    public function store(Request $request, $institution_id)
    {
        $request['institution_id'] = $institution_id;
        $request = $this->service->store($request->all());


        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('institution.product.index', $institution_id);
    }


    public function show($id)
    {
        $product = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $product,
            ]);
        }

        return view('products.show', compact('product'));
    }


    public function edit($institution_id, $product_id)
    {
        $product = $this->repository->find($product_id);

        return view('institutions.product.edit', [
            //'institution_id' => $institution_id,
            'product' => $product,
        ]);
    }


    public function update(Request $request, $institution_id, $product_id)
    {
        $request = $this->service->update($request->all(), $product_id);

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);


        return redirect()->route('institution.product.index', $institution_id);
    }



    public function destroy($institution_id, $product_id)
    {
        $this->repository->delete($product_id);

        session()->flash('success', [
            'success'   => true,
            'messages'  => 'Produto removido',
        ]);

        return redirect()->route('institution.product.index', $institution_id);
    }
}
