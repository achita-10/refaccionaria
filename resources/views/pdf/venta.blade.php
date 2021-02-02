<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 100px;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 100%;
        
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }
    </style>
    <body>
    @foreach($factura as $f)
        <header>
            <div id="logo">
                <img src="img/logo2.png" alt="incanatoIT" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Refaccionaria El Águila</b><br>Bernardo Sixtega Polito<br>RFC<br> 95780, {{$f->Fecha_Hora}}
                </p>
            </div>
            
            <div id="fact">
                <p>FACTURA<br>
                {{$f->Folio}}</p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr style="text-align:center;">
                            <th id="fac" colspan="3">Datos del Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Sr(a).</b> {{$f->Cliente}}</td>
                            <td><b>{{$f->Doc_Cliente}}</b>: {{$f->RFC_Cliente}}</td>
                            <td><b>Teléfono:</b> {{$f->Telefono}}</td>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Dirección:</b> {{$f->Direccion}}</td>
                            <td><b>Email:</b> {{$f->Email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th colspan="3">Datos Generales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $uso = '';
                                if($f->Uso=='G01'){
                                    $uso = 'Adquisición de mercancias';
                                }else if($f->Uso=='G02'){
                                    $uso = 'Devoluciones, descuentos o bonificaciones';
                                }else if($f->Uso=='G03'){
                                    $uso = 'Gastos en general';
                                }else if($f->Uso=='I01'){
                                    $uso = 'Construcciones';
                                }else if($f->Uso=='I02'){
                                    $uso = 'Mobilario y equipo de oficina por inversiones';
                                }else if($f->Uso=='I03'){
                                    $uso = 'Equipo de transporte';
                                }else if($f->Uso=='I04'){
                                    $uso = 'Equipo de computo y accesorios';
                                }else if($f->Uso=='I05'){
                                    $uso = 'Dados, troqueles, moldes, matrices y herramental';
                                }else if($f->Uso=='I06'){
                                    $uso = 'Comunicaciones telefónicas';
                                }else if($f->Uso=='I07'){
                                    $uso = 'Comunicaciones satelitales';
                                }else if($f->Uso=='I08'){
                                    $uso = 'Otra maquinaria y equipo';
                                }else if($f->Uso=='D01'){
                                    $uso = 'Honorarios médicos, dentales y gastos hospitalarios.';
                                }else if($f->Uso=='D02'){
                                    $uso = 'Gastos médicos por incapacidad o discapacidad';
                                }else if($f->Uso=='D03'){
                                    $uso = 'Gastos funerales.';
                                }else if($f->Uso=='D04'){
                                    $uso = 'Donativos.';
                                }else if($f->Uso=='D05'){
                                    $uso = 'Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).';
                                }else if($f->Uso=='D06'){
                                    $uso = 'Aportaciones voluntarias al SAR.';
                                }else if($f->Uso=='D07'){
                                    $uso = 'Primas por seguros de gastos médicos.';
                                }else if($f->Uso=='D08'){
                                    $uso = 'Gastos de transportación escolar obligatoria.';
                                }else if($f->Uso=='D09'){
                                    $uso = 'Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.';
                                }else if($f->Uso=='D10'){
                                    $uso = 'Pagos por servicios educativos (colegiaturas)';
                                }else{
                                    $uso = 'Por definir';
                                }
                            ?>
                            <td> <b>Uso: </b> {{$uso}}</td>
                            <?php
                                $Comprobante = '';
                                if($f->Tipo_Comprobante=='I'){
                                    $Comprobante = 'Ingreso';
                                }else if($f->Tipo_Comprobante=='E'){
                                    $Comprobante = 'Egreso';
                                }else if($f->Tipo_Comprobante=='T'){
                                    $Comprobante = 'Traslado';
                                }else if($f->Tipo_Comprobante=='N'){
                                    $Comprobante = 'Nómina';
                                }else{
                                    $Comprobante = 'Pago';
                                }
                            ?>
                            <td> <b>Tipo de comprobante:</b> {{$Comprobante}}</td>
                        </tr>
                        <tr>
                            <?php
                                $Moneda = '';
                                if($f->Moneda=='MXN'){
                                    $Moneda = 'Peso Mexicano';
                                }else{
                                    $Moneda = 'México Unidad de Inversión (UDI)';
                                }
                            ?>
                            <td> <b>Moneda: </b>{{$Moneda}}</td>
                            <?php
                                $Forma_Pago = '';
                                if($f->Forma_Pago=='01'){
                                    $Forma_Pago = 'Efectivo';
                                }else if($f->Forma_Pago=='02'){
                                    $Forma_Pago = 'Cheque nominativo';
                                }else if($f->Forma_Pago=='G03'){
                                    $Forma_Pago = 'Transferencia electrónica de fondos';
                                }else if($f->Forma_Pago=='04'){
                                    $Forma_Pago = 'Tarjeta de crédito';
                                }else if($f->Forma_Pago=='05'){
                                    $Forma_Pago = 'Monedero electrónico';
                                }else if($f->Forma_Pago=='06'){
                                    $Forma_Pago = 'Dinero electrónico';
                                }else if($f->Forma_Pago=='08'){
                                    $Forma_Pago = 'Vales de despensa';
                                }else if($f->Forma_Pago=='12'){
                                    $Forma_Pago = 'Dación en pago';
                                }else if($f->Forma_Pago=='13'){
                                    $Forma_Pago = 'Pago por subrogación';
                                }else if($f->Forma_Pago=='14'){
                                    $Forma_Pago = 'Pago por consignación';
                                }else if($f->Forma_Pago=='15'){
                                    $Forma_Pago = 'Condonación';
                                }else if($f->Forma_Pago=='17'){
                                    $Forma_Pago = 'Compensación';
                                }else if($f->Forma_Pago=='23'){
                                    $Forma_Pago = 'Novación';
                                }else if($f->Forma_Pago=='24'){
                                    $Forma_Pago = 'Confusión';
                                }else if($f->Forma_Pago=='25'){
                                    $Forma_Pago = 'Remisión de deuda';
                                }else if($f->Forma_Pago=='26'){
                                    $Forma_Pago = 'Prescripción o caducidad';
                                }else if($f->Forma_Pago=='27'){
                                    $Forma_Pago = 'A satisfacción del acreedor';
                                }else if($f->Forma_Pago=='28'){
                                    $Forma_Pago = 'Tarjeta de débito';
                                }else if($f->Forma_Pago=='29'){
                                    $Forma_Pago = 'Tarjeta de servicios';
                                }else if($f->Forma_Pago=='30'){
                                    $Forma_Pago = 'Aplicación de anticipos';
                                }else if($f->Forma_Pago=='31'){
                                    $Forma_Pago = 'Intermediario pagos';
                                }else{
                                    $Forma_Pago = 'Por definir';
                                }
                            ?>
                            <td> <b>Forma de pago:</b> {{$Forma_Pago}}</td>
                        </tr>
                        <tr>
                            <?php
                                $Metodo_Pago = '';
                                if($f->Metodo_Pago=='PUE'){
                                    $Metodo_Pago = 'Pago en una sola exhibición';
                                }else{
                                    $Metodo_Pago = 'Pago en parcialidades o diferido';
                                }
                            ?>
                            <td> <b>Método de pago: </b> {{$Metodo_Pago}}</td>
                            <?php
                                $Regimen = '';
                                if($f->Regimen=='601'){
                                    $Regimen = 'General de Ley Personas Morales';
                                }else if($f->Regimen=='603'){
                                    $Regimen = 'Personas Morales con Fines no Lucrativos';
                                }else if($f->Regimen=='605'){
                                    $Regimen = 'Sueldos y Salarios e Ingresos Asimilados a Salarios';
                                }else if($f->Regimen=='608'){
                                    $Regimen = 'Demás ingresos';
                                }else if($f->Regimen=='609'){
                                    $Regimen = 'Consolidación';
                                }else if($f->Regimen=='610'){
                                    $Regimen = 'Residentes en el Extranjero sin Establecimiento Permanente en México';
                                }else if($f->Regimen=='611'){
                                    $Regimen = 'Ingresos por Dividendos (socios y accionistas)';
                                }else if($f->Regimen=='612'){
                                    $Regimen = 'Personas Físicas con Actividades Empresariales y Profesionales';
                                }else if($f->Regimen=='614'){
                                    $Regimen = 'Ingresos por intereses';
                                }else if($f->Regimen=='616'){
                                    $Regimen = 'Sin obligaciones fiscales';
                                }else if($f->Regimen=='620'){
                                    $Regimen = 'Sociedades Cooperativas de Producción que optan por diferir sus ingresos';
                                }else if($f->Regimen=='621'){
                                    $Regimen = 'Incorporación Fiscal';
                                }else if($f->Regimen=='622'){
                                    $Regimen = 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras';
                                }else if($f->Regimen=='623'){
                                    $Regimen = 'Opcional para Grupos de Sociedades';
                                }else if($f->Regimen=='624'){
                                    $Regimen = 'Coordinados';
                                }else if($f->Regimen=='629'){
                                    $Regimen = 'Hidrocarburos';
                                }else if($f->Regimen=='607'){
                                    $Regimen = 'Régimen de Enajenación o Adquisición de Bienes';
                                }else if($f->Regimen=='629'){
                                    $Regimen = 'De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales';
                                }else if($f->Regimen=='630'){
                                    $Regimen = 'Enajenación de acciones en bolsa de valores';
                                }else if($f->Regimen=='615'){
                                    $Regimen = 'Régimen de los ingresos por obtención de premios';
                                }else {
                                    $Regimen = 'Arrendamiento';
                                }
                            ?>
                            <td> <b>Régimen Fiscal: </b>{{$Regimen}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>Clave Producto / Servicio</th>
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>Clave Unidad</th>
                            <th>PRECIO UNIT</th>
                            <th>DESC.</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($detalles as $d)
                        <tr>
                            <td>{{$d->N_SAT}}</td>
                            <td>{{$d->Cantidad}}</td>
                            <td>{{$d->Articulo}}</td>
                            <td>{{$d->C_Unidad}}</td>
                            <td>{{$d->Precio}}</td>
                            <td>{{$d->Descuento}}</td>
                            <td>{{$d->Cantidad*$d->Precio-$d->Descuento}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    @foreach($venta as $ven)
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>SUBTOTAL</th>
                            <td>$ {{round($ven->Total-($ven->Total*$ven->Impuesto),2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>IVA</th>
                            <td>$ {{round($ven->Total*$ven->Impuesto,2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>$ {{$ven->Total}}</td>
                        </tr>
                    @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su compra!</b></p>
            </div>
        </footer>
    </body>
</html>