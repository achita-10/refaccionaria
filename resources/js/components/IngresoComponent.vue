<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ingresos</h4>
                        <template v-if="listado==1">
                            <button @click="mostrarDetalle()" class="btn btn-primary btn-round ml-auto" >
                                <i class="fa fa-plus"></i>
                                Nuevo Ingreso
                            </button>
                        </template>
                        <template v-else>
                            <button @click="ocultarDetalle()" class="btn btn-primary btn-border btn-round ml-auto" >
                                Cerrar
                            </button>
                        </template>

                    </div>
                </div>   
                <template v-if="listado==1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabla_ingresos" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th># Ingreso</th>
                                                <th>T_C</th>
                                                <th>Folio</th>
                                                
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr v-for="ingreso in arrayIngreso " :key="ingreso.id">
                                                <td v-text="ingreso.id"></td>
                                                <td v-text="ingreso.Tipo_Comprobante"></td>
                                                <td v-text="ingreso.Num_Folio"></td>
                                                <td v-text="ingreso.Fecha_Hora"></td>
                                                <td v-text="ingreso.Total"></td>
                                                <td>
                                                    <div v-if="ingreso.Estado=='Registrado'">
                                                        <span class="badge badge-success">Activo</span>
                                                    </div>
                                                    <div v-else>
                                                        <span class="badge badge-danger">Desactivado</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button @click="verIngreso(ingreso.id)" type="button"  title="Ver" class="btn btn-link btn-success " >
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    
                                                    <!--Comprobamos que la categoria este activa, el v-if verificar que el valor Condicion sea 1 
                                                    para poder desactivar la categoria-->
                                                    <template v-if="ingreso.Estado=='Registrado'">
                                                        <button @click="desactivarIngreso(ingreso.id)" type="button"  title="Desactivar" class="btn btn-link btn-danger " >
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </template>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </template>
                <!--Fin Listado-->
                <!--Inicio Formulario-->
                <template v-else-if="listado==0">
                    
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-9 col-md-9">
                                    
                                        <label for="">Proveedor (*)</label>
                                        <v-select
                                            @search="seleccionarProveedor"
                                            label="Nombre"
                                            :options="arrayProveedor"
                                            placeholder="Buscar Proveedores..."
                                            @input="obtenerDatosProveedor"
                                        >
                                        </v-select>
                                    
                                </div>
                                <div class="col-sm-3 col-md-3 ">
                                    <div class="form-group form-floating-label">
                                        <input id="impuesto" type="text" class="form-control input-border-bottom" v-model="Impuesto">
                                        <label for="impuesto" class="placeholder">Impuesto (*)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-floating-label">
                                        <select id="comprobante" class="form-control input-border-bottom" v-model="Tipo_Comprobante">
                                            <option value="0" >Seleccione</option>
                                            <option value="Factura">Factura</option>
                                            <option value="Nota Remisión">Nota Remisión</option>
                                            <option value="Ticket">Ticket</option>
                                        </select>
                                        <label for="comprobante" class="placeholder">Tipo Comprobante (*)</label>
                                    </div> 
                                </div>
                                
                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group form-floating-label">
                                        <input id="numero" type="text" v-model="Num_Folio" class="form-control input-border-bottom" placeholder="000x">
                                        <label for="numero" class="placeholder">Folio (*)</label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="form-group form-floating-label">
                                        <div class="form-inline">
                                            <!--input para ingresar el codigo de barras-->
                                            <!--Cuando se precione enter en el input se ejecutara el metodo buscarArticulo-->
                                            <input id="numero" type="text"  v-model="Codigo" @keyup.enter="buscarArticulo()" class="form-control input-border-bottom" placeholder="Ingrese Codígo">
                                            <label for="numero" class="placeholder">Artículo &nbsp;<span style="color:red;" v-show="ID_Articulo==0"> (* Seleccione)</span></label>
                                            <button @click="abrirModal()" class="btn btn-primary">... </button>
                                            <input type="text" readonly class="form-control" v-model="Articulo" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-2 ">
                                    <div class="form-group form-floating-label">
                                        <input id="precio" type="text" v-model="Precio" class="form-control input-border-bottom" placeholder="precio">
                                        <label for="precio" class="placeholder">Precio <span style="color:red;" v-show="Precio==0"> (* Ingrese)</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-2 ">
                                    <div class="form-group form-floating-label">
                                        <input id="cantidad" type="number" v-model="Cantidad" class="form-control input-border-bottom" placeholder="000x">
                                        <label for="cantidad" class="placeholder">Cantidad <span style="color:red;" v-show="Cantidad==0"> (* Ingrese)</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-2 ">
                                    <div class="form-group ">
                                        <button @click="agregarDetalle()" class="btn btn-primary btn-round ml-auto" >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div v-show="errorIngreso" class="form-group div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjsIngreso" :key="error" v-text="error">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Artículo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>SubTotal</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <!--Si existe algun detalle del articulo se mostrarán los registro-->
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,indice) in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.Articulo">

                                            </td>
                                            <td > 
                                                <input v-model="detalle.Precio" type="text" value="3" class="form-control">
                                            </td>
                                            <td>
                                                <input v-model="detalle.Cantidad" type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                {{detalle.Precio*detalle.Cantidad}}
                                            </td>
                                            <td>
                                                <button @click="eliminarDetalle(indice)" type="button" class="btn btn-link btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <!--Comprobamos que la categoria este activa, el v-if verificar que el valor Condicion sea 1 
                                                para poder desactivar la categoria-->
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ {{Total_Parcial = (Total-Total_Impuesto).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ {{Total_Impuesto = ((Total*Impuesto)/(1+Impuesto)).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{ Total = calcularTotal}}</td>
                                        </tr>
                                    </tbody>
                                    <!--de lo contrario se mostrará lo siguiente-->
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">No hay artículos agregados</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <button class="btn btn-success btn-round" @click="registrarIngreso()" >Registrar Ingreso</button>
                                </div>
                            </div>
                        </div>
                    
                </template>
                <!--Fin Formulario-->
                <!--Ver ingreso -->
                <!--Ver ingreso -->
                <template v-else-if="listado==2">
                    <form action="">
                        <div class="card-body ">
                            <div class=" row">
                                <div class="col-sm-9 col-md-6 ">
                                    <div class="form-group">
                                        <label for="">Proveedor</label>
                                        <p v-text="Proveedor"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6 ">
                                    <div class="form-group">
                                        <label for="">Impuesto</label>
                                        <p v-text="Impuesto"></p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="">Tipo Comprobante</label>
                                        <p v-text="Tipo_Comprobante"></p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 ">
                                    <div class="form-group">
                                        <label for="">Número de Comprobante</label>
                                        <p v-text="Num_Folio"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>Articulo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>SubTotal</th>
                                            
                                        </tr>
                                    </thead>
                                    <!--Si existe algun detalle del articulo se mostrarán los registro-->
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.Articulo">

                                            </td>
                                            <td v-text="detalle.Precio"> 
                                                
                                            </td>
                                            <td v-text="detalle.Cantidad">
                                                
                                            </td>
                                            <td>
                                                {{detalle.Precio*detalle.Cantidad}}
                                            </td>
                                            
                                        </tr>
                                        
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ {{Total_Parcial = (Total-Total_Impuesto).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ {{Total_Impuesto = ((Total*Impuesto)).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{ Total }}</td>
                                        </tr>
                                    </tbody>
                                    <!--de lo contrario se mostrará lo siguiente-->
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">No hay artículos agregados</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </template>  
            </div>
        </div>
        <div class="modal fade" id="modal_agregar_articulo" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="table-responsive">
                            <table id="tabla_articulos" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        
                                        <th>Codígo</th>
                                        <th>Nombre</th>                                        
                                        <th>Descripción</th>
                                        <th>N_Parte</th>
                                        <th>Stock</th>                                        
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                                        
                                        <td v-text="articulo.Codigo"></td>
                                        <td v-text="articulo.Nombre"></td>
                                        <td v-text="articulo.Descripcion"></td>
                                        <td v-text="articulo.N_Parte"></td>
                                        <td v-text="articulo.Stock"></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button @click="mostrarImagen(articulo)" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-success btn-lg" >
                                                    <i class="fas fa-camera"></i>
                                                </button>
                                                <VueEasyLightbox
                                                :visible="visible"
                                                :imgs="imgs"
                                                :index="index"
                                                @hide="handleHide"
                                                ></VueEasyLightbox>
                                                <button @click="agregarDetalleModal(articulo)" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" >
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
import Vue from 'vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import VueEasyLightbox from 'vue-easy-lightbox'

    export default {
        data(){
            return{
                ingreso_id : 0,
                ID_Proveedor : 0,
                ID_Usuario : '',
                Proveedor : '',
                Nombre : '',
                Tipo_Comprobante : 0,
                Num_Folio : '',
                Fecha_Hora : '',
                Impuesto : 0.16,
                Total : 0.0,
                Total_Impuesto : 0.0,
                Total_Parcial : 0.0,
                Estado : '',
                arrayIngreso : [],
                arrayDetalle : [],
                arrayProveedor : [],
                arrayArticulo: [],
                ID_Articulo: 0,
                Codigo: '',
                Articulo : '',
                Precio: '',
                Cantidad:0,
                //Variables para mostrar y ocultar el listado y el formulario de registro
                listado: 1,
                //esta variable modal sirve para visualizar u ocultar nuestro modal
                tituloModal : '',
                tipoAccion : 0,
                errorIngreso : 0,
                errorMostrarMsjsIngreso : [],

                //Seccion para la imagen del artículo
                imgs: '',  // Img Url , string or Array
                visible: false,
                index: 0   // default
                

            }
        },
        components:{
            vSelect,
            VueEasyLightbox
        },
        /*
            Los metodos computados se estan ejecutando siempre
        */
        computed : {
            calcularTotal: function(){
                var resultado = 0;
                for (var i = 0; i < this.arrayDetalle.length; i++) {
                    resultado= resultado + (this.arrayDetalle[i].Precio* this.arrayDetalle[i].Cantidad);
                }
                return resultado;
            }
        },
        methods : {
            showSingle() {
                this.imgs = 'img/1563679452_celosa.jpg'
                this.show()
            },
            show() {
                this.visible = true
            },
            handleHide() {
                this.visible = false
            },
            tablaIngreso(){
                jQuery(function(){
                    jQuery('#tabla_ingresos').DataTable();
                });
            },
            tablaArticulos(){
                jQuery(function(){
                    jQuery('#tabla_articulos').DataTable();
                });
            },
            
            listarIngreso(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/ingreso';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayIngreso=respuesta.ingresos;
                    me.tablaIngreso();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            obtenerDatosProveedor(val1){
                let me = this;
                me.loading= true;
                me.ID_Proveedor = val1.id;
                
            },
            seleccionarProveedor(search, loading) {
                loading(true);
                this.search(loading, search, this);
                },
            search(loading, search, vm){
                // Make a request for a user with a given ID
                let me=this;
                loading(true);
                var url = '/proveedor/seleccionarProveedor?Filtro='+search ;
                axios.get(url).then(function (response) {
                    // handle success
                    let respuesta = response.data;
                    q:search
                    me.arrayProveedor=respuesta.proveedores;
                    loading(false);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            }, 
            buscarArticulo(){
                let me=this;
                var url = '/articulo/buscarArticulo?Filtro='+me.Codigo;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayArticulo = respuesta.articulos;
                    if(me.arrayArticulo.length>0){
                        me.Articulo = me.arrayArticulo[0]['Nombre'];
                        me.ID_Articulo = me.arrayArticulo[0]['id'];

                    }else{
                        me.Articulo = 'No existe artículo';
                        me.ID_Articulo = 0;
                    }
                }).catch(function(error){
                    console.log(error);
                }).finally(function(){

                });
            },
            encuentra(id_articulo){
                var sw=0;
                for (var i = 0; i < this.arrayDetalle.length; i++) {
                    if(this.arrayDetalle[i].ID_Articulo==id_articulo){
                        sw=true;
                    }
                    
                }
                return sw;
            },
            eliminarDetalle(indice){
                let me = this;
                me.arrayDetalle.splice(indice,1);
            },
            agregarDetalle(){
                let me =this;
                if(me.ID_Articulo==0 || me.Cantidad==0 || me.Precio==0){

                }else{
                    //Verificar si el articulo ya se encuentra en el detalle
                    if(me.encuentra(me.ID_Articulo)){
                        Swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este artículo ya se encuentra agregado',
                            
                        })
                    }else{
                        me.arrayDetalle.push({
                            ID_Articulo : me.ID_Articulo,
                            Articulo : me.Articulo,
                            Cantidad : me.Cantidad,
                            Precio : me.Precio,
                        });
                        
                        me.Codigo = '';
                        me.ID_Articulo = 0;
                        me.Articulo = '';
                        me.Cantidad = 0;
                        me.Precio = 0;
                        
                    }
                    
                }
                
            },
            agregarDetalleModal(data = []){
                let me = this;
                //Verificar si el articulo ya se encuentra en el detalle
                if(me.encuentra(data['id'])){
                    Swal.fire({
                        type: 'error',
                        title: 'Error...',
                        text: 'Este artículo ya se encuentra agregado',
                        
                    })
                }else{
                    me.arrayDetalle.push({
                        ID_Articulo : data['id'],
                        Articulo : data['Nombre'],
                        Cantidad : 1,
                        Precio : data['Precio_Compra'],
                    });
                    
                }
            },
            listarArticulo(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/articulo/listarArticulos';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayArticulo=respuesta.articulos;
                    me.tablaArticulos();
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            registrarIngreso(){
                //para registrar se utiliza el metodo post de axios
                if(this.validarIngreso()){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.post('/ingreso/registrar',{
                        'ID_Proveedor':this.ID_Proveedor,
                        'Tipo_Comprobante':this.Tipo_Comprobante,
                        'Num_Folio':this.Num_Folio,
                        'Impuesto':this.Impuesto,
                        'Total':this.Total,
                        'data':this.arrayDetalle,
                        
                    }).then(function (response) {
                        me.listado = 1;
                        me.listarIngreso();
                        me.ID_Proveedor = 0;
                        me.Tipo_Comprobante = 0;
                        me.Num_Folio = '';
                        me.Impuesto = 0.16;
                        me.Total = 0.0;
                        me.ID_Articulo = 0;
                        me.Cantidad = 0;
                        me.Precio = 0;
                        me.arrayDetalle = [];
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
            desactivarIngreso(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea anular el ingreso?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/ingreso/desactivar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarIngreso();
                        swalWithBootstrapButtons.fire(
                        'Ingreso anulado exitosamente',
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
            validarIngreso(){
                this.errorIngreso  =   0;
                this.errorMostrarMsjsIngreso  =   [];
                if(this.ID_Proveedor==0){
                    this.errorMostrarMsjsIngreso.push('Seleccione Proveedor');
                }
                if(this.Tipo_Comprobante==0){
                    this.errorMostrarMsjsIngreso.push('Ingrese el tipo de comprobante');
                }
                if(!this.Num_Folio){
                    this.errorMostrarMsjsIngreso.push('Ingrese el número de comprobante');
                }
                if(!this.Impuesto){
                    this.errorMostrarMsjsIngreso.push('Ingrese el impuesto');
                }
                if(this.arrayDetalle.length<=0){
                    this.errorMostrarMsjsIngreso.push('Ingrese detalles');
                }
                if(this.errorMostrarMsjsIngreso.length){
                    this.errorIngreso =   1;
                }
                return this.errorIngreso;
            },
            mostrarDetalle(){
                let me = this;
                me.listado=0;
                me.ID_Proveedor = 0;
                me.Tipo_Comprobante = 0;
                me.Num_Folio = '';
                me.Impuesto = 0.16;
                me.Total = 0.0;
                me.ID_Articulo = 0;
                me.Cantidad = 0;
                me.Precio = '';
                me.Codigo = '';
                me.Articulo= '';
                me.arrayDetalle = [];
                
            },
            ocultarDetalle(){   
                this.errorMostrarMsjsIngreso = [];
                this.listarIngreso();
                this.listado=1;
            },
            verIngreso (id_ingreso){
                
                let me = this;
                me.listado =2;
                var arrayIngresoT = [];
                //peticion para obtener los datos del ingreso
                var url ='/ingreso/obtenerCabecera?ID='+id_ingreso;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    arrayIngresoT = respuesta.ingreso;
                    me.Proveedor = arrayIngresoT[0]['Nombre'];
                    me.Tipo_Comprobante = arrayIngresoT[0]['Tipo_Comprobante'];
                    me.Num_Folio = arrayIngresoT[0]['Num_Folio'];
                    me.Impuesto = arrayIngresoT[0]['Impuesto'];
                    me.Total = arrayIngresoT[0]['Total'];

                }).catch(function(error){
                    console.log(error);
                }).finally(function(){

                });


                //peticion para obtener los datos de los detalles
                
                var url2 ='/ingreso/obtenerDetalles?ID='+id_ingreso;
                axios.get(url2).then(function(response){
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayDetalle = respuesta.detalles;

                }).catch(function(error){
                    console.log(error);
                }).finally(function(){

                });

            },
            abrirModal(){
                this.listarArticulo();
                $('#modal_agregar_articulo').modal('show');
                this.tituloModal = 'Seleccione uno o varios artículos';         
            },
            cerrarModal(){
                jQuery('#modal_agregar_articulo').modal('hide');
                this.arrayArticulo=[];
            },
            mostrarImagen(data = []){
                this.imgs = 'img/'+data['Imagen'];
                this.show()
            },
            
        },
        mounted() {
            this.listarIngreso();
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
    @media (min-width: 600px){
        .btnagregar{
            margin-top: 2rem;
        }    
    }
    
</style>

