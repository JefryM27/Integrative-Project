document.addEventListener("DOMContentLoaded", function () {
  function validarTexto(input) {
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(input.value.trim());
  }

  function validarNumeros(input) {
    const regex = /^[0-9]+$/;
    return regex.test(input.value.trim());
  }

  function validarCorreo(input) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(input.value.trim());
  }

  function validarTelefono(input) {
    const regex = /^\d{8}$/;
    return regex.test(input.value.trim());
  }

  function validarCedula(input) {
    const regex = /^\d{9}$/;
    return regex.test(input.value.trim());
  }

  function mostrarError(input, mensaje) {
    const formGroup = input.closest(".form-group");
    let errorElement = formGroup.querySelector(".error-message");

    if (!errorElement) {
      errorElement = document.createElement("div");
      errorElement.className = "error-message";
      errorElement.style.color = "red";
      formGroup.appendChild(errorElement);
    }

    errorElement.textContent = mensaje;
    input.classList.add("is-invalid");
  }

  function quitarError(input) {
    const formGroup = input.closest(".form-group");
    const errorElement = formGroup.querySelector(".error-message");

    if (errorElement) {
      formGroup.removeChild(errorElement);
    }

    input.classList.remove("is-invalid");
  }

  document.querySelector("form").addEventListener("submit", function (event) {
    let isValid = true;

    const nombreInput = document.getElementById("nombre");
    if (nombreInput && !validarTexto(nombreInput)) {
      isValid = false;
      mostrarError(nombreInput, "El nombre solo debe contener letras.");
    } else if (nombreInput) {
      quitarError(nombreInput);
    }

    const montoInput = document.getElementById("monto");
    if (montoInput && !validarNumeros(montoInput)) {
      isValid = false;
      mostrarError(montoInput, "El monto debe ser un número.");
    } else if (montoInput) {
      quitarError(montoInput);
    }

    const correoInput = document.getElementById("correo");
    if (correoInput && !validarCorreo(correoInput)) {
      isValid = false;
      mostrarError(correoInput, "Ingrese un correo electrónico válido.");
    } else if (correoInput) {
      quitarError(correoInput);
    }

    const telefonoInput = document.getElementById("telefono");
    if (telefonoInput && !validarTelefono(telefonoInput)) {
      isValid = false;
      mostrarError(
        telefonoInput,
        "El número de teléfono debe tener 8 dígitos."
      );
    } else if (telefonoInput) {
      quitarError(telefonoInput);
    }

    const cedulaInput = document.getElementById("cedula");
    if (cedulaInput && !validarCedula(cedulaInput)) {
      isValid = false;
      mostrarError(cedulaInput, "La cédula debe tener 9 dígitos.");
    } else if (cedulaInput) {
      quitarError(cedulaInput);
    }

    if (!isValid) {
      event.preventDefault();
    }
  });

  window.formValidator = {
    validarTexto,
    validarNumeros,
    validarCorreo,
    validarTelefono,
    validarCedula,
    mostrarError,
    quitarError,
  };
});
