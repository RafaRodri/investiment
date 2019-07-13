@include('templates.formularios.input', [
    'input' => 'name',
    'label' => 'Nome do Grupo',
    'attributes' => [
        'placeholder' => 'Nome do Grupo'
    ]
])

@include('templates.formularios.select', [
    'select' => 'user_id',
    'label' => 'Usuário',
    'attributes' => [
        'placeholder' => 'Usuário'
    ],
    'data' => $user_list,
])

@include('templates.formularios.select', [
    'select' => 'institution_id',
    'label' => 'Instituição',
    'attributes' => [
        'placeholder' => 'Instituição'
    ],
    'data' => $institution_list,
])

@include('templates.formularios.submit', [
    'input' => $submit_name
])
