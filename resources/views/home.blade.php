<x-app title="Dashboard">
<div class="container-fuild">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-dark">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('isAdmin')
                    {{ __('You are logged in!') }}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
</x-app>
