@include('templates.formularios.input', [
    'input' => 'cpf',
    'label' => 'CPF',
    'attributes' => [
        'placeholder' => 'CPF'
    ]
])

@include('templates.formularios.input', [
    'input' => 'name',
    'label' => 'Nome',
    'attributes' => [
        'placeholder' => 'Nome'
    ]
])

@include('templates.formularios.input', [
    'input' => 'phone',
    'label' => 'Telefone',
    'attributes' => [
        'placeholder' => 'Telefone'
    ]
])

@include('templates.formularios.input', [
    'input' => 'email',
    'label' => 'E-mail',
    'attributes' => [
        'placeholder' => 'E-mail'
    ]
])

@include('templates.formularios.password', [
    'input' => 'password',
    'label' => 'Senha',
    'attributes' => [
        'placeholder' => 'Senha'
    ]
])

@include('templates.formularios.submit', [
    'input' => $submit_name
])
