function checkRut(rut) {
    var valor = rut.value.replace('.', '');
    valor = valor.replace('-', '');

    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    rut.value = cuerpo + '-' + dv

    if (cuerpo.length < 7) {
        rut.setCustomValidity("RUT Incompleto");
        return false;
    }

    suma = 0;
    multiplo = 2;

    for (i = 1; i <= cuerpo.length; i++) {

        index = multiplo * valor.charAt(cuerpo.length - i);

        suma = suma + index;

        if (multiplo < 7) {
            multiplo = multiplo + 1;
        } else {
            multiplo = 2;
        }

    }

    dvEsperado = 11 - (suma % 11);

    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;

    if (dvEsperado != dv) {
        rut.setCustomValidity("RUT Inválido");
        return false;
    }

    rut.setCustomValidity('');
}

var Fn = {
    validaRut: function(rutCompleto) {
        if (!/^[0-9]+-[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function(T) {
        var M = 0,
            S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}