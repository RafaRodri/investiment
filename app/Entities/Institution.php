<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Institution.
 *
 * @package namespace App\Entities;
 */
class Institution extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = true;


    /** Definir o relacionamento entre as duas classes modelo */
    public function groups(){
        /** Tipo de relacionamento que temos da Instituição com o Grupo, é de 1-n
         * (1 grupo pertence somente  a 1 instituição, e 1 instituição tem vários grupos)
         *
         * Nesse caso, usamos o 'hasMany'
         */
        return $this->hasMany(Group::class);

    }


    public function products(){
        return $this->hasMany(Product::class);
    }

}
