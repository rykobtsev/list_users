<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Зареєструватись</h2>
            <form id="authForm" action="/main/add" method="POST">
                <div class="form-group">
                    <label for="firstName">Ім'я:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Введіть ім'я" value="<?= $dataForm['firstName'] ?? null; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Прізвище:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Введіть прізвище" value="<?= $dataForm['lastName'] ?? null; ?>">
                </div>
                <div class=" form-group">
                    <label for="email">Email:</label>
                    <div class="invalid-feedback error_email" <?php if (!empty($error['email']))  echo "style='display:block'" ?>>
                        <?= $error['email'] ?? null; ?>
                    </div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Введіть email" value="<?= $dataForm['email'] ?? null; ?>" required>
                </div>
                <div class=" form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Введіть пароль" required>
                </div>
                <div class=" form-group">
                    <label for="confirmPassword">Повторення пароль:</label>
                    <div class="invalid-feedback error_confirm_password" <?php if (!empty($error['password']))  echo "style='display:block'" ?>>
                        <?= $error['password'] ?? null; ?>
                    </div>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Повторіть пароль" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary btn-block mt-4" value="Відправити">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/public/js/main.js"></script>