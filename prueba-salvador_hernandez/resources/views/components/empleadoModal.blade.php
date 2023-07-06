<div class="modal modal-lg fade" id="empleadoModal" tabindex="-1" aria-labelledby="empleadoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal" name="tituloModal">Empleado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-4">
                <label for="nameIpx">Nombres:</label>
                <input
                    type="text"
                    id="nameIpx"
                    name="nameIpx"
                    class="form-control"
                    placeholder="Ingrese los nombres del empleado"
                    />
            </div>
            <div class="col-md-4">
                <label for="apellidosIpx">Apellidos:</label>
                <input
                    type="text"
                    id="apellidosIpx"
                    name="apellidosIpx"
                    class="form-control"
                    placeholder="Ingrese los apellidos del empleado"
                    />
            </div>
            <div class="col-md-4">
                <label for="correoIpx">Correo:</label>
                <input
                    type="email"
                    id="correoIpx"
                    name="correoIpx"
                    class="form-control"
                    placeholder="Ingrese el correo electrónico del empleado"
                    />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="telefonoIpx">Telefono:</label>
                <input
                    type="text"
                    id="telefonoIpx"
                    name="telefonoIpx"
                    class="form-control"
                    placeholder="Ingrese un número de teléfono"
                    />
            </div>
            <div class="col-md-4 pt-4">
                <select class="form-select form-select-sm" aria-label=".form-select-sm" id="depaSlct" name="depaSlct">
                    <option value="0" selected>Seleccione un Departamento</option>
                    <div class="departamentoSlctBody">
                        @foreach($departamentos as $departamento)
                        <option value="{{$departamento->id}}">{{$departamento->valor}}</option>
                        @endforeach
                    </div>
                </select>
            </div>
            <div class="col-md-4 pt-4">
                <select class="form-select form-select-sm" aria-label=".form-select-sm" id="muniSlct" name="muniSlct">
                    <option value="0" selected>Seleccione un municipio</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveBtn" name="saveBtn">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn" name="cancelBtn">Cancelar</button>

      </div>
    </div>
  </div>
</div>
