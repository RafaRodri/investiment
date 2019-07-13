@include('templates.formularios.input', [
    'input' => 'name',
    'label' => 'Nome do produto'
])

@include('templates.formularios.input', [
    'input' => 'description',
    'label' => 'Descrição'
])

@include('templates.formularios.input', [
    'input' => 'index',
    'label' => 'Indexador'
])

@include('templates.formularios.input', [
    'input' => 'interest_rate',
    'label' => 'Taxa de juros'
])

@include('templates.formularios.submit', [
    'input' => $submit_name
])
