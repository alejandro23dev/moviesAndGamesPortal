<html>

<head>
    <title><?php echo BUSINESS_NAME; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!-- css --->
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/timepicker/timepicker.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/plugins/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- js --->
    <script>
        var hostUrl = "<?php echo base_url('public/assets/'); ?>";
    </script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/scripts.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/fslightbox/fslightbox.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/typedjs/typedjs.bundle.js'); ?>"></script>


    <script src="<?php echo base_url('public/assets/js/custom/apps/ecommerce/customers/listing/listing.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/widgets.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/widgets.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/apps/chat/chat.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/utilities/modals/upgrade-plan.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/utilities/modals/create-app.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/utilities/modals/users-search.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/timepicker/timepicker.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>

    <script>
        function simpleAlert(icon, title) {
            Swal.fire({
                position: "top-end",
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 2500
            });
        }

        function globalError() {
            Swal.fire({
                title: 'Error',
                text: 'An error has ocurred',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    </script>
</head>
<div class="container">
    <div id="modal"></div>
    <div id="view">
        <?php echo view($page); ?>
    </div>
</div>