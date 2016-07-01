/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function escreverResultado(data) {
    
    var res = JSON.parse(data);
    if (res.length !== 0) {
        alert('Comentario adicionado');
        var section = document.getElementById('comentarios');
        var article = document.createElement('article');
        section.appendChild(article);
        document.getElementById('areaComentario').innerHTML = '';
        var section = document.getElementById('comentarios');
        var article = document.createElement('article');
        article.innerHTML = res[0]['comentario'] + ' Autor: ' + res[0]['autor'];
        section.appendChild(article);
        document.getElementById('areaComentario').value = '';
    }else{
        alert('Ocorreu um erro');
    }
}

function comentarioAJAX() {
    var comentarioAdd = document.getElementById('areaComentario').value;
    var id = this.parentNode.getAttribute('data-id');
    if (comentarioAdd !== '') {
        $.get('Application/Service/ComentarioService.php', {comentario: comentarioAdd, idOferta: id},
                function (data) {
                    escreverResultado(data);
                })
                .fail(function () {
                    alert('Ocorreu um erro');
                }
                );
    } else {
        alert('Insira alguma coisa no comentário');
    }
}

function initEvents() {
    document.getElementById('comentar').addEventListener('click', comentarioAJAX);
}

document.addEventListener('DOMContentLoaded', initEvents);