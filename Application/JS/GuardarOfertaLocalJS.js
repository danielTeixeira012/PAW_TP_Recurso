var ofertas = [];

function loadAllFromLocalSorage() {

    if (typeof (Storage) !== "undefined") {
        try {
            ofertas = [];
            var temp = localStorage.getItem('ofertasGuardadasNA');
            if (temp !== null) {
                ofertasTemp = JSON.parse(temp);
                var i = 0;
                for (i = 0; i < ofertasTemp.length; i++) {
                    ofertas.push(ofertasTemp[i]);
                }
            }
        } catch (err) {
            if (err === QUOTA_EXCEEDED_ERR) {
                console.error('Limite da localStorage excedido');
            } else {
                console.error('Erro ao guardar para a localStorage');
            }
        }
    } else {
        console.error("Sorry! No Web Storage support..");
    }
}

function guardarOfertasUserNA() {
    if (typeof (Storage) !== "undefined") {
        try {
            localStorage.setItem('ofertasGuardadasNA', JSON.stringify(ofertas));
        } catch (err) {
            if (err === QUOTA_EXCEEDED_ERR) {
                console.error("Limite da local storage excedido!!");
            } else {
                console.error("Erro!");
            }
        }
    } else {
        console.error('Não guardado');
    }
}

function contains(idOferta) {
    for (i = 0; i < ofertas.length; ++i) {
        if (ofertas[i] === idOferta) {
            return true;
        }
    }
    return false;

}

function localSaveOferta() {
    var idOferta = this.parentNode.getAttribute('data-idOferta');
    if (!contains(idOferta)) {
        ofertas.push(idOferta);
    } else {

    }
    guardarOfertasUserNA();
    location.reload();
}

function initEvents() {
    loadAllFromLocalSorage();
    if (ofertas.length <= 0) {

        var line = document.createElement('li');
        var a = document.createElement('a');
        a.setAttribute('href', "<?php echo Config::getRootPath() . 'VerOfertasLocais.php'; ?>");
        a.innerHTML = 'Ofertas Guardadas';
        line.appendChild(a);
        document.getElementById('navList').appendChild(line);


    }
    var lSave = document.getElementsByClassName('localSave');
    if (lSave.length > 0) {
        var i = 0;
        for (i = 0; i < lSave.length; ++i) {
            var idOferta = lSave[i].parentNode.getAttribute('data-idOferta');
            if (!contains(idOferta)) {
                lSave[i].addEventListener('click', localSaveOferta);
            } else {
                var parent = lSave[i].parentNode.parentNode;
                var p = document.createElement('p');
                p.innerHTML = 'Já se encontra guardado';
                lSave[i].parentNode.remove();
                parent.appendChild(p);
                i--;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', initEvents);