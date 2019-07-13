<table class="default-table">
    <thead>
    <tr>
        <th>Produto</th>
        <th>Nome da instituição</th>
        <th>Valor investido</th>
    </tr>
    </thead>
    <tbody>
    @foreach($product_list as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->institution->name }}</td>
            <td>R$ {{ number_format($product->valueFromUser(Auth::user()), 2, ',', '.') }}</td>
        </tr>
    @endforeach()
    </tbody>
</table>
