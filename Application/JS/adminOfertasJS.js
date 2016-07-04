/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function resultsEliminarOferta(data, id) {
    if (data !== '') {
        alert(data);
        document.querySelector('tr[id="' + id + '"]').remove();
    } else {
        alert('Erro');
    }
}

function resultsDesativarOferta(data, button) {
    if (data !== '') {
        alert(data);
        button.value = "Ativar";
    } else {
        alert('Erro');
    }
}

function resultsAtivarOferta(data, button) {
    if (data !== '') {
        if (data === 'Oferta não ativa, data limite expirada') {
            alert(data);
        } else {
            if (data === 'Oferta ativada') {
                alert(data);
                button.value = "Desativar";
            }
        }
    } else {
        alert('Erro');
    }
}

function eliminarOferta() {
    var id = this.parentNode.parentNode.getAttribute('id');
    $.get('../Application/Service/EliminarOfertaService.php', {idOferta: id},
            function (data) {
                resultsEliminarOferta(data, id);
            }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );
}

function ativarOferta(button, id) {
    $.get('../Application/Service/AtivarOfertaService.php', {idOferta: id},
            function (data) {
                resultsAtivarOferta(data, button);
            }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );
}

function desativarOferta(button, id) {

    $.get('../Application/Service/DesativarOfertaService.php', {idOferta: id},
            function (data) {
                resultsDesativarOferta(data, button);
            }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );
}

function verEstado() {
    var id = this.parentNode.parentNode.getAttribute('id');
    var estado = this.getAttribute('value');
    var button = this;
    if (estado === 'Desativar') {
        desativarOferta(button, id);
    } else {
        if (estado === 'Ativar') {
            ativarOferta(button, id);
        } else {
            alert('Erro');
        }
    }

}

function initEvents() {
    var x = document.getElementsByClassName('eliminarOferta');
    var opcao = document.getElementsByClassName('opcao');
    var i = 0;
    var j = 0;


    for (i = 0; i < x.length; ++i) {
        x[i].addEventListener('click', eliminarOferta);
    }
    for (j = 0; j < opcao.length; j++) {
        opcao[j].addEventListener('click', verEstado);
    }
}

document.addEventListener('DOMContentLoaded', initEvents);