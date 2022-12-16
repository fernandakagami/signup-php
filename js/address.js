async function buscaEndereco(cep) {    
    try {
        let consultaCep = await fetch(`http://viacep.com.br/ws/${cep}/json`);
        let consultaCepConvertida = await consultaCep.json();
        if (consultaCepConvertida.erro) {
            throw Error('CEP não existente!');
        }           
        let logradouro = document.getElementById('street');
        let bairro = document.getElementById('district');
        let cidade = document.getElementById('city');
        let estado = document.getElementById('contry_state');

        logradouro.value = consultaCepConvertida.logradouro;
        bairro.value = consultaCepConvertida.bairro;
        cidade.value = consultaCepConvertida.localidade;
        estado.value = consultaCepConvertida.uf        
        return consultaCepConvertida;
    } catch (erro) {
        console.log(erro);
    }    
}

var cep = document.getElementById('cep');
cep.addEventListener("focusout", () => buscaEndereco(cep.value));