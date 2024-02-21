<?php
$n=1;
if (! empty($data) && is_array($data)): ?>
    <?php foreach ($data as $data_item): ?>
        <tr>
            <th scope="row"><?=$n?></th>
            <td><?= esc($data_item['subject_name']) ?></td>
            <td><?= esc($data_item['name']) ?></td>
            <td><?= esc($data_item['period_start'] = date('d.m.Y', strtotime($data_item['period_start']))) ?> - <?= esc($data_item['period_end'] = date('d.m.Y', strtotime($data_item['period_end']))) ?></td>
            <td><?= esc($data_item['planned_duration']) ?></td>
            <td>
                <a href="/inspections/edit/<?= esc($data_item['id']) ?>" class="btn btn-outline-secondary">Ред.</a>
                <a href="/inspections/delete/<?= esc($data_item['id']) ?>" class="btn btn-outline-secondary">Удалить</a>
            </td>
        </tr>

        <?php $n++;
    endforeach ?>

<?php else: ?>
    <th scope="row"><?=$n?></th>
    <td>Нет записей</td>

<?php endif ?>