<?php
session_start();
require_once('inc/header.php');


if(isset($_GET['remove'])){
    $product = $_GET['remove'];
    unset($_SESSION['cart'][$product]);
}


if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $product => $qty){
        if($qty <= 0){
            unset($_SESSION['cart'][$product]);
        } else {
            $_SESSION['cart'][$product]['qty'] = $qty;
        }
    }
    echo "<div class='alert alert-success text-center'>Cart updated!</div>";
}

$cart = $_SESSION['cart'] ?? [];
?>

<!-- Cart Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="mb-4">Your Cart</h2>
        <?php if(!empty($cart)): ?>
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach($cart as $product => $details):
                        $lineTotal = $details['price'] * $details['qty'];
                        $total += $lineTotal;
                    ?>
                    <tr>
                        <td><?= $product ?></td>
                        <td>$<?= number_format($details['price'],2) ?></td>
                        <td>
                            <input type="number" name="qty[<?= $product ?>]" value="<?= $details['qty'] ?>" min="0">
                        </td>
                        <td>$<?= number_format($lineTotal,2) ?></td>
                        <td>
                            <a href="?remove=<?= urlencode($product) ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2"><strong>$<?= number_format($total,2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3">
                <input type="submit" name="update_cart" value="Update Cart" class="btn btn-primary">
                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            </div>
        </form>
        <?php else: ?>
        <p>Your cart is empty.</p>
        <a href="index.php" class="btn btn-primary">Go to Shop</a>
        <?php endif; ?>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>