<template>
    <div >
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Clientes</h4>
                    <button @click="abrirModal('cliente','registrar')" class="btn btn-primary btn-round ml-auto" >
                        <i class="fa fa-plus"></i>
                        Nuevo Cliente
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!--Fin del modal agregar/actualizar-->
                <div class="table-responsive">
                    <table id="tabla_clientes" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>N° Doc</th>
                                <th>Dirección</th>
                                <th>Telefono</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in arrayCliente" :key="cliente.id">     
                                <td v-text="cliente.Nombre"></td>
                                <td v-text="cliente.Tipo_Documento"></td>
                                <td v-text="cliente.Num_Documento"></td>
                                <td v-text="cliente.Direccion"></td>
                                <td v-text="cliente.Telefono"></td>
                                <td>
                                    <div class="form-button-action">
                                        <button @click="abrirModal('cliente','actualizar',cliente)" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" >
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
        <div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button v-if="tipoAccion==1" type="button" id="addRowButton" class="btn btn-success" @click='registrarCliente()'>Registrar</button>
                        <button v-if="tipoAccion==2" type="button" id="addRowButton" class="btn btn-primary" @click="actualizarCliente()">Actualizar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Inicio del modal agregar/actualizar-->  
</template>
<script>
export default {
    data (){
        return{
            //Datos a recibir
            cliente_id : 0,
            Nombre : '',
            Tipo_Documento : '',
            Num_Documento : '',
            Direccion : '',
            Telefono : '',
            Email : '',
            arrayCliente : [],
            //variables para los msj de error y modales
            tituloModal : '',
            tipoAccion : 0,
            errorCliente : 0,
            errorMostrarMsjsCliente : [],
            

        }
    },
    methods:{
        tablaCliente(){
            jQuery(function(){
                jQuery('#tabla_clientes').DataTable();
            });
        },
        listarClientes(){
            let me = this;
            var url = '/cliente';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayCliente = respuesta.clientes;
                me.tablaCliente();
            })
            .catch(function(error){
                console.log(error);
            })
            .finally(function(){

            });
        },
        registrarCliente(){
            //para registrar se utiliza el metodo post de axios
            if(this.validarCliente()){
                return;
            }else{
                let me=this;
                //Las variables Nombre y Descripcion son las definidas en la funcion data
                axios.post('/cliente/registrar',{
                    
                    'Nombre':this.Nombre,
                    'Tipo_Documento' : this.Tipo_Documento,
                    'Num_Documento' : this.Num_Documento,
                    'Direccion' : this.Direccion,
                    'Telefono' : this.Telefono,
                    'Email' : this.Email,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarClientes();
                    swal.fire('Cliente Registrado','','success');
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
        actualizarCliente(){
            //para actualizar se utiliza el metodo put de axios
            if(this.validarCliente()){
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
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarClientes();
                    swal.fire('Cliente Actualizado','','success');
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
        
        validarCliente(){
            this.errorCliente  =   0;
            this.errorMostrarMsjsCliente  =   [];
            if(!this.Nombre) this.errorMostrarMsjsCliente.push('El Nombre Es Requerido');
            

            if(this.errorMostrarMsjsCliente.length){
                this.errorCliente =   1;
            }
            return this.errorCliente;
        },
        cerrarModal(){
            jQuery('#modal_cliente').modal('hide');
            this.tituloModal    =   '';
            
            this.Nombre         =   '';
            this.Tipo_Documento =   '';
            this.Num_Documento  =   '';
            this.Direccion      =   '';
            this.Telefono       =   '';
            this.Email          =   '';
            
            this.errorCliente      =   0;
            
        },
        abrirModal(modelo,accion,data=[]){
            switch(modelo){
                case 'cliente':{
                    switch(accion){
                        case 'registrar':{
                            jQuery('#modal_cliente').modal('show');
                            this.Nombre         =   '';
                            this.Tipo_Documento =   '';
                            this.Num_Documento  =   '';
                            this.Direccion      =   '';
                            this.Telefono       =   '';
                            this.Email          =   '';
                            this.tituloModal        =   'Registrar Cliente';
                            this.tipoAccion         =   1;
                            break;
                        }
                        case 'actualizar':{
                            jQuery('#modal_cliente').modal('show');
                            this.tituloModal    =   'Actualizar Cliente';
                            this.tipoAccion     =   2;
                            this.cliente_id     =   data['id'];
                            this.Nombre         =   data['Nombre'];
                            this.Tipo_Documento =   data['Tipo_Documento'];
                            this.Num_Documento  =   data['Num_Documento'];
                            this.Direccion      =   data['Direccion'];
                            this.Telefono       =   data['Telefono'];
                            this.Email          =   data['Email'];
                            break;
                        }
                    }
                }
            }
            
        },
    },
    mounted(){
        this.listarClientes();
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
