<table class="default-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome do Grupo</th>
        <th>Valor investido</th>
        <th>Instituição</th>
        <th>Nome do Responsável</th>
        <th>Menu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($group_list as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>R$ {{ number_format($group->total_value, 2, ',', '.') }}</td>
            <td>{{ $group->institution->name }}</td>
            <td>{{ $group->owner->name }}</td>
            <td>
                {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'delete']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ Route('group.show', $group->id) }}">Detalhes</a>
                <a href="{{ Route('group.edit', $group->id) }}">Editar</a>
            </td>
        </tr>
    @endforeach()
    </tbody>
</table>
