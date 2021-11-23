function validarLogin() {
    $pass = document.getElementById("uspass");
    $passValor = $pass.value;
    $valido = true;
    if (($passValor.length < 8) || ($passValor.length > 10)) {
        $valido = false;
    }
    $arregloPass = $passValor.split("");
    $letra = false;
    $numero = false;
    for ($i = 0; $i < $passValor.length; $i++) {
        if (isNaN($arregloPass[$i])) {
            $letra = true;

        } else {
            $numero = true;
        }
    }
    if (!$letra || !$numero) {
        $valido = false;
    }
    if (!$valido) {
        $pass.value = null;
        $passHelp = document.getElementById("pass-text");
        $passHelp.innerHTML = "Contraseña de 8 a 10 caracteres. Debe contener 1 letra y 1 número. ";
    }
    var $usuario = document.getElementById("usnombre");

    if ($usuario.value.length == 0) {
        $valido = false;
        $usuario.value = null;
        $userHelp = document.getElementById("user-text");
        $userHelp.innerHTML = "Por favor, ingrese nombre de usuario.";
    }

    if ($usuario.value.length > 20) {
        $valido = false;
        $usuario.value = null;
        $userHelp = document.getElementById("user-text");
        $userHelp.innerHTML = "Usuario debe ser menor a 20 caracteres.";
    }

    if ($passValor == $usuario.value) {
        $valido = false;
        $pass.value = null;
        $passHelp = document.getElementById("pass-text");
        $passHelp.innerHTML += "La clave no puede ser igual al usuario.";
    }
    return $valido;
}

function validarRegistroUsuario() {
    $pass = document.getElementById("uspass");
    $passValor = $pass.value;
    $valido = true;
    if (($passValor.length < 8) || ($passValor.length > 10)) {
        $valido = false;
    }
    $arregloPass = $passValor.split("");
    $letra = false;
    $numero = false;
    for ($i = 0; $i < $passValor.length; $i++) {
        if (isNaN($arregloPass[$i])) {
            $letra = true;

        } else {
            $numero = true;
        }
    }
    if (!$letra || !$numero) {
        $valido = false;
    }
    if (!$valido) {
        $pass.value = null;
        $passHelp = document.getElementById("pass-text");
        $passHelp.innerHTML = "Contraseña de 8 a 10 caracteres. Debe contener 1 letra y 1 número. ";
    }
    var $usuario = document.getElementById("usnombre");

    if ($usuario.value.length == 0) {
        $valido = false;
        $usuario.value = null;
        $userHelp = document.getElementById("user-text");
        $userHelp.innerHTML = "Por favor, ingrese nombre de usuario.";
    }

    if ($usuario.value.length > 20) {
        $valido = false;
        $usuario.value = null;
        $userHelp = document.getElementById("user-text");
        $userHelp.innerHTML = "Usuario debe ser menor a 20 caracteres.";
    }

    if ($passValor == $usuario.value) {
        $valido = false;
        $pass.value = null;
        $passHelp = document.getElementById("pass-text");
        $passHelp.innerHTML += "La clave no puede ser igual al usuario.";
    }

    var $email = document.getElementById("usmail");

    if(!(validateEmail($email.value))){
        $valido = false;
        // $email.value= null;
        $mailHelp = document.getElementById("mail-text");
        $mailHelp.innerHTML = "El correo electrónico es incorrecto.";
    }
    return $valido;
}

function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
