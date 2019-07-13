<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Moviment.
 *
 * @package namespace App\Entities;
 */
class Moviment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'group_id', 'product_id', 'value', 'type'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }


    /** escopo que vai trazer somente aplicações de um determinado produto */
    public function scopeProduct($query, $product){
        return $query->where('product_id', $product->id);
    }

    /** escopo que vai trazer aplicações */
    public function scopeApplication($query){
        return $query->where('type', 1);
    }

    /** escopo que vai trazer resgates */
    public function scopeOutflow($query){
        return $query->where('type', 2);
    }



}
