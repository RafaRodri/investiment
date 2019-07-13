<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    Use SoftDeletes;
    use Notifiable;

    /**
     * Se "true", os campos created_at, update_at e delete_at, serão usados e o Laravel vai gerenciar de forma automática
     */
    public $timestamps = true;

    /**
     * Nem sempre a tabela respeita o padrão de nomenclatura que o Laravel espera, e aqui deve ser informado (ex.: tbl_usuario)
     * Se tiver seguindo os padrões, não precisa explicitar, pois o Laravel já vai entender de forma automática
     */
    protected $table = 'users';

    /**
     * Array com atributos da tabela
     *
     * Permitindo passar os valores por injeção na classe na hora que está criando
     * Ex.: $usuario = new User(['Rafael', 'email@email.com','1@3#5'])
     *
     * Ao invés de:
     *      $usuario = new User();
     *      $usuario->name = "rafael";
     *      $usuario->email = "email@email.com";
     *      $usuario->password = "1@3#5";
     */
    protected $fillable = ['cpf', 'name', 'phone','birth','gender','notes','email','password','status','permission'];

    /**
     * Array com parâmetros da tabela que serão ocultos quando a busca for feita
     */
    protected $hidden = ['password', 'remember_token',];



    /** Relacionamento N:N (belongsToMany)
     *  Para saber em quais grupos o usuário está
     */
    public function groups(){
        /**
         *  precisa passar como parâmetro também, a tabela que vai gerar p 'apoio' para esse relacionamento
         *
         *  caso, as chaves tivessem uma nomenclatura diferente, poderiam ser passadas como parâmetro também
         *
         */
        return $this->belongsToMany(Group::class, 'user_groups');
    }

    public function moviments(){
        return $this->hasMany(Moviment::class);
    }



    /**  "Camada intermediária" (entre o pedido de salvar a senha e a senha de fato ir para o banco) que vai tratar a senha,
        fazendo uso dos modificadores do Laravel (usados quando definimos ou lemos uma váriavel), nesse caso 'set'
    */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }

    public function getFormattedCpfAttribute(){
        $cpf = $this->attributes['cpf'];

        return substr($cpf, 0, 3). '.' . substr($cpf, 3, 3). '.' . substr($cpf, 6, 3). '-' . substr($cpf, -2);
    }

    public function getFormattedPhoneAttribute(){
        $phone = $this->attributes['phone'];

        return '(' . substr($phone, 0, 2). ') ' . substr($phone, 2, 4). '-' . substr($phone, -4);
    }

    public function getFormattedBirthAttribute(){
        $birth = explode('-', $this->attributes['birth']);

        if(count($birth) != 3)
            return "";

        return $birth[2] . '/' . $birth[1] . '/' . $birth[0];
    }
}
