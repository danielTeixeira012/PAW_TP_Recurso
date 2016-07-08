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

function removerOferta(){
    var idRemove = this.parentNode.parentNode.getAttribute('idOferta');
    var i=0;
    for(i=0; i<ofertas.length; i++){
        if(ofertas[i] === idRemove){
            ofertas.splice(i, 1);
        }
    }
    this.parentNode.parentNode.remove();
    guardarOfertasUserNA();
    location.reload();
}

function construirTabela(data) {
  
    
    
    var oferta = JSON.parse(data);
    var tr = document.createElement('tr');
    var a = document.createElement('a');
    
    var td = document.createElement('td');
    var tdButton = document.createElement('td');
    var tdButton2 = document.createElement('td'); 
    
    var button = document.createElement('button');  
    var buttonDelete = document.createElement('button'); 
    
    tr.setAttribute('idOferta',oferta[0]['idOferta']);
    tdButton.setAttribute('class','tdButtom');
    tdButton2.setAttribute('class','tdButtom');
    
    button.setAttribute('class','tableButton');
    buttonDelete.setAttribute('class','tableButton');
    buttonDelete.setAttribute('id','removeOferta');
    buttonDelete.addEventListener('click', removerOferta);
    
    buttonDelete.innerHTML='Remover';  
    button.innerHTML = 'Ver Oferta';
    
    a.setAttribute('href','verOfertas.php?oferta='+oferta[0]['idOferta']);
    a.appendChild(button);
    tdButton.appendChild(a);
    tdButton2.appendChild(buttonDelete);
    td.innerHTML = oferta[0]['tituloOferta'];
    tr.appendChild(td);
    tr.appendChild(tdButton);
    tr.appendChild(tdButton2);
    document.getElementById('tableOfertasLocais').appendChild(tr);
}



function AceitarAJAX(idOferta) {
    $.get('Application/Service/ListarOfertasLocais.php', {idOferta: idOferta},
            function (data) {
                construirTabela(data);
            }).fail(function () {
        alert('Ocorreu um erro');
    }
    );

}


function initEvents() {
    loadAllFromLocalSorage();
    if (ofertas.length > 0) {
        var i = 0;
        for (i = 0; i < ofertas.length; ++i) {
            AceitarAJAX(ofertas[i]);
        }
    } else {
        window.location="index.php";
    }
}

document.addEventListener('DOMContentLoaded', initEvents);

