<ul class="pagination">
	<?php if ($pg['firstPage']): ?>
        <li><a href="<?php echo $BASE, $pg['route'], $pg['prefix'].$pg['firstPage']; ?>">First</a></li>
    <?php endif; ?>
	<?php if ($pg['prevPage']): ?>
        <li><a href="<?php echo $BASE, $pg['route'], $pg['prefix'].$pg['prevPage']; ?>"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
    <?php endif; ?>
	<?php foreach (($pg['rangePages']?:array()) as $page): ?>
        <li <?php echo $page == $pg['currentPage'] ? 'class="active"':''; ?>><a href="<?php echo $BASE, $pg['route'], $pg['prefix'].$page; ?>"><?php echo $page; ?></a></li>
	<?php endforeach; ?>
	<?php if ($pg['nextPage']): ?>
        <li><a href="<?php echo $BASE, $pg['route'], $pg['prefix'].$pg['nextPage']; ?>"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
    <?php endif; ?>
	<?php if ($pg['lastPage']): ?>
        <li><a href="<?php echo $BASE, $pg['route'], $pg['prefix'].$pg['lastPage']; ?>">Last [<?php echo $pg['lastPage']; ?>]</a></li>
    <?php endif; ?>
</ul>