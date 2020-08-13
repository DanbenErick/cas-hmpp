// Input File

let btnDeleteItems = document.querySelectorAll(".btn_delete");

btnDeleteItems.forEach(item => {
    item.addEventListener("click", event => {
        let resultado = confirm("Quieres eliminar");
        if(resultado) {
            console.log("Eliminacion Aboratada")
        }else {
            event.preventDefault()
        }
    })
})

let btn;
btn = document.querySelector("#file-documento")
if(btn != null)
    btn.addEventListener("change", function(){
        let file = btn
        if(file.value) {
            let nameFile = file.value.split("\\")
            document.querySelector("#name").textContent = nameFile[nameFile.length - 1]
        }else {
            console.log("No hay contenido")
        }
    })

let aside = document.querySelector("#aside")
let buttonShowAside = document.querySelector("#btn_action")
if(aside != null && buttonShowAside != null)
    buttonShowAside.addEventListener("click", function() {
        aside.classList.toggle("show")
    })
    buttonShowAside.addEventListener("click", function() {
        if(btn_action.classList.contains("icon-close")) {
            buttonShowAside.classList.remove("icon-close")
            buttonShowAside.classList.add("icon-menu")
        }else{
            buttonShowAside.classList.remove("icon-menu")
            buttonShowAside.classList.add("icon-close")
        }
    })