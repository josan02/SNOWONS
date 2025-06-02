<?php
include_once __DIR__ . '/../includes/header.php';
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<h2>🛒Tu Carrito</h2>

<?php if (empty($carrito)): ?>
    <!-- Si el carrito esta vacio, mostramos este mensaje -->
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Recorremos todos los productos del carrito -->
            <?php foreach ($carrito as $item): 
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal; 
            ?>
            <tr>
                <td><?= htmlspecialchars($item['nombre']) ?></td>
                <td><?= number_format($item['precio'], 2) ?> €</td>
                <td><?= $item['cantidad'] ?></td>
                <td><?= number_format($subtotal, 2) ?> €</td>
                <td>
                    <!-- Formulario para eliminar un producto -->
                    <form method="post" action="<?= BASE_URL ?>/controllers/carritoController.php">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <!-- Fila del total general -->
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total:</strong></td>
                <td colspan="2"><strong><?= number_format($total, 2) ?> €</strong></td>
            </tr>
        </tfoot>
    </table>

    <!-- Si el carrito tiene algo, mostramos el boton de finalizar -->
    <?php if (!empty($carrito)): ?>
    <div style="margin-top: 20px;">
        <a class="btn-principal" href="<?= BASE_URL ?>/views/finalizarPedido.php">
            Finalizar pedido
        </a>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php
include_once __DIR__ . '/../includes/footer.php';
?>
