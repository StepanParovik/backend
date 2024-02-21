<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<!-- Пагинация -->
<div class="d-flex justify-content-end">
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php foreach ($pager->links() as $link) : ?>
                    <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                        <a class="page-link" href="<?= $link['uri'] ?>">
                            <?= $link['title'] ?>
                        </a>
                    </li>
                <?php endforeach ?>
                <li class="page-item <?= $pager->hasNext() ? '' : 'disabled' ?>">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
</div>
