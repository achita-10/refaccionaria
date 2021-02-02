<template>
    <div >
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Usuarios</h4>
                    <button @click="abrirModal('usuario','registrar')" class="btn btn-primary btn-round ml-auto" >
                        <i class="fa fa-plus"></i>
                        Nuevo Usuario
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabla_usuarios" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>N° Doc</th>
                                <th>Dirección</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in arrayUsuarios" :key="usuario.id">     
                                
                                <td v-text="usuario.Nombre"></td>
                                <td v-text="usuario.Tipo_Documento"></td>
                                <td v-text="usuario.Num_Documento"></td>
                                <td v-text="usuario.Direccion"></td>
                                <td v-text="usuario.usuario"></td>
                                <td v-text="usuario.Rol"></td>
                                <td>
                                    <div class="form-button-action">
                                        <button @click="abrirModal('usuario','actualizar',usuario)" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <template v-if="usuario.Condicion">
                                            <button @click="desactivarUsuario(usuario.id)" type="button" class="btn btn-link btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </template>
                                        <!--De lo contrario se ejecutara este codigo para activar la usuario-->
                                        <template v-else="">
                                            <button @click="activarUsuario(usuario.id)" type="button" class="btn btn-link btn-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg"  role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h5 class="modal-title" v-text="tituloModal">
                            
                        </h5>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--<p class="small">Create a new row using this form, make sure you fill them all</p>-->
                        <form>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group form-group-default">
                                        <label >Nombre</label>
                                        <input type="text" class="form-control" v-model="Nombre" placeholder="Ingrese Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Documento</label>
                                        <input type="text" class="form-control" v-model="Tipo_Documento" placeholder="Documento">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >N° Documento</label>
                                        <input type="text" class="form-control" v-model="Num_Documento" placeholder="N° Documento">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Dirección</label>
                                        <input type="text" class="form-control " v-model="Direccion" placeholder="Ingrese Dirección">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Telefono</label>
                                        <input type="text" class="form-control" v-model="Telefono" placeholder="Telefono">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Correo</label>
                                        <input type="email" class="form-control" v-model="Email" placeholder="email">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Rol</label>
                                        <select name="" id="" class="form-control" v-model="ID_Rol">
                                            <option value="0" selected >Seleccione un rol</option>
                                            <option v-for="rol in arrayRoles" :key="rol.id" :value="rol.id" v-text="rol.Nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Usuario</label>
                                        <input type="text" class="form-control" v-model="Usuario" placeholder="Usuario">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Password</label>
                                        <input type="password" class="form-control" v-model="Password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div v-show="errorCliente" class="form-group div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjsCliente" :key="error" v-text="error">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer no-bd">
                        <button v-if="tipoAccion==1" type="button" id="addRowButton" class="btn btn-success" @click='registrarUsuario()'>Registrar</button>
                        <button v-if="tipoAccion==2" type="button" id="addRowButton" class="btn btn-primary" @click="actualizarUsuario()">Actualizar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin del modal agregar/actualizar-->
    </div>    
    <!--Inicio del modal agregar/actualizar-->  
