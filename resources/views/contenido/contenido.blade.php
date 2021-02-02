@extends('principal')
@section('contenido') 

@if(Auth::check())   
    @if(Auth::user()->ID_Rol ==1)
    <template v-if="menu==0">
        <dashboard-component></dashboard-component>
    </template>

    <template v-if="menu==1">
    <articulo-component></articulo-component>
    </template>

    <template v-if="menu==2">
        
        <categoria-component></categoria-component>
        
    </template>
    <template v-if="menu==3">
        <ingreso-component></ingreso-component>
    </template>
    <template v-if="menu==4">
        <proveedor-component></proveedor-component>
    </template>
    <template v-if="menu==5">
        <venta-component></venta-component>
    </template>
    <template v-if="menu==6">
    <cliente-component></cliente-component>
    </template>
    <template v-if="menu==7">
        <user-component></user-component>
    </template>
    <template v-if="menu==8">
        <rol-component></rol-component>
    </template>
    <template v-if="menu==9">
        <h1>Contenido de los Reportes de Ingreso</h1>
    </template>
    <template v-if="menu==10">
        <h1>Contenido de los Reportes de Ventas</h1>
    </template>
    <template v-if="menu==11">
        <h1>Contenido de Ayuda</h1>
    </template>
    <template v-if="menu==12">
        <h1>Contenido de Acerca de</h1>
    </template>
    @elseif (Auth::user()->ID_Rol ==2)
        <template v-if="menu==0">
            <dashboard-component></dashboard-component>
        </template>
        <template v-if="menu==5">
            <h1>Contenido de las Ventas</h1>
        </template>
        <template v-if="menu==6">
        <cliente-component></cliente-component>
        </template>
        <template v-if="menu==10">
            <venta-component></venta-component>
        </template>
        <template v-if="menu==11">
            <h1>Contenido de Ayuda</h1>
        </template>
        <template v-if="menu==12">
            <h1>Contenido de Acerca de</h1>
        </template>
    @elseif (Auth::user()->ID_Rol ==3)
        <template v-if="menu==0">
            <dashboard-component></dashboard-component>
        </template>
        <template v-if="menu==1">
        <articulo-component></articulo-component>
        </template>

        <template v-if="menu==2">
            
            <categoria-component></categoria-component>
            
        </template>
        <template v-if="menu==3">
            <ingreso-component></ingreso-component>
        </template>
        <template v-if="menu==4">
            <proveedor-component></proveedor-component>
        </template>
        <template v-if="menu==9">
            <h1>Contenido de los Reportes de Ingreso</h1>
        </template>
        <template v-if="menu==11">
            <h1>Contenido de Ayuda</h1>
        </template>
        <template v-if="menu==12">
            <h1>Contenido de Acerca de</h1>
        </template>
    @else

    @endif
@endif
    
@endsection