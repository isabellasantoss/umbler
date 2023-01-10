const ViaCep = async (cep) => {
    if(document.getElementById(cep).value.length == 8){
        const requisicao = await fetch(`https://viacep.com.br/ws/${document.getElementById(cep).value}/json/`)
        const dados = await requisicao.json();

        document.getElementById('cidade').value = dados.localidade;
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('logradouro').value = dados.logradouro;
        document.getElementById('estado').value = dados.uf;    
    }
}
