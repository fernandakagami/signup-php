var cpf = document.getElementById('cpf');
var cpfOptions = {
  mask: '000.000.000-00'
};
var mask = IMask(cpf, cpfOptions);

var phone = document.getElementById('phone');
var phoneOptions = {
    mask: '+00 (000) 00000-0000'
};
var mask = IMask(phone, phoneOptions);

var cep = document.getElementById('cep');
var cepOptions = {
  mask: '00000-000'
};
var mask = IMask(cep, cepOptions);