<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Artículos</h4>
                    <button @click="abrirModal('articulo','registrar')" class="btn btn-primary btn-round ml-auto" >
                        <i class="fa fa-plus"></i>
                        Nuevo Artículo
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- /.modal fin aplicaciones-->
                <div class="table-responsive">
                    <table id="tabla_articulos" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codígo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                                <th>N° Parte</th>
                                <!-- <th>Estado</th> -->
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                                <td v-text="articulo.id"></td>
                                <td v-text="articulo.Codigo" ></td>
                                <td v-text="articulo.Nombre"></td>
                                <td v-text="articulo.Precio_Venta"></td>
                                <td v-text="articulo.Descripcion"></td>
                                <td v-text="articulo.Stock"></td>
                                <td v-text="articulo.N_Parte"></td>
                                <!-- <td>
                                    <div v-if="articulo.Condicion">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>
                                </td> -->
                                <td>
                                    <div class="form-button-action">
                                        <button @click="abrirModal('articulo','actualizar',articulo)" type="button" data-toggle="tooltip" title="Actualizar Información" class="btn btn-link btn-primary btn-lg" >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button @click="abrirModalAp(articulo)" type="button" data-toggle="tooltip" title="Registrar Aplicación" class="btn btn-link btn-info btn-lg" >
                                            <i class="fas fa-drafting-compass"></i>
                                        </button>
                                        <template v-if="articulo.Condicion">
                                            <button @click="desactivarArticulo(articulo.id)" type="button" title="Desactivar Artículo" class="btn btn-link btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </template>
                                        <!--De lo contrario se ejecutara este codigo para activar la articulo-->
                                        <template v-else="">
                                            <button @click="activarArticulo(articulo.id)" type="button" title="Activar Artículo" class="btn btn-link btn-success">
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
        <!--inicio modal articulo-->
        <div class="modal fade" id="modal_articulo" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group form-group-default">
                                        <template v-if="AccionImagen==0 || ActualizarImagen==1">
                                            <img-inputer class="img-fluid" v-model="file" theme="light" size="large"/>
                                        </template>
                                        <template v-else>
                                            <img v-bind:src="'img/'+Imagen" alt="Foto del Artículo" width="100%" height="190px" @click="showSingle" >
                                            <VueEasyLightbox
                                            :visible="visible"
                                            :imgs="imgs"
                                            :index="index"
                                            @hide="handleHide"
                                            ></VueEasyLightbox>
                                        </template>
                                        
                                        
                                    </div>
                                </div>
                                <template v-if="ActualizarImagen==0">
                                    <div class="col-sm-6 col-md-6 ">
                                        <div class="form-group form-group-default">
                                            <label>Codígo</label>
                                            <input v-model="Codigo" type="text" class="form-control" placeholder="Codígo de Barra">
                                            
                                        </div>
                                        <barcode :value="Codigo" :options="{format: 'EAN - 13'}">Generando Codígo de Barras</barcode>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Categoría</label>
                                            <select class="form-control" v-model="ID_Categoria">
                                                <!--El valor del primer option es 0 por que la variable ID_Categoria inicialmente es 0-->
                                                <option value="0">Seleccionar</option>
                                                <!--iniciamos un bluque que mostrará todas las categorias activas 
                                                con un value de categoria.id
                                                y el texto que se mostrara con la directiva v-text-->
                                                <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.Nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Nombre</label>
                                            <input v-model="Nombre" type="text" class="form-control" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Precio de Venta</label>
                                            <input v-model="Precio_Venta" type="text" class="form-control" placeholder="precio de venta" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Precio de Compra</label>
                                            <input v-model="Precio_Compra" type="text" class="form-control" placeholder="precio de compra" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Stock</label>
                                            <input v-model="Stock" type="number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>N° Parte</label>
                                            <input v-model="N_Parte" type="text" class="form-control" placeholder="N° parte" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>N° SAT</label>
                                            <input v-model="N_SAT" type="text" class="form-control" placeholder="N° SAT" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Clave Unidad</label>
                                            <input v-model="C_Unidad" type="text" class="form-control" placeholder="Clave unidad" >
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Descripción</label>
                                            <input v-model="Descripcion" type="text" class="form-control" placeholder="descripción" >
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div v-show="errorArticulo" class="form-group div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjsArticulo" :key="error" v-text="error">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer no-bd">
                        <template v-if="ActualizarImagen==0">
                            <button v-if="AccionImagen==1" @click="cambiarImagen()" type="button"  class="btn btn-success" >Actualizar Imagen</button>
                            <button v-if="tipoAccion==1" type="button"  class="btn btn-success" @click='registrarArticulo()'>Registrar</button>
                            <button v-if="tipoAccion==2" type="button"  class="btn btn-primary" @click="actualizarArticulo()">Actualizar</button>
                        </template>
                        <template v-else>
                            <button @click="regresar()" type="button"  class="btn btn-info" >Regresar</button>
                            <button @click="actualizarImagen()" type="button"  class="btn btn-success" >Actualizar</button>
                        </template>
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--fin modal articulo-->
        <!--Inicio Modal aplicaciones-->
        <div class="modal fade" id="modal_aplicacion" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg"  role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h5 class="modal-title" v-text="tituloModalAp">
                            
                        </h5>
                        <button type="button" class="close" @click="cerrar_M_A()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--<p class="small">Create a new row using this form, make sure you fill them all</p>-->
                    
                    <template v-if="sugerencias==1 || sugerencias==3">
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Modelo <span style="color:red;" v-show="Modelo==''">(*)</span></label>
                                            <input v-model="Modelo" type="text" class="form-control" placeholder="Modelo">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Motor <span style="color:red;" v-show="Motor==''">(*)</span></label>
                                            <input v-model="Motor" type="text" class="form-control" placeholder="Motor" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Año <span style="color:red;" v-show="Año==''">(*)</span></label>
                                            <input v-model="Año" type="text" class="form-control" placeholder="Año" >
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </template>
                    <template v-else>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tabla_aplicaciones" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>N° App</th>
                                            <th>Modelo</th>
                                            <th>Motor</th>
                                            <th>Año</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="aplicacion in arrayAplicacion" :key="aplicacion.id">
                                            <td v-text="aplicacion.id"></td>
                                            <td v-text="aplicacion.Modelo"></td>
                                            <td v-text="aplicacion.Motor"></td>
                                            <td v-text="aplicacion.Ano"></td>
                                            <td>
                                                <button @click="editarAplicacion(aplicacion)" type="button" data-toggle="tooltip" title="Editar Aplicación" class="btn btn-link btn-primary btn-lg" >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                    
                    <div class="modal-footer no-bd">
                        <template v-if="sugerencias==3">
                            <button type="button" class="btn btn-info" @click='actualizarAplicacion()'>Actualizar</button>
                        </template>
                        <template v-if="sugerencias==2">
                            <button type="button" class="btn btn-info" @click='mostrarForm()'>Regresar</button>
                        </template>
                        <template v-else-if="sugerencias==1">
                            <button type="button" class="btn btn-info" @click='mostrarAplicaciones()'>Aplicaciones</button>
                            <button type="button" class="btn btn-success" @click='registrarAplicacion()'>Registrar</button>
                        </template>
                        
                        <button type="button" class="btn btn-secondary" @click="cerrar_M_A()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Inicio del modal agregar/actualizar-->  
