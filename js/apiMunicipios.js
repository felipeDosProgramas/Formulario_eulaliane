/** @type {HTMLSelectElement} */
const selectMunicipios = document.querySelector('select#cidade');
const cacheMuncipios = {}

/**
 * @param {int} idEstado
 * @returns {Promise<void>}
 */
async function getMunicipiosDoEstado(idEstado) {
    if (cacheMuncipios[idEstado])
        return popularSelectDeMunicipios(cacheMuncipios[idEstado]);
    const server = await fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+ idEstado +"/municipios");
    const dadosMunicipio = await server.json();
    const nomesMunicipiosDoEstado = separarApenasNomesDosMunicipiosDoEstado(dadosMunicipio);
    cacheMuncipios[idEstado] = nomesMunicipiosDoEstado;
    popularSelectDeMunicipios(nomesMunicipiosDoEstado);
}

function separarApenasNomesDosMunicipiosDoEstado(dadosMunicipio){
    const nomesMunicipiosDoEstado = []
    dadosMunicipio.forEach(
        (v) => nomesMunicipiosDoEstado.push(v.nome)
    );
    return nomesMunicipiosDoEstado;
}

/**
 * @param {string} value
 * @returns {HTMLOptionElement}
 */
function criarOptionFn (value){
    const opt = document.createElement('option');
    opt.innerText = value;
    return opt;
}
/** @param {string[]} municipios */
function popularSelectDeMunicipios(municipios) {
    selectMunicipios.innerText = '';
    municipios.forEach(
        (municipio) => selectMunicipios.append(criarOptionFn(municipio))
    );
}