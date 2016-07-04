function candidatarRes(data){
    document.getElementById('candidatar').remove();
    var p = document.createElement('p');
    p.innerHTML = data;
    document.getElementById('article').appendChild(p);
    alert(data);
}

function candidatarAJAX(){
    var id = this.parentNode.getAttribute('data-id');
    
    $.get('Application/Service/CandidatarService.php', {idOferta: id}, 
        function(data){
            candidatarRes(data);
    }).fail(function () {
                    alert('Ocorreu um erro');
                }
    );
}

function initEvents(){
    document.getElementById('candidatar').addEventListener('click', candidatarAJAX);
}


document.addEventListener('DOMContentLoaded', initEvents);
