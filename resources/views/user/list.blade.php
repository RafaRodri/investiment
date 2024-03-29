<table class="default-table">
    <thead>
    <tr>
        <td>#</td>
        <td>CPF</td>
        <td>Nome</td>
        <td>Telefone</td>
        <td>Nascimento</td>
        <td>E-mail</td>
        <td>Status</td>
        <td>Permissão</td>
        <td>Menu</td>
    </tr>
    </thead>

    <tbody>
    @foreach($user_list as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->formattedCpf }}</td>
            <td>{{ $user->name }}</td>
            {{--<td>{{ dd($user) }}</td>--}}
            <td>{{ $user->formattedPhone }}</td>
            <td>{{ $user->formattedBirth }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>{{ $user->permission }}</td>
            <td>
                {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ route('user.edit', $user->id) }}">Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
