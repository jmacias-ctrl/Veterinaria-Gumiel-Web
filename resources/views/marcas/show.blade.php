@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Marcas') }}</div>
                    <div class="card-body">
                        <form action="{{ route('marcas-update',['id' => $marca->id]) }}" method="POST">
                            @method('PATCH')
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
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $marca->nombre}}">
                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar marca') }}
                                    </button>
                                </div>
                            </div>

                        </form>    

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection