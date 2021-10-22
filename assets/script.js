let btnMesCommandes = document.getElementById('mesCommandesAccount')
let btnMesAdresses = document.getElementById('mesAdressesAccount')
let btnProfil = document.getElementById('profilAccount')
let templatProfil = document.getElementById('templatProfil')
let templatMesCommandes = document.getElementById('templatMesComandes')
let templatMesAdresses = document.getElementById('templatMesAdresse')
let index =

btnProfil.addEventListener('click', function (){
    console.log('fgnhj;k')
    templatMesCommandes.classList.remove('visible')
    templatMesAdresses.classList.remove('visible')
    templatProfil.classList.add('visible')
})
