<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>


                <livewire:backend.theme.menu-item
                    :url="'admin.home'"
                    :icon="'ri-dashboard-line'"
                    :label="'Dashboard'"
                    :hasSubMenu="false" />



                <li class="menu-title">Pages</li>

                <livewire:backend.theme.menu-item
                    :url="''"
                    :icon="'ri-layout-3-line'"
                    :label="'T-Shirt'"
                    :hasSubMenu="true"
                    :subMenuItems="
                    [
                        ['url' => 'admin.tshirt.category.index', 'label' => 'Category'],
                        ['url' => 'admin.design.index', 'label' => 'Design'],
                        ['url' => 'admin.tshirt.index', 'label' => 'T-Shirt'],
                    ]" />


                <livewire:backend.theme.menu-item
                    :url="''"
                    :icon="'ri-layout-3-line'"
                    :label="'Products'"
                    :hasSubMenu="true"
                    :subMenuItems="
                    [
                        ['url' => 'admin.product.create', 'label' => 'Add Product'],
                        ['url' => 'admin.product.index', 'label' => 'All Prodcuts'],
                        ['url' => 'admin.category.index', 'label' => 'Category'],
                        ['url' => 'admin.size.index', 'label' => 'Size'],
                        ['url' => 'admin.color.index', 'label' => 'Color'],
                    ]" />


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>