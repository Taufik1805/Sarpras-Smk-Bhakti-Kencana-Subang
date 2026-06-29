<?php if ($pager->hasPrevious()) : ?>
<ul class="pagination">
    <li>
        <a href="<?= $pager->getFirst() ?>">« First</a>
    </li>

    <li>
        <a href="<?= $pager->getPrevious() ?>">‹ Prev</a>
    </li>
<?php else : ?>
<ul class="pagination">
<?php endif; ?>

<?php foreach ($pager->links() as $link) : ?>
    <li class="<?= $link['active'] ? 'active' : '' ?>">
        <a href="<?= $link['uri'] ?>">
            <?= $link['title'] ?>
        </a>
    </li>
<?php endforeach; ?>

<?php if ($pager->hasNext()) : ?>

    <li>
        <a href="<?= $pager->getNext() ?>">Next ›</a>
    </li>

    <li>
        <a href="<?= $pager->getLast() ?>">Last »</a>
    </li>

<?php endif; ?>

</ul>