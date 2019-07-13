@include('templates.formularios.input',[
    'input' => 'name',
    'label' => 'Nome',
    'attributes' => [
        'placeholder' => 'Nome'
    ]
])

@include('templates.formularios.submit', [
    'input' => $submit_name
])
