<table class="default-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome da Instituição</th>
        <th>Menu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($institutions_list as $institution)
        <tr>
            <td>{{ $institution->id }}</td>
            <td>{{ $institution->name }}</td>
            <td>
                {!! Form::open(['route' => ['institution.destroy', $institution->id], 'method' => 'delete']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ route('institution.show', $institution->id) }}">Detalhes</a>
                <a href="{{ route('institution.edit', $institution->id) }}">Editar</a>
                <a href="{{ route('institution.product.index', $institution->id) }}">Produtos</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
