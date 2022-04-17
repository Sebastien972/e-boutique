window.onload = () => {
    const search = document.querySelector ('#shearch_produit_mots')
    const filtre = document.querySelector('#filtre')
    let inputCategorie = document.querySelectorAll('#filtre input')

            search.addEventListener('input', ()=>{
                //récupération des valeur de la barre de recherche
                let mots = search.value
                //création de la queryString
                let param = new URLSearchParams()
                param.append('search', mots)
                // console.log(param.toString());
                 
            })


        inputCategorie.forEach(input => {
            input.addEventListener('change', ()=>{
                const form = new FormData(filtre)

                let param = new URLSearchParams()
                form.forEach((value, key) => {
                    param.append(key, value)
                    // console.log( param.append(key, value));
                })

                //génération de l'url de la page actuel
                const url = new URL(window.location.href)
                console.log('dhjgkjfhdgsf');

                fetch(url.pathname + "?" + param.toString() + "&ajax=1", {
                    headers: {
                        "X-Requested-with":"XMLHttpRequest"
                    }
                }).then( response =>
                    response.json()

                ).then(
                    data => {
                        // console.log(data);
                        //zonne de contenu
                        const boutique = document.getElementById('boutique')
                        //remplace le contenue
                        boutique.innerHTML = data.content
                        //metre a jour l'url
                        history.pushState({}, null, url.pathname + "?" + param.toString())
                    }
                ).catch(e => alert(e))
            })
        })
}