</template>
<script>
export default {
    data (){
        return{
            //Datos a recibir
            cliente_id:0,
            Nombre : '',
            Tipo_Documento : '',
            Num_Documento : '',
            Direccion : '',
            Telefono : '',
            Email : '',
            Usuario : '',
            Password : '',
            ID_Rol : 0,
            arrayUsuarios : [],
            arrayRoles:[],
            //variables para los msj de error y modales
            tituloModal : '',
            tipoAccion : 0,
            errorCliente : 0,
            errorMostrarMsjsCliente : [],
        }
    },
    methods:{
        tablaUsuario(){
            jQuery(function(){
                jQuery('#tabla_usuarios').DataTable();
            });
        },
        seleccionar_rol(){
            let me = this;
            var url = '/rol/seleccionar_rol';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayRoles = respuesta.roles;
                
            })
            .catch(function(error){
                console.log(error);
            })
            .finally(function(){

            });
        },
        listarUsuarios(){
            let me = this;
            var url = '/users';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayUsuarios = respuesta.usuarios;
                me.tablaUsuario();
            })
            .catch(function(error){
                console.log(error);
            })
            .finally(function(){

            });
        },
        registrarUsuario(){
            //para registrar se utiliza el metodo post de axios
            if(this.validarUsuario()){
                return;
            }else{
                let me=this;
                //Las variables Nombre y Descripcion son las definidas en la funcion data
                axios.post('/users/registrar',{
                    
                    'Nombre':this.Nombre,
                    'Tipo_Documento' : this.Tipo_Documento,
                    'Num_Documento' : this.Num_Documento,
                    'Direccion' : this.Direccion,
                    'Telefono' : this.Telefono,
                    'Email' : this.Email,
                    'Usuario' : this.Usuario,
                    'Password' : this.Password,
                    'ID_Rol' : this.ID_Rol,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuarios();
                    swal.fire('Usuario Registrado','','success');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            }
        },
        actualizarUsuario(){
            //para actualizar se utiliza el metodo put de axios
            if(this.validarUsuario()){
                return;
            }else{
                let me=this;
                //Las variables Nombre y Descripcion son las definidas en la funcion data
                axios.put('/users/actualizar',{
                    'ID'    :   this.cliente_id,
                    'Nombre':this.Nombre,
                    'Tipo_Documento' : this.Tipo_Documento,
                    'Num_Documento' : this.Num_Documento,
                    'Direccion' : this.Direccion,
                    'Telefono' : this.Telefono,
                    'Email' : this.Email,
                    'Usuario' : this.Usuario,
                    'Password' : this.Password,
                    'ID_Rol' : this.ID_Rol,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuarios();
                    swal.fire('Usuario Actualizado','','success');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            }
        },
        activarUsuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: '¿Desea Activar El Usuario?',
            text: "Presione Aceptar para confirmar o Cancelar para regresar",
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me  =   this;
                axios.put('/users/activar',{
                    'ID': id,
                })
                .then(function(response){
                    me.listarUsuarios();
                    swalWithBootstrapButtons.fire(
                    'Usuario Activado',
                    '',
                    'success'
                    );
                })
                .catch(function(error){
                    console.log(error);
                })
                .finally(function(){

                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            });
        },
        desactivarUsuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: '¿Desea Desactivar El Usuario?',
            text: "Presione Aceptar para confirmar o Cancelar para regresar",
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me  =   this;
                axios.put('/users/desactivar',{
                    'ID': id,
                })
                .then(function(response){
                    me.listarUsuarios();
                    swalWithBootstrapButtons.fire(
                    'Usuario Desactivado',
                    '',
                    'success'
                    );
                })
                .catch(function(error){
                    console.log(error);
                })
                .finally(function(){

                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            });
        },
        validarUsuario(){
            this.errorCliente  =   0;
            this.errorMostrarMsjsCliente  =   [];
            if(!this.Nombre) this.errorMostrarMsjsCliente.push('El Nombre Es Requerido');
            if(!this.Usuario) this.errorMostrarMsjsCliente.push('El Usuario Es Requerido');
            if(!this.Password) this.errorMostrarMsjsCliente.push('El Password Es Requerido');
            if(this.ID_Rol==0) this.errorMostrarMsjsCliente.push('El Rol Es Requerido');
            if(this.errorMostrarMsjsCliente.length){
                this.errorCliente =   1;
            }
            return this.errorCliente;
        },
        cerrarModal(){
            jQuery('#modal_usuario').modal('hide');
            this.tituloModal    =   '';
            
            this.Nombre         =   '';
            this.Tipo_Documento =   '';
            this.Num_Documento  =   '';
            this.Direccion      =   '';
            this.Telefono       =   '';
            this.Email          =   '';
            this.Usuario        =   '';
            this.Password       =   '';
            this.ID_Rol         =   0;
            this.errorCliente      =   0;
            
        },
        abrirModal(modelo,accion,data=[]){
            //Se mostraran todos los datos del arrayRoles llamando al metodo seleccionar_rol
            this.seleccionar_rol();
            switch(modelo){
                case 'usuario':{
                    switch(accion){
                        case 'registrar':{
                            jQuery('#modal_usuario').modal('show');
                            this.Nombre         =   '';
                            this.Tipo_Documento =   '';
                            this.Num_Documento  =   '';
                            this.Direccion      =   '';
                            this.Telefono       =   '';
                            this.Email          =   '';
                            this.Usuario        =   '';
                            this.Password       =   '';
                            this.ID_Rol         =   0;
                            this.tituloModal        =   'Registrar Usuario';
                            this.tipoAccion         =   1;
                            break;
                        }
                        case 'actualizar':{
                            jQuery('#modal_usuario').modal('show');
                            this.tituloModal    =   'Actualizar Usuario';
                            this.tipoAccion     =   2;
                            this.cliente_id     =   data['id'];
                            this.Nombre         =   data['Nombre'];
                            this.Tipo_Documento =   data['Tipo_Documento'];
                            this.Num_Documento  =   data['Num_Documento'];
                            this.Direccion      =   data['Direccion'];
                            this.Telefono       =   data['Telefono'];
                            this.Email          =   data['Email'];
                            this.Usuario        =   data['usuario'];
                            this.Password       =   data['password'];
                            this.ID_Rol         =   data['ID_Rol'];
                            break;
                        }
                    }
                }
            }
            
            
        },
    },
    mounted(){
        this.listarUsuarios();
    }
}
</script>
<style>
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
