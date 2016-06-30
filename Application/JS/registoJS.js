/* 
  * To change this license header, choose License Headers in Project Properties.
  * To change this template file, choose Tools | Templates
  * and open the template in the editor.
  */
 
 
 
 function empregador(){
     document.getElementById('formEmpregador').style.display = "block";
     document.getElementById('formPrestador').style.display = "none";
 }
 
 function prestador(){
     document.getElementById('formPrestador').style.display = "block";
     document.getElementById('formEmpregador').style.display = "none";
 }
 
 function initEvents(){
     document.getElementById('tipoEmpregador').addEventListener('click', empregador);
     document.getElementById('tipoPrestador').addEventListener('click', prestador);
 }
 
 document.addEventListener('DOMContentLoaded', initEvents);