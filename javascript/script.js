/* eslint-disable no-undef */
// Configuración para la ventana modal de crear clientes
function showMessageClientes(message, messageType) {
  const $messageC = $('#message_cliente');
  $messageC.text(message).removeClass('error success').addClass(messageType).fadeIn(400);
  setTimeout(() => {
    $messageC.fadeOut(400, () => {
      $messageC.text('').removeClass('error success').show();
    });
  }, 2000);
}
$(document).ready(() => {
  $('#save-button-createCustomer').click((event) => {
    event.preventDefault();
    // Vaciar el contenido de #modal-resultado
    $('#modal-resultado').empty();
    $.ajax({
      url: 'archivosPHP/crearClientes.php',
      type: 'post',
      data: $('#crearCliente').serialize(),
      success(response) {
        $('#modal-resultado').html(response);
        // Vaciar los campos después de enviar la información
        $('#crearCliente')[0].reset();
      },
    });
  });
  // Agregar evento click para cerrar el modal sin procesar el formulario nuevamente
  $('.close-button').click(() => {
    // Ocultar el modal
    $('#modal-container-crearCliente').hide();
    // Vaciar el contenido del modal
    $('#modal-resultado').empty();
    // Evitar que el formulario se procese nuevamente si se hace clic en "Cerrar"
    return false;
  });
});

