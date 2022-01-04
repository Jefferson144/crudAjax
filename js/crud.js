$(document).ready(function(){ 
    
    /* para actualizar */
    $(document).on('click','.actualizarUser',function(){

        var id = $(this).attr('id'); /* traemos el id que esta en el dom con el atributo id */

        $('#mostrar_user').html(''); /* le damos prioridad a la caja donde se va visualizar nuestro modal de actualizar
        que se va llamar mas adelante */
        $.ajax({ /* hacemos el ajax para enviar los datos */
            url: './modelo/mostrarUsuario.php',
            type: 'POST',
            cache: false,
            data: {idUser:id},
            success:function(data){
                $('#mostrar_user').html(data); /* le pasaremos el data */
                /* este id de abajo es del formulario que nosotros estamos llamando que esta en mostrarUsuario.php */
                $('#actualizarUserModal').modal('show'); /* mostramos el modal */
            }
        })

    })
    
    
    
    /* para eliminar */
    $(document).on('click','.eliminarUser',function(){ /* le doy prioridad cuando se
        da click al boton eliminarUser */
        /* guardo el valor en una variable, lo obtengo mediante el dom mediante el atributo id */
        var id = $(this).attr('id'); /* ACA SIEMPRE SERA ID porque es como decir id="ejemplo" */
        
        Swal.fire({ /* para hacer un modal con sweetalert */
            title: '¿ Esta seguro de eliminar ?', /* titulo de eliminar */
            text: "Esta accion es irreversible", /* texto de eliminar */
            icon: 'warning', /* icono de eliminar */
            showCancelButton: true, /* sintaxis del mensaje de eliminar */
            confirmButtonColor: '#3085d6', /* color de aceptar */
            cancelButtonColor: '#d33', /* color del boton cancelar */
            confirmButtonText: 'ELIMINAR' /* texto del boton eliminar */
          }).then((result) => {
            if (result.isConfirmed) { /* si el resultado es el boton confirmar entonces lo eliminamos */
             $.ajax({ /* trabajamos un ajax para enviar los datos */
                 url: './modelo/deleteUser.php', /* url donde llegan los datos */
                 type: 'POST', /* en el metodo post */
                 data: {idUser:id}, /* el primer parametro es como va llegar y el segundo que le vamos a enviar 
                 id es el var y idUser como llega */
                 success:function(data){ /* sintaxis */
                    /* se elimino correctamente */
                    Swal.fire({
                        icon: 'success',
                        title: 'Se elimino correctamente',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(()=>{
                        window.location.reload(); /* relogeo la pestaña */
                    })
                 }
             })
            }
            })

    })

    /* le hacemos una funcion a todo el formulario */
    /* le damos prioridad al formulario con evento submit para registrar un usuario */
    $("#addUserForm").submit(function(e){
        /* le damos esta linea de codigo que es mas por sintaxis */
        e.preventDefault();
        /* Traemos los datos */
        var primerNombre = $("#primerNombre").val();
        var primerApellido = $("#primerApellido").val();
        var telefono = $("#telefono").val();
        /* comprobamos que no esten vacios */
        if (primerNombre.length == 0 || telefono.length == 0 || primerApellido == 0){
            Swal.fire({
                icon: 'error',
                title: 'Ha ocurrido un error',
                text: 'Intenta nuevamente'
            })
        } else {
            Swal.fire({
                title: 'Insertar usuario',
                text: "¿ Esta seguro de insertar usuario ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Insertar'
              }).then((result) => {
                if (result.isConfirmed) {
                  /* hacemos el ajas que es para donde se va a ir la informacion */        
                    $.ajax({
                        url: './modelo/sentencias.php', /* a que archivo */
                        type: 'POST', /* tipo post o get en este caso post */
                        data: $(this).serialize(), /* el data es enviar la informacion practicamente de forma correcta */
                        cache: false, /* sintaxis */
                        success:function(data){ /* una funcion de que si se haya insertado */
                            Swal.fire({
                                icon: 'success',
                                title: 'Insercion correcta',
                                timer: 1000, /* tiempo de carga del mensaje */
                                showConfirmButton: false,
                            }).then(()=>{ /* cuando termine quiero que la ventana se refresque */
                                window.location.reload();
                            })
                        }
                    })
                }
            })
            /* OPCION 1 DE INSERTAR
            hacemos el ajas que es para donde se va a ir la informacion       
            $.ajax({
                url: './modelo/sentencias.php', a que archivo 
                type: 'POST', tipo post o get en este caso post 
                data: $(this).serialize(), el data es enviar la informacion practicamente de forma correcta
                cache: false, sintaxis
                success:function(data){ una funcion de que si se haya insertado
                    Swal.fire({
                        icon: 'success',
                        title: 'Insercion correcta',
                        timer: 1000, tiempo de carga del mensaje
                        showConfirmButton: false,
                    }).then(()=>{ cuando termine quiero que la ventana se refresque
                        window.location.reload();
                    })
                }
            })*/
        }
    })

})