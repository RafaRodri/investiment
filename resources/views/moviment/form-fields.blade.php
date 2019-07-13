@include('templates.formularios.select', [
    'label' => 'Grupo',
    'select' => 'group_id',
    'data' => $group_list ?? [],
])

@include('templates.formularios.select', [
    'label' => 'Produto',
    'select' => 'product_id',
    'data' => $product_list ?? [],
])

@include('templates.formularios.input', [
    'label' => 'Valor',
    'input' => 'value',
])

@include('templates.formularios.submit', [
    'input' => $submit_name
])
