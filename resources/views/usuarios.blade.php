<x-app title="Usuários">
    <div class="row">
        <div class="col-4 p2">
            <x-adminlte-info-box title="Total de usuários" text="{{ $total }}" icon="fas fa-lg fa-users text-dark"
                theme="gradient-teal" />
        </div>
        <div class="col-4 p2">
            <x-adminlte-info-box title="Técnicos" text="{{ $tecnicos }}" icon="fas fa-lg fa-screwdriver text-dark"
                theme="gradient-primary" />
        </div>
        <div class="col-4 p2">
            <x-adminlte-info-box title="Administradores" text="{{ $admins }}" icon="fas fa-lg fa-user-tie text-dark"
                theme="gradient-info" />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>
                                <button class="btn btn-link @if($usuario->admin) text-success @else text-white @endif" url="{{ route('changeAdmin',['user'=>$usuario]) }}">
                                    <i class="fas fa-user-tie"></i>
                                </button>
                                <button class="btn btn-link @if($usuario->tecnico)text-success @else text-white @endif" url="{{ route('changeTecnico',['user'=>$usuario]) }}">
                                    <i class="fas fa-screwdriver"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            <form action="#" id="change_user" method="post">
                @csrf
            </form>
        </div>
    </div>
    @push('js')
       <script>
            document.querySelectorAll('table button.btn').forEach(element => {
                element.addEventListener('click',function(event){
                    const form = document.getElementById('change_user');
                    form.action = event.currentTarget.getAttribute('url');
                    form.submit();
                })
            });
       </script>
    @endpush
</x-app>