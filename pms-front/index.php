<?php
session_start();
require_once('inc/header.php');


if(isset($_POST['add_to_cart'])){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_qty'];

    if(isset($_SESSION['cart'][$name])){
        $_SESSION['cart'][$name]['qty'] += $qty; 
    } else {
        $_SESSION['cart'][$name] = ['price' => $price, 'qty' => $qty];
    }

    echo "<div class='alert alert-success text-center'>Added $qty x $name to cart!</div>";
}


$products = [
    ['name'=>'Fancy Product', 'price'=>40],
    ['name'=>'Special Item', 'price'=>18],
    ['name'=>'Sale Item', 'price'=>25],
    ['name'=>'Popular Item', 'price'=>40],
];
?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5"></div>
    <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Shop in style</h1>
        <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
    </div>
    </div>
</header>

<!-- Products Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach($products as $product): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bolder"><?= $product['name'] ?></h5>
                        <p>$<?= number_format($product['price'],2) ?></p>
                        <!-- Add to Cart Form -->
                        <form method="POST">
                            <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                            <input type="number" name="product_qty" value="1" min="1" class="mb-2 form-control">
                            <button type="submit" name="add_to_cart" class="btn btn-outline-dark mt-auto">Add to
                                Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Mini Cart Summary / Checkout Link -->
<section class="py-3 bg-light">
    <div class="container px-4 px-lg-5">
        <h3>Your Cart Summary</h3>
        <?php if(!empty($_SESSION['cart'])): ?>
        <?php
            $total = 0;
            foreach($_SESSION['cart'] as $item){
                $total += $item['price'] * $item['qty'];
            }
        ?>
        <p>Total items: <?= count($_SESSION['cart']) ?> | Total Price: $<?= number_format($total,2) ?></p>
        <a href="cart.php" class="btn btn-primary">View Cart / Checkout</a>
        <?php else: ?>
        <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>