<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
	<!--si el  carritto esta iniciado y el contaador es mayor o igual a uno -->
<table>
	<tr>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Unidades</th>
		<th>Eliminar</th>
	</tr>
	<?php //muestrame los productos
		foreach($carrito as $indice => $elemento): 
		$producto = $elemento['producto'];
	?>
	
	<tr>
		<td>
			<?php if ($producto->imagen != null): ?> <!-- si no hay img poner la de por defecto-->
				<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
			<?php endif; ?>
		</td>
		<td>
			<a href="<?= base_url ?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
		</td>
		<td>
			<?=$producto->precio?>
		</td>
		<td>
			<?=$elemento['unidades']?>
			<div class="updown-unidades"> <!-- unidades del producto, aumentaro desminuir -->
				<a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
				<a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
			</div>
		</td>
		<td> <!-- eleminar producto d carrito -->
			<a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-carrito button-red">Quitar producto</a>
		</td>
	</tr>
	
	<?php endforeach; ?>
</table>
<br/><!-- vaciaar ttodo el carrito -->
<div class="delete-carrito">
	<a href="<?=base_url?>carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a>
</div>
<div class="total-carrito">
	<?php $stats = Utils::statsCarrito(); ?>
	<!-- invoco el metdo staats y  asi obtengo el tottal en la vista -->
	<h3>Precio total: <?=$stats['total']?> $</h3>
	<a href="<?=base_url?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
</div>

<?php else: ?>
	<p>El carrito está vacio, añade algun producto</p>
<?php endif; ?>