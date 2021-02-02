<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menú</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Almacén</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li @click="menu=1">
                                <a href="#">
                                    <span class="sub-item">Artículos</span>
                                </a>
                            </li>
                            <li @click="menu=2">
                                <a href="#">
                                    <span class="sub-item">Categorías</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Compras</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li @click="menu=3">
                                <a href="#">
                                    <span class="sub-item">Ingresos</span>
                                </a>
                            </li>
                            <li @click="menu=4">
                                <a href="#">
                                    <span class="sub-item">Proveedores</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Ventas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li @click="menu=5">
                                <a href="#">
                                    <span class="sub-item">Ventas</span>
                                </a>
                            </li>
                            <li @click="menu=6">
                                <a href="#">
                                    <span class="sub-item">Clientes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Acceso</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li @click="menu=7">
                                <a href="#">
                                    <span class="sub-item">Usuarios</span>
                                </a>
                            </li>
                            <li @click="menu=8">
                                <a href="#">
                                    <span class="sub-item">Roles</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>