const typeformations = document.querySelectorAll(".formation")
typeformations.forEach((typeformation) => {
    //Listner de disable en direct
    typeformation.addEventListener("change", (e) => {
        disableCheckboxes(e.target.getAttribute("class"));
    })
    //Le disable au démarage
    disableCheckboxes(typeformation.getAttribute("class"))
})
//Fonction de desactivation
function disableCheckboxes(classval) {
    let num = classval.substring(10)
    const formateurs = document.getElementsByName("formateurs" + num + "[]")
    const typeformations = document.querySelectorAll(".formation")
    //Cherche si le select est le bon
    typeformations.forEach((typeformation) => {
        if(typeformation.getAttribute("class") === classval) {
            //Boucle sur les formateurs
            formateurs.forEach((formateur) => {
                let tmpstr = formateur.getAttribute("data-metiers")
                let arr = tmpstr.split(",")
                let type = typeformation.value
                let disable = false
                //Verifie si il faut desactiver la checkbox
                for(let i = 0;i < arr.length - 1;i++) {
                    if(type === arr[i]) {
                        disable = true
                        break
                    } else {
                        disable = false
                    }
                }
                let id = formateur.getAttribute("id")
                let dates = document.querySelectorAll('.' + id)
                //Desactive la checkbox et ses champs date si il le faut
                if(!disable) {
                    formateur.setAttribute("disabled", "")
                    formateur.checked = false
                    dates.forEach((date) => {
                        date.setAttribute("disabled", "")
                    })
                } else {
                    formateur.removeAttribute("disabled")
                    dates.forEach((date) => {
                        date.removeAttribute("disabled")
                    })
                }
            })
        }
    })
}

//Boucle de gestion des dates (premiere <= deuxieme, premiere > date du jour)
const inputdates = document.querySelectorAll("input[type='date']")
for(let j = 0;j < inputdates.length;j += 2) {
    //Listner premiere <= deuxieme, premiere >= date du jour
    inputdates[j].addEventListener("change", () => {
        inputdates[j + 1].setAttribute("min", inputdates[j].value)
        //premiere <= deuxieme
        if(inputdates[j].value > inputdates[j + 1].value) {
            inputdates[j + 1].value = inputdates[j].value
        }
        //premiere >= date du jour
        if(inputdates[j].value < inputdates[j].getAttribute("min")) {
            inputdates[j].value = inputdates[j].getAttribute("min")
        }
    })
    //Listner deuxieme >= premiere
    inputdates[j + 1].addEventListener("change", () => {
        if(inputdates[j + 1].value < inputdates[j + 1].getAttribute("min")) {
            inputdates[j + 1].value = inputdates[j + 1].getAttribute("min")
        }
    })
}