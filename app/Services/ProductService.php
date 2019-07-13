<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductService{
    private $repository;
    private $validator;

    public function __construct(ProductRepository $repository,
                                ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function store($data){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $product = $this->repository->create($data);


            return [
                'success' => true,
                'messages' => 'Produto cadastrado',
                'data' => $product,
            ];
        }
        catch (Exception $e){
            switch(get_class($e)){
                case ValidatorException::class  : return ['success' => false,'messages' => $e->getMessageBag(),];
                default                         : return ['success' => false,'messages' => $e->getMessage(),];
            }
        }

    }

    public function update($data, $id){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $product = $this->repository->update($data, $id);

            return [
                'success' => true,
                'messages' => 'Produto atualizado',
                'data' => $product,
            ];
        }
        catch (Exception $e){
            switch(get_class($e)){
                case ValidatorException::class  : return ['success' => false,'messages' => $e->getMessageBag(),];
                default                         : return ['success' => false,'messages' => $e->getMessage(),];
            }
        }
    }

}
