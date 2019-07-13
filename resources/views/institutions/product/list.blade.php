<table class="default-table">
    <thead>
    <tr>
        <td>#</td>
        <td>Nome</td>
        <td>Descrição</td>
        <td>Indexador</td>
        <td>Taxa de juros</td>
        <td>Menu</td>
    </tr>
    </thead>

    <tbody>
    @forelse($institution->products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->index }}</td>
            <td>{{ $product->interest_rate }}</td>
            <td>
                {!! Form::open(['route' => ['institution.product.destroy', $institution->id, $product->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ route('institution.product.edit', [$institution->id, $product->id]) }}">Editar</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">Nenhum produto cadastrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
