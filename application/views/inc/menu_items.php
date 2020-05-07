<?php foreach($menus as $menu): ?>
	<?php 
    $link = (!empty($menu['Link'])) ? base_url().$menu['Link'] : "javascript: void(0);"; 
    $li_classes = array();
    if (isset($menu['Active']) && $menu['Active'])
    {
        array_push($li_classes, "active");
    }

    if (isset($menu['Open']) && $menu['Open'])
    {
        array_push($li_classes, "open");
    }
    ?>
    <li class="<?php echo implode(" ", $li_classes); ?>" data-activematch="<?php echo $menu['ActiveMatch']; ?>">
        <a href="<?php echo $link; ?>">
            <?php if (!empty($menu['Icon'])): ?>
                <i class="<?php echo $menu['Icon']; ?>"></i>
            <?php endif; ?>

            <span class="title"> <?php echo quotes_to_entities($menu['Name']); ?></span>
            <?php if (sizeof($menu['Children']) > 0): ?>
                <i class="icon-arrow"></i>
            <?php endif; ?>
            <span class="selected"></span>
        </a>

        <?php if (sizeof($menu['Children']) > 0): ?>
            <ul class="sub-menu" style="display:block;">
                <!--Recursion-->
                <?php $menu_data = array("menus" => $menu['Children']); ?>
                <?php $this->load->view("inc/menu_items", $menu_data); ?>
            </ul>
        <?php endif; ?>
    </li>
<?php endforeach; ?>