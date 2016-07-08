<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'ComentariosManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="Application/Styles/Listar.css">
        <title></title>  
        <script src="Application/Libs/jquery-2.2.4.js"></script>
        <script src="Application/JS/candidatarJS.js"></script>
        <script src="Application/JS/comentarioJS.js"></script>
        <?php
        if (!$session) {
            ?>
            <script src="Application/JS/GuardarOfertaLocalJS.js"></script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php require_once 'Application/imports/Header.php'; ?>      
        <?php
        $idOferta = filter_input(INPUT_GET, 'oferta');
        $man = new OfertaManager();
        $res = $man->getOfertaByID($idOferta);
        $prestadorMan = new PrestadorManager();
        $manEmpregador = new EmpregadorManager();
        if ($res != array()) {
            $pre = $manEmpregador->getEmpregadorByid($res[0]['idEmpregador']);
            ?>
            <section id="oferta">
                <article id="article" itemscope data-id="<?= $idOferta ?>">
                    <h2><?= $res[0]['tituloOferta'] ?></h2>
                    <p><b>Informação Oferta:</b> <?= $res[0]['informacaoOferta'] ?></p>
                    <p><b>Função Oferta:</b> <?= $res[0]['funcaoOferta'] ?></p>
                    <p><b>Salario: </b><?= $res[0]['salario'] ?></p>
                    <p><b>Requisitos:</b> <?= $res[0]['requisitos'] ?></p>
                    <p><b>Regiao: </b><?= $res[0]['regiao'] ?></p>
                    <p><b>Tipo Oferta:</b> <?= $res[0]['tipoOferta'] ?></p>
                    <p><b>Empregador: </b><?= $pre[0]['email'] ?></p>

                    <?php
                    if ($session && $tipo) {
                        if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
                            $candMan = new CandidaturaManager();
                            $presMan = new PrestadorManager();
                            $returnPres = $presMan->verifyEmail(SessionManager::getSessionValue('email'));
                            $returnCand = $candMan->getCandidaturaByIdPrestadorAndStatusCandidaturasAndIdOferta($returnPres[0]['idPrestador'], 'submetida', $idOferta);
                            $returnCand2 = $candMan->getCandidaturaByIdPrestadorAndStatusCandidaturasAndIdOferta($returnPres[0]['idPrestador'], 'aceitada', $idOferta);
                            $returnCand3 = $candMan->getCandidaturaByIdPrestadorAndStatusCandidaturasAndIdOferta($returnPres[0]['idPrestador'], 'rejeitada', $idOferta);
                            if (empty($returnCand) && empty($returnCand2) && empty($returnCand3)) {
                                if (!$man->VerificaOfertaExpirou($idOferta)) {
                                    ?>
                                    <button class="buttonC" id="candidatar">Candidatar</button>    
                                    <?php
                                } else {
                                    ?>
                                    <p>Não são aceite candidaturas</p>
                                    <?php
                                }
                            } else {
                            if(!empty($returnCand)){
                                ?>
                                <p>Já se candidatou a esta oferta de trabalho, no entanto ainda não foi escolhido o vencedor</p>
                                <?php
                            }else if(!empty($returnCand2)){
                                 ?>
                                <p>Foi aceite para esta oferta</p>
                                <?php
                            }else if(!empty($returnCand3)){
                                 ?>
                                <p>Infelizmente foi rejeitado para esta oferta</p>
                                <?php
                            }
                            }
                        } else if (SessionManager::getSessionValue('tipoUser') === 'empregador') {
                            //ver se é dele
                            $candidMan = new CandidaturaManager();
                            $logado = $manEmpregador->getEmpregadorByMail(SessionManager::getSessionValue('email'));
                            if ($res[0]['idEmpregador'] === $logado[0]['idEmpregador']) {

                                //publicada
                                $candidaturas = $candidMan->getCandidaturasSubmetidasByIdOferta($idOferta);
                                if (!empty($candidaturas)) {
                                    ?>
                                    <h2>Candidatos á oferta de trabalho</h2>
                                    <table>
                                        <tr>
                                            <th>Prestador</th> 
                                        </tr>

                                        <?php
                                        foreach ($candidaturas as $key => $value) {
                                            ?>

                                            <tr>
                                                <td><?= $prestadorMan->getPrestadorByid($value['idPrestador'])[0]['nome'] ?></td>
                                                <td class="tdButtom"><a href="empregador/VerHistoricoCandidato.php?prestador=<?= $value['idPrestador'] ?>"><button class="tableButton">Ver prestador</button></a></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </table>
                                    <?php
                                } else {

                                    $candidaturasVence = $candidMan->getVencedorCandidaturaByIdOferta($idOferta);
                                    if (empty($candidaturasVence)) {
                                        ?>
                                        <p>Não foram efetuadas candidaturas para esta oferta</p>
                                        <?php
                                    } else {
                                        $idVencedor = $candidaturasVence[0]['idPrestador'];
                                        $prestadorVencedor = $prestadorMan->getPrestadorByid($idVencedor);
                                        ?>
                                        <h2>Vencedor da oferta</h2>     
                                        <table>
                                            <tr>
                                                <th>Prestador</th> 
                                            </tr>
                                            <tr>
                                                <td><?= $prestadorVencedor[0]['nome'] ?></td>
                                                <td class="tdButtom"><a href="empregador/VerHistoricoCandidato.php?prestador=<?= $idVencedor ?>"><button class="tableButton">Ver prestador</button></a></td>
                                            </tr>
                                        </table>
                                        <?php
                                        $candidaturasRejeitadas = $candidMan->getCandidaturasRejeitadaByIdOferta($idOferta);
                                        if (!empty($candidaturasRejeitadas)) {
                                            ?>
                                            <h2>Candidatos Rejeitados</h2>
                                            <table>
                                                <tr>
                                                    <th>Prestador</th> 
                                                </tr>
                                                <?php
                                                foreach ($candidaturasRejeitadas as $key => $value) {
                                                    $prestadorMan = $prestadorMan->getPrestadorByid($value['idPrestador']);
                                                    ?>

                                                    <tr>
                                                        <td><?= $prestadorMan[0]['nome'] ?></td>
                                                        <td class="tdButtom"><a href="empregador/VerHistoricoCandidato.php?prestador=<?= $value['idPrestador'] ?>"><button class="tableButton">Ver prestador</button></a></td>

                                                    </tr>
                                                <?php }
                                                ?>
                                            </table>

                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </article>

            </section>
            <section id="comentarios" itemscope data-id="<?= $idOferta ?>">
                <?php
                if ($session && $tipo) {
                    ?>
                    <textarea id="areaComentario" type="text"></textarea>
                    <button class="buttonC" id="comentar">Comentar</button>
                    <?php
                }
                ?>

                <?php
                $ComentariosManager = new ComentariosManager();
                $comentarios = $ComentariosManager->getComentarioByIDOferta($idOferta);
                if (!empty($comentarios)) {
                    ?>
                    <h2>Comentarios sobre a oferta</h2>
                    <?php
                    foreach ($comentarios as $key => $value) {
                        ?>
                        <article class="comentario">
                            <p class="autor">Autor: <?= $value['autor'] ?></p>
                            <p class="coment"><?= $value['comentario'] ?></p>                 
                        </article>
                        <?php
                    }
                }
                ?>
            </section>
            <?php
        } else {
            ?>
            <h2>Não existe nenhuma oferta com o id <?= $idOferta ?></h2>
            <?php
        }
        ?>

    </body>
    <?php require_once 'Application/imports/Footer.php'; ?>
</html>
