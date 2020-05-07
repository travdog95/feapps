<!-- start: PAGE TITLE & BREADCRUMB -->
<!-- <ol class="breadcrumb">
    <li class="<?php if ($active_page == 'Home') echo 'active'; ?>">
        <i class="clip-home-3"></i>
        <?php if ($active_page == 'Home'): ?>
            Home
        <?php else: ?>
            <a href="<?php echo base_url(); ?>home">Home</a>
        <?php endif; ?>
    </li>
    <?php foreach ($bread_crumbs as $bread_crumb): ?>
        <li class="<?php if ($bread_crumb['name'] == $active_page) echo 'active'; ?>">
            <?php $name = ($bread_crumb['name'] == $active_page) ? quotes_to_entities($bread_crumb['name']) : '<a href="'.base_url().$bread_crumb['link'].'">'.quotes_to_entities($bread_crumb['name']).'</a>'; ?>
            <?php echo $name; ?>
        </li>
    <?php endforeach; ?>
    <li class="search-box"></li>
</ol> -->
<!-- end: PAGE TITLE & BREADCRUMB -->
