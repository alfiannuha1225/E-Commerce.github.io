const name = document.getElementById('name')
const password = document.getElementById('password')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
    let messages = []
    if (name, value === ' || name,value == null') {
        messages.push('Name is required')
    }
    if (password.value, length <= 6) {
        messages.push("password 6 caracter ")
    }
    if (messages, length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    }
})