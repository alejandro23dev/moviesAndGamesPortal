<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false" style="">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="../../demo1/dist/index.html" class="d-lg-none">
                            <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/default-small.svg'); ?>" class="h-30px">
                        </a>
                    </div>
                    <!-- TOP BAR -->
                    <?php echo view('main/topBar'); ?>
                    <!-- END TOP BAR -->
                </div>
            </div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!-- LEFT BAR -->
                <?php echo view('main/leftSideBar'); ?>
                <!-- END LEFT BAR -->
                <!-- MAIN CONTENT -->
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="ratio ratio-16x9">
                                <video id="main-video" class="card-img-top shadow" controls>
                                    <source src="<?php echo base_url('public/assets/media/videos/sample video.mp4') ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="col-12">
                            <h1 class="mt-4"><?php echo $movie[0]->name; ?></h1>
                            <p class="mt-4 text-gray-500">Publicada el <?php echo date('d M Y', strtotime($movie[0]->uploadDate)); ?> || hace <?php $movieDate = date('Y-m-d', strtotime($movie[0]->uploadDate));
                                                                                                                                                $movieDateTime = new DateTime($movieDate);
                                                                                                                                                $currentDateTime = new DateTime();
                                                                                                                                                $interval = date_diff($movieDateTime, $currentDateTime);
                                                                                                                                                $years = $interval->y;
                                                                                                                                                $months = $interval->m;
                                                                                                                                                if ($years > 0) {
                                                                                                                                                    echo $years . " años";
                                                                                                                                                } else {
                                                                                                                                                    echo $months . " meses";
                                                                                                                                                }; ?></p>
                            <p class="mt-4"><?php echo $movie[0]->description; ?></p>
                            <div class="mt-4 d-flex justify-content-start gap-2">
                                <button class="btn btn-sm btn-secondary shadow rounded"><i class="bi bi-hand-thumbs-up"></i> Me gusta</button>
                                <button class="btn btn-sm btn-secondary shadow rounded"><i class="bi bi-download"></i> Descargar</button>
                                <button class="btn btn-sm btn-secondary shadow rounded"><i class="bi bi-chat-dots"></i> Comentar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
        </div>
    </div>
</body>

<style>
    .main-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .video-container {
        width: 100%;
        padding-bottom: 56.25%;
        position: relative;
    }

    #main-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .video-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin-top: 20px;
    }

    .video-title {
        margin: 0;
        margin-bottom: 10px;
    }

    .video-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .btn-like,
    .btn-download,
    .btn-comment {
        cursor: pointer;
    }
</style>