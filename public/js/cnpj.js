const options = {
    method: 'GET',
    headers: {
        'X-RapidAPI-Key': '3c4e62a369mshbe85821bdc86b05p1a67a5jsn19802889445b',
        'X-RapidAPI-Host': 'consulta-cnpj-gratis.p.rapidapi.com'
    }
};

function CNPJ_Fetch(cnpj) {
    if (document.getElementById(cnpj).value.length == 14) {

        fetch(`https://consulta-cnpj-gratis.p.rapidapi.com/office/${document.getElementById(cnpj).value}?simples=false`, options)
            .then(response => response.json())
            .then(response => {
                let emails_do_cnpj = [];
                
                response.emails.forEach(element => {
                    emails_do_cnpj.push(element.address);
                });

                document.getElementById('nome_fantasia').value = response.alias
                document.getElementById('razao_social').value = response.company.name
                document.getElementById('atividade').value = response.mainActivity.text
                document.getElementById('emails').value = emails_do_cnpj.join(',')

                document.getElementById('cep').value = response.address.zip;
                document.getElementById('cidade').value = response.address.city;
                document.getElementById('bairro').value = response.address.district;
                document.getElementById('logradouro').value = response.address.street;
                document.getElementById('estado').value = response.address.state;
                document.getElementById('numero').value = response.address.number;
            })
            .catch(err => console.error(err));
    }
}