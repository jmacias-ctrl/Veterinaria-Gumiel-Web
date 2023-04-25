@include('layouts.layouts_users')
@section('content')
    <a type="button" href="{{ route('productos.create') }}">Crear</a>
    <table class="table-responsive w-full">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th style="display: none;">ID</th>
                <th class="border px-4 py-2">NOMBRE</th>
                <th class="border px-4 py-2">MARCA</th>
                <th class="border px-4 py-2">DESCRIPCION</th>
                <th class="border px-4 py-2">TIPO</th>
                <th class="border px-4 py-2">STOCK</th>
                <th class="border px-4 py-2">PRODUCTO ENFOCADO</th>
                <th class="border px-4 py-2">PRECIO</th>
                <th class="border px-4 py-2">IMAGEN</th>
                <th class="border px-4 py-2">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td style="display: none;">{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->tipo }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->producto_enfocado }}</td>
                    <td>{{ $producto->precio }}</td>

                    <td class="border px-14 py-1">
                        <img src="/imagen/{{ $producto->imagen }}" width="60%">
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex justify-center rounded-lg text-lg" role="group">
                            <!-- botón editar -->
                            <a href="{{ route('productos.edit', $producto->id) }}"
                                class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>

                            <!-- botón borrar -->
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                class="formEliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div>
        {!! $productos->links() !!}
    </div>
@endsection
@section('js-after')
    <script>
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.formEliminar')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: '¿Confirma la eliminación del registro?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#20c997',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire('¡Eliminado!',
                                    'El registro ha sido eliminado exitosamente.', 'success');
                            }
                        })
                    }, false)
                })
        })()
    </script>
@endsection
