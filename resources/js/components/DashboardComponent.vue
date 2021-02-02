<template>
    <div >
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ventas</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChartVentas" style="width: 50%; height: 50%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ingresos</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChartIngresos" style="width: 50%; height: 50%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</template>
<script>
export default {
    data(){
        return {
            /*Grafica de ingresos */
            varIngreso:null,
            charIngreso:null,
            ingresos:[],
            varTotalIngresos:[],
            varMesIngresos:[],

            /*Grafica de ventas */
            varVentas:null,
            charVenta:null,
            ventas:[],
            varTotalVentas:[],
            varMesVentas:[],
            colores:[],
        }
    },
    methods :{
        obtenerIngresos(){
            let me = this;
            var url= '/dashboard';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.ingresos = respuesta.ingresos;
                me.loadIngresos();
            }).catch(function(e){
                console.log(e);
            })
        },
        obtenerVentas(){
            let me = this;
            var url= '/dashboard';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.ventas = respuesta.ventas;
                me.loadVentas();
            }).catch(function(e){
                console.log(e);
            })
        },
        aleatorio(inferior,superior){
            var numPosibilidades = superior - inferior;
            var aleat = Math.random() * numPosibilidades;
            aleat = Math.floor(aleat);
            return parseInt(inferior) + aleat;
        },
        obtenerColor(){
            let me = this;
            var color_aleatorio = '';
            var hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F")
            var color_aleatorio = "#";
            for (var i=0;i<6;i++){
                var pos = me.aleatorio(0,hexadecimal.length);
                color_aleatorio += hexadecimal[pos];
            }
            return color_aleatorio;
        },
        loadIngresos(){
            
            let me = this;
            me.ingresos.map(function(e){
                me.varMesIngresos.push('Mes: '+e.mes);
                me.varTotalIngresos.push(e.total);
                me.colores.push(me.obtenerColor());
            });
            
            me.varIngreso= document.getElementById('pieChartIngresos').getContext('2d');
            me.charIngreso = new Chart(me.varIngreso, {
                type: 'bar',
                data: {
                    labels: me.varMesIngresos,
                    datasets: [{
                        label: 'Ingresos',
                        data: me.varTotalIngresos,
                        backgroundColor: me.colores,
                        borderColor:me.colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        loadVentas(){
            
            let me = this;
            me.ventas.map(function(e){
                me.varMesVentas.push('Mes: '+e.mes);
                me.varTotalVentas.push(e.total);
                me.colores.push(me.obtenerColor());
            });
            
            me.varVentas= document.getElementById('pieChartVentas').getContext('2d');
            me.charVenta = new Chart(me.varVentas, {
                type: 'bar',
                data: {
                    labels: me.varMesVentas,
                    datasets: [{
                        label: 'Ventas',
                        data: me.varTotalVentas,
                        backgroundColor: me.colores,
                        borderColor:me.colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
    },
    mounted(){
        this.obtenerIngresos();
        this.obtenerVentas();
    }
}
</script>