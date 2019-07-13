<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Exception;

class GroupService
{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function store($data){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);


            return [
                'success' => true,
                'messages' => 'Grupo cadastrado',
                'data' => $group,
            ];
        }
        catch (Exception $e){

            // verificar qual é a classe da variável '$e', para assim listar melhor o erro
            switch(get_class($e)){
                // case QueryException::class      : return ['success' => false,'messages' => $e->getMessage(),];
                case ValidatorException::class  : return ['success' => false,'messages' => $e->getMessageBag(),];
                // case Exception::class           : return ['success' => false,'messages' => $e->getMessage(),];
                default                         : return ['success' => false,'messages' => $e->getMessage(),];
            }
        }
    }

    public function userStore($group_id, $data){
        try{
//            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $group      = $this->repository->find($group_id);
            $user_id    = $data['user_id'];


            /**
             *  Relacionamento do usuário com o grupo
             *
             *  attach vai pegar o objeto grupo e inserir no relacionamento n:n uma entrada, entre o user_id e o group
             */
            $group->users()->attach($user_id);

            //dd($group->users());
            //dd($group->users);


            return [
                'success' => true,
                'messages' => 'Usuário relacionado com sucesso',
                'data' => $group,
            ];
        }
        catch (Exception $e){

            // verificar qual é a classe da variável '$e', para assim listar melhor o erro
            switch(get_class($e)){
                // case QueryException::class      : return ['success' => false,'messages' => $e->getMessage(),];
                case ValidatorException::class  : return ['success' => false,'messages' => $e->getMessageBag(),];
                // case Exception::class           : return ['success' => false,'messages' => $e->getMessage(),];
                default                         : return ['success' => false,'messages' => $e->getMessage(),];
            }
        }
    }

    public function update($data, $id){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $group = $this->repository->update($data, $id);


            return [
                'success' => true,
                'messages' => 'Grupo atualizado',
                'data' => $group,
            ];
        }
        catch (Exception $e){

            // verificar qual é a classe da variável '$e', para assim listar melhor o erro
            switch(get_class($e)){
                // case QueryException::class      : return ['success' => false,'messages' => $e->getMessage(),];
                case ValidatorException::class  : return ['success' => false,'messages' => $e->getMessageBag(),];
                // case Exception::class           : return ['success' => false,'messages' => $e->getMessage(),];
                default                         : return ['success' => false,'messages' => $e->getMessage(),];
            }
        }
    }
}
