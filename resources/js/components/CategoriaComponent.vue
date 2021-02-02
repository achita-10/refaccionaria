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
                    <h4 class="card-title">Categorías</h4>
                    <button @click="abrirModal('categoria','registrar')" class="btn btn-primary btn-round ml-auto" >
                        <i class="fa fa-plus"></i>
                        Nueva Categoría
                    </button>
                </div>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="tabla_categorias" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="categoria in arrayCategoria" :key="categoria.id">     
                                <td v-text="categoria.id"></td>
                                <td v-text="categoria.Nombre"></td>
                                <td v-text="categoria.Descripcion"></td>
                                <td>
                                    <div v-if="categoria.Condicion==1">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-button-action">
                                        <button @click="abrirModal('categoria','actualizar',categoria)" type="button" data-toggle="tooltip" title="Editar Información" class="btn btn-link btn-primary btn-lg" >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        
                                        <template v-if="categoria.Condicion">
                                            <button @click="desactivarCategoria(categoria.id)" type="button" title="Desactivar Categoría" class="btn btn-link btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </template>
                                        <!--De lo contrario se ejecutara este codigo para activar la categoria-->
                                        <template v-else="">
                                            <button @click="activarCategoria(categoria.id)" type="button" title="Activar Categoría" class="btn btn-link btn-success">
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
        <div class="modal fade" id="modal_categoria" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group form-group-default">
                                        <label >Nombre</label>
                                        <input type="text" class="form-control" v-model="Nombre" placeholder="Ingrese Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 ">
                                    <div class="form-group form-group-default">
                                        <label >Descripción</label>
                                        <input type="text" class="form-control " v-model="Descripcion" placeholder="Ingrese Descripción">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div v-show="errorCategoria" class="form-group div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjsCategoria" :key="error" v-text="error">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer no-bd">
                        <button v-if="tipoAccion==1" type="button" id="addRowButton" class="btn btn-success" @click='registrarCategoria()'>Registrar</button>
                        <button v-if="tipoAccion==2" type="button" id="addRowButton" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin del modal agregar/actualizar-->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                categoria_id : 0,
                Nombre : '',
                Descripcion : '',
                arrayCategoria : [],
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria : 0,
                errorMostrarMsjsCategoria : [],
            }
        },
       
        methods : {
            tablaCategoria(){
                $(function(){
                    $('#tabla_categorias').DataTable();
                });
            },
            listarCategoria(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/categoria';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayCategoria=respuesta.categorias;
                    me.tablaCategoria();
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            registrarCategoria(){
                //para registrar se utiliza el metodo post de axios
                if(this.validarCategoria()){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.post('/categoria/registrar',{
                        'Nombre':this.Nombre,
                        'Descripcion':this.Descripcion,
                    }).then(function (response) {
                        swal.fire('Categoría Registrada','','success');
                        me.cerrarModal();
                        me.listarCategoria();
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
            actualizarCategoria(){
                //para actualizar se utiliza el metodo put de axios
                if(this.validarCategoria()){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.put('/categoria/actualizar',{
                        'ID'    :   this.categoria_id,
                        'Nombre':this.Nombre,
                        'Descripcion':this.Descripcion,
                    }).then(function (response) {
                        swal.fire('Categoría Actualizada','','success');
                        me.cerrarModal();
                        me.listarCategoria();
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
            activarCategoria(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea Activar Esta Categoria?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/categoria/activar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarCategoria();
                        swalWithBootstrapButtons.fire(
                        'Categoria Activada',
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
            desactivarCategoria(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea Desactivar Esta Categoria?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/categoria/desactivar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarCategoria();
                        swalWithBootstrapButtons.fire(
                        'Categoria Desactivada',
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
            validarCategoria(){
                this.errorCategoria  =   0;
                this.errorMostrarMsjsCategoria  =   [];
                if(!this.Nombre){
                    this.errorMostrarMsjsCategoria.push('El Nombre es requerido');
                }
                if(this.errorMostrarMsjsCategoria.length){
                    this.errorCategoria =   1;
                }
                return this.errorCategoria;
            },
            cerrarModal(){
                jQuery('#modal_categoria').modal('hide');
                this.tituloModal    =   '';
                this.Nombre         =   '';
                this.Descripcion    =   '';
                this.errorMostrarMsjsCategoria = [];
                
            },
            abrirModal(modelo,accion,data=[]){
                switch(modelo){
                    case 'categoria':{
                        switch(accion){
                            case 'registrar':{
                                jQuery('#modal_categoria').modal('show');
                                this.Nombre =   '';
                                this.Descripcion    =   '';
                                this.tituloModal    =   'Registrar Categoría';
                                this.tipoAccion     =   1;
                                break;
                            }
                            case 'actualizar':{
                                jQuery('#modal_categoria').modal('show');
                                this.tituloModal    =   'Actualizar Categoría';
                                this.tipoAccion     =   2;
                                this.categoria_id   =   data['id'];
                                this.Nombre         =   data['Nombre'];
                                this.Descripcion    =   data['Descripcion'];
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.listarCategoria();
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

