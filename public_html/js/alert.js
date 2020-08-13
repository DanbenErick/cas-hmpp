//General
const emptyInputs = _ => {
    swal("Upps!", "No rellenaste todos los campos!", "error")
}
const notValidateCaptcha = _ => {
    swal("Upps!", "No pasaste la validacion ReCaptcha", "error")
}
// Documentos

const okUploadFile = _ => {
    swal("Excelente!", "Se subio correctamente el archivo!", "success")
}
const failUploadFile = _ => {
    swal("Upps!", "No se logro subir el archivo!", "error")
}
const thereDocumentCode = _ => {
    swal("Codigo Registrado", "Ya existe un documento con este codigo", "warning")
}
const formatInvalid = _ => {
    swal("Formato Invalido", "El formato que intentas subir no es un PDF", "error")
}
const problemDeleteDocument = _ => {
    swal("Error al Eliminar", "No se puedo eliminar la plaza", "error");
}
const okDeleteDocument = _ => {
    swal("Eliminado Correctamente", "Se elimino el documento indicado", "success");
}
const okEditDocument = _ => {
    swal("Edicion Exitosa", "Se edito correctamente el documento indicado", "success")
}
const failEditDocument = _ => {
    swal("Error", "No se puedo editar el documento indicado", "error")
}

// Convocatoria

const okRegisterAnnouncement = _ => {
    swal("Excelente!", "Se Creo Correctamente la Convocatoria!", "success")
}
const failRegisterAnnouncement = _ => {
    swal("Upps!", "Ocurrio un Error al Crear la Convocatoria!", "error")
}
const there_convocatory = _ => {
    swal("Convocatoria Vigente", "Tiene que cumplise la Convocaria", "warning")
}
const okDeleteConvocatory = _ => {
    swal("Eliminado Correctamente", "Se elimino la convocatoria indicada", "success");
}

const problemDeleteConvocatory = _ => {
    swal("Error al Eliminar", "No se pudo eliminar la convocatoria", "error");
}
const failEditConvocatory = _ => {
    swal("Error al Editar", "No se pudo editar la convocatoria", "error");
}
const okEditConvocatory = _ => {
    swal("Edicion Exitosa!", "Se Edito Correctamente la Convocatoria!", "success")
}
// Plazas

const okRegisterWorkplace = _ => {
    swal("Excelente!", "Se Registro Correctamente al Plaza!", "success")
}
const failRegisterWorkPlace = _ => {
    swal("Upps!", "No se logro registrar la plaza!", "error")
}
const thereWorkplaceCode = _ => {
    swal("Codigo Registrado", "Ya existe un plaza con este codigo", "warning");
}
const problemDeleteWP = _ => {
    swal("Error al Eliminar", "No se puedo eliminar la plaza", "error");
}
const okDeleteWorkplace = _ => {
    swal("Eliminado Correctamente", "Se elimino la plaza indicada", "success");
}
const okEditWorkplace = _ => {
    swal("Edicion Exitosa!", "Se edito correctamente la plaza indicada!", "success")
}
const failEditWorkplace = _ => {
    swal("Error", "No se pudo editar la plaza indicada", "error");
}
const applicantRegiserToWP = _ => {
    swal("Aplicante Registrado", "Ya hay una persona postulando a esta plaza", "error")
}
//Aplicantes
const successAccept = _ => {
    swal("Operacion Exitosa", "Se acepto al postulante", "success");
}
const errorAccept = _ => {
    swal("Error", "No se pudo aceptar al postulante", "error");
}
const successDecline = _ => {
    swal("Operacion Exitosa", "Se rechazo al postulante", "success");
}
const errorDecline = _ => {
    swal("Error", "No se pudo rechazar al postulante", "error");
}
const okRegisterApplicant = _ => {
    swal("Operacion Exitosa", "Se registro al postulante exitosamente", "success");
}

const failRegisterApplicant = _ => {
    swal("Error", "No se pudo registrar el postulante", "error");
}

const maxIntents = _ => {
    swal("Error", "Ya alcanzo el maximo de intentos por DNI", "warning");
}
const errorCamps = () => {
    swal("Error", "Ingresaste un dato erroneo", "warning");
}

//Usuarios


const okRegisterUser = _ => {
    swal("Execelente", "Se registro el usuario exitosamente", "success");
}

const failRegisterUser = _ => {
    swal("Error", "Ocurrio un error al crear el usuario", "error");
}

const editUserOk = _ => {
    swal("Excelente", "Se edito la informacion del usuario", "success")
}

const editUserFail = _ => {
    swal("Error", "No se puedo editar la informacion usuario", "error")
}

// Login

const failCredentials = _ => {
    swal("Error", "El usuario o la contraseña esta mal", "error")
}
const failLogin = _ => {
    swal("Error", "Ocurrio un error, intentalo otra vez", "error")
}
// Gerarara Documentos

const okGenerateDocument = _ => {
    swal("Excelente", "Se genero correctamente el reporte", "success")
}
const failGenerateDocument = _ => {
    swal("Error", "Ocurrio un error, intentalo otra vez", "error")
}
const notTime = _ => {
    swal("Error", "No se cumple la fecha establecida", "Warning")
}
const failReport = _ => {
    swal("Error", "Ocurrio un error, intentalo otra vez", "error")
}