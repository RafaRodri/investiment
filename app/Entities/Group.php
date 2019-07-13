<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Group extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'user_id', 'institution_id'];

    public $timestamps = true;


    /** Grupo pertence a uma Instituição e tem alguém responsável por ele */
    public function owner(){
        /**
         * belongsTo, esse método indica a qual classe (User) essa classe em questão (Group) pertence.
         * Já trazendo toda a ligação entre as chaves. Sabendo que usa a 'user_id' como chave.
         * E quando tiver um objeto instanciado, é possível acessar através do relacionamento (ex.: $group->owner->name)
         *
         * Resumindo: Group pertence a User
         */
        return $this->belongsTo(User::class, 'user_id');    // precisa especificar o campo a ser relacionado, porque o relacionamento tem um nome diferente (owner e não user)
    }


    /** Relacionamento N:N (belongsToMany)
     *  Para saber quais usuários estão no grupo
     */
    public function users(){
        /**
         *  precisa passar como parâmetro também, a tabela que vai gerar p 'apoio' para esse relacionamento
         *
         *  caso, as chaves tivessem uma nomenclatura diferente, poderiam ser passadas como parâmetro também
         *
         */
        return $this->belongsToMany(User::class, 'user_groups');
    }


    public function institution(){
        /** Group pertence a Institution */
        return $this->belongsTo(Institution::class);
    }

    public function moviments(){
        return $this->hasMany(Moviment::class);
    }

    /** Método acessor para cácular valor */
    public function getTotalValueAttribute(){
        /** Calcular SEM UTILIZAR SCOPE */
        // $total = 0;
        // #dd($this->moviments);

        // foreach($this->moviments as $moviment)
        //     $total += $moviment->value;

        // return $total;

        /** Outra forma, SEM UTILIZAR SCOPE */
        //$inflows  = $this->moviments()->where('type', 1)->sum('value');
        //$outflows = $this->moviments()->where('type', 2)->sum('value');

        //return $inflows - $outflows;

        /** Calcular UTILIZANDO SCOPE */
        #return $this->moviments->sum('value');

        $inflows  = $this->moviments()->application()->sum('value');
        $outflows = $this->moviments()->outflow()->sum('value');

        return $inflows - $outflows;
    }

}
