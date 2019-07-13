<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSocial extends Model
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
    protected $fillable = [
        'user_id', 'social_network', 'social_id', 'social_email', 'social_avatar'
    ];


    /**
     * Array com parâmetros da tabela que serão ocultos quando a busca for feita
     */
    protected $hidden = [];
}
