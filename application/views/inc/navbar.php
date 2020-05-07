<div class="navbar-content">
    <!-- start: SIDEBAR -->
    <div class="main-navigation navbar-collapse collapse">
        <!-- start: MAIN MENU TOGGLER BUTTON -->
        <div class="navigation-toggler">
            <i class="clip-chevron-left"></i>
            <i class="clip-chevron-right"></i>
        </div>
        <!-- end: MAIN MENU TOGGLER BUTTON -->


        <!-- start: MAIN NAVIGATION MENU -->
        <ul class="main-navigation-menu">
            <?php
            //$menu_data = array("menus" => $menus);
            $this->load->view("inc/menu_items"); 
            ?>
 		</ul>
        <!-- end: MAIN NAVIGATION MENU -->
    </div>
    <!-- end: SIDEBAR -->
</div>