@extends('layouts.plantilla')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/empleados.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/empleadoModal.js') }}" defer></script>
@endsection

@section('contenidoPrincipal')
@include('components.empleadoModal')
<div class="card text-bg-light mb-3" style="margin-top:5%;">
    <div class="card-header">
        <center>
            <h4 class="card-title">Filtros de búsqueda</h4>
        </center>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label for="nameIpbx">Nombres:</label>
                <input
                    type="text"
                    id="nameIpbx"
                    name="nameIpbx"
                    class="form-control"
                    placeholder="Ingrese los nombres del empleado"
                    />
            </div>
            <div class="col-md-4">
                <label for="apellidosIpbx">Apellidos:</label>
                <input
                    type="text"
                    id="apellidosIpbx"
                    name="apellidosIpbx"
                    class="form-control"
                    placeholder="Ingrese los apellidos del empleado"
                    />
            </div>
            <div class="col-md-4">
                <label for="correoIpbx">Correo:</label>
                <input
                    type="email"
                    id="correoIpbx"
                    name="correoIpbx"
                    class="form-control"
                    placeholder="Ingrese el correo electrónico del empleado"
                    />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="telefonoIpbx">Telefono:</label>
                <input
                    type="text"
                    id="telefonoIpbx"
                    name="telefonoIpbx"
                    class="form-control"
                    placeholder="Ingrese un número de teléfono"
                    />
            </div>
            <div class="col-md-4 pt-4">
                <select class="form-select form-select-sm" aria-label=".form-select-sm" id="departamentosSlct" name="departamentosSlct">
                    <option value="0" selected>Seleccione un Departamento</option>
                    <div class="departamentoSlctBody">
                        @foreach($departamentos as $departamento)
                        <option value="{{$departamento->id}}">{{$departamento->valor}}</option>
                        @endforeach
                    </div>
                </select>
            </div>
            <div class="col-md-4 pt-4">
                <select class="form-select form-select-sm" aria-label=".form-select-sm" id="municipioSlct" name="municipioSlct">
                    <option value="0" selected>Seleccione un municipio</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mt-2">
            <button
                id="buscarBtn"
                name="buscarBtn"
                type="button btn"
                class="btn btn-outline-success"
                >Buscar</button>
                <button
                id="limpiarBtn"
                name="limpiarBtn"
                type="button btn"
                class="btn btn-outline-secondary"
                onclick="limpiarFiltros()"
                >Limpiar filtros</button>
        </div>

        <div class="pt-2">
            <button type="button" class="btn btn-outline-primary mt-2 " id="registrarEmpleadoBtn" name="registrarEmpleadoBtn">
                Registrar Empleado
            </button>
        </div>

        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12">
                <table id="empleadostbl" name="empleadostbl" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                            <td>{{$empleado->nombre}}</td>
                            <td>{{$empleado->apellido}}</td>
                            <td class="emaillbl">{{$empleado->correo}}</td>
                            <td>{{$empleado->telefono}}</td>
                            <td>{{$empleado->departamento}}</td>
                            <td>{{$empleado->municipio}}</td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success"
                                        onclick="verEmpleado({{$empleado->id}}, false)"
                                        >Ver</button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-warning"
                                        onclick="verEmpleado({{$empleado->id}}, true)"
                                        >Actualizar</button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        onclick="eliminarEmpleado({{$empleado->id}})"
                                        >Eliminar</button>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/empleados.js') }}" defer></script>
@endsection
