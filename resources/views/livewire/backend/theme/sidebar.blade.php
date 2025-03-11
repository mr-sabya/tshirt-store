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

                <livewire:backend.theme.menu-item
                    :url="'admin.banner.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Banners'"
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

                <livewire:backend.theme.menu-item
                    :url="''"
                    :icon="'ri-layout-3-line'"
                    :label="'Expense'"
                    :hasSubMenu="true"
                    :subMenuItems="
                    [
                        ['url' => 'admin.expense.category.index', 'label' => 'Expense Category'],
                        ['url' => 'admin.expense.index', 'label' => 'Expense'],
                    
                    ]" />

                <livewire:backend.theme.menu-item
                    :url="'admin.order.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Orders'"
                    :hasSubMenu="false" />

                <livewire:backend.theme.menu-item
                    :url="'admin.supplier.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Suppliers'"
                    :hasSubMenu="false" />

                <livewire:backend.theme.menu-item
                    :url="'admin.lead.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Leads'"
                    :hasSubMenu="false" />

                <livewire:backend.theme.menu-item
                    :url="'admin.purchase.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Purchase Orders'"
                    :hasSubMenu="false" />

                <livewire:backend.theme.menu-item
                    :url="'admin.user.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Users'"
                    :hasSubMenu="false" />

                <livewire:backend.theme.menu-item
                    :url="'admin.barcode.index'"
                    :icon="'ri-dashboard-line'"
                    :label="'Bar Codes'"
                    :hasSubMenu="false" />


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>