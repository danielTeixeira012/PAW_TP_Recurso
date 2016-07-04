<header id="head">         
    <?php
    require_once __DIR__ . '/../../login.php';
    ?>
    <nav>
        <ul id="navList">
            <li><a href="<?php echo Config::getRootPath() . 'index.php'; ?>">Home</a></li>


            <?php
            if ($session) {
                ?>
                <?php
                if ($tipoUtilizador === 'prestador') {
                    ?>
                    <li class="dropdown">
                        <a href="<?php echo Config::getRootPath() . 'Prestador/areaPessoalPrestador.php'; ?>" class="dropbtn">Área Prestador</a>
                        <ul class="drop-nav">
                            <li><a href="<?php echo Config::getRootPath() . 'Prestador/ofertasTrabalhoFavoritas.php'; ?>">Ofertas Favoritas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Prestador/ofertasTrabalhoSubmetidas.php'; ?>">Ofertas Submetidas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Prestador/ofertasTrabalhoFinalizadas.php'; ?>">Ofertas Aceitado</a></li>
                        </ul>
                    </li>
                    <?php
                } else if ($tipoUtilizador === 'empregador') {
                    ?>
                    <li class="dropdown">
                        <a href="<?php echo Config::getRootPath() . 'Empregador/AreaEmpregador.php'; ?>" class="dropbtn">Área Empregador</a>
                        <ul class="drop-nav">
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorPendentes.php'; ?>">Ofertas Pendentes</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorPublicadas.php'; ?>">Ofertas Publicadas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorFinalizadas.php'; ?>">Ofertas Finalizadas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/OfertasPrestadorExpiradas.php'; ?>">Ofertas Expiradas</a></li>
                            <li><a href="<?php echo Config::getRootPath() . 'Empregador/AddOferta.php'; ?>">Adicionar Oferta</a></li>

                        </ul>
                    </li>
                    <?php
                } else if ($tipoUtilizador === 'administrador') {
                    ?>
                    <li><a href=" <?php echo Config::getRootPath() . 'Administrador/AreaAdministrador.php'; ?>">Área Administrador</a></li>
                    <?php
                }
                ?>

                <?php
            }
            ?>
        </ul> 
    </nav>
</header>