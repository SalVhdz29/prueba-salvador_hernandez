$(document).ready(function(){

    const empleadosTable = new DataTable("#empleadostbl");
    const inputsBusqueda=["nameIpbx", "apellidosIpbx", "correoIpbx", "telefonoIpbx", "departamentosSlct", "municipioSlct"];

    inputsBusqueda.map(input=>{
        $("#"+input).on('change',function(){
            $(this).removeClass('is-invalid');
        })
    })

    $("#registrarEmpleadoBtn").on('click',function(){
        $('#empleadoModal').modal('toggle');
        loadModal(true, null);
    });

    $("#departamentosSlct").on("change", function(){
        $.ajax({
            url:"/api/employees/getMunicipios/"+this.value,
            success:(result)=>{
                const {municipios} = result;
                $("#municipioSlct").html("");
                const defaultOption ="<option value='0' selected>Seleccione un municipio</option>";
                    $("#municipioSlct").append(defaultOption);
                municipios.map(municipio=>{
                    const option ="<option value="+municipio.id+">"+municipio.valor+"</option>"
                    $("#municipioSlct").append(option);
                })

            },
            error: (error)=>{
                Swal.fire({
                    icon:"error",
                    title:"Ha ocurrido un error al obtener los municipios",
                    confirmButtonText:"Aceptar"
                })
            }
        });
    })//#departamentosSlct

    $("#buscarBtn").on('click', function(){
        const nombres = $("#nameIpbx").val();
        const apellidos =$("#apellidosIpbx").val();
        const correo =$("#correoIpbx").val();
        const telefono=$("#telefonoIpbx").val();
        const id_departamento =$("#departamentosSlct").val();
        const id_municipio =$("#municipioSlct").val();
        const patternEmail =/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

        let valid=true;
        // if(nombres === null|| nombres.length === 0){
        //     $("#nameIpbx").addClass("is-invalid");
        //     valid=false;
        // }
        // if(apellidos === null|| apellidos.length === 0){
        //     $("#apellidosIpbx").addClass("is-invalid");
        //     valid=false;
        // }
        if(correo.length > 0 && patternEmail.test(correo) === false){
            $("#correoIpbx").addClass("is-invalid");
            valid=false;
        }
        if(telefono.length > 0 && telefono.length !== 8){
            $("#telefonoIpbx").addClass("is-invalid");
            valid=false;
        }
        // if(id_departamento === null || id_departamento === "0"){
        //     $("#departamentosSlct").addClass("is-invalid");
        //     valid=false;
        // }
        // if(id_municipio === null || id_municipio === "0"){
        //     $("#municipioSlct").addClass("is-invalid");
        //     valid=false;
        // }

        if(!valid){
            Swal.fire({
                icon:"error",
                title:"Campos con errores",
                confirmButtonText:"Aceptar"
            })
            return;
        }
        // Llamada a servicio.
        const data={
            nombres,
            apellidos,
            correo,
            telefono,
            id_departamento,
            id_municipio
        }
        $.ajax({
            url:"/api/employees/obtenerEmpleadosFilter/",
            method:'POST',
            data,
            dataType:'JSON',
            success:(result)=>{

                const {empleados} = result;
                $("#empleadostbl > tbody").html("");

                empleados.map(empleado =>{
                    const empleadoRow = `<tr>
                    <td>${empleado.nombre}</td>
                    <td>${empleado.apellido}</td>
                    <td class="emaillbl">${empleado.correo}</td>
                    <td>${empleado.telefono}</td>
                    <td>${empleado.departamento}</td>
                    <td>${empleado.municipio}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined">
                            <button
                            type="button"
                            class="btn btn-outline-success"
                            onclick="verEmpleado(${empleado.id}, false)"
                            >Ver</button>
                            <button
                            type="button"
                            class="btn btn-outline-warning"
                            onclick="verEmpleado(${empleado.id}, true)"
                            >Actualizar</button>
                            <button
                            type="button"
                            class="btn btn-outline-danger"
                            onclick="eliminarEmpleado(${empleado.id})"
                            >Eliminar</button>
                        </div>
                    </td>
                    </tr>`
                    $("#empleadostbl > tbody").append(empleadoRow)
                });

            },
            error: (error)=>{
                console.log("error: ", error)

                //validación de lado del servidor.
                if(error.status === 422){
                    Swal.fire({
                        icon:"error",
                        title:"Los datos proporcionados no son validos",
                        confirmButtonText:"Aceptar"
                    })
                }else{
                    Swal.fire({
                        icon:"error",
                        title:"Ha ocurrido un error al obtener los empleados",
                        confirmButtonText:"Aceptar"
                    })
                }

            }
        });

    })

    $("#saveBtn").on('click', function(){
        const nombres = $("#nameIpx").val();
        const apellidos =$("#apellidosIpx").val();
        const correo =$("#correoIpx").val();
        const telefono=$("#telefonoIpx").val();
        const id_departamento =$("#depaSlct").val();
        const id_municipio =$("#muniSlct").val();

        const patternEmail =/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

        let valid=true;
        if(nombres === null|| nombres.length === 0){
            $("#nameIpx").addClass("is-invalid");
            valid=false;
        }
        if(apellidos === null|| apellidos.length === 0){
            $("#apellidosIpx").addClass("is-invalid");
            valid=false;
        }
        if(correo === null|| correo.length === 0 || patternEmail.test(correo) === false){
            $("#correoIpx").addClass("is-invalid");
            valid=false;
        }
        if(telefono === null|| telefono.length === 0 || telefono.length !== 8){
            $("#telefonoIpx").addClass("is-invalid");
            valid=false;
        }
        if(id_departamento === null || id_departamento === "0"){
            $("#depaSlct").addClass("is-invalid");
            valid=false;
        }
        if(id_municipio === null || id_municipio === "0"){
            $("#muniSlct").addClass("is-invalid");
            valid=false;
        }

        if(!valid){
            Swal.fire({
                icon:"error",
                title:"Campos con errores",
                confirmButtonText:"Aceptar"
            })
            return;
        }
        // Llamada a servicio.
        const id_empleado = localStorage.getItem("idEmpleado");
        const data={
            id_empleado,
            nombres,
            apellidos,
            correo,
            telefono,
            id_departamento,
            id_municipio
        }
        const method = id_empleado?'PUT':'POST';
        const successMessage = id_empleado?"El empleado se ha Actualizado con éxito":"El empleado se creo con éxito";
        $.ajax({
            url:"/api/employees/empleado/",
            method,
            data,
            dataType:'JSON',
            success:(result)=>{

                Swal.fire({
                    icon:"success",
                    title:successMessage,
                    confirmButtonText:"Aceptar"
                })
                limpiarDataModal()
                $('#empleadoModal').modal('toggle');
                cargarEmpleados();
            },
            error: (error)=>{
                console.log("error: ", error)

                //validación de lado del servidor.
                if(error.status === 422){
                    Swal.fire({
                        icon:"error",
                        title:"Los datos proporcionados no son validos",
                        confirmButtonText:"Aceptar"
                    })
                }else{
                    Swal.fire({
                        icon:"error",
                        title:"Ha ocurrido un error al insertar los datos del empleado",
                        confirmButtonText:"Aceptar"
                    })
                }

            }
        });
    })


}) //document.

