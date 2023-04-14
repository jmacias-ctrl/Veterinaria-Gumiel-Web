@extends('layouts.app')
<title>Gestion Insumos médicos</title>
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-5">
            <h4>Gestion de Insumos Medicos</h4>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-5">
            <a class="btn btn-primary ms-5" href="#" role="button">Agregar insumo</a>
        </div>
    </div>
    <div class="row">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Tipo</th>
            <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            </tr>
        </tbody>
        </table>
    </div>
    <div class="row">
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
            <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
        </ul>
        </nav>
    </div>
    </div>

@endsection
