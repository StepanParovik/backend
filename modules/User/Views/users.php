<container>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
        </ol>
    </nav>
    <a class="btn btn-success" href="user/create" role="button">Добавить</a>
    <table class="table table-striped">
        <thead>
        <th>
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Отчество</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Логин</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n=1;
        if (! empty($user) && is_array($user)): ?>
            <?php foreach ($user as $user_item): ?>
                <tr>
                    <th scope="row"><?=$n?></th>
                    <td><?= esc($user_item['first_name']) ?></td>
                    <td><?= esc($user_item['last_name']) ?></td>
                    <td><?= esc($user_item['patronymic']) ?></td>
                    <td><?= esc($user_item['create_date'] = date("d.m.Y")) ?></td>
                    <td><?= esc($user_item['login']) ?></td>
                </tr>
            <?php endforeach ?>

        <?php else: ?>

            <h3>Нет записей</h3>

            <p>Хм, такого быть не может.</p>

        <?php endif ?>
        </tbody>
    </table>
</container>