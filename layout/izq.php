<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Junta de Ahorros</h3>
        <strong>$</strong>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="<?php obt()?>index" style="color : white">
                <div class="nav-link"><i class="fas fa-home mr-3 icomas"></i><span>Inicio</span></div>
            </a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="nav-link"><i class="fas fa-users"></i>
                    <span>Socios</span></div>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="<?php obt()?>socioslist" class=" font-weight-bold text-dark"><i class="fas fa-list mr-2"></i>Listar</a>
                </li>
                <li>
                    <a href="<?php obt()?>sociosadd" class="font-weight-bold"><i class="fas fa-plus mr-2"></i>Agregar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#Calculossubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="nav-link"><i class="fas fa-calculator mr-3 icomas"></i>
                    <span>Cálculos</span></div>
            </a>
            <ul class="collapse list-unstyled" id="Calculossubmenu">
                <li>
                    <a href="#" class=" font-weight-bold"><i class="fas fa-money-bill mr-2"></i>Utilidades</a>
                </li>
                <li>
                    <a href="<?php obt()?>solicitud" class="font-weight-bold"><i class="fas fa-university mr-2"></i>Prestamos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <div class="nav-link"><i class="fas fa-question"></i>
                    <span>Prueba</span></div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="nav-link"><i class="fas fa-paper-plane"></i>
                    <span></span></div>
            </a>
        </li>
    </ul>
</nav>