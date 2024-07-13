<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-white active" key="t-menu"><i class="bx bx-collection"></i> Navigation</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboardst">Dashboard</span>
                    </a>
                </li>
                @role('Super Admin|Admin')
                <li>
                    <a href="{{ route('admin.menu.index') }}" class="waves-effect">
                        <i class="bx bx-menu"></i>
                        <span key="t-main-menu">Main Menu</span>
                    </a>
                </li>
                @endrole
                @role('Super Admin|Admin')
                <li>
                    <a href="{{ route('admin.banner.index') }}" class="waves-effect">
                        <i class="bx bx-slider-alt"></i>
                        <span key="t-banner">Banner</span>
                    </a>
                </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="{{ route('admin.customer.index') }}" class="waves-effect">
                            <i class="bx bxs-user-pin"></i>
                            <span key="t-customer">Customer</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="{{ route('admin.partner.index') }}" class="waves-effect">
                            <i class="bx bxs-user-pin"></i>
                            <span key="t-customer">Partner</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-report"></i>
                            <span key="t-reports">Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.courier.report') }}" key="t-courier-report">Courier Report</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.report') }}" key="t-user-report">User Report</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.stock.report') }}" key="t-stock">Stock Report</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cart-alt"></i>
                            <span key="t-products">Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.product.create') }}" key="t-new-product">Add New Product</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.index') }}" key="t-all-product">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.category.index') }}" key="t-product-category">Category</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.feature.category.index') }}" key="t-feature-category">Feature Category</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.color.index') }}" key="t-product-color">Color</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.size.index') }}" key="t-product-size">Size</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cart-alt"></i>
                            <span key="t-products">Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.product.create') }}" key="t-new-product">Add New Product</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.partner.product') }}" key="t-all-product">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.category.index') }}" key="t-product-category">Category</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.feature.category.index') }}" key="t-feature-category">Feature Category</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.color.index') }}" key="t-product-color">Color</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.size.index') }}" key="t-product-size">Size</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-stock">Stock Manger</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.supplier.index') }}" key="t-supplier">Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.stock.index') }}" key="t-stock">Stock</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.stock.purchase') }}" key="t-purchase">Purchase</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="{{ route('admin.tag.index') }}" class="waves-effect">
                            <i class="bx bx-purchase-tag-alt"></i>
                            <span key="t-tag">Tag</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-truck"></i>
                            <span key="t-courier">Courier</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.courier.index') }}" key="t-courier">Courier</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.courier.city.index') }}" key="t-courier-city">City</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.courier.zone.index') }}" key="t-courier-zone">Zone</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.courier.order.show', 1) }}" key="t-courier-return">Courier
                                    Return</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-user">User</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.user.index') }}" key="t-user">User</a>
                            </li>
                            @role('Super Admin')
                                <li>
                                    <a href="{{ route('admin.permission.index') }}" key="t-permission">Permission</a>
                                </li>
                            @endrole
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="{{ route('admin.status.order.list', 1) }}" class="waves-effect">
                            <i class="bx bx-shopping-bag"></i>
                            <span key="t-invocie">Order</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager|User')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bxs-group'></i>
                            <span key="t-invocie">Electrician</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('backend.electrician') }}" key="t-user">All Electrician</a>
                            </li>
                            @role('Super Admin')
                                <li>
                                    <a href="{{ route('backend.electrician.category') }}" key="t-permission">Category</a>
                                </li>
                            @endrole
                        </ul>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="{{ route('admin.order.pending.invoice.page') }}" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span key="t-invocie">Invoice</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="{{ route('admin.order.delivery.page') }}" class="waves-effect">
                            <i class="bx bxs-calendar-check"></i>
                            <span key="t-delivered">Delivered</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="{{ route('admin.subscriber.all') }}" class="waves-effect">
                            <i class="bx bx-envelope"></i>
                            <span key="t-subscriber">Subscriber</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="{{ route('admin.page.index') }}" class="waves-effect">
                            <i class="bx bxs-detail"></i>
                            <span key="t-page">Page</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin|Manager')
                    <li>
                        <a href="{{ route('admin.support.message.index') }}" class="waves-effect">
                            <i class="bx bx-support"></i>
                            <span key="t-support-message">Support Message</span>
                        </a>
                    </li>
                @endrole
                @role('Super Admin|Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-setting">Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('admin.setting.general') }}" key="t-general">General</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sms') }}" key="t-sms">SMS Setting</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.setting.thanks.note') }}" key="t-thanks-note">Thanks Note</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.city.index') }}" key="t-city">City</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.setting.social') }}" key="t-social">Social Links</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.analytic') }}" key="t-analytics">Analytics</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.contact.info') }}" key="t-contactinfo">Contact Information</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.static.banner.index') }}" key="t-static-banner">Static Banner </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.service.ads.index') }}" key="t-service-ads">3 Service</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.order-status.index') }}" key="t-order-status">Order Status</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                <li>
                    <a href="{{ route('web.home') }}" target="_blank" class="waves-effect">
                        <i class="bx bx-planet text-danger"></i>
                        <span key="t-visit" class="text-danger">Visit Website</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
