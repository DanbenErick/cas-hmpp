let buttonsOpenModal = document.querySelectorAll("#modal_evaluar"),
    buttonAceptar = document.querySelector("#aceptar_button"),
    buttonRechazar = document.querySelector("#rechazar_button"),
    modal = document.querySelector("#modal"),
    buttonCloseModal = document.querySelector("#close_modal")
    buttonsOpenModal.forEach(button => {
        button.addEventListener("click", e => {
            buttonAceptar.addEventListener("click", function() {
                let calificacion = document.querySelector("#calificacion_cv").value
                if(calificacion == ""){
                    calificacion = 0
                }
                buttonAceptar.setAttribute("href", `../php/accept_applicant.php?id=${e.target.value}&eval=${calificacion}`)
            })
            buttonRechazar.addEventListener("click", function() {
                let calificacion = document.querySelector("#calificacion_cv").value
                if(calificacion == ""){
                    calificacion = 0
                }
                buttonRechazar.setAttribute("href", `../php/decline_applicant.php?id=${e.target.value}&eval=${calificacion}`)
            })
            modal.style.display = "flex"
        })
    })
    buttonCloseModal.addEventListener("click", function() {
        modal.style.display = "none";
    })