/**************** IMPORTANTE - modificar a url quando o sistema mudar de servidor  *************/
function getInfoCCT(cct, element) {

    let table = document.getElementById(element);

    fetch(`http://127.0.0.1:8000/buscar-cct/${cct}`)
        .then((response) => response.json())
        .then((data) => {
            table.innerHTML = `
            <ul>
                <li>CCT: ${data[0].cct}</li>
                <li>Sindicato Patronal: ${data[0].sind_patronal}</li>
                <li>Sindicato Laboral: ${data[0].sind_laboral}</li>
                <li>Abrangência: ${data[0].abrang}</li>
            </ul>`
        });
}