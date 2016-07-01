<header id="head">         
    <?php
    require_once __DIR__ . '/../../login.php';
    ?>
    <nav>
        <ul>
            <li><a href="<?php echo Config::getRootPath() . 'index.php'; ?>">Home</a></li>


            <?php
            if ($session) {
                ?>
                <?php
                if ($tipoUtilizador === 'prestador') {
                    ?>
                    <li><a href=" <?php echo Config::getRootPath() . 'Prestador/areaPessoalPrestador.php'; ?>">Area Prestador</a></li>
                    <?php
                } else if ($tipoUtilizador === 'empregador') {
                    ?>
                    <li><a href="<?php echo Config::getRootPath() . 'Empregador/AreaEmpregador.php'; ?>">Área Empregador</a></li>
                    <li class="dropdown">
                        <a href="" class="dropbtn">Ofertas</a>
                        <ul class="drop-nav">
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorPendentes.php'; ?>">Ofertas Pendentes</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorPublicadas.php'; ?>">Ofertas Publicadas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorFinalizadas.php'; ?>">Ofertas Finalizadas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorExpiradas.php'; ?>">Ofertas Expiradas</a></li>
                        </ul>
                    </li>
                    <?php
                } else if ($tipoUtilizador === 'administrador') {
                    ?>
                    <li><a href=" <?php echo Config::getRootPath() . 'administrador/AreaAdministrador.php'; ?>">Área Administrador</a></li>
                    <?php
                }
                ?>

                <?php
            }
            ?>
        </ul> 
    </nav>
</header>