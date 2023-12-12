const formateurs = document.getElementsByName("formateurs[]")
const typeformation = document.querySelector("#formation")
//Fonction de desactivation des boxes
function disableCheckboxes() {
    formateurs.forEach((formateur) => {
        let tmpstr = formateur.getAttribute("data-metiers")
        let arr = tmpstr.split(",")
        let type = typeformation.value
        let disable = false
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

//J'ai tenté quelque chose pour les dates plus petites que d'autres mais ça ne marche pas
const inputdates = document.querySelectorAll("input[type='date']")
for(let j = 0;j < inputdates.length;j += 2) {
    inputdates[j].addEventListener("change", () => {
        inputdates[j + 1].setAttribute("min", inputdates[j].value)
        if(inputdates[j + 1].value > inputdates[j].value) {
            inputdates[j + 1].value = inputdates[j].value
        }
    }) 
}

typeformation.addEventListener("change", disableCheckboxes)

disableCheckboxes()