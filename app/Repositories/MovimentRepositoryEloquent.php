<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MovimentRepository;
use App\Entities\Moviment;
use App\Validators\MovimentValidator;

/**
 * Class MovimentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MovimentRepositoryEloquent extends BaseRepository implements MovimentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Moviment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MovimentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saldo($filter)
    {
         return ([
             'application' => $this->model->where($filter)->application()->pluck('value', 'id')->all(),
             'outflow'     => $this->model->where($filter)->outflow()->pluck('value', 'id')->all(),
             'sum app'     => $this->model->where($filter)->application()->sum('value'),
             'sum out'     => $this->model->where($filter)->outflow()->sum('value'),
             'saldo'       => $this->model->where($filter)->application()->sum('value') - $this->model->where($filter)->outflow()->sum('value'),
         ]);

        //return $this->model->where($filter)->application()->sum('value') - $this->model->where($filter)->outflow()->sum('value');
    }

    
}
