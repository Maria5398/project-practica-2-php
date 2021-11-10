<?php if (isset($product)): ?> <!-- si existe el poducto, muestrame sus datos -->
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>
			<p class="price"><?= $product->precio ?>$</p>
			<!-- se añade a carrito el producto selecionaaddo -->
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
		</div>
	</div>
<?php else: ?><!-- de lo  contrario  envia este sms -->
	<h1>El producto no existe</h1>
<?php endif; ?>
