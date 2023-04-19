<?php
include('header.php');
include('configuracion.php');
?>

<div class="tipopago">
<table class="tablapago">
  <thead>
    <tr>
      <th>Forma de pago</th>
      <th>Descripción</th>
      <th>Tarjetas aceptadas</th>
      <th>Cuotas</th>
      <th>Promociones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <a href="https://banco.com/pagar-con-tarjeta-de-credito">
          <button class="pago-tarjeta-credito">Tarjeta de crédito</button>
        </a>
      </td>
      <td>Paga con tu tarjeta de crédito y aprovecha las promociones disponibles</td>
      <td>Visa, Mastercard, American Express</td>
      <td>3, 6, 12 cuotas</td>
      <td>Descuentos en tiendas asociadas</td>
    </tr>
    <tr>
      <td>
        <a href="https://banco.com/pagar-con-tarjeta-de-debito">
          <button class="pago-tarjeta-debito">Tarjeta de débito</button>
        </a>
      </td>
      <td>Realiza el pago con tu tarjeta de débito y obtén un descuento especial</td>
      <td>Todas las tarjetas de débito</td>
      <td>Pago único</td>
      <td>10% de descuento en tu próxima compra</td>
    </tr>
    <tr>
      <td>
        <a href="https://banco.com/pagar-en-efectivo">
          <button class="pago-efectivo">Pago en efectivo</button>
        </a>
      </td>
      <td>Paga en efectivo en nuestra tienda física y obtén un descuento adicional</td>
      <td>-</td>
      <td>-</td>
      <td>5% de descuento en tu compra actual</td>
    </tr>
  </tbody>
</table>
</div>