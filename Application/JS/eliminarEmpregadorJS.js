/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function results(data, id){
    alert(data);
    document.querySelector('tr[id="'+id+'"]').remove();
    
}

function eliminarEmpregadorAJAX(){
    var id = this.parentNode.parentNode.getAttribute('id');
    $.get('../Application/Service/EliminarEmpregadorService.php', {idEmpregador: id},
            function (data) {
                results(data,id);
            }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );
}

function initEvents(){
    var x = document.getElementsByClassName('eliminarEmpregador');
    var i = 0;
    
    for(i = 0; i < x.length; ++i){
        x[i].addEventListener('click', eliminarEmpregadorAJAX);
    }
}

document.addEventListener('DOMContentLoaded', initEvents);