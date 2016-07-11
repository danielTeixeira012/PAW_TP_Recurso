<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'AdministradorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    require_once 'VerificaCookies.php';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Application/Styles/Index.css">
        <script src="Application/Libs/jquery-2.2.4.js"></script>
        <script src="Application/JS/PesquisaJS.js"></script>
        <?php
        if (!$session) {
            ?>
            <script src="Application/JS/GuardarOfertaLocalJS.js"></script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php require_once './Application/Imports/Header.php'; ?>
        <section id="pesquisarArea">
            <?php
            $categoriasMan = new CategoriasManager();
            $categorias = $categoriasMan->getCategorias();
            ?>
            <form  method="get" action="Pesquisa.php"  id="procuraForm"> 
                <label for="pesquisatexto">Pesquisar por descritivo</label>
                <input  type="text" name="pesquisatexto" id="pesquisatexto">
                <label for="categoriaSearch">Pesquisar por Categoria</label>
                <select id = "categoriaSearch" name ="categoria">
                    <option/>
                    <?php
                    foreach ($categorias as $key => $value) {
                        ?>     
                        <option value="<?= $value['idCategoria'] ?>"><?= $value['nomeCategoria'] ?></option>                     

                        <?php
                    }
                    ?>  
                </select>
                <label for="tipoHorario">Pesquisar por Horário</label>
                <select id = "tipoHorario" name ="horario"> 
                    <option/>
                    <option value="fullTime">Full-Time</option>
                    <option value="partTime">Part-Time</option>       
                </select>
                <input  class="button" type="submit" value="Procurar"> 
            </form> 
        </section>
        <section id="ofertas">
            <?php
            if (isset($_GET['pesquisatexto']) && filter_input(INPUT_GET, 'pesquisatexto', FILTER_SANITIZE_STRING) != '') {
                $pesquisa = filter_input(INPUT_GET, 'pesquisatexto', FILTER_SANITIZE_STRING);
                $ofertaMan = new OfertaManager();
                $ofertasPesquisa = $ofertaMan->pesquisar($pesquisa);
                ?>
                <h2>Pesquisa por "<?= $pesquisa ?>"</h2>
                <?php
                if (!empty($ofertasPesquisa)) {
                    foreach ($ofertasPesquisa as $key => $value) {
                        ?>
                        <a href="verOfertas.php?oferta=<?= $value['idOferta'] ?>">
                            <article>
                                <section>
                                    <?php
                                    $manCategoria = new CategoriasManager();
                                    $categoria = $manCategoria->getCategoriaByID($value['idCategoria'])
                                    ?>
                                    <img src="<?= $categoria[0]['fotoPath'] ?>"/>
                                    <input type='hidden' id='<?= $value['idOferta'] ?>'/>
                                    <h2><?= $value['tituloOferta'] ?></h2>
                                    <p><b>Região:</b> <?= $value['regiao'] ?></p>

                                    <p><b>Info:</b><?php
                                        $infor = $value['informacaoOferta'];
                                        echo substr($infor, 0, 100);
                                        if (strlen($infor) > 100) {
                                            echo '...';
                                        }
                                        ?> </p>
                                </section>
                                <?php
                                if ($session && $tipo) {
                                    if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
                                        $manPre = new PrestadorManager();
                                        $res = $manPre->verifyEmail(SessionManager::getSessionValue('email'));
                                        $manFav = new FavoritosManager();
                                        $resCan = $manFav->getFavoritosByIDPrestadorAndIdOFerta($res[0]['idPrestador'], $value['idOferta']);
                                        if (empty($resCan)) {
                                            ?> 

                                            <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/starplus.png" alt="favorito"></a>

                                            <?php
                                        } else {
                                            ?> 
                                            <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/star.png" alt="favorito"></a>
                                            <?php
                                        }
                                    }
                                    ?>
                                </article>
                            </a>  
                            <?php
                        } else {
                            ?> 
                        </a>
                        <button data-idOferta="<?= $value['idOferta'] ?>"><img class="localSave" src="Application/Resources/icons/save.png" alt="Guardar"></button>          
                    </article>

                    <?php
                }
            }
        } else {
            ?>
            <p>A procura não retornou nehuma oferta</p>
            <?php
        }
    }
    ?>
    <!-- Pesquisa por categoria -->
    <?php
    if (isset($_GET['categoria']) && filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING) != '') {
        $pesquisa = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING);
        $ofertaMan = new OfertaManager();
        $categoriaMan = new CategoriasManager();
        $categoria = $categoriaMan->getCategoriaByID($pesquisa);
        ?>
        <h2>Pesquisa por categoria "<?= $categoria[0]['nomeCategoria'] ?>"</h2>
        <?php
        if (!empty($categoria)) {
            $ofertasCategoria = $ofertaMan->pesquisarCategoria($pesquisa);
            if (!empty($ofertasCategoria)) {
                foreach ($ofertasCategoria as $key => $value) {
                    ?>
                    <a href="verOfertas.php?oferta=<?= $value['idOferta'] ?>">
                        <article>
                            <section>
                                <?php
                                $manCategoria = new CategoriasManager();
                                $categoria = $manCategoria->getCategoriaByID($value['idCategoria'])
                                ?>
                                <img src="<?= $categoria[0]['fotoPath'] ?>"/>
                                <input type='hidden' id='<?= $value['idOferta'] ?>'/>
                                <h2><?= $value['tituloOferta'] ?></h2>
                                <p><b>Região:</b> <?= $value['regiao'] ?></p>

                                <p><b>Info:</b><?php
                                    $infor = $value['informacaoOferta'];
                                    echo substr($infor, 0, 100);
                                    if (strlen($infor) > 100) {
                                        echo '...';
                                    }
                                    ?> </p>
                            </section>
                            <?php
                            if ($session && $tipo) {
                                if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
                                    $manPre = new PrestadorManager();
                                    $res = $manPre->verifyEmail(SessionManager::getSessionValue('email'));
                                    $manFav = new FavoritosManager();
                                    $resCan = $manFav->getFavoritosByIDPrestadorAndIdOFerta($res[0]['idPrestador'], $value['idOferta']);
                                    if (empty($resCan)) {
                                        ?> 

                                        <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/starplus.png" alt="favorito"></a>

                                        <?php
                                    } else {
                                        ?> 
                                        <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/star.png" alt="favorito"></a>
                                        <?php
                                    }
                                }
                                ?>
                            </article>
                        </a>  
                        <?php
                    } else {
                        ?> 
                    </a>
                    <button data-idOferta="<?= $value['idOferta'] ?>"><img class="localSave" src="Application/Resources/icons/save.png" alt="Guardar"></button>          
                    </article>

                    <?php
                }
            }
        } else {
            ?>
            <p>A procura não retornou nehuma oferta</p>
            <?php
        }
    } else {
        ?>
        <p>A categoria não existe</p>
        <?php
    }
}
?>
<!-- Pesquisa por Horário -->
<?php
if (isset($_GET['horario']) && filter_input(INPUT_GET, 'horario', FILTER_SANITIZE_STRING) != '') {
    $pesquisa = filter_input(INPUT_GET, 'horario', FILTER_SANITIZE_STRING);
    $ofertaMan = new OfertaManager();
    ?>
    <h2>Pesquisa por Horário "<?= $pesquisa ?>"</h2>
    <?php
    if ($pesquisa !== "fullTime" || $pesquisa !== "partTime") {
        $ofertasHorario = $ofertaMan->pesquisarHorario($pesquisa);
        if (!empty($ofertasHorario)) {
            foreach ($ofertasHorario as $key => $value) {
                ?>
                <a href="verOfertas.php?oferta=<?= $value['idOferta'] ?>">
                    <article>
                        <section>
                            <?php
                            $manCategoria = new CategoriasManager();
                            $categoria = $manCategoria->getCategoriaByID($value['idCategoria'])
                            ?>
                            <img src="<?= $categoria[0]['fotoPath'] ?>"/>
                            <input type='hidden' id='<?= $value['idOferta'] ?>'/>
                            <h2><?= $value['tituloOferta'] ?></h2>
                            <p><b>Região:</b> <?= $value['regiao'] ?></p>

                            <p><b>Info:</b><?php
                                $infor = $value['informacaoOferta'];
                                echo substr($infor, 0, 100);
                                if (strlen($infor) > 100) {
                                    echo '...';
                                }
                                ?> </p>
                        </section>
                        <?php
                        if ($session && $tipo) {
                            if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
                                $manPre = new PrestadorManager();
                                $res = $manPre->verifyEmail(SessionManager::getSessionValue('email'));
                                $manFav = new FavoritosManager();
                                $resCan = $manFav->getFavoritosByIDPrestadorAndIdOFerta($res[0]['idPrestador'], $value['idOferta']);
                                if (empty($resCan)) {
                                    ?> 

                                    <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/starplus.png" alt="favorito"></a>

                                    <?php
                                } else {
                                    ?> 
                                    <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/star.png" alt="favorito"></a>
                                    <?php
                                }
                            }
                            ?>
                        </article>
                    </a>  
                    <?php
                } else {
                    ?> 
                    </a>
                    <button data-idOferta="<?= $value['idOferta'] ?>"><img class="localSave" src="Application/Resources/icons/save.png" alt="Guardar"></button>          
                    </article>

                    <?php
                }
            }
        } else {
            ?>
            <p>A procura não retornou nehuma oferta</p>
            <?php
        }
    } else {
        ?>
        <p>O horário não é válido</p>
        <?php
    }
}
if (empty($ofertasPesquisa) && empty($ofertasCategoria) && empty($ofertasHorario)) {
    ?>
    <p>A sua pesquisa não retornou nenhuma pesquisa</p>
    <?php
}
?>
</section>
<?php require_once './Application/Imports/Footer.php'; ?>
</body>
</html>
