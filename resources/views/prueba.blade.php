@extends('layouts.app')

@section('content')
    
{{-- <!-- formulario usado en la página de inicio (Rolando) -->
<form action="javascript: BuscarFull();">
    <div class="formBusqueda">
    <div class="formitem"><h3><strong>Tipo de Vehículo</strong></h3>
      <select id="SubTipoVeh" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="SubTipoVehC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    <div class="formitem"><h3><strong>Marca</strong></h3>
      <select id="MarcaVeh" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="MarcaVehC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    <div class="formitem"><h3><strong>Modelo</strong></h3>
      <select id="ModeloVeh" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="ModeloVehC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    <div class="formitem"><h3><strong>Versión</strong></h3>
      <select id="VersionVeh" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="VersionVehC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    <div class="formitem"><h3><strong>Tipo de pieza</strong></h3>
      <select id="TipoPieza" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="TipoPiezaC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    <div class="formitem"><h3><strong>Pieza</strong></h3>
      <select id="Pieza" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion"><option value="-1">Seleccionar</option></select>
      <img style="margin-left:20px; display:none;" id="PiezaC" src="/wp-admin/images/wpspin_light.gif">
    </div>
    </div>
    <div style="text-align: center"><input type="submit" id="btnBusquedaAvanzada" name="btnBusquedaAvanzada" value="Buscar" class="wpcf7-form-control wpcf7-submit" /></div>
    </form>
    <div id="loader"></div><div id="resultados" style="height:2rem"></div>
    <div id="piezas" class="tabla-piezas"></div>
    
    <!-- formulario actual busqueda rápida -->
    <form action="/buscador-de-piezas/" method="get">
    <div class="formBusquedaRapida">
      <div class="itemBusquedaRapida">
        <input name="idPiezaBusqueda" placeholder="Nº de Pieza Renauto" id="txtIdPieza" type="text" class="csssolicitudes inputBusquedaRapida" />
      </div>
      <div class="itemBusquedaRapida">
        <input name="busqueda" placeholder="Indique la pieza que busca" id="txtDescripcion" type="text" class="csssolicitudes inputBusquedaRapida" />
      </div>
      <div class="itemBusquedaRapida">
        <input type="submit" value="Buscar" class="wpcf7-form-control wpcf7-submit botonInvertido" />
      </div>
    </div>
    </form>
    
    <!-- formulario original página de inicio -->
    <div class="formBusqueda">
    <form action="javascript: BusquedaAvanzada();">
      <div class="izquierda">
        <div style="margin-bottom: 20px;">
          <h3><strong>Tipo de Vehículo</strong></h3>
          <select id="Tipo" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" onchange="GetSubTipos();" style="width: 100%"></select>
        </div>
        <div style="margin-bottom: 20px; display: none;">
          <h3>SubTipo</h3>
          <select id="SubTipo" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" onchange="GetMarcas();GetGrupos();" style="width: 300px;"></select>
        </div>
        <div style="margin-bottom: 50px;">
          <h3><strong>Modelo</strong></h3>
          <select id="Modelo" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" onchange="GetVersiones();" style="min-width: 300px;"></select>
        </div>
        <div style="margin-bottom: 20px;">
          <h3><strong>Tipo de pieza</strong></h3>
            <select id="Grupo" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" onchange="GetPiezas();" style="min-width: 300px;"></select>
        </div>
        <div style="margin-bottom: 20px;"> <input type="checkbox" id="chkEquiv" /> Incluir piezas compatibles.</div>
      </div>
      <div class="derecha">
        <div style="margin-bottom: 20px;">
          <h3><strong>Marca</strong></h3>
          <select id="Marca" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" onchange="GetModelos();" style="width: 300px;"></select>
        </div>
        <div style="margin-bottom: 50px;">
          <h3><strong>Versión</strong></h3>
          <select id="Version" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" style="min-width: 300px;"></select>
        </div>    
        <div style="margin-bottom: 20px;">
          <h3><strong>Pieza</strong></h3>
          <select id="Pieza" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required csssolicitudes flechaSeleccion" style="min-width: 300px;"></select>
        </div>
      </div>
    <div style="margin-bottom: 20px;">
    <input type="checkbox" id="chkEquiv" /> Incluir piezas compatibles.
    </div>
      <div style="text-align: center"><input type="submit" id="btnBusquedaAvanzada" name="btnBusquedaAvanzada" value="Buscar" class="wpcf7-form-control wpcf7-submit" /></div>
    </form>
    </div>
    
    <!-- formulario original busqueda rápida -->
    <form action="/temporal/buscador-de-piezas/" method="get">
    <div style="width: 100%; display: flex; flex-direction: row; align-items: baseline;">
    <div style="flex: 25%; margin-right: 20px;">
    <input name="idPiezaBusqueda" placeholder="Nº de Pieza Renauto" id="txtIdPieza" type="text" class="csssolicitudes" style="padding-top: 10px !important; padding-bottom: 10px !important; height: 45px !important;" />
    </div>
    <div style="flex: 65%; margin-right: 20px;">
    <input name="busqueda" placeholder="Indique la pieza que busca" id="txtDescripcion" type="text" class="csssolicitudes" style="padding-top: 10px !important; padding-bottom: 10px !important; height: 45px !important;" />
    </div>
    <div style="flex: 15%;">
    <input type="submit" value="Buscar" class="wpcf7-form-control wpcf7-submit botonInvertido" />
    </div>
    </div>
    </form> --}}

    <!-- Formulario que se actualiza -->
    <label for="category">Menus</label>
<select id="category" name="category">
  <option value="electronics">Electrónica</option>
  <option value="clothing">Ropa</option>
  <option value="books">Libros</option>
</select>

<label for="product">Producto:</label>
<select id="product" name="product">
  <!-- Las opciones se actualizarán según la selección en el primer campo -->
</select>


<script>
    // Obtener los elementos de los campos de selección
    const categoryField = document.getElementById('category');
    const productField = document.getElementById('product');
  
    // Crear una matriz de productos para cada categoría
    const electronicsProducts = ['Smartphone', 'Tablet', 'Laptop'];
    const clothingProducts = ['Camiseta', 'Pantalón', 'Zapatos'];
    const booksProducts = ['Novela', 'Biografía', 'Ensayo'];
  
    // Actualizar el segundo campo según la selección del primer campo
    categoryField.addEventListener('change', (event) => {
      const selectedCategory = event.target.value;
      let products;
  
      // Seleccionar los productos según la categoría seleccionada
      switch (selectedCategory) {
        case 'electronics':
          products = electronicsProducts;
          break;
        case 'clothing':
          products = clothingProducts;
          break;
        case 'books':
          products = booksProducts;
          break;
        default:
          products = [];
      }
  
      // Actualizar las opciones del segundo campo
      productField.innerHTML = '';
      products.forEach((product) => {
        const option = document.createElement('option');
        option.value = product;
        option.textContent = product;
        productField.appendChild(option);
      });
    });
  </script>
    
    
@endsection