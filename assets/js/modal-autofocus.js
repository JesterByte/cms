function modalAutofocus(modalId, firstInputId) {
    const myModal = document.getElementById(modalId)
    const myInput = document.getElementById(firstInputId)
    
    myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
    })
}