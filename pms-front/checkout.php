<?php session_start();
require_once('inc/header.php');
$cart = $_SESSION['cart'] ?? [];
if(isset($_POST['place_order'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note = $_POST['note'] ?? '';
    $order = "Name: $name\nEmail: $email\nAddress: $address\nPhone: $phone\nNote: $note\nCart: " . print_r($cart, true) . "\n------------------\n";
    file_put_contents('orders.txt', $order, FILE_APPEND);
    unset($_SESSION['cart']);
    echo "<div class='alert alert-success text-center'>Order placed successfully!</div>";
}
 ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                        <ul class="list-unstyled"> <?php 
                            $total = 0;
                            if(!empty($cart)):
                                foreach($cart as $product => $details):
                                    $lineTotal = $details['price'] * $details['qty'];
                                    $total += $lineTotal;
                            ?>
                            <li class="border p-2 my-1">
                                <?= $product ?> -
                                <span class="text-success mx-2"><?= $details['qty'] ?> x
                                    $<?= number_format($details['price'],2) ?> =
                                    $<?= number_format($lineTotal,2) ?></span>
                            </li>
                            <?php 
                                endforeach; 
                            else:
                            ?>
                            <li class="p-2">Your cart is empty.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <h5>Total: $<?= number_format($total,2) ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <form method="POST" class="form border my-2 p-3">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Notes</label>
                <input type="text" name="note" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" name="place_order" value="Place Order" class="btn btn-success">
            </div>
        </form>
    </div>
    </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>