</template>

<script>

    import VueBarcode from 'vue-barcode';
    import Vue from 'vue';
    import ImgInputer from 'vue-img-inputer'
    import 'vue-img-inputer/dist/index.css'
    import VueEasyLightbox from 'vue-easy-lightbox'
    Vue.component('ImgInputer', ImgInputer)
    export default {
        data(){
            return{
                articulo_id : 0,
                ID_Categoria : 0,
                Nombre_Categoria : '',
                Codigo : '',
                Nombre : '',
                Precio_Venta : '',
                Precio_Compra : '',
                N_Parte : '',
                N_SAT : '',
                Stock : 0,
                Numero_Articulo : 0,
                C_Unidad : 'H87',
                Descripcion : '',
                arrayArticulo : [],
                //esta variable modal sirve para visualizar u ocultar nuestro modal
                tituloModal : '',
                tipoAccion : 0,
                errorArticulo : 0,
                errorMostrarMsjsArticulo : [],
                arrayCategoria : [],
                //variables para el modal aplicaciones
                sugerencias: 1,
                tituloModalAp : '',
                Modelo : '',
                Motor : '',
                Año : '',
                arrayAplicacion : [],
                aplicacion_id: 0,
                //Variables para las imagenes
                AccionImagen : 0,
                ActualizarImagen : 0,
                Imagen : '',
                file : null,
                imgs: '',  // Img Url , string or Array
                visible: false,
                index: 0   // default

            }
        },
        //Seccion para el código de barras
        components: {
            'barcode': VueBarcode,
            VueEasyLightbox
        },
        
        methods : {
            showSingle() {
                this.imgs = 'img/' + this.Imagen;
                this.show()
            },
            // showMultiple() {
            //     this.imgs = ['http://via.placeholder.com/350x150', 'http://via.placeholder.com/350x150']
            //     this.index = 1  // index of imgList
            //     this.show()
            // },
            show() {
                this.visible = true
            },
            handleHide() {
                this.visible = false
            },
            tablaArticulo(){
                $(function() {
                    $('#tabla_articulos').DataTable();
               });   
                
            },
            tablaAplicacion(){
                jQuery(function(){
                    jQuery('#tabla_aplicaciones').DataTable();
                });
            },
            listarArticulo(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/articulo';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayArticulo=respuesta.articulos;
                    me.Numero_Articulo = respuesta.Numero_Articulo;
                    me.tablaArticulo();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            listarAplicaciones(id_articulo){
                // Make a request for a user with a given ID
                let me=this;

                var url = '/aplicacion/obtenerAplicaciones?ID_Articulo='+id_articulo;
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayAplicacion=respuesta.aplicaciones;
                    me.tablaAplicacion();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            seleccionarCategoria(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/categoria/seleccionar_categoria';
                axios.get(url).then(function (response) {
                    // handle success
                    
                    var respuesta = response.data;
                    me.arrayCategoria=respuesta.categorias;
                    //me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },   
            registrarArticulo(){
                //para registrar se utiliza el metodo post de axios
                if(this.validarArticulo()){
                    return;
                }else{
                    let me=this;
                    //Creamos el formData
                    var data = new  FormData();
                    data.append('Numero',this.Numero_Articulo);
                    data.append('ID_Categoria', this.ID_Categoria);
                    data.append('Codigo', this.Codigo);
                    data.append('Nombre', this.Nombre);
                    data.append('Precio_Venta', this.Precio_Venta);
                    data.append('Precio_Compra', this.Precio_Compra);
                    data.append('N_Parte', this.N_Parte);
                    data.append('N_SAT', this.N_SAT);
                    data.append('Stock', this.Stock);
                    data.append('Descripcion', this.Descripcion);
                    
                    data.append('C_Unidad', this.C_Unidad);
                    //Añadimos la imagen seleccionada
                    data.append('File', this.file);
                    //Añadimos el método POST dentro del formData
                    // Como lo hacíamos desde un formulario simple _(no ajax)_
                    data.append('_method', 'post');
                    
                    axios.post('/articulo/registrar',data).then(function (response) {
                        swal.fire('Artículo Registrado','','success');
                        me.cerrarModal();
                        me.listarArticulo();
                        
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
            actualizarArticulo(){
                
                //para actualizar se utiliza el metodo put de axios
                if(this.validarArticulo()){
                    return;
                }else{
                    let me=this;
                    
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.put('/articulo/actualizar',{
                        'ID' : this.articulo_id,
                        'ID_Categoria' : this.ID_Categoria,
                        'Codigo' : this.Codigo,
                        'Nombre' : this.Nombre,
                        'Precio_Venta' : this.Precio_Venta,
                        'Precio_Compra' : this.Precio_Compra,
                        'N_Parte' : this.N_Parte,
                        'N_SAT' : this.N_SAT,
                        'Stock' : this.Stock,
                        'Descripcion' : this.Descripcion,
                        
                        'C_Unidad' : this.C_Unidad,


                    }).then(function (response) {
                        swal.fire('Artículo Actualizado','','success');
                        me.cerrarModal();
                        me.listarArticulo();
                        
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
            activarArticulo(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea Activar El Artículo?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/articulo/activar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarArticulo();
                        swalWithBootstrapButtons.fire(
                        'Artículo Activado',
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
            desactivarArticulo(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea Desactivar Este Artículo?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/articulo/desactivar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarArticulo();
                        swalWithBootstrapButtons.fire(
                        'Artículo Desactivado',
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
            validarArticulo(){
                this.errorArticulo  =   0;
                this.errorMostrarMsjsArticulo  =   [];
                if(this.ID_Categoria=='0') this.errorMostrarMsjsArticulo.push('La Categoria Es Requerida');
                if(!this.Nombre) this.errorMostrarMsjsArticulo.push('El Nombre del Articulo Es Requerido');
                //if(this.Stock=='0') this.errorMostrarMsjsArticulo.push('El Stock Es Requerido');
                if(!this.Precio_Venta) this.errorMostrarMsjsArticulo.push('El Precio de Venta Es Requerido');
                

                if(this.errorMostrarMsjsArticulo.length){
                    this.errorArticulo =   1;
                }
                return this.errorArticulo;
            },
            cerrarModal(){
                
                jQuery('#modal_articulo').modal('hide');
                this.tituloModal        =   '';
                this.articulo_id        =   0;
                this.ID_Categoria       =   0;
                this.Nombre_Categoria   =   '';
                this.Codigo             =   '';
                this.Nombre             =   '';
                this.Precio_Venta       =   '';
                this.Precio_Compra      =   '';
                this.N_Parte            =   '';
                this.N_SAT              =   '';
                this.Stock              =   0;
                this.Descripcion        =   '';
                this.errorArticulo      =   0;
                this.Imagen             =   '';
                this.AccionImagen       =   0;
                this.ActualizarImagen   =   0;
                
                this.C_Unidad           =   '';
            },
            abrirModal(modelo,accion,data=[]){
                switch(modelo){
                    case 'articulo':{
                        switch(accion){
                            case 'registrar':{
                                this.AccionImagen = 0;
                                jQuery('#modal_articulo').modal('show');
                                this.ID_Categoria       =   0;
                                this.Nombre_Categoria   =   '';
                                this.Codigo             =   '';
                                this.Nombre             =   '';
                                this.Precio_Venta       =   '';
                                this.Precio_Compra      =   '';
                                this.N_Parte            =   '';
                                this.N_SAT              =   '';
                                this.Stock              =   0;
                                this.Descripcion        =   '';
                                
                                this.C_Unidad           =   'H87';
                                this.tituloModal        =   'Registrar Articulo';
                                this.tipoAccion         =   1;
                                break;
                            }
                            case 'actualizar':{
                                this.AccionImagen = 1;
                                jQuery('#modal_articulo').modal('show');
                                this.tituloModal    =   'Actualizar Articulo';
                                this.tipoAccion     =   2;
                                this.articulo_id    =   data['id'];
                                this.ID_Categoria   =   data['ID_Categoria'];
                                this.Codigo         =   data['Codigo'];
                                this.Nombre         =   data['Nombre'];
                                this.Precio_Venta   =   data['Precio_Venta'];
                                this.Precio_Compra  =   data['Precio_Compra'];
                                this.N_Parte        =   data['N_Parte'];
                                this.N_SAT          =   data['N_SAT'];
                                this.Stock          =   data['Stock'];
                                this.Descripcion    =   data['Descripcion'];
                                
                                this.C_Unidad       =   data['C_Unidad'];
                                this.Imagen         =   data['Imagen'];
                                break;
                            }
                        }
                    }
                }
                this.seleccionarCategoria();
            },
            cerrar_M_A(){
                let me = this;
                jQuery('#modal_aplicacion').modal('hide');
                me.Modelo='';
                me.Motor='';
                me.Año='';
                me.articulo_id = '';
                me.tituloModalAp= '';
                me.arrayAplicacion= [];
                me.sugerencias = 1;

            },
            abrirModalAp(data= []){
                let me =this;
                jQuery('#modal_aplicacion').modal('show');
                me.tituloModalAp = 'Registrar Aplicación';
                me.articulo_id = data['id'];
               

            },
            registrarAplicacion(){
                
                //para registrar se utiliza el metodo post de axios
                if(this.Modelo=='' || this.Motor=='' || this.Año==''){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.post('/aplicacion/registrar',{
                        'ID_Articulo' : this.articulo_id,
                        'Modelo' : this.Modelo,
                        'Ano':this.Año,
                        'Motor' : this.Motor,
                        
                    }).then(function (response) {
                        jQuery('#modal_aplicacion').modal('hide');
                        me.cerrar_M_A();
                        swal.fire('Aplicación Registrada','','success');
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
            mostrarForm(){
                let me = this;
                me.sugerencias = 1;
                me.tituloModalAp = 'Registrar Aplicación';
            },
            mostrarAplicaciones(){
                let me = this;
                var articulo = me.articulo_id;
                me.sugerencias = 2;
                me.tituloModalAp = 'Aplicaciones Registradas';
                me.listarAplicaciones(articulo);
            },
            editarAplicacion(data = []){
                let me = this;
                me.sugerencias =3;
                me.Modelo = data['Modelo'];
                me.Motor = data['Motor'];
                me.Año = data['Ano'];
                me.aplicacion_id = data['id'];
            },
            actualizarAplicacion(){
                //para registrar se utiliza el metodo post de axios
                if(this.Modelo=='' || this.Motor=='' || this.Año==''){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.put('/aplicacion/actualizar',{
                        'ID' : this.aplicacion_id,
                        'Modelo' : this.Modelo,
                        'Ano':this.Año,
                        'Motor' : this.Motor,
                        
                    }).then(function (response) {
                        jQuery('#modal_aplicacion').modal('hide');
                        me.cerrar_M_A();
                        swal.fire('Aplicación Actualizada','','success');
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
            actualizarImagen(){
                let me=this;
                //Creamos el formData
                var data = new  FormData();
                data.append('ID', this.articulo_id);
                //Añadimos la imagen seleccionada
                data.append('File', this.file);
                //Añadimos el método POST dentro del formData
                // Como lo hacíamos desde un formulario simple _(no ajax)_
                data.append('_method', 'post');
                
                axios.post('/articulo/imagen',data).then(function (response) {
                    swal.fire('Imagen Actualizada','','success');
                    me.cerrarModal();
                    me.listarArticulo();
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            cambiarImagen(){
                let me = this;
                me.ActualizarImagen=1;
            },
            regresar(){
                this.ActualizarImagen=0;
            }
        },
        mounted() {
            this.listarArticulo();
        }
    }
</script>
<style>
    
    .img-inputer--large{
        height: 190px;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>

