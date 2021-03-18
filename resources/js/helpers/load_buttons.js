


//в data нужно создавать btnOldHtml
export function disableSubmission(btn){

    btn.setAttribute('disabled','disabled')
    this.btnOldHtml = btn.innerHTML
    btn.innerHTML = '<span class = "fa fa-spinner fa-spin"></span> Пожалуйста подождите...'
}


export function enableSubmission(btn){

    btn.removeAttribute('disabled')
    btn.innerHTML = this.btnOldHtml
}