function verEmpleado(id_empleado, is_editable){
    $('#empleadoModal').modal('toggle');
    $.ajax({
        url:"/api/employees/empleado/"+id_empleado,
        success:(empleado)=>{
            loadModal(false, empleado, is_editable);

        },
        error: (error)=>{
            Swal.fire({
                icon:"error",
                title:"Ha ocurrido un error al obtener los datos del empleado",
                confirmButtonText:"Aceptar"
            })
        }
    });
}

function eliminarEmpleado(id_empleado){
    Swal.fire({
        title:"Eliminar Empleado",
        icon:"warning",
        text:"¿Desea eliminar este empleado?",
        showCancelButton:true,
        confirmButtonText:"Si, eliminar"
    }).then(result=>{
        if(result.isConfirmed){
            $.ajax({
                url:"/api/employees/empleado/"+id_empleado,
                method:'DELETE',
                success:(result)=>{
                    Swal.fire({
                        icon:"success",
                        title:"Empleado eliminado",
                        text:"El empleado ha sido eliminado con éxito",
                        button:"Aceptar"
                    })

                    cargarEmpleados();

                },
                error: (error)=>{
                    Swal.fire({
                        icon:"error",
                        title:"Ha ocurrido un error al obtener los datos del empleado",
                        confirmButtonText:"Aceptar"
                    })
                }
            });
        }
    })
}

function cargarEmpleados(){
    $.ajax({
        url:"/api/employees/empleado",
        success:(empleados)=>{
            $("#empleadostbl > tbody").html("");

            empleados.map(empleado =>{
                const empleadoRow = `<tr>
                <td>${empleado.nombre}</td>
                <td>${empleado.apellido}</td>
                <td class="emaillbl">${empleado.correo}</td>
                <td>${empleado.telefono}</td>
                <td>${empleado.departamento}</td>
                <td>${empleado.municipio}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined">
                        <button
                        type="button"
                        class="btn btn-outline-success"
                        onclick="verEmpleado(${empleado.id}, false)"
                        >Ver</button>
                        <button
                        type="button"
                        class="btn btn-outline-warning"
                        onclick="verEmpleado(${empleado.id}, true)"
                        >Actualizar</button>
                        <button
                        type="button"
                        class="btn btn-outline-danger"
                        onclick="eliminarEmpleado(${empleado.id})"
                        >Eliminar</button>
                    </div>
                </td>
                </tr>`
                $("#empleadostbl > tbody").append(empleadoRow)
            });

        },
        error: (error)=>{
            console.log("error: ", error)

            //validación de lado del servidor.
            Swal.fire({
                icon:"error",
                title:"Ha ocurrido un error al obtener los empleados",
                confirmButtonText:"Aceptar"
            })

        }
    });
}

function limpiarFiltros(){
    const inputsBusqueda=["nameIpbx", "apellidosIpbx", "correoIpbx", "telefonoIpbx"];

    inputsBusqueda.map(input=>{
        $("#"+input).removeClass('is-invalid');

        $("#"+input).val("");

    })
    $("#departamentosSlct").val(0);
    $("#municipioSlct").html("");
    const defaultOption ="<option value='0' selected>Seleccione un municipio</option>";
    $("#municipioSlct").append(defaultOption);
    $("#municipioSlct").val(0);


    cargarEmpleados();
}

