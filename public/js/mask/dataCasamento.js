function dataCasamento() {
    if (document.getElementById('estado_civil').value != 'Casado') {
        document.getElementById('data_casamento').disabled = true;
    } else {
        document.getElementById('data_casamento').disabled = false;
    }
}

dataCasamento();