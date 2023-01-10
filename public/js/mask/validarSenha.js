function validarConfirmacaoDeSenha(valorConfirmacao) {
    let valorAComparar = document.getElementById('password').value
    if (valorConfirmacao != valorAComparar) {
        document.getElementById('register-btn').disabled = true;
    } else {
        if (valorConfirmacao.length == 8) {
            document.getElementById('register-btn').disabled = false;
        }
    }
}