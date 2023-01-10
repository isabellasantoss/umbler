function validacao_datas(campo, comparativo) {

    let campoComparativo = document.getElementById(comparativo).value;

    if (campo.value > '1950-12-31') {
        if (campo.value < campoComparativo) {
            alert('Ops! Verifique novamente os campos de data');
            campo.value = '';
        }
    }
}