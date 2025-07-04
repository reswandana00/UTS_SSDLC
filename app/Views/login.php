<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="/login">
    <h1>Login</h1>
    <p>Silakan login untuk melanjutkan mode demo</p>
    <p>Username: demo</p>
    <p>Password: demo</p>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>