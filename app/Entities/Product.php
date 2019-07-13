<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['institution_id', 'name', 'description', 'index', 'interest_rate'];


    /** Relacionamento */
    public function institution(){
        return $this->belongsTo(Institution::class);
    }


    public function moviments(){
        return $this->hasMany(Moviment::class);
    }


    public function valueFromUser(){
        /** Calcular total de forma diferente, utilizando SCOPE (diferente da forma feita em Group.php) */
        #dd($this->moviments()->product($this)->application()->sum('value'));

        $inflows  = $this->moviments()->product($this)->application()->sum('value');
        $outflows = $this->moviments()->product($this)->outflow()->sum('value');

        return $inflows - $outflows;
    }

}
