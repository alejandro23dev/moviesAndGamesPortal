<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="../../demo1/dist/index.html">
            <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/default-dark.svg'); ?>" class="h-25px app-sidebar-logo-default">
            <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/default-small.svg'); ?>" class="h-20px app-sidebar-logo-minimize">
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true" style="height: 768px;">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#sidebar_movies" data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Peliculas</span>
                        </div>
                    </div>
                    <?php foreach ($movieCategories as $mc) { ?>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-address-book fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title"><?php echo $mc->name; ?></span>
                                <span class="menu-arrow"></span>
                            </span>

                            <?php foreach ($movies as $m) { ?>
                                <?php if ($m->categoryID == $mc->id) { ?>
                                    <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <a class="menu-link movie" data-movie-id="<?php echo $m->id; ?>" href="<?php echo base_url('Home/movie?movieID=') . '' . $m->id; ?>">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title"><?php if ($m->status == 1) echo $m->name, '<i class="bi bi-broadcast text-success fs-4"></i>';
                                                                            else echo $m->name, '<i class="bi bi-broadcast text-danger fs-4"></i>'; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php foreach ($movies as $m) { ?>
                                <?php if ($m->categoryID != $mc->id) { ?>
                                    <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">No hay peliculas de esta categoría</span>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php break;
                            } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#sidebar_games" data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Juegos</span>
                        </div>
                    </div>
                    <?php foreach ($gameCategories as $gc) { ?>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-address-book fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title"><?php echo $gc->name; ?></span>
                                <span class="menu-arrow"></span>
                            </span>

                            <?php foreach ($games as $g) { ?>
                                <?php if ($g->categoryID == $gc->id) { ?>
                                    <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <a class="menu-link game" href="#">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title"><?php if ($g->status == 1) echo $g->name, '<i class="bi bi-broadcast text-success fs-4"></i>';
                                                                            else echo $g->name, '<i class="bi bi-broadcast text-danger fs-4"></i>'; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php foreach ($games as $g) { ?>
                                <?php if ($g->categoryID != $gc->id) { ?>
                                    <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">No hay Juegos de esta categoría</span>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php break;
                            } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--FOOTER-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="https://preview.keenthemes.com/html/metronic/docs" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" data-bs-original-title="200+ in-house components and 3rd-party plugins" data-kt-initialized="1">
            <span class="btn-label"><?php echo BUSINESS_NAME; ?> &copy<?php echo date('Y'); ?></span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--FOOTER-->
</div>