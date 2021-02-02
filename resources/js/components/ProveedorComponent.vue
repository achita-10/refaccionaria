<template>
    <div >
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Proveedores</h4>
                    <button @click="abrirModal('proveedor','registrar')" class="btn btn-primary btn-round ml-auto" >
                        <i class="fa fa-plus"></i>
                        Nuevo Proveedor
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabla_proveedores" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>N° Doc</th>
                                <th>Dirección</th>
                                <th>Contacto</th>
                                <th>Telefono_C</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="proveedor in arrayProveedor" :key="proveedor.id">     
                                
                                <td v-text="proveedor.Nombre"></td>
                                <td v-text="proveedor.Tipo_Documento"></td>
                                <!-- <td v-text="proveedor.Nombre_Categoria"></td>-->
                                <td v-text="proveedor.Num_Documento"></td>
                                <td v-text="proveedor.Direccion"></td>
                                <!--<td v-text="proveedor.Descripcion"></td>-->
                                <td v-text="proveedor.Contacto"></td>
                                <td v-text="proveedor.Telefono_Contacto"></td>
                                <td>
                                    <div class="form-button-action">
                                        <button @click="abrirModal('proveedor','actualizar',proveedor)" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modal_proveedor" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <label >Contacto</label>
                                        <input type="text" class="form-control" v-model="Contacto" placeholder="Contacto">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-group-default">
                                        <label >Tel. Contacto</label>
                                        <input type="text" class="form-control" v-model="Telefono_Contacto" placeholder="telefono del contacto">
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
                        <button v-if="tipoAccion==1" type="button" id="addRowButton" class="btn btn-success" @click='registrarProveedor()'>Registrar</button>
                        <button v-if="tipoAccion==2" type="button" id="addRowButton" class="btn btn-primary" @click="actualizarProveedor()">Actualizar</button>
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
            Contacto : '',
            Telefono_Contacto : '',
            arrayProveedor : [],
            //variables para los msj de error y modales
            
            tituloModal : '',
            tipoAccion : 0,
            errorCliente : 0,
            errorMostrarMsjsCliente : [],
            

        }
    },
    
    methods:{
        tablaProveedor(){
            $(function(){
                $('#tabla_proveedores').DataTable();
            });
        },
        listarProveedores(){
            let me = this;
            var url = '/proveedor';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayProveedor = respuesta.proveedores;
                me.tablaProveedor();
            })
            .catch(function(error){
                console.log(error);
            })
            .finally(function(){

            });
        },
        registrarProveedor(){
            //para registrar se utiliza el metodo post de axios
            if(this.validarProveedor()){
                return;
            }else{
                let me=this;
                //Las variables Nombre y Descripcion son las definidas en la funcion data
                axios.post('/proveedor/registrar',{
                    
                    'Nombre':this.Nombre,
                    'Tipo_Documento' : this.Tipo_Documento,
                    'Num_Documento' : this.Num_Documento,
                    'Direccion' : this.Direccion,
                    'Telefono' : this.Telefono,
                    'Email' : this.Email,
                    'Contacto' : this.Contacto,
                    'Telefono_Contacto' : this.Telefono_Contacto,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProveedores();
                    swal.fire('Proveedor Registrado','','success');
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
        actualizarProveedor(){
            //para actualizar se utiliza el metodo put de axios
            if(this.validarProveedor()){
                return;
            }else{
                let me=this;
                //Las variables Nombre y Descripcion son las definidas en la funcion data
                axios.put('/cliente/actualizar',{
                    'ID'    :   this.cliente_id,
                    'Nombre':this.Nombre,
                    'Tipo_Documento' : this.Tipo_Documento,
                    'Num_Documento' : this.Num_Documento,
                    'Direccion' : this.Direccion,
                    'Telefono' : this.Telefono,
                    'Email' : this.Email,
                    'Contacto' : this.Contacto,
                    'Telefono_Contacto' : this.Telefono_Contacto,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProveedores();
                    swal.fire('Proveedor Actualizado','','success');
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
        validarProveedor(){
            this.errorCliente  =   0;
            this.errorMostrarMsjsCliente  =   [];
            if(!this.Nombre) this.errorMostrarMsjsCliente.push('El Nombre Es Requerido');
            

            if(this.errorMostrarMsjsCliente.length){
                this.errorCliente =   1;
            }
            return this.errorCliente;
        },
        cerrarModal(){
            jQuery('#modal_proveedor').modal('hide');
            this.tituloModal    =   '';
            
            this.Nombre         =   '';
            this.Tipo_Documento =   '';
            this.Num_Documento  =   '';
            this.Direccion      =   '';
            this.Telefono       =   '';
            this.Email          =   '';
            this.Contacto       =   '';
            this.Telefono_Contacto  =   '';
            
            this.errorCliente      =   0;
            
        },
        abrirModal(modelo,accion,data=[]){
            switch(modelo){
                case 'proveedor':{
                    switch(accion){
                        case 'registrar':{
                            jQuery('#modal_proveedor').modal('show');
                            this.Nombre         =   '';
                            this.Tipo_Documento =   '';
                            this.Num_Documento  =   '';
                            this.Direccion      =   '';
                            this.Telefono       =   '';
                            this.Email          =   '';
                            this.Contacto       =   '';
                            this.Telefono_Contacto  =   '';
                            this.tituloModal        =   'Registrar Proveedor';
                            this.tipoAccion         =   1;
                            break;
                        }
                        case 'actualizar':{
                            jQuery('#modal_proveedor').modal('show');
                            this.tituloModal    =   'Actualizar Proveedor';
                            this.tipoAccion     =   2;
                            this.cliente_id     =   data['id'];
                            this.Nombre         =   data['Nombre'];
                            this.Tipo_Documento =   data['Tipo_Documento'];
                            this.Num_Documento  =   data['Num_Documento'];
                            this.Direccion      =   data['Direccion'];
                            this.Telefono       =   data['Telefono'];
                            this.Email          =   data['Email'];
                            this.Contacto       =   data['Contacto'];
                            this.Telefono_Contacto  =   data['Telefono_Contacto'];
                            break;
                        }
                    }
                }
            }
            
        },
    },
    mounted(){
        this.listarProveedores();
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
