var ofertas = [];
var countId = 0;


function loadAllFromLocalSorage() {

    if (typeof (Storage) !== "undefined") {
        try {
            ofertas = [];
            var temp = localStorage.getItem('ofertas');
            var temp2 = localStorage.getItem('countId');
            if (temp !== null && temp2 !== null) {
                ofertasTemp = JSON.parse(temp);
                countId = JSON.parse(temp2);
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

function loadOfertasUserFromLocalSorage() {
    if (typeof (Storage) !== "undefined") {
        try {
            ofertas = [];
            var temp = localStorage.getItem('ofertas');
            var temp2 = localStorage.getItem('countId');

            if (temp !== null && temp2 !== null) {
                ofertasTemp = JSON.parse(temp);
                countId = JSON.parse(temp2);
                var i = 0;
                var idEmpregador = document.getElementById('idEmpregador').value;
                for (i = 0; i < ofertasTemp.length; i++) {
                    if (ofertasTemp[i]['idEmpregador'] === idEmpregador) {
                        ofertas.push(ofertasTemp[i]);
                    }
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

function guardarOfertasStorage() {
    if (typeof (Storage) !== "undefined") {
        try {
            localStorage.setItem('ofertas', JSON.stringify(ofertas));
            localStorage.setItem('countId', JSON.stringify(countId));
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

function preencherOferta() {
    loadAllFromLocalSorage();
    var i = 0;
    for (i = 0; i < ofertas.length; i++) {
        if (ofertas[i]['idOferta'] == document.getElementById('selectLoad').value) {
            document.getElementById("categoria").value = ofertas[i]['categoria'];
            document.getElementById('tituloOferta').setAttribute('value', ofertas[i]['tituloOferta']);
            document.getElementById('informacaoOferta').innerHTML = ofertas[i]['informacaoOferta'];
            document.getElementById('funcaoOferta').innerHTML = ofertas[i]['funcaoOferta'];
            document.getElementById('salario').setAttribute('value', ofertas[i]['salario']);
            document.getElementById('requisitos').innerHTML = ofertas[i]['requisitos'];
            document.getElementById("tipoOferta").value = ofertas[i]['tipoOferta'];
            document.getElementById('regiao').setAttribute('value', ofertas[i]['regiao']);
            document.getElementById('dataLimite').setAttribute('value', ofertas[i]['dataLimite']);
            //remover dalocal storage
            alert('Atenção!!!! A oferta escolhida foi removida localmente caso pretenda mantêla terá de a guardar novamente');
            ofertas.splice(i, 1);
            guardarOfertasStorage();
        }
    }
}

function appenSelect() {
    loadOfertasUserFromLocalSorage();
    var i = 0;
    var count = 0;
    var select = document.createElement("select");
    var label = document.createElement("label");
    select.setAttribute('id', 'selectLoad');
    label.setAttribute('for', 'selectLoad');
    label.innerHTML='Carregar dados locais';
    for (i = 0; i < ofertas.length; ++i) {
        var optionTemp = document.createElement("option");
        optionTemp.value = ofertas[i]['idOferta'];
        optionTemp.innerHTML = ofertas[i]['tituloOferta'];
        select.appendChild(optionTemp);
        count++;
    }
    if (count != 0) {
        document.getElementById('lsDIV').appendChild(label);
        document.getElementById('lsDIV').appendChild(select);
        document.getElementById("selectLoad").selectedIndex = -1;
        document.getElementById('selectLoad').addEventListener('change', preencherOferta);
    }

}

function saveOferta() {
    loadAllFromLocalSorage();
    var idOferta = countId + 1;
    var categoria = document.getElementById('categoria').value;
    var tituloOferta = document.getElementById('tituloOferta').value;
    var informacaoOferta = document.getElementById('informacaoOferta').value;
    var funcaoOferta = document.getElementById('funcaoOferta').value;
    var salario = document.getElementById('salario').value;
    var requisitos = document.getElementById('requisitos').value;
    var regiao = document.getElementById('regiao').value;
    var idEmpregador = document.getElementById('idEmpregador').value;
    var tipoOferta = document.getElementById('tipoOferta').value;
    var dataLimite = document.getElementById('dataLimite').value;
    if (categoria === null || categoria === "" ||
            tituloOferta === null || tituloOferta === "" ||
            informacaoOferta === null || informacaoOferta === "" ||
            funcaoOferta === null || funcaoOferta === "" ||
            salario === null || salario === "" ||
            idEmpregador === null || idEmpregador === "" ||
            tipoOferta === null || tipoOferta === "" ||
            dataLimite === null || dataLimite === "") {
        alert("Um ou mais dos campos estão vazios!!!");
    } else {
        var oferta = {idOferta: idOferta, categoria: categoria, tituloOferta: tituloOferta,
            informacaoOferta: informacaoOferta, funcaoOferta: funcaoOferta, salario: salario,
            requisitos: requisitos, regiao: regiao, idEmpregador: idEmpregador,
            tipoOferta: tipoOferta, dataLimite: dataLimite};

        ofertas.push(oferta);
        countId += 1;
        guardarOfertasStorage();
        location.reload();
    }

}

function verifyDelete() {
    alert('xpto');
}


function initEvents() {
    document.getElementById('guardarTemp').addEventListener('click', saveOferta);
}

document.addEventListener('DOMContentLoaded', initEvents);
document.addEventListener('DOMContentLoaded', appenSelect);
