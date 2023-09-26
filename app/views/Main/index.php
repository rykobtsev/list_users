<div class="container mt-5">
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Всі користувачі</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"><strong>ID</strong></div>
                            <div class="col-md-4"><strong>Ім'я</strong></div>
                            <div class="col-md-4"><strong>Email</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php foreach ($data as $user) : ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4"><?= $user['id'] ?></div>
                                <div class="col-md-4"><?= $user['name'] ?></div>
                                <div class="col-md-4"><?= $user['email'] ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>