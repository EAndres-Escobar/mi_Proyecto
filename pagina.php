<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EdSoft</title>
  <link rel="shortcut icon" href="img/edsof.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
</head>

<body>
  <header>
    <div class="title">
      <div class="logo-container">
        <img src="img/logo.png" class="logoFarmacia" alt="Logo de la farmacia">
        <h1 class="heading">La Mano Amiga</h1>
      </div>
      <img src="img/edsof.png" class="logoEdsoft" alt="Logo empresa EdSoft">
    </div>
  </header>
  <main>
    <!-- Barra de navegación y submenú de caja -->
    <div class="navbar">
      <ul>
        <li><a href="#" class="navbar-link" data-target="empleados">EMPLEADOS</a></li>
        <li class="dropdown-caja">
          <a href="#" class="navbar-link">CAJA</a>
          <ul class="submenu-caja">
            <li><a href="#" class="navbar-link" data-target="cierreCaja">Cierre Diario</a></li>
            <li><a href="#" class="navbar-link" data-target="registrarProveedores">Ingresar proveedor</a></li>
          </ul>
        </li>
        <li><a href="#" class="navbar-link" data-target="ventasRealizadas">CONSULTAR VENTAS</a></li>
        <li><a href="#" class="navbar-link" data-target="proveedores">PROVEEDORES</a></li>
        <li><a href="#" class="navbar-link" data-target="clientes">CLIENTES</a></li>
      </ul>
    </div>
    <!-- Gráficos e imágenes aleatorias -->
    <div class="Menu-Central">
      <div class="menu-section">
        <!-- Gráfico de barras -->
        <div class="menu-section-item">
          <canvas id="bar-chart-canvas"></canvas>
        </div>
      </div>
      <div class="menu-section">
        <!-- Imagen aleatoria -->
        <div class="window-section-item">
          <img id="random-image-element" src="" alt="Imagen aleatoria">
        </div>
      </div>
      <div class="menu-section">
        <!-- Mensaje -->
        <div class="window-section-item">
          <p id="message-content"></p>
        </div>
      </div>
      <div class="menu-section">
        <!-- Gráfico circular -->
        <div class="window-section-item">
          <canvas id="pie-chart-canvas"></canvas>
        </div>
      </div>
    </div>
    <!-- tabla de buscar empleados -->
    <form action="archivosPHP/empleados.php" method="post">
      <div class="modal-window" id="modal-container-empleados">
        <div class="modal-content" id="modal-content-empleados">
          <h2 class="title-empleados">Empleados</h2>
          <div id="body-empleados">
            <input type="text" id="search-code-empleados" name="search-code-empleados" placeholder="Buscar por código">
            <input type="text" id="search-name-empleados" name="search-name-empleados" placeholder="Buscar por nombre">
            <button id="search-button-empleados">Buscar</button>
            <button id="erase-button-empleados">Borrar</button>
          </div>
          <div class="table-container-empleados">
            <table class="empleados-table" id="empleados-result-table">
              <thead>
                <tr>
                  <th>nombres</th>
                  <th>apellidos</th>
                  <th>documentoid</th>
                  <th>email</th>
                  <th>celular</th>
                  <th>cargo</th>
                  <th>foto</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div id="message_empleados" class="message_empleados"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Ventana de compras -->
    <form id="crear_compra" method="POST">
      <div class="modal-window" id="modal-container-compras">
        <div class="modal-content" id="modal-content-compras">
          <h2 class="title-compra">Compra de Productos</h2>
          <div id="body-compra">
            <div class="input-group-compra">
              <label for="nombre">Codigo Producto:</label>
              <input type="text" id="codigo_compra" name="codigo_compra" placeholder="Ingrese el codigo del producto">
            </div>
            <div class="input-group-compra">
              <label for="nombre">Nombre Producto:</label>
              <input type="text" id="nombre_compra" name="nombre_compra" placeholder="Ingrese el nombre del producto">
            </div>
            <div class="input-group-compra">
              <label for="fecha-vencimiento">Fecha Vencimiento:</label>
              <input type="date" id="fecha-vencimiento" name="fecha_vencimiento_compra">
            </div>
            <div class="input-group-compra">
              <label for="laboratorio">Laboratorio:</label>
              <input type="text" id="laboratorio_compra" name="laboratorio_compra" placeholder="Ingrese el laboratorio">
            </div>
            <div class="input-group-compra">
              <label for="lote">Lote:</label>
              <input type="text" id="lote_compra" name="lote_compra" placeholder="Ingrese el lote">
            </div>
            <div class="input-group-compra">
              <label for="registro-sanitario">Registro sanitario:</label>
              <input type="text" id="registro_sanitario" name="registro_sanitario_compra" placeholder="Ingrese el número de registro">
            </div>
            <div class="input-group-compra">
              <label for="precio-venta">Precio Venta:</label>
              <input type="number" id="precio_venta_compra" name="precio_venta_compra" placeholder="Ingrese el precio de venta">
            </div>
            <div class="button-group-compra">
              <button id="clear-button-compra" type="button" name="clear-button-compra">Borrar</button>
              <button id="save-button-compra" type="submit" name="save-button-compra">Guardar</button>
            </div>
    </form>
    </div>
    </div>
    <div id="modal-mensaje-compra" class="modal-mensaje-compra"></div>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Ventana del inventario -->
    <form action="archivosPHP/inventario.php" method="post">
      <div class="modal-window" id="modal-container-inventario">
        <div class="modal-content" id="modal-content-inventario">
          <h2 class="title-inventory">Inventario</h2>
          <div id="body-inventory">
            <input type="text" id="search-code-inventory" name="search-code-inventory" placeholder="Buscar por código">
            <input type="text" id="search-name-inventory" name="search-name-inventory" placeholder="Buscar por nombre">
            <button id="search-button-inventory">Buscar</button>
            <button id="erase-button-inventory">Borrar</button>
          </div>
          <div class="table-container-inventory">
            <table class="inventory-table" id="inventory-result-table">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre Producto</th>
                  <th>Fecha Compra</th>
                  <th>Fecha Vencimiento</th>
                  <th>Laboratorio</th>
                  <th>Lote</th>
                  <th>Registro Sanitario</th>
                  <th>Precio Venta</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div id="message_inventario" class="message_inventario"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- ingresar datos de cierre de caja -->
    <form id="cierreCaja" action="archivosPHP/cierreCaja.php" method="post">
      <div class="modal-window" id="modal-container-cierreCaja">
        <div class="modal-content" id="modal-content-cierreCaja">
          <h2 class="title-cierreCaja">Cierre Diario</h2>
          <div id="preview-data">
            <div class="input-group-cierreCaja">
              <label for="efectivo_inicial">Efectivo Inicial:</label>
              <input type="number" id="efectivo_inicial" name="efectivo_inicial" placeholder="Ingrese el valor" required>
            </div>
            <div class="input-group-cierreCaja">
              <label for="ventas_efectivo">Ventas en Efectivo:</label>
              <input type="number" id="ventas_efectivo" name="ventas_efectivo" placeholder="Ingrese el valor" required>
            </div>
            <div class="input-group-cierreCaja">
              <label for="ventas_tarjeta">Ventas con Tarjeta:</label>
              <input type="number" id="ventas_tarjeta" name="ventas_tarjeta" placeholder="Ingrese el valor" required>
            </div>
            <div class="input-group-cierreCaja">
              <label for="nombre_gastos">Nombre del Gastos:</label>
              <input type="text" id="nombre_gastos" name="nombre_gastos" placeholder="Ingrese el Nombre del gasto" required>
            </div>
            <div class="input-group-cierreCaja">
              <label for="gasto">Valor del Gasto:</label>
              <input type="number" id="gasto" name="gasto" placeholder="Ingrese el valor" required>
            </div>
            <div class="input-group-cierreCaja">
              <label for="nombre_usuario">Usuario:</label>
              <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de usuario" required>
            </div>
          </div>
          <div class="button-group-cierreCaja">
            <button id="save-button-cierreCaja" type="submit" name="cierreCaja">Cerrar Caja</button>
          </div>
          <h2 id="title-vistaPrevia" class="title-vistaPrevia">Vista Previa</h2>
    </form>
    <div id="message_cierreCaja" class="message_cierreCaja"></div>
    <div id="preview-container" class="preview-container"></div>
    </div>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- ingresar datos de los proveedores -->
    <form id="registrarProveedor" action="archivosPHP/registrarProveedores.php" method="post">
      <div class="modal-window" id="modal-container-registrarProveedores">
        <div class="modal-content" id="modal-content-registrarProveedores">
          <h2 class="title-registrarProveedores">Registrar proveedor</h2>
          <div id="body-RP">
            <div class="input-group-registrarProveedores">
              <label for="NombresRegistroProveedores">Nombres:</label>
              <input type="text" id="NombresRegistroProveedores" name="NombresRP" placeholder="Ingrese los nombres">
            </div>
            <div class="input-group-registrarProveedores">
              <label for="ApellidosRP">Apellidos:</label>
              <input type="text" id="ApellidosRP" name="ApellidosRP" placeholder="Ingrese los apellidos">
            </div>
            <div class="input-group-registrarProveedores">
              <label for="DocumentoRP">Documento ID:</label>
              <input type="number" id="DocumentoRP" name="DocumentoRP" placeholder="Ingrese el Documento">
            </div>
            <div class="input-group-registrarProveedores">
              <label for="CorreoRP">Correo Electrónico:</label>
              <input type="text" id="CorreoRP" name="CorreoRP" placeholder="Ingrese el correo electrónico">
            </div>
            <div class="input-group-registrarProveedores">
              <label for="CelularRP">Número de Celular:</label>
              <input type="text" id="CelularRP" name="CelularRP" placeholder="Ingrese el número de celular">
            </div>
            <div class="input-group-registrarProveedores">
              <label for="LaboratorioRP">Entidad:</label>
              <input type="text" id="EntidadRP" name="EntidadRP" placeholder="Ingrese la entidad a la que pertenece">
            </div>
          </div>
          <div class="button-group-registraProveedores">
            <button id="save-button-registraProveedores" type="submit" name="save_RP">Registrar Proveedor</button>
          </div>
    </form>
    <div id="message_registrarProveedores" class="message_registrarProveedores"></div>
    </div>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Lista de proveedores en el navbar -->
    <form action="archivosPHP/proveedores.php" method="post">
      <div class="modal-window" id="modal-container-proveedores">
        <div class="modal-content" id="modal-content-proveedores">
          <h2 class="title-suppliers">Lista de Proveedores</h2>
          <div id="body-suppliers">
            <input type="text" id="search-code-suppliers" name="search-code-suppliers" placeholder="Buscar por Documento ID">
            <input type="text" id="search-name-suppliers" name="search-name-suppliers" placeholder="Buscar por nombre">
            <button id="search-button-suppliers">Buscar</button>
            <button id="erase-button-suppliers">Borrar</button>
            <div class="table-container-suppliers">
              <table class="suppliers-table" id="suppliers-table">
                <thead>
                  <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Documento_ID</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>Entidad</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="message_proveedores" class="message_proveedores"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Contenido de crearCliente dentro de venta -->
    <form id="crearCliente" method="POST">
      <div class="modal-window" id="modal-container-crearCliente">
        <div class="modal-content" id="modal-content-crearCliente">
          <h2 class="title-createCustomer">Registrar Cliente</h2>
          <div class="input-group-createCustomer">
            <label for="Nombres">Nombres:</label>
            <input type="text" id="NombresCliente" name="Nombres" placeholder="Ingrese los nombres">
          </div>
          <div class="input-group-createCustomer">
            <label for="Apellidos">Apellidos:</label>
            <input type="text" id="ApellidosCliente" name="Apellidos" placeholder="Ingrese los apellidos">
          </div>
          <div class="input-group-createCustomer">
            <label for="Documento">Documento ID:</label>
            <input type="number" id="DocumentoCliente" name="Documento" placeholder="Ingrese el Documento">
          </div>
          <div class="input-group-createCustomer">
            <label for="Correo">Correo Electrónico:</label>
            <input type="text" id="Correo<Cliente" name="Correo" placeholder="Ingrese el correo electrónico">
          </div>
          <div class="input-group-createCustomer">
            <label for="Celular">Número de Celular:</label>
            <input type="text" id="CelularCliente" name="Celular" placeholder="Ingrese el número de celular">
          </div>
        </div>
        <div class="button-group-crearCliente">
          <button id="save-button-createCustomer" type="submit" name="save_cliente">Crear Cliente</button>
        </div>
        <div class="modal-resultado" id="modal-resultado"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Lista de Clientes en el navbar -->
    <form action="archivosPHP/buscarClientes.php" method="post">
      <div class="modal-window" id="modal-container-clientes">
        <div class="modal-content" id="modal-content-clientes">
          <h2 class="title-customers">Lista de Clientes</h2>
          <div id="body-customers">
            <input type="text" id="search-code-customers" name="search-code-customers" placeholder="Buscar por Documento ID">
            <input type="text" id="search-name-customers" name="search-name-customers" placeholder="Buscar por nombre">
            <button id="search-button-customers">Buscar</button>
            <button id="erase-button-customers">Borrar</button>
            <div class="table-container-customers">
              <table class="customers-table" id="customer-results-table">
                <thead>
                  <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Documento</th>
                    <th>Correo</th>
                    <th>Celular</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="message_cliente" class="message_cliente"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Menu lateral con iconos -->
    <div class="lateral">
      <ul>
        <li class="user">
          <a href="#">
            <img src="img/usuariod.png" alt="logo" class="navbar-link" data-target="Usuario">
            <span>USUARIO</span>
          </a>
        </li>
        <li class="sales-menu">
          <a href="#">
            <img src="img/venta.png" alt="logo de Venta">
            <span>VENTA</span>
          </a>
          <ul class="sales-submenu">
            <li><a href="#" class="navbar-link" data-target="facturar">Facturar</a></li>
            <li><a href="#" class="navbar-link" data-target="crearCliente">Crear Cliente</a></li>
            <li><a href="#" class="navbar-link" data-target="registrarMensajero">Registrar Mensajero</a></li>
          </ul>
        </li>
        <li class="compra-menu">
          <a href="#">
            <img src="img/compra.png" alt="logo" class="navbar-link" data-target="compras">
            <span>COMPRA</span>
          </a>
        </li>
        <li class="inventario-menu">
          <a href="#">
            <img src="img/buscarp.png" alt="logo" class="navbar-link" data-target="inventario">
            <span>INVENTARIO</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- Ventana de usuario -->
    <div class="modal-window" id="modal-container-Usuario">
      <div class="modal-content" id="modal-content-Usuario">
        <h2 class="title-Usuario">Datos de Usuario</h2>
        <div id="body-User">
          <!-- Contenido de usuario -->
          <div class="user-field">
            <div class="Nombre-usuario">
              <label>Nombres:</label>
              <span id="user-nombres"></span>
            </div>
          </div>
          <div class="user-field">
            <div class="Apellidos-usuario">
              <label>Apellidos:</label>
              <span id="user-apellidos"></span>
            </div>
          </div>
          <div class="user-field">
            <div class="Cedula-usuario">
              <label>Cédula:</label>
              <span id="user-cedula"></span>
            </div>
          </div>
          <div class="photo-container">
            <div class="Fotografia-usuario">
              <label>Fotografía:</label>
              <img id="user-foto" src="img/mia (2).png" alt="Foto del usuario">
            </div>
          </div>
          <div class="user-field">
            <div class="Correo-usuario">
              <label>Correo Electrónico:</label>
              <span id="user-correo"></span>
            </div>
          </div>
          <div class="user-field">
            <div class="Celular-usuario">
              <label>Número de Celular:</label>
              <span id="user-celular"></span>
            </div>
          </div>
          <div class="user-field">
            <div class="Cargo-usuario">
              <label>Cargo:</label>
              <span id="user-cargo"></span>
            </div>
          </div>
        </div>
      </div>
      <button class="close-button">Cerrar</button>
    </div>
    <!-- Contenido de facturar dentro de venta -->
    <form id="facturarVenta" method="post">
      <div class="modal-window" id="modal-container-facturar">
        <div class="modal-content" id="modal-content-facturar">
          <h2 class="title-sales">Facturar Venta</h2>
          <div class="input-group-facturar">
            <label for="codigo_vendedor">Código Vendedor:</label>
            <input type="number" id="codigo_vendedor" name="codigo_vendedor" placeholder="Ingrese el código">
            <button class="search-button-codigoVendedor" id="search-button-codigoVendedor">🔍</button>
          </div>
          <div class="input-group-facturar">
            <label for="nombre_vendedor">Nombre Vendedor:</label>
            <input type="text" id="nombre_vendedor" name="nombre_vendedor">
          </div>
          <div class="input-group-facturar">
            <label for="Cedula-Cliente">Cedula cliente:</label>
            <input type="number" id="Cedula-Cliente" name="Cedula-Cliente" placeholder="Ingrese Cedula">
            <button class="search-button-cedulaCliente" id="search-button-cedulaCliente">🔍</button>
          </div>
          <div class="input-group-facturar">
            <label for="Nombre-Cliente">Nombre Cliente:</label>
            <input type="text" id="Nombre-Cliente" name="Nombre-Cliente">
          </div>
          <div class="center-container">
            <div class="subtitle-factura" id="subtitle-factura">
              <h2>Datos Producto</h2>
            </div>
          </div>
          <div class="input-group-facturar">
            <label for="Codigo-Producto2">Codigo Producto:</label>
            <input type="number" id="Codigo-Producto2" name="Codigo-Producto2" placeholder="Ingrese el Codigo">
            <button class="search-button-codigoProducto" id="search-button-codigoProducto">🔍</button>
          </div>
          <div class="input-group-facturar">
            <label for="Nombre-Producto">Nombre Producto:</label>
            <input type="text" id="Nombre-Producto" name="Nombre-Producto" placeholder="Ingrese el Nombre del producto">
          </div>
          <div class="input-group-facturar">
            <label for="precio-venta">Precio Venta:</label>
            <input type="number" id="precio-venta" name="precio-venta" class="readonly-input" value="" readonly>
          </div>
          <div class="input-group-facturar">
            <label for="Cantidad-Producto">Cantidad:</label>
            <input type="number" id="Cantidad-Producto" name="Cantidad-Producto">

            <label class="total" for="Total-Venta">Total:</label>
            <input type="number" id="Total-Venta" name="Total-Venta" class="readonly-input" value="" readonly>

            <label class="total-general" for="Total-general">
              <b>General:</b>
            </label>
            <input type="number" id="Total-general" name="Total-general" class="Total-general" value="" readonly>
          </div>
        </div>
        <div class="table-container-scrollable">
          <table class="scrollable-table">
            <thead>
              <tr>
                <th>Código Producto</th>
                <th>Nombre</th>
                <th>Precio Venta</th>
                <th>Cantidad</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
    </form>
    </div>
    <div id="button-group-facturarVenta" class="button-group-facturarVenta">
      <button id="add-product-to-table-button">Agregar Producto</button>
      <button id="clear-cart-button">Limpiar Carrito</button>
      <button id="checkout-button">Facturar</button>
    </div>
    <div id="mensaje"></div>
    <button class="close-button">Cerrar</button>
    </div>
    <!-- Contenido de registrarMensajero dentro de venta -->
    <form id="crearMensajero" method="POST">
      <div class="modal-window" id="modal-container-registrarMensajero">
        <div class="modal-content" id="modal-content-registrarMensajero">
          <h2 class="title-registerMessenger">Registrar Mensajero</h2>
          <div class="input-group-registerMessenger">
            <label for="Nombres">Nombres:</label>
            <input type="text" id="NombresMensajero" name="NombresMensajero" placeholder="Ingrese los nombres">
          </div>
          <div class="input-group-registerMessenger">
            <label for="Apellidos">Apellidos:</label>
            <input type="text" id="ApellidosMensajero" name="ApellidosMensajero" placeholder="Ingrese los apellidos">
          </div>
          <div class="input-group-registerMessenger">
            <label for="Documento">Documento ID:</label>
            <input type="number" id="DocumentoMensajero" name="DocumentoMensajero" placeholder="Ingrese el Documento">
          </div>
          <div class="input-group-registerMessenger">
            <label for="Correo">Correo Electrónico:</label>
            <input type="text" id="CorreoMensajero" name="CorreoMensajero" placeholder="Ingrese el correo electrónico">
          </div>
          <div class="input-group-registerMessenger">
            <label for="Celular">Número de Celular:</label>
            <input type="text" id="CelularMensajero" name="CelularMensajero" placeholder="Ingrese el número de celular">
          </div>
        </div>
        <div class="button-group-registerMessenger">
          <button id="save-button-registerMessenger" type="submit" name="save_mensajero">Registrar Mensajero</button>
        </div>
        <div class="modal-resultado-mensajero" id="modal-resultado-mensajero"></div>
    </form>
    <button class="close-button">Cerrar</button>
    </div>

    <div id="cerrar_sesion">
    </div>
    <div class="logout_index">
      <a class="logout" href="inicioSesion/index.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Cerrar Sesión</span>
      </a>
    </div>
    <?php
    $archivosPHP = [
      "comprarProductos.php",
      "crearMensajero.php",
      "crearClientes.php",
      "buscarClientes.php",
      "inventario.php",
      "registrarProveedor.php",
      "proveedores.php",
      "empleados.php",
      "cierreCaja.php",
      "buscarPorCodigoProducto.php",
      "buscarCodigoVendedor.php",
      "buscarCedulaCliente.php"
    ];

    array_map(function ($archivo) {
      include("archivosPHP/$archivo");
    }, $archivosPHP);
    ?>
  </main>
  <footer>
  </footer>
  <script src="javascript/modal.js"></script>
  <script src="javascript/graficos.js"></script>
  <script src="javascript/script.js"></script>
  <script src="javascript/cierreDiario.js"></script>
  <script src="javascript/facturar.js"></script>
</body>

</html>