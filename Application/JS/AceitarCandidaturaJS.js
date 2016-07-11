function aceitarResultado(data) {
    $buttons = document.getElementsByClassName('aceitarButton');
    $count = $buttons.length;
    for (var i = $count; i !== 0; --i) {
        $buttons[i - 1].remove();
    }
    var p = document.createElement('p');
    p.innerHTML = data;
    document.getElementById('opcoes').appendChild(p);
}

function AceitarAJAX() {
    var idCandidatura = this.parentNode.parentNode.getAttribute('data-idCandidatura');
    var idOferta = this.parentNode.parentNode.getAttribute('data-idOferta');
    $.get('../Application/Service/AceitarCandidatura.php', {idCandidatura: idCandidatura, idOferta: idOferta},
            function (data) {
                aceitarResultado(data);
            }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );

}

function initEvents() {

    var buts = document.getElementsByClassName('aceitarButton');
    var i = 0;
    for (i = 0; i < buts.length; ++i) {
        buts[i].addEventListener('click', AceitarAJAX);
    }
}


document.addEventListener('DOMContentLoaded', initEvents);
