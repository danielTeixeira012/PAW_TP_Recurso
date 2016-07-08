/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function escreverResultado(data) {
    var dados = JSON.parse(data);
    document.getElementById('resultado').innerHTML = '';
    if (dados.length !== 0) {
        var section = document.getElementById('resultado');
        var i = 0;
        var secOfertas = document.createElement('section');
        secOfertas.setAttribute('id', 'ofertas');
        var offer = document.getElementById('ofertas');
        while (offer.firstChild) {
            offer.removeChild(offer.firstChild);
        }
        for (i = 0; i < dados.length; ++i) {
            var a = document.createElement('a');
            a.setAttribute('href', 'verOfertas.php?oferta=' + dados[i]['idOferta']);
            var article = document.createElement('article');
            var section = document.createElement('section');
            var img = document.createElement('img');
            img.setAttribute('src', dados[i]['fotoPath']);
            var inputId = document.createElement('input');
            inputId.setAttribute('type', 'hidden');
            inputId.setAttribute('id', dados[i]['idOferta']);
            var h2 = document.createElement('h2');
            h2.innerHTML = dados[i]['tituloOferta'];
            var pReg = document.createElement('p');
            var bReg = document.createElement('b');
            bReg.innerHTML = 'Região:';
            pReg.appendChild(bReg);
            pReg.innerHTML += dados[i]['regiao'];
            var pInf = document.createElement('p');
            var bInf = document.createElement('b');
            bInf.innerHTML = 'Info:';
            pInf.appendChild(bInf);
            pInf.innerHTML += dados[i]['informacaoOferta'];


            a.appendChild(article);
            article.appendChild(section);
            section.appendChild(img);
            section.appendChild(inputId);
            section.appendChild(h2);
            section.appendChild(pReg);
            section.appendChild(pInf);
            document.getElementById('ofertas').appendChild(a);


//            <a href="verOfertas.php?oferta=<?= $value['idOferta'] ?>">
//                    <article>
//                        <section>
//                           
//                            <img src="<?= $categoria[0]['fotoPath'] ?>"/>
//                            <input type='hidden' id='<?= $value['idOferta'] ?>'/>
//                            <h2><?= $value['tituloOferta'] ?></h2>
//                            <p><b>Região:</b> <?= $value['regiao'] ?></p>
//
//                            <p><b>Info:</b><?php
//                                $infor = $value['informacaoOferta'];
//                                echo substr($infor, 0, 100);
//                                if (strlen($infor) > 100) {
//                                    echo '...';
//                                }
//                                ?> </p>
//                        </section>
//                        <?php
//                        if ($session && $tipo) {
//                            if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
//                                $manPre = new PrestadorManager();
//                                $res = $manPre->verifyEmail(SessionManager::getSessionValue('email'));
//                                $manFav = new FavoritosManager();
//                                $resCan = $manFav->getFavoritosByIDPrestadorAndIdOFerta($res[0]['idPrestador'], $value['idOferta']);
//                                if (empty($resCan)) {
//                                    ?> 
//
//                                    <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/starplus.png" alt="favorito"></a>
//
//                                    <?php
//                                } else {
//                                    ?> 
//                                    <a href="Prestador/adicionarFavoritos.php?oferta=<?= $value['idOferta'] ?>"><img class="favorito" src="Application/Resources/icons/star.png" alt="favorito"></a>
//                                    <?php
//                                }
//                            }
//                            ?>
//                        </article>
//                    </a>  
//                    <?php
//                } else {
//                    ?> 
//                </a>
//                <button data-idOferta="<?= $value['idOferta'] ?>"><img class="localSave" src="Application/Resources/icons/save.png" alt="Guardar"></button>          



//            var table = document.createElement('table');
//            var th1 = document.createElement('th');
//            var th2 = document.createElement('th');
//            var tr = document.createElement('tr');
//            var td1 = document.createElement('td');
//            var td2 = document.createElement('td');
//            var a = document.createElement('a');
//            a.setAttribute('href', 'verOfertas.php?oferta=' + dados[i]['idOferta']);
//            var button = document.createElement('button');
//            button.innerHTML = "Ver oferta";
//            a.appendChild(button);
//            th1.innerHTML = "Titulo oferta";
//            th2.innerHTML = "Opção";
//            td1.innerHTML = dados[i]['tituloOferta'];
//            td2.appendChild(a);
//            tr.appendChild(th1);
//            tr.appendChild(th2);
//            th1.appendChild(td1);
//            th2.appendChild(td2);
//            table.appendChild(th1);
//            table.appendChild(th2);
//            table.appendChild(tr);
//            section.appendChild(table);
        }
    } else {
        document.getElementById('resultado').innerHTML = 'Não existe resultados para a sua procura!';
    }
}

function pesquisarOfertasAJAX() {
    var pesquisa = document.getElementById('areaPesquisa').value;
    $.get('Application/Service/PesquisaService.php', {categoria: pesquisa},
            function (data) {
                escreverResultado(data);
            }).fail(function () {
        alert('Ocorreu um erro');
    }
    );
}

function apagarResultados() {
    document.getElementById('resultado').innerHTML = "";
}

function initEvents() {
    document.getElementById('pesquisa').addEventListener('click', pesquisarOfertasAJAX);
    document.getElementById('apagar').addEventListener('click', apagarResultados);
}

document.addEventListener('DOMContentLoaded', initEvents);