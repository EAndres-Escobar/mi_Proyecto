/* eslint-disable no-unused-vars */
/* eslint-disable no-shadow */
/* eslint-disable new-cap */
/* eslint-disable max-len */
/* eslint-disable func-names */
/* eslint-disable no-restricted-globals */
/* eslint-disable no-use-before-define */
/* eslint-disable no-undef */
function showMessageBuscarPorCodigo(message, type) {
  const mensajeDiv = document.getElementById('mensaje');
  mensajeDiv.innerHTML = `<div class="${type}">${message}</div>`;
  setTimeout(() => {
    mensajeDiv.innerHTML = ''; // Limpia el mensaje después de un tiempo
  }, 3000); // Limpia el mensaje después de 3 segundos (puedes ajustar el tiempo)
}
$(document).ready(() => {
  $('#search-button-codigoProducto').click((e) => {
    e.preventDefault();
    const searchCodeC = $('#Codigo-Producto2').val();

    // Verificar si el campo de código está vacío
    if (!searchCodeC) {
      showMessageBuscarPorCodigo('Por favor, ingrese un código', 'error');
      return;
    }

    // Verificar si el campo de código ya contiene datos
    if ($('#Nombre-Producto').val() && $('#precio-venta').val()) {
      showMessageBuscarPorCodigo('El campo ya está lleno', 'error');
      return;
    }

    $.ajax({
      url: 'archivosPHP/buscarPorCodigoProducto.php',
      type: 'post',
      data: {
        'Codigo-Producto2': searchCodeC,
      },
      success(response) {
        if (response.trim() === '') {
          // Los datos no existen en la base de datos
          showMessageBuscarPorCodigo('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer los datos del resultado
          const data = JSON.parse(response);

          // Verificar si los campos coinciden con los resultados de la búsqueda
          if ($('#Nombre-Producto').val() === data.nombreProducto && $('#precio-venta').val() === data.PrecioVenta) {
            showMessageBuscarPorCodigo('El producto ya existe', 'error');
          } else {
            // Cargar los datos en los campos de entrada
            $('#Codigo-Producto2').val(data.codigoP);
            $('#Nombre-Producto').val(data.nombreProducto);
            $('#precio-venta').val(data.PrecioVenta);
            showMessageBuscarPorCodigo('Resultado de búsqueda cargado con éxito', 'success');
          }
        }
      },
    });
  });
});

$(document).ready(() => {
  // Escucha los eventos 'input' en los campos de entrada 'precio-venta' y 'Cantidad-Producto'
  $('#precio-venta, #Cantidad-Producto').on('input', () => {
    const precioVenta = parseFloat($('#precio-venta').val()) || 0;
    const cantidadProducto = parseFloat($('#Cantidad-Producto').val()) || 0;
    const totalVenta = precioVenta * cantidadProducto;
    $('#Total-Venta').val(totalVenta);
  });
});
// ventana de buscar vendedor
/* eslint-disable no-restricted-globals */
/* eslint-disable no-use-before-define */
/* eslint-disable no-undef */
function showMessageV(message, type) {
  const mensajeDiv = document.getElementById('mensaje');
  mensajeDiv.innerHTML = `<div class="${type}">${message}</div>`;
  setTimeout(() => {
    mensajeDiv.innerHTML = ''; // Limpia el mensaje después de un tiempo
  }, 3000); // Limpia el mensaje después de 3 segundos (puedes ajustar el tiempo)
}
$(document).ready(() => {
  $('#search-button-codigoVendedor').click((e) => {
    e.preventDefault();
    const searchCodeC = $('#codigo_vendedor').val();

    // Verificar si el campo de código está vacío
    if (!searchCodeC) {
      showMessageV('Por favor, ingrese un código', 'error');
      return;
    }

    // Verificar si el campo de código ya contiene datos
    if ($('#nombre_vendedor').val()) {
      showMessageV('El campo ya está lleno', 'error');
      return;
    }

    $.ajax({
      url: 'archivosPHP/buscarCodigoVendedor.php',
      type: 'post',
      data: {
        codigo_vendedor: searchCodeC,
      },
      success(response) {
        if (response.trim() === '') {
          // Los datos no existen en la base de datos
          showMessageV('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer los datos del resultado
          const data = JSON.parse(response);

          // Verificar si los campos coinciden con los resultados de la búsqueda
          if ($('#nombre_vendedor').val() === data.nombreVendedor) {
            showMessageV('El producto ya existe', 'error');
          } else {
            // Cargar los datos en los campos de entrada
            $('#codigo_vendedor').val(data.idUsuario);
            $('#nombre_vendedor').val(`${data.nombres} ${data.apellidos}`);
            showMessageV('Resultado de búsqueda cargado con éxito', 'success');
          }
        }
      },
    });
  });
});
// ventana de buscar cliente
/* eslint-disable no-restricted-globals */
/* eslint-disable no-use-before-define */
/* eslint-disable no-undef */
function showMessageC(message, type) {
  const mensajeDiv = document.getElementById('mensaje');
  mensajeDiv.innerHTML = `<div class="${type}">${message}</div>`;
  setTimeout(() => {
    mensajeDiv.innerHTML = ''; // Limpia el mensaje después de un tiempo
  }, 3000); // Limpia el mensaje después de 3 segundos (puedes ajustar el tiempo)
}
$(document).ready(() => {
  $('#search-button-cedulaCliente').click((e) => {
    e.preventDefault();
    const searchCodeC = $('#Cedula-Cliente').val();

    // Verificar si el campo de código está vacío
    if (!searchCodeC) {
      showMessageC('Por favor, ingrese un código', 'error');
      return;
    }

    // Verificar si el campo de código ya contiene datos
    if ($('#Nombre-Cliente').val()) {
      showMessageC('El campo ya está lleno', 'error');
      return;
    }

    $.ajax({
      url: 'archivosPHP/buscarCedulaCliente.php',
      type: 'post',
      data: {
        'Cedula-Cliente': searchCodeC,
      },
      success(response) {
        if (response.trim() === '') {
          // Los datos no existen en la base de datos
          showMessageC('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer los datos del resultado
          const data = JSON.parse(response);

          // Verificar si los campos coinciden con los resultados de la búsqueda
          if ($('#Nombre-Cliente').val() === data.nombreCliente) {
            showMessageC('El producto ya existe', 'error');
          } else {
            // Cargar los datos en los campos de entrada
            $('#Cedula-Cliente').val(data.documentoid);
            $('#Nombre-Cliente').val(`${data.nombres} ${data.apellidos}`);
            showMessageC('Resultado de búsqueda cargado con éxito', 'success');
          }
        }
      },
    });
  });
});

// Obtener el botón "Limpiar Carrito" por su ID
document.addEventListener('DOMContentLoaded', () => {
  const clearCartButton = document.getElementById('clear-cart-button');

  // Agregar un evento de clic al botón
  clearCartButton.addEventListener('click', (e) => {
    e.preventDefault(); // Evita que el botón realice su acción predeterminada (enviar el formulario)

    // Limpiar los valores de los campos de entrada
    document.getElementById('codigo_vendedor').value = '';
    document.getElementById('nombre_vendedor').value = '';
    document.getElementById('Cedula-Cliente').value = '';
    document.getElementById('Nombre-Cliente').value = '';
    document.getElementById('Codigo-Producto2').value = '';
    document.getElementById('Nombre-Producto').value = '';
    document.getElementById('precio-venta').value = '';
    document.getElementById('Cantidad-Producto').value = '';
    document.getElementById('Total-Venta').value = '';

    // Borrar el contenido de la tabla dinámica
    const tableBody = document.querySelector('.scrollable-table tbody');
    tableBody.innerHTML = '';

    // Mostrar un mensaje de éxito
    showMessage('Los datos se han eliminado correctamente', 'success');
  });

  // Función para mostrar mensajes
  function showMessage(message, type) {
    const mensaje = document.getElementById('mensaje');
    mensaje.textContent = message;
    mensaje.className = type;
    setTimeout(() => {
      mensaje.textContent = '';
      mensaje.className = '';
    }, 3000);
  }
});

// Función para mostrar un mensaje
$(document).ready(() => {
  // Inicializa el total general
  let totalGeneral = 0;

  $('#add-product-to-table-button').click((e) => {
    e.preventDefault();

    // Obtén los valores de los campos de entrada
    const codigoProducto = $('#Codigo-Producto2').val().trim();
    const nombreProducto = $('#Nombre-Producto').val().trim();
    const precioVenta = parseFloat($('#precio-venta').val()) || 0; // Convertir a número o usar 0 si es NaN
    const cantidadProducto = parseFloat($('#Cantidad-Producto').val()) || 0; // Convertir a número o usar 0 si es NaN

    // Verificar si los campos están vacíos
    if (
      codigoProducto === ''
      || nombreProducto === ''
      || isNaN(precioVenta)
      || isNaN(cantidadProducto)
      || precioVenta <= 0
      || cantidadProducto <= 0
    ) {
      // Mostrar un mensaje de error si los campos están vacíos o contienen valores no válidos
      showMessage('Todos los campos son obligatorios y deben ser válidos', 'error');
      return;
    }

    // Calcula el total de la venta
    const totalVenta = precioVenta * cantidadProducto;

    // Crea una nueva fila con los datos
    const newRow = `<tr>
      <td>${codigoProducto}</td>
      <td>${nombreProducto}</td>
      <td>${precioVenta}</td>
      <td>${cantidadProducto}</td>
      <td>${totalVenta}</td>
    </tr>`;

    // Agrega la nueva fila a la tabla
    $('.scrollable-table tbody').append(newRow);

    // Limpia los campos de entrada
    $('#Codigo-Producto2').val('');
    $('#Nombre-Producto').val('');
    $('#precio-venta').val('');
    $('#Cantidad-Producto').val('');
    $('#Total-Venta').val('');

    // Actualiza el total general
    totalGeneral += totalVenta;

    // Muestra el total general actualizado
    updateTotalGeneral(totalGeneral);

    // Muestra un mensaje de éxito
    showMessage('Producto agregado correctamente', 'success');
  });

  $('#clear-cart-button').click(() => {
    // Limpiar la tabla
    $('.scrollable-table tbody').empty();

    // Restablece el total general a cero
    totalGeneral = 0;

    // Actualiza el total general en la vista
    updateTotalGeneral(totalGeneral);
  });

  // Función para mostrar mensajes
  function showMessage(message, type) {
    const mensaje = $('#mensaje');
    mensaje.text(message).addClass(type);
    setTimeout(() => {
      mensaje.text('').removeClass(type);
    }, 3000);
  }

  // Función para actualizar el total general en la vista
  function updateTotalGeneral(total) {
    $('#Total-general').val(total.toFixed());
  }
});
