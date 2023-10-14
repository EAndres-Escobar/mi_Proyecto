// eslint-disable-next-line func-names
window.onload = function () {
  const efectivoInicial = document.getElementById('efectivo_inicial');
  const ventasEfectivo = document.getElementById('ventas_efectivo');
  const ventasTarjeta = document.getElementById('ventas_tarjeta');
  const nombreGastos = document.getElementById('nombre_gastos');
  const gasto = document.getElementById('gasto');
  const nombreUsuario = document.getElementById('nombre_usuario');
  const previewContainer = document.getElementById('preview-container');
  const cerrarCajaButton = document.getElementById('save-button-cierreCaja');

  // eslint-disable-next-line no-multi-assign, max-len, func-names
  efectivoInicial.oninput = ventasEfectivo.oninput = ventasTarjeta.oninput = nombreGastos.oninput = gasto.oninput = nombreUsuario.oninput = function () {
    previewContainer.innerHTML = `Efectivo Inicial: <span class="data">${efectivoInicial.value}</span><br>`
        + `Ventas en Efectivo: <span class="data">${ventasEfectivo.value}</span><br>`
        + `Ventas con Tarjeta: <span class="data">${ventasTarjeta.value}</span><br>`
        + `Nombre del Gastos: <span class="data">${nombreGastos.value}</span><br>`
        + `Valor del Gasto: <span class="data">${gasto.value}</span><br>`
        + `Usuario: <span class="data">${nombreUsuario.value}</span>`;
    // eslint-disable-next-line max-len
    if (efectivoInicial.value || ventasEfectivo.value || ventasTarjeta.value || nombreGastos.value || gasto.value || nombreUsuario.value) {
      previewContainer.style.display = 'block';
    } else {
      previewContainer.style.display = 'none';
    }
  };
  // eslint-disable-next-line func-names
  cerrarCajaButton.onclick = function (e) {
    e.preventDefault();
    efectivoInicial.value = '';
    ventasEfectivo.value = '';
    ventasTarjeta.value = '';
    nombreGastos.value = '';
    gasto.value = '';
    nombreUsuario.value = '';
    previewContainer.innerHTML = '';
    previewContainer.style.display = 'none';
  };
};
/* eslint-disable no-undef */
// Configuración para la ventana modal de crear proveedores
$(document).ready(() => {
  $('#save-button-cierreCaja').click((event) => {
    event.preventDefault();
    // Vaciar el contenido de #modal-resultado-mensajero
    $('#message_cierreCaja').empty();

    $.ajax({
      url: 'archivosPHP/cierreCaja.php',
      type: 'post',
      data: $('#cierreCaja').serialize(),
      success(response) {
        $('#message_cierreCaja').html(response);
        // Vaciar los campos después de enviar la información
        $('#cierreCaja')[0].reset();
      },
    });
  });
  // Agregar evento click para cerrar el modal sin procesar el formulario nuevamente
  $('.close-button').click(() => {
    // Ocultar el modal
    $('#modal-container-cierreCaja').hide();
    // Vaciar el contenido del modal
    $('#message_cierreCaja').empty();
    // Evitar que el formulario se procese nuevamente si se hace clic en "Cerrar"
    return false;
  });
});
