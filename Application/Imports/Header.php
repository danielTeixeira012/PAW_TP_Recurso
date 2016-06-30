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