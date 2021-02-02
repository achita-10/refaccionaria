<template>
<!--Directivas-->
<!--
    v-model : enlaca a los componente html con las variables definidas en el data
    v-text : muestra el texto de las variables definidas en el data
    v-for : recorre los array definidos en el data

-->
<div >
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Roles</h4>
                <button @click="abrirModal('usuario','registrar')" class="btn btn-primary btn-round ml-auto" >
                    <i class="fa fa-plus"></i>
                    Nuevo Rol
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla_roles" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th># Rol</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rol in arrayRol" :key="rol.id">     
                            
                            <td v-text="rol.id"></td>
                            <td v-text="rol.Nombre"></td>
                            <td v-text="rol.Descripcion"></td>
                            <td>
                                <div v-if="rol.Condicion==1">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
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
        data(){
            return{
                rol_id : 0,
                Nombre : '',
                Descripcion : '',
                arrayRol : [],
                //esta variable modal sirve para visualizar u ocultar nuestro modal
                tituloModal : '',
                tipoAccion : 0,
            }
        },
        methods : {
            tablaRol(){
                jQuery(function(){
                    jQuery('#tabla_roles').DataTable();
                });
            },
            listarRol(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/rol';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayRol=respuesta.roles;
                    me.tablaRol();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            
            
        },
        mounted() {
            this.listarRol();
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

