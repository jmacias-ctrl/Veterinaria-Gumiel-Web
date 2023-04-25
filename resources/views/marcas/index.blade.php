@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Marcas') }}</div>
                    <div class="card-body">
                        <form action="{{ route('marcas') }}" method="POST">
                            @csrf

                            @if (session('success'))
                                <h6 class=" alert alert-success">{{session('success')}}</h6>
                            @endif

                            @error('nombre')
                                <h6 class=" alert alert-danger">{{ $message }}</h6>
                            @enderror
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre de Marca') }}</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre">
                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar marca') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                                <div class="col-md-8 offset-md-2 pt-3">
                            @foreach ($marcas as $marca)
                                <div class="row py-1">
                                    <div class="col-md-9 d-flex align-items-center">
                                        <a href="{{ route('marcas-edit',['id' => $marca->id]) }}">{{ $marca->nombre}}</a>
                                    </div>

                                    <div class="col-md-3 d-flex justify-content-end">
                                        <form action="{{ route('marcas-destroy',[$marca->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">{{ __('Eliminar') }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection