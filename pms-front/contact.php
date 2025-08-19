<?php require_once('inc/header.php');

$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$successMsg = "";


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST['name'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $message = trim($_POST['message'] ?? "");

    
    if (empty($name)) $nameErr = "Please enter your name";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $emailErr = "Please enter a valid email";
    if (empty($message)) $messageErr = "Please enter a message";

    
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        
        $contactData = "Name: $name\nEmail: $email\nMessage: $message\n-------------------\n";

        
        file_put_contents('contacts.txt', $contactData, FILE_APPEND);

        $successMsg = "Thank you, $name! Your message has been sent.";
        
        $name = $email = $message = "";
    }
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
            <div class="col-8 mx-auto">
                <?php if($successMsg): ?>
                <div class="alert alert-success text-center"><?= $successMsg ?></div>
                <?php endif; ?>
                <form action="" method="POST" class="form border my-2 p-3">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" class="form-control">
                        <?php if($nameErr): ?><small class="text-danger"><?= $nameErr ?></small><?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" class="form-control">
                        <?php if($emailErr): ?><small class="text-danger"><?= $emailErr ?></small><?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="">Message</label>
                        <textarea name="message" class="form-control"
                            rows="7"><?= htmlspecialchars($message) ?></textarea>
                        <?php if($messageErr): ?><small class="text-danger"><?= $messageErr ?></small><?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Send" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>