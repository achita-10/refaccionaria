<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ventas</h4>
                        <template v-if="listado==1">
                            <button @click="mostrarDetalle()" class="btn btn-primary btn-round ml-auto" >
                                <i class="fa fa-plus"></i>
                                Nueva Venta
                            </button>
                        </template>
                        <template v-else-if="listado==2">
                            <button @click="mostrarDetalle()" class="btn btn-primary btn-round ml-auto" >
                                <i class="fa fa-plus"></i>
                                Nueva Venta
                            </button>
                            <button @click="ocultarDetalle()" class="btn btn-primary btn-border btn-round ml-auto" >
                                Cerrar
                            </button>
                        </template>
                        <template v-else>
                            <button @click="abrirModal()" class="btn btn-info btn-round ml-auto" >                                
                                Artículos
                            </button>
                            <button @click="ocultarDetalle()" class="btn btn-primary btn-border btn-round ml-auto" >
                                Cerrar
                            </button>
                        </template>
                    </div>
                </div>
                <div class="card-body">
                    <template v-if="listado==1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla_ventas" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th># Venta</th>
                                                <!-- <th>Cliente</th>
                                                <th>Documento</th>
                                                <th>N° Documento</th> -->
                                                
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr v-for="venta in arrayVenta " :key="venta.id">
                                                <td v-text="venta.id"></td>
                                                <!-- <td v-text="venta.Nombre"></td>
                                                <td v-text="venta.Tipo_Comprobante"></td>
                                                <td v-text="venta.Num_Folio"></td> -->
                                                <td v-text="venta.Fecha_Hora"></td>
                                                <td v-text="venta.Total"></td>
                                                <td>
                                                    <div v-if="venta.Estado=='Registrado'">
                                                        <span class="badge badge-success">Activo</span>
                                                    </div>
                                                    <div v-else>
                                                        <span class="badge badge-danger">Desactivado</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button @click="verVenta(venta.id)" type="button"  title="Ver" class="btn btn-link btn-success " >
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- <button @click="abrirModalF(venta.id)" type="button"  title="Facturar" class="btn btn-link btn-warning " >
                                                        <i class="far fa-file-alt"></i>
                                                    </button> -->
                                                    <button @click="generarPDF(venta.id)" type="button" title="PDF" class="btn btn-link btn-info">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </button> 
                                                    <!--Comprobamos que la categoria este activa, el v-if verificar que el valor Condicion sea 1 
                                                    para poder desactivar la categoria-->
                                                    <template v-if="venta.Estado=='Registrado'">
                                                        <button @click="desactivarVenta(venta.id)" type="button"  title="Desactivar" class="btn btn-link btn-danger " >
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
                    </template>
                    <template v-else-if="listado==0">
                        <section>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 ">
                                    <div class="form-group">
                                        <!--La etiqueta span solo se visualizara cuando el ID_Articulo es 0-->
                                        <label for="">Código <span style="color:red;" v-show="ID_Articulo==0">(* Seleccione)</span></label>
                                        <input type="text" class="form-control" v-model="Codigo" @keyup.enter="buscarArticulo()" placeholder="Ingrese Código">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="">Artículo </label>
                                        <input type="text" readonly class="form-control" v-model="Articulo" >
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Precio">Precio <span style="color:red;" v-show="Precio==0">(* Ingrese)</span></label>
                                        <input type="number" step="any" class="form-control" v-model="Precio">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Precio">Cantidad <span style="color:red;" v-show="Cantidad==0">(* Ingrese)</span></label>
                                        <input type="number"  class="form-control" v-model="Cantidad">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Descuento">Descuento </label>
                                        <input type="number" step="any" class="form-control" v-model="Descuento">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-success form-control btnagregar" @click="agregarDetalle()"><i class="icon-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div v-show="errorVenta" class="form-group div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjsVenta" :key="error" v-text="error">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-12 col-md-12">
                                    <div class="table-responsive">
                                        <table id="" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Articulo</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Descuento</th>
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
                                                        <input v-model="detalle.Precio" type="number"  class="form-control">
                                                    </td>
                                                    <td>
                                                        <!--La directiva v-show mostrara el contenido cuando se cumpla la condicion-->
                                                        <span style="color:red;" v-show="detalle.Cantidad>detalle.Stock"> Stock: {{detalle.Stock}}</span>
                                                        <input  v-model="detalle.Cantidad" type="number"  class="form-control">
                                                    </td>
                                                    <td>
                                                        <span style="color:red;" v-show="detalle.Descuento>(detalle.Precio*detalle.Cantidad)"> Descuento Superior</span>
                                                        <input v-model="detalle.Descuento" type="number"  class="form-control">
                                                    </td>
                                                    <td>
                                                        {{detalle.Precio*detalle.Cantidad-detalle.Descuento}}
                                                    </td>
                                                    <td>
                                                        <button @click="eliminarDetalle(indice)" type="button" class="btn btn-success">
                                                            <i class="icon-close"></i>
                                                        </button>
                                                        <!--Comprobamos que la categoria este activa, el v-if verificar que el valor Condicion sea 1 
                                                        para poder desactivar la categoria-->
                                                        
                                                        
                                                    </td>
                                                </tr>
                                                
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" align="right"><strong>Total Parcial:</strong></td>
                                                    <td>$ {{Total_Parcial = (Total-Total_Impuesto).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" align="right"><strong>Total Impuesto:</strong></td>
                                                    <td>$ {{Total_Impuesto = ((Total*Impuesto)/(1+Impuesto)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" align="right"><strong>Total Neto:</strong></td>
                                                    <td>$ {{ Total = calcularTotal}}</td>
                                                </tr>
                                            </tbody>
                                            <!--de lo contrario se mostrará lo siguiente-->
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="6">No hay artículos agregados</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </template>
                    <!--Ver venta -->
                    <template v-else-if="listado==2">
                        <section>
                            <div class=" row">
                                <div class="col-sm-9 col-md-6 ">
                                    <div class="form-group">
                                        <label for="">Cliente</label>
                                        <template v-if="Cliente==''">
                                            <p >Cliente no disponible</p>
                                        </template>
                                        <template v-else>
                                            <p v-text="Cliente"></p>
                                        </template>
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
                                        <template v-if="Tipo_Comprobante==0">
                                            <p >Comprobante no disponible</p>
                                        </template>
                                        <template v-else>
                                            <p v-text="Tipo_Comprobante"></p>
                                        </template>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 ">
                                    <div class="form-group">
                                        <label for="">Número de Comprobante</label>
                                        <template v-if="Num_Comprobante==''">
                                            <p >Número no disponible</p>
                                        </template>
                                        <template v-else>
                                            <p v-text="Num_Comprobante"></p>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>Articulo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Descuento</th>
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
                                            <td v-text="detalle.Descuento">
                                                
                                            </td>
                                            <td>
                                                {{detalle.Precio*detalle.Cantidad-detalle.Descuento}}
                                            </td>
                                            
                                        </tr>
                                        
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ {{Total_Parcial = (Total-Total_Impuesto).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ {{Total_Impuesto = ((Total*Impuesto)).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{ Total }}</td>
                                        </tr>
                                    </tbody>
                                    <!--de lo contrario se mostrará lo siguiente-->
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6">No hay artículos agregados</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>   
                    </template> 
                </div>
                <div class="card-action">
                    <button v-if="listado==0" class="btn btn-primary" @click="registrarVenta()" >Registrar Venta</button>
                </div>
            </div>
        </div>
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
        <div class="modal fade" id="modal_factura" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg"  role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h5 class="modal-title" v-text="tituloModalF">
                            
                        </h5>
                        <button type="button" class="close" @click="cerrarModalF()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9 col-md-9 ">
                                <div class="form-group">
                                    <label for="">Cliente (*)</label>
                                    <v-select
                                        @search="seleccionarCliente"
                                        label="Nombre"
                                        :options="arrayCliente"
                                        placeholder="Buscar Clientes..."
                                        @input="obtenerDatosCliente"
                                    >

                                    </v-select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 ">
                                <div class="form-group">
                                    <label for="">Impuesto <span style="color:red;" v-show="Impuesto==0">(*)</span></label>
                                    <select class="form-control" v-model="Impuesto">
                                        <option value="0" >Seleccione</option>
                                        <option value="001">ISR</option>
                                        <option value="002">IVA</option>
                                        <option value="003">IEPS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Uso <span style="color:red;" v-show="Uso==0">(*)</span></label>
                                    <select class="form-control" v-model="Uso">
                                        <option value="0" >Seleccione</option>
                                        <option value="G01">Adquisición de mercancias</option>
                                        <option value="G02">Devoluciones, descuentos o bonificaciones</option>
                                        <option value="G03">Gastos en general</option>
                                        <option value="I01">Construcciones</option>
                                        <option value="I02">Mobiliario y equipo de oficina por inversiones</option>
                                        <option value="I03">Equipo de transporte</option>
                                        <option value="I04">Equipo de computo y accesorios</option>
                                        <option value="I05">Dados, troqueles, moldes, matrices y herremental</option>
                                        <option value="I06">Comunicaciones telefonicas</option>
                                        <option value="I07">Comunicaciones satelitales</option>
                                        <option value="I08">Otra maquinaria y equipo</option>
                                        <option value="D01">Honorarios médicos, dentales y gastos hospitalarios</option>
                                        <option value="D02">Gastos médicos por incapacidad o discapacidad</option>
                                        <option value="D03">Gastos funerales</option>
                                        <option value="D04">Donativos</option>
                                        <option value="D05">Intereses reales efectivamente pagados por creditos hipotecarios (casa habitación)</option>
                                        <option value="D06">Aportaciones voluntarias al SAR</option>
                                        <option value="D07">Primas por seguros de gastos médicos</option>
                                        <option value="D08">Deposito de cuentas para el ahorro, primas que tengan como base planos de pensiones</option>
                                        <option value="D09">Pagos por servicios educativos (colegiaturas)</option>
                                        <option value="P01">Por definir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="">Comprobante <span style="color:red;" v-show="Tipo_Comprobante==0">(*)</span></label>
                                    <select class="form-control" v-model="Tipo_Comprobante">
                                        <option value="0" >Seleccione</option>
                                        <option value="I">Ingreso</option>
                                        <option value="E">Egreso</option>
                                        <option value="T">Traslado</option>
                                        <option value="N">Nómina</option>
                                        <option value="P">Pago</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Número <span style="color:red;" v-show="Num_Comprobante==''">(*)</span></label>
                                    <input type="text" v-model="Num_Comprobante" class="form-control" placeholder="000x">
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Moneda <span style="color:red;" v-show="Moneda==0">(*)</span></label>
                                    <select class="form-control" v-model="Moneda">
                                        <option value="0" >Seleccione</option>
                                        <option value="MXN">Peso Mexicano</option>
                                        <option value="MXV">México Unidad de Inversión (UDI)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Forma de Pago <span style="color:red;" v-show="Forma_Pago==0">(*)</span></label>
                                    <select class="form-control" v-model="Forma_Pago">
                                        <option value="0" >Seleccione</option>
                                        <option value="01">Efectivo</option>
                                        <option value="02">Cheque nominativo</option>
                                        <option value="03">Transferencia electrónica de fondos</option>
                                        <option value="04">Tarjeta de crédito</option>
                                        <option value="05">Monedero electrónico</option>
                                        <option value="06">Dinero electrónico</option>
                                        <option value="08">Vales de despensa</option>
                                        <option value="12">Dación en pago</option>
                                        <option value="13">Pago por subrogación</option>
                                        <option value="14">Pago por consignación</option>
                                        <option value="15">Condonación</option>
                                        <option value="17">Compensación</option>
                                        <option value="23">Novación</option>
                                        <option value="24">Confusión</option>
                                        <option value="25">Remisión de deuda</option>
                                        <option value="26">Prescripción o caducidad</option>
                                        <option value="27">A satisfacción del acreedor</option>
                                        <option value="28">Tarjeta de débito</option>
                                        <option value="29">Tarjeta de servicios</option>
                                        <option value="30">Aplicación de anticipos</option>
                                        <option value="31">Intermediario pagos</option>
                                        <option value="99">Por definir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Método de Pago <span style="color:red;" v-show="Metodo_Pago==0">(*)</span></label>
                                    <select class="form-control" v-model="Metodo_Pago">
                                        <option value="0" >Seleccione</option>
                                        <option value="PUE">Pago en una sola exhibición</option>
                                        <option value="PPD">Pago en parcialidades o diferido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 ">
                                <div class="form-group">
                                    <label for="">Régimen Fiscal <span style="color:red;" v-show="Regimen==0">(*)</span></label>
                                    <select class="form-control" v-model="Regimen">
                                        <option value="0" >Seleccione</option>
                                        <option value="601">General de Ley Personas Morales</option>
                                        <option value="603">Personas Morales con Fines no Lucrativos</option>
                                        <option value="605">Sueldos y Salarios e Ingresos Asimilados a Salarios</option>
                                        <option value="608">Demás ingresos</option>
                                        <option value="609">Consolidación</option>
                                        <option value="610">Residentes en el Extranjero sin Establecimiento Permanente en México</option>
                                        <option value="611">Ingresos por Dividendos (socios y accionistas)</option>
                                        <option value="612">Personas Físicas con Actividades Empresariales y Profesionales</option>
                                        <option value="614">Ingresos por intereses</option>
                                        <option value="616">Sin obligaciones fiscales</option>
                                        <option value="620">Sociedades Cooperativas de Producción que optan por diferir sus ingresos</option>
                                        <option value="621">Incorporación Fiscal</option>
                                        <option value="622">Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                                        <option value="623">Opcional para Grupos de Sociedades</option>
                                        <option value="624">Coordinados</option>
                                        <option value="628">Hidrocarburos</option>
                                        <option value="607">Régimen de Enajenación o Adquisición de Bienes</option>
                                        <option value="629">De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales</option>
                                        <option value="630">Enajenación de acciones en bolsa de valores</option>
                                        <option value="615">Régimen de los ingresos por obtención de premios</option>
                                        <option value="606">Arrendamiento</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div v-show="errorFactura" class="form-group div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjsFactura" :key="error" v-text="error">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="button" class="btn btn-success" @click="registrarFactura()">Guardar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModalF()">Cerrar</button>
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
                venta_id : 0,
                ID_Cliente : 0,
                ID_Usuario : '',
                Cliente : '',
                Nombre : '',
                Fecha_Hora : '',
                Impuesto : 0,
                Stock : 0,
                Total : 0.0,
                Total_Impuesto : 0-0,
                Total_Parcial : 0.0,
                Estado : '',
                arrayVenta : [],
                arrayDetalle : [],
                arrayCliente : [],
                arrayArticulo: [],
                ID_Articulo: 0,
                Codigo: '',
                Articulo : '',
                Precio: 0,
                Cantidad:0,
                Descuento : 0,
                //Variables para mostrar y ocultar el listado y el formulario de registro
                listado: 1,
                //esta variable modal sirve para visualizar u ocultar nuestro modal
                tituloModal : '',
                tipoAccion : 0,
                //Modal factura
                tituloModalF : '',
                //Validar venta
                errorVenta : 0,
                errorMostrarMsjsVenta : [],

                //Validar factura
                errorFactura : 0,
                errorMostrarMsjsFactura : [],

               //Seccion para la imagen del artículo
                imgs: '',  // Img Url , string or Array
                visible: false,
                index: 0,   // default

                //Variables para Facturar
                Moneda : 0,
                Tipo_Comprobante : 0,
                Num_Comprobante : '',
                Uso : 0,
                Metodo_Pago : 0,
                Forma_Pago : 0,
                Regimen: 0,

            }
        },
        components:{
            vSelect,
            VueEasyLightbox
        },
        /*Codigo para la paginacion
            Los metodos computados se estan ejecutando siempre
        */
        
        computed : {
            calcularTotal: function(){
                var resultado = 0;
                for (var i = 0; i < this.arrayDetalle.length; i++) {
                    resultado= resultado + (this.arrayDetalle[i].Precio* this.arrayDetalle[i].Cantidad-this.arrayDetalle[i].Descuento);
                    
                }
                return resultado;
            }
        },
        methods : {

            /*Codigo para las imagenes */
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
            mostrarImagen(data = []){
                this.imgs = 'img/'+data['Imagen'];
                this.show()
            },
            /*Codigo para los formularios */
            tablaVenta(){
                jQuery(function(){
                    jQuery('#tabla_ventas').DataTable();
                });
            },
            tablaArticulos(){
                jQuery(function(){
                    jQuery('#tabla_articulos').DataTable();
                });
            },
            generarPDF(id){
                window.open('/venta/PDF/'+id+'_blank')
            },
            listarVenta(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/venta';
                axios.get(url).then(function (response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayVenta=respuesta.ventas; 
                    me.tablaVenta();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            obtenerDatosCliente(val1){
                let me = this;
                me.loading= true;
                me.ID_Cliente = val1.id;
                
            },
            seleccionarCliente(search, loading) {
                loading(true);
                this.search(loading, search, this);
                },
            search(loading, search, vm){
                // Make a request for a user with a given ID
                let me=this;
                loading(true);
                var url = '/cliente/seleccionarCliente?Filtro='+search ;
                axios.get(url).then(function (response) {
                    // handle success
                    let respuesta = response.data;
                    q:search
                    me.arrayCliente=respuesta.clientes;
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
                var url = '/articulo/buscarArticuloVenta?Filtro='+me.Codigo;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayArticulo = respuesta.articulos;
                    if(me.arrayArticulo.length>0){
                        me.Articulo = me.arrayArticulo[0]['Nombre'];
                        me.ID_Articulo = me.arrayArticulo[0]['id'];
                        me.Precio = me.arrayArticulo[0]['Precio_Venta'];
                        me.Stock = me.arrayArticulo[0]['Stock'];

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
                        if(me.Cantidad>me.Stock){
                            Swal.fire({
                                type: 'error',
                                title: 'Error...',
                                text: 'No hay Stock Disponible!',
                                
                            })
                        }else{
                            me.arrayDetalle.push({
                                ID_Articulo : me.ID_Articulo,
                                Articulo : me.Articulo,
                                Cantidad : me.Cantidad,
                                Precio : me.Precio,
                                Descuento : me.Descuento,
                                Stock : me.Stock
                            });
                            
                            me.Codigo = '';
                            me.ID_Articulo = 0;
                            me.Articulo = '';
                            me.Cantidad = 0;
                            me.Precio = 0;
                            me.Descuento = 0;
                            me.Stock = 0;
                        }
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
                        Precio : data['Precio_Venta'],
                        Descuento : 0,
                        Stock : data['Stock'],

                    });
                }
            },
            listarArticulo(){
                // Make a request for a user with a given ID
                let me=this;
                var url = '/articulo/listarArticulosVenta';
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
            registrarVenta(){
                //para registrar se utiliza el metodo post de axios
                if(this.validarVenta()){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.post('/venta/registrar',{
                        // 'ID_Cliente':this.ID_Cliente,
                        // 'Tipo_Comprobante':this.Tipo_Comprobante,
                        // 'Num_Comprobante':this.Num_Comprobante,
                        'Impuesto':this.Impuesto,
                        'Total':this.Total,
                        'data':this.arrayDetalle,
                        
                    }).then(function (response) {
                        me.listado = 1;
                        me.listarVenta();
                        // me.ID_Cliente = 0;
                        // me.Tipo_Comprobante = 0;
                        
                        // me.Num_Comprobante = '';
                        me.Impuesto = 0.16;
                        me.Total = 0.0;
                        me.ID_Articulo = 0;
                        me.Cantidad = 0;
                        me.Precio = 0;
                        me.Stock = 0;
                        me.Codigo = '';
                        me.Descuento = 0;
                        me.arrayDetalle = [];
                        // window.open('/venta/PDF/'+response.data.id+'_blank');
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
            registrarFactura(){
                //para registrar se utiliza el metodo post de axios
                if(this.validarFactura()){
                    return;
                }else{
                    let me=this;
                    //Las variables Nombre y Descripcion son las definidas en la funcion data
                    axios.post('/factura/registrar',{
                        'ID_Venta' : this.venta_id,
                        'ID_Cliente':this.ID_Cliente,
                        'Uso' : this.Uso,
                        'Impuesto' : this.Impuesto,
                        'Tipo_Comprobante':this.Tipo_Comprobante,
                        'Num_Comprobante':this.Num_Comprobante,
                        'Moneda':this.Moneda,
                        'Forma_Pago':this.Forma_Pago,
                        'Metodo_Pago':this.Metodo_Pago,
                        'Regimen':this.Regimen,
                    }).then(function (response) {
                        me.listado = 1;
                        me.listarVenta();
                        me.venta_id = 0;
                        me.ID_Cliente = 0;
                        me.Tipo_Comprobante = 0;
                        me.Num_Comprobante = '';
                        me.Impuesto = 0;
                        me.Uso = 0;
                        me.Moneda = 0;
                        me.Forma_Pago = 0;
                        me.Metodo_Pago = 0;
                        me.Regimen = 0;     
                        Swal.fire(
                        'Factura Registrada',
                        '',
                        'success'
                        );              
                        // window.open('/venta/PDF/'+response.data.id+'_blank');
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
            desactivarVenta(id){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: '¿Desea anular esta venta?',
                text: "Presione Aceptar para confirmar o Cancelar para regresar",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me  =   this;
                    axios.put('/venta/desactivar',{
                        'ID': id,
                    })
                    .then(function(response){
                        me.listarVenta();
                        swalWithBootstrapButtons.fire(
                        'Venta anulada exitosamente',
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
            validarVenta(){
                let me = this;
                me.errorVenta  =   0;
                me.errorMostrarMsjsVenta  =   [];
                /*Validar que el Stock de los articulos sea mayor o igula que la cantidad que se esten vendiendo */
                /*Recorrer el arrayDetalle con map */
                var articulo = '';
                me.arrayDetalle.map(function(x){
                    if(x.Cantidad>x.Stock){
                        articulo = x.Articulo + ' con stock insuficiente';
                        me.errorMostrarMsjsVenta.push(articulo);
                    }
                })
                if(me.arrayDetalle.length<=0){
                    me.errorMostrarMsjsVenta.push('Ingrese detalles');
                }
                
                if(me.errorMostrarMsjsVenta.length){
                    me.errorVenta =   1;
                }
                return me.errorVenta;
            },
            validarFactura(){
                let me = this;
                me.errorFactura  =   0;
                me.errorMostrarMsjsFactura  =   [];
                
                if(me.ID_Cliente==0){
                    me.errorMostrarMsjsFactura.push('Seleccione Cliente');
                }
                if(me.Impuesto==0){
                    me.errorMostrarMsjsFactura.push('Ingrese el impuesto');
                }
                if(me.Tipo_Comprobante==0){
                    me.errorMostrarMsjsFactura.push('Ingrese el tipo de comprobante');
                }
                
                if(!me.Num_Comprobante){
                    me.errorMostrarMsjsFactura.push('Ingrese el número de comprobante');
                }
                
                if(me.Uso==0){
                    me.errorMostrarMsjsFactura.push('Ingrese el Uso');
                }
                if(me.Moneda==0){
                    me.errorMostrarMsjsFactura.push('Ingrese la moneda');
                }
                if(me.Forma_Pago==0){
                    me.errorMostrarMsjsFactura.push('Ingrese la forma de pago');
                }
                if(me.Metodo_Pago==0){
                    me.errorMostrarMsjsFactura.push('Ingrese el método de pago');
                }
                if(me.Regimen==0){
                    me.errorMostrarMsjsFactura.push('Ingrese el régimen');
                }
                
                if(me.errorMostrarMsjsFactura.length){
                    me.errorFactura =   1;
                }
                return me.errorFactura;
            },
            mostrarDetalle(){
                let me = this;
                me.listado=0;
                // me.ID_Proveedor = 0;
                // me.Tipo_Comprobante = 0;
                
                // me.Num_Comprobante = '';
                me.Impuesto = 0.16;
                me.Total = 0.0;
                me.ID_Articulo = 0;
                me.Cantidad = 0;
                me.Precio = 0;
                me.arrayDetalle = [];
                
            },
            ocultarDetalle(){
                this.errorMostrarMsjsVenta = [];
                this.listarVenta();
                this.listado=1;
            },
            verVenta (id_venta){
                
                let me = this;
                me.listado =2;
                var arrayVentaT = [];
                //peticion para obtener los datos del ingreso
                var url ='/venta/obtenerCabecera?ID='+id_venta;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    arrayVentaT = respuesta.venta;
                    
                    // me.Tipo_Comprobante = arrayVentaT[0]['Tipo_Comprobante'];
                    
                    // me.Num_Comprobante = arrayVentaT[0]['Num_Folio'];
                    me.Impuesto = arrayVentaT[0]['Impuesto'];
                    me.Total = arrayVentaT[0]['Total'];

                }).catch(function(error){
                    console.log(error);
                }).finally(function(){

                });


                //peticion para obtener los datos de los detalles
                
                var url2 ='/venta/obtenerDetalles?ID='+id_venta;
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
                $('#modal_articulo').modal('show');
                this.tituloModal = 'Seleccione uno o varios artículos';         
            },
            abrirModalF(id){
                let me = this;
                me.venta_id = id;

                $('#modal_factura').modal('show');
                me.tituloModalF = 'Registrar Facturación';  
            },
            cerrarModal(){
                
                jQuery('#modal_articulo').modal('hide');
                this.arrayArticulo=[];
            },
            cerrarModalF(){
                jQuery('#modal_factura').modal('hide');
            }
        },
        mounted() {
            this.listarVenta();
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