// Configuración para la ventana modal de crear mensajeros
$(document).ready(() => {
  $('#save-button-registerMessenger').click((event) => {
    event.preventDefault();
    // Vaciar el contenido de #modal-resultado-mensajero
    $('#modal-resultado-mensajero').empty();
    $.ajax({
      url: 'archivosPHP/crearMensajero.php',
      type: 'post',
      data: $('#crearMensajero').serialize(),
      success(response) {
        $('#modal-resultado-mensajero').html(response);
        // Vaciar los campos después de enviar la información
        $('#crearMensajero')[0].reset();
      },
    });
  });
  // Agregar evento click para cerrar el modal sin procesar el formulario nuevamente
  $('.close-button').click(() => {
    // Ocultar el modal
    $('#modal-container-registrarMensajero').hide();
    // Vaciar el contenido del modal
    $('#modal-resultado-mensajero').empty();
    // Evitar que el formulario se procese nuevamente si se hace clic en "Cerrar"
    return false;
  });
});
// Buscar los clientes ingresados en la base de datos
$(document).ready(() => {
  const addedDataIds = new Set(); // Conjunto para realizar un seguimiento de los IDs
  $('#search-button-customers').click((e) => {
    e.preventDefault();
    const searchCodeC = $('#search-code-customers').val();
    const searchNameC = $('#search-name-customers').val();
    if (!searchCodeC && !searchNameC) {
      showMessageClientes('Por favor, ingresa un Documento ID o un nombre', 'error');
      return;
    }
    $.ajax({
      url: 'archivosPHP/buscarClientes.php',
      type: 'post',
      data: {
        'search-code-customers': searchCodeC,
        'search-name-customers': searchNameC,
      },
      success(response) {
        if (response.trim() === '') {
          showMessageClientes('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer el ID único del resultado
          const resultIdC = $(response).find('td:eq(2)').text();
          // Verificar si el ID ya se ha agregado previamente
          if (!addedDataIds.has(resultIdC)) {
            // Agregar los nuevos resultados a la tabla y al conjunto
            $('#customer-results-table tbody').append(response);
            addedDataIds.add(resultIdC);
            showMessageClientes('Resultado de búsqueda cargado con éxito', 'success');
          } else {
            showMessageClientes('El resultado ya existe en la tabla', 'error');
          }
        }
      },
    });
  });
  $('#erase-button-customers').click((e) => {
    e.preventDefault();
    const $tbody = $('#customer-results-table tbody');
    if ($tbody.children().length === 0) {
      showMessageClientes('No hay datos en la tabla para eliminar', 'error');
    } else {
      $tbody.empty();
      addedDataIds.clear(); // Limpiar el conjunto al hacer clic en "Borrar"
      showMessageClientes('Todos los resultados han sido eliminados de la tabla', 'success');
    }
  });
});

// Compra de medicamentos
function showMessageCompra(message, messageType) {
  const mensajeD = $('#modal-mensaje-compra');
  mensajeD.html(`<h3 class="${messageType}">${message}</h3>`).fadeIn(400, () => {
    setTimeout(() => {
      mensajeD.fadeOut(400);
    }, 2000);
  });
}
$(document).ready(() => {
  $('#save-button-compra').click((event) => {
    event.preventDefault();
    // Vaciar el contenido de #modal-resultado-mensajero
    $('#modal-mensaje-compra').empty();
    $.ajax({
      url: 'archivosPHP/comprarProductos.php',
      type: 'post',
      data: $('#crear_compra').serialize(),
      success(response) {
        $('#modal-mensaje-compra').html(response);
        // Vaciar los campos después de enviar la información
        $('#crear_compra')[0].reset();
      },
      error(jqXHR, textStatus, errorThrown) {
        // eslint-disable-next-line no-console
        console.error(`Error: ${errorThrown}`);
        // Mostrar mensaje de error en el modal
        $('#modal-mensaje-compra').html(`<h3 class="error">Ocurrió un error: ${textStatus}</h3>`);
      },
    });
  });
  $('#clear-button-compra').click((e) => {
    e.preventDefault();
    // Reiniciar el formulario para borrar los datos ingresados
    $('#crear_compra')[0].reset();
    showMessageCompra('Todos los datos han sido borrados exitosamente', 'success');
  });
  // Agregar evento click para cerrar el modal sin procesar el formulario nuevamente
  $('.close-button').click(() => {
    // Ocultar el modal
    $('#modal-container-compras').hide();
    // Vaciar el contenido del modal
    $('#modal-mensaje-compra').empty();
    // Evitar que el formulario se procese nuevamente si se hace clic en "Cerrar"
    return false;
  });
});

// cargar los datos al inventario
// Función para mostrar mensajes con clase de estilo (error o success)
function showMessageInventario(message, messageType) {
  const $message = $('#message_inventario');
  $message.text(message).removeClass('error success').addClass(messageType).fadeIn(400);
  setTimeout(() => {
    $message.fadeOut(400, () => {
      $message.text('').removeClass('error success').show();
    });
  }, 2000);
}
$(document).ready(() => {
  const addedDataIds = new Set(); // Conjunto para realizar un seguimiento de los IDs

  $('#search-button-inventory').click((e) => {
    e.preventDefault();
    const searchCode = $('#search-code-inventory').val();
    const searchName = $('#search-name-inventory').val();
    if (!searchCode && !searchName) {
      showMessageInventario('Por favor, ingresa un ID o un nombre', 'error');
      return;
    }
    $.ajax({
      url: 'archivosPHP/inventario.php',
      type: 'post',
      data: {
        'search-code-inventory': searchCode,
        'search-name-inventory': searchName,
      },
      success(response) {
        if (response.trim() === '') {
          showMessageInventario('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer el ID único del resultado
          const resultId = $(response).find('td:first').text();
          // Verificar si el ID ya se ha agregado previamente
          if (!addedDataIds.has(resultId)) {
            // Agregar los nuevos resultados a la tabla y al conjunto
            $('#inventory-result-table tbody').append(response);
            addedDataIds.add(resultId);
            showMessageInventario('Resultado de búsqueda cargado con éxito', 'success');
          } else {
            showMessageInventario('El resultado ya existe en la tabla', 'error');
          }
        }
      },
    });
  });
  $('#erase-button-inventory').click((e) => {
    e.preventDefault();
    const $tbody = $('#inventory-result-table tbody');
    if ($tbody.children().length === 0) {
      showMessageInventario('No hay datos en la tabla para eliminar', 'error');
    } else {
      $tbody.empty();
      addedDataIds.clear(); // Limpiar el conjunto al hacer clic en "Borrar"
      showMessageInventario('Todos los resultados han sido eliminados de la tabla', 'success');
    }
  });
});

// Configuración para la ventana modal de crear proveedores
$(document).ready(() => {
  $('#save-button-registraProveedores').click((event) => {
    event.preventDefault();
    // Vaciar el contenido de #modal-resultado-mensajero
    $('#message_registrarProveedores').empty();

    $.ajax({
      url: 'archivosPHP/registrarProveedor.php',
      type: 'post',
      data: $('#registrarProveedor').serialize(),
      success(response) {
        $('#message_registrarProveedores').html(response);
        // Vaciar los campos después de enviar la información
        $('#registrarProveedor')[0].reset();
      },
    });
  });
  // Agregar evento click para cerrar el modal sin procesar el formulario nuevamente
  $('.close-button').click(() => {
    // Ocultar el modal
    $('#modal-container-registrarProveedores').hide();
    // Vaciar el contenido del modal
    $('#message_registrarProveedores').empty();
    // Evitar que el formulario se procese nuevamente si se hace clic en "Cerrar"
    return false;
  });
});

// configuración de la ventana de buscar proveedores
// Función para mostrar mensajes con clase de estilo (error o success)
function showMessageProveedores(messageP, messageType) {
  const $messageP = $('#message_proveedores');
  $messageP.text(messageP).removeClass('error success').addClass(messageType).fadeIn(400);
  setTimeout(() => {
    $messageP.fadeOut(400, () => {
      $messageP.text('').removeClass('error success').show();
    });
  }, 2000);
}

$(document).ready(() => {
  const addedDataIds = new Set(); // Conjunto para realizar un seguimiento de los IDs
  $('#search-button-suppliers').click((e) => {
    e.preventDefault();
    const searchCodeP = $('#search-code-suppliers').val();
    const searchNameP = $('#search-name-suppliers').val();
    if (!searchCodeP && !searchNameP) {
      showMessageProveedores('Por favor, ingresa un Documento ID o un nombre', 'error');
      return;
    }
    $.ajax({
      url: 'archivosPHP/proveedores.php',
      type: 'post',
      data: {
        'search-code-suppliers': searchCodeP,
        'search-name-suppliers': searchNameP,
      },
      success(response) {
        if (response.trim() === '') {
          showMessageProveedores('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer el ID único del resultado
          const resultIdP = $(response).find('td:eq(2)').text();
          // Verificar si el ID ya se ha agregado previamente
          if (!addedDataIds.has(resultIdP)) {
            // Agregar los nuevos resultados a la tabla y al conjunto
            $('#suppliers-table tbody').append(response);
            addedDataIds.add(resultIdP);
            showMessageProveedores('Resultado de búsqueda cargado con éxito', 'success');
          } else {
            showMessageProveedores('El resultado ya existe en la tabla', 'error');
          }
        }
      },
    });
  });
  $('#erase-button-suppliers').click((e) => {
    e.preventDefault();
    const $tbody = $('#suppliers-table tbody');
    if ($tbody.children().length === 0) {
      showMessageProveedores('No hay datos en la tabla para eliminar', 'error');
    } else {
      $tbody.empty();
      addedDataIds.clear(); // Limpiar el conjunto al hacer clic en "Borrar"
      showMessageProveedores('Todos los resultados han sido eliminados de la tabla', 'success');
    }
  });
});

// configuración de la ventana de búsqueda de empleados
// Función para mostrar mensajes con clase de estilo (error o success)
function showMessageEmpleados(message, messageType) {
  const $message = $('#message_empleados');
  $message.text(message).removeClass('error success').addClass(messageType).fadeIn(400);
  setTimeout(() => {
    $message.fadeOut(400, () => {
      $message.text('').removeClass('error success').show();
    });
  }, 2000);
}
$(document).ready(() => {
  const addedDataIds = new Set(); // Conjunto para realizar un seguimiento de los IDs
  $('#search-button-empleados').click((e) => {
    e.preventDefault();
    const searchCode = $('#search-code-empleados').val();
    const searchName = $('#search-name-empleados').val();
    if (!searchCode && !searchName) {
      showMessageEmpleados('Por favor, ingresa un Documento ID o un nombre', 'error');
      return;
    }
    $.ajax({
      url: 'archivosPHP/empleados.php',
      type: 'post',
      data: {
        'search-code-empleados': searchCode,
        'search-name-empleados': searchName,
      },
      success(response) {
        if (response.trim() === '') {
          showMessageEmpleados('Los datos no existen en la base de datos', 'error');
        } else {
          // Extraer el ID único del resultado
          const resultId = $(response).find('td:eq(2)').text();
          // Verificar si el ID ya se ha agregado previamente
          if (!addedDataIds.has(resultId)) {
            // Agregar los nuevos resultados a la tabla y al conjunto
            $('#empleados-result-table tbody').append(response);
            addedDataIds.add(resultId);
            showMessageEmpleados('Resultado de búsqueda cargado con éxito', 'success');
          } else {
            showMessageEmpleados('El resultado ya existe en la tabla', 'error');
          }
        }
      },
    });
  });

  $('#erase-button-empleados').click((e) => {
    e.preventDefault();
    const $tbody = $('#empleados-result-table tbody');
    if ($tbody.children().length === 0) {
      showMessageEmpleados('No hay datos en la tabla para eliminar', 'error');
    } else {
      $tbody.empty();
      addedDataIds.clear(); // Limpiar el conjunto al hacer clic en "Borrar"
      showMessageEmpleados('Todos los resultados han sido eliminados de la tabla', 'success');
    }
  });
});
