<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

  private $repository;
  private $validator;

  public function __construct(UserRepository $repository, UserValidator $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }


  public function index()
  {
    return view('user.dashboard');
  }


  /*
   *
   * Error:   Target [App\Repositories\UserRepository] is not instantiable while building [App\Http\Controllers\DashboardController].
   * Motivo:  Ocorre quando não é feito o binding (em providers/RepositoryServiceProvider.php)
   *          está sendo informado que quando o usuário for usar a classe "UserRepository", vai usar a "UserRepositoryEloquent"
   *              public function register()
   *                  {
   *                      $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
   *                  }
   *
   *          Quando usa-se o Eloquent e a camada repository que foi feita a extração no pacote, é possível mudar o tipo de repositório a ser usado
   *          Então, dentro do nosso sistema, vamos sempre tratar como "UserRepository", e esse provider que vai fazer a gestão de qual interface essa
   *          classe vai implementar, e nesse caso será é a "UserRepositoryEloquent"
   *
   *
   * Solução: https://youtu.be/a6JoJfeAy0o?t=325
   *
   *          (em config/app.php) informar que esse provider existe e que o Laravel precisa entender e seguir o que está sendo declarado nele):
   *              App\Providers\RepositoryServiceProvider::class,
   */

  public function auth(Request $request)
  {
    $data = [
      'email' => $request->get('username'),
      'password' => $request->get('password')
    ];

    try {
      /** Se for trabalhar com criptografia */
      if (env('PASSWORD_HASH')) {

        /**
         * Usar classe "Auth" do próprio Laravel para autenticar
         * 1º parâmetro, array com email e password
         * 2º parâmetro, pode ser usado para salvar login em cache (matenha-me conectado)
         **/
        Auth::attempt($data, false);
      } /** Se NÃO for trabalhar com criptografia */
      else {
        $user = $this->repository->findWhere(['email' => $request->get('username')])->first();
        if (!$user)
          throw new Exception("O e-mail informado é inválido.");

        if ($user->password != $request->get('password'))
          throw new Exception("Senha incorreta");


        /** Fazer autenticação a partir de um objeto (sem Auth::attempt), como já temos o usuário em uma variável */
        Auth::login($user);
      }
      return redirect()->route('user.dashboard');
    } catch (Exception $e) {
      //return $e->getMessage();
      session()->flash('success', [
        'success' => false,
        'messages' => $e->getMessage(),
      ]);

      return redirect()->route('user.login');
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('user.login');
  }
}
