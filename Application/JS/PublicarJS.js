function publicarResultado(data) {
    document.getElementById('publicar').remove();
    var p = document.createElement('p');
    p.innerHTML = data;
    document.getElementById('article').appendChild(p);
}

function publicarAJAX() {
    var id = this.parentNode.getAttribute('data-id');
    $.get('Application/Service/PublicarService.php', {idOferta: id},
            function (data) {
                publicarResultado(data);
            }
    );
}

function initEvents() {

    $publicar = document.getElementById('publicar');
    if ($publicar !== null) {
        $publicar.addEventListener('click', publicarAJAX);
    }
}


document.addEventListener('DOMContentLoaded', initEvents);
