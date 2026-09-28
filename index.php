<?php include 'layout/head.php'; ?>
<body>
    <?php include 'layout/header.php'; ?>

    <main>
        <form action="app/controllers/emailController.php" method="post">
            <input type="text" placeholder="Enter your text here" type="email" name="email">
            <button type="submit">Submit</button>
        </form>
    </main>

    <?php include 'layout/footer.php'; ?>
</body>
</html>