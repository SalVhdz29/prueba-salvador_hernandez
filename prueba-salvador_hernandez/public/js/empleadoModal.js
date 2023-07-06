
const loadModal=(registrarflg, dataEmpleado, isEditable)=>{

    let titulo = "Crear Empleado";
    let textoBtn ="Guardar Empleado";
    if(!registrarflg){
        titulo = isEditable?"Actualizar Empleado":"Ver Datos de Empleado";
        textoBtn="Actualizar Empleado";
        const {
            id,
            nombre,
            apellido,
            correo,
            telefono,
            id_departamento,
            id_municipio
        } = dataEmpleado;
        $("#nameIpx").val(nombre);
        $("#apellidosIpx").val(apellido);
        $("#correoIpx").val(correo);
        $("#telefonoIpx").val(telefono);
        $("#depaSlct").val(id_departamento);
        $.ajax({
            url:"/api/employees/getMunicipios/"+id_departamento,
            success:(result)=>{
                const {municipios} = result;
                $("#muniSlct").html("");
                const defaultOption ="<option value='0'>Seleccione un municipio</option>";
                    $("#muniSlct").append(defaultOption);
                municipios.map(municipio=>{
                    let selectedOpt="";
                    if(municipio.id == id_municipio){
                        selectedOpt="selected";
                    }
                    const option ="<option value="+municipio.id+">"+municipio.valor+"</option>"
                    $("#muniSlct").append(option);
                })

                $("#muniSlct").val(id_municipio);

            },
            error: (error)=>{
                Swal.fire({
                    icon:"error",
                    title:"Ha ocurrido un error al obtener los municipios",
                    confirmButtonText:"Aceptar"
                })
            }
        });

        //deshabilitando si es modo readonly
       if(!isEditable){
        $("#nameIpx").attr('disabled', !isEditable);
        $("#apellidosIpx").attr('disabled', !isEditable);
        $("#correoIpx").attr('disabled', !isEditable);
        $("#telefonoIpx").attr('disabled', !isEditable);
        $("#depaSlct").attr('disabled', !isEditable);
        $("#muniSlct").attr('disabled', !isEditable);

        $("#saveBtn").attr('disabled',!isEditable);
       }

       localStorage.setItem("idEmpleado",id);
    }

    $("#tituloModal").html(titulo);
    $("#saveBtn").html(textoBtn);
}

$("#depaSlct").on("change", function(){
    $.ajax({
        url:"/api/employees/getMunicipios/"+this.value,
        success:(result)=>{
            const {municipios} = result;
            $("#muniSlct").html("");
            const defaultOption ="<option value='0' selected>Seleccione un municipio</option>";
                $("#muniSlct").append(defaultOption);
            municipios.map(municipio=>{
                const option ="<option value="+municipio.id+">"+municipio.valor+"</option>"
                $("#muniSlct").append(option);
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
})//#depaSlct

const inputsBusqueda=["nameIpx", "apellidosIpx", "correoIpx", "telefonoIpx", "depaSlct", "muniSlct"];

    inputsBusqueda.map(input=>{
        $("#"+input).on('change',function(){
            $(this).removeClass('is-invalid');
        })
    })



$("#cancelBtn").on('click', function(){
    limpiarDataModal()
})

function limpiarDataModal(){
    $("#nameIpx").val("");
    $("#apellidosIpx").val("");
    $("#correoIpx").val("");
    $("#telefonoIpx").val("");
    $("#depaSlct").val(0);
    $("#muniSlct").html("");
    const defaultOption ="<option value='0' selected>Seleccione un municipio</option>";
    $("#muniSlct").append(defaultOption);
    $("#muniSlct").val(0);

    $("#nameIpx").removeAttr('disabled');
    $("#apellidosIpx").removeAttr('disabled');
    $("#correoIpx").removeAttr('disabled');
    $("#telefonoIpx").removeAttr('disabled');
    $("#depaSlct").removeAttr('disabled');
    $("#muniSlct").removeAttr('disabled');
    $("#saveBtn").removeAttr('disabled');
    localStorage.removeItem('idEmpleado');
}
