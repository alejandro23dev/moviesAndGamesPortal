<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url('<?php echo base_url('public/assets/media/auth/bg4.jpg'); ?>');
        }

        [data-bs-theme="dark"] body {
            background-image: url('<?php echo base_url('public/assets/media/auth/bg4-dark.jpg'); ?>');
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">

        <div class="d-flex flex-column-fluid justify-content-center justify-content-center p-12 p-lg-20">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <div class="form w-100">
                        <div class="text-center mb-11">
                            <!-- Logo -->
                            <span class="mb-7">
                                <img alt="Logo" src="<?php echo base_url('public/assets/media/img/settings.png') ?>" class="w-25" />
                            </span>
                            <h1 class="text-dark fw-bolder mb-3">Espacio Reservado para el Administrador</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Introduzca sus credenciales</div>
                        </div>
                        <!-- Input Access Password -->
                        <div class="fv-row mb-8">
                            <!--Input Password-->
                            <input type="password" id="txt-pass<?php echo $uniqid; ?>" class="form-control bg-transparent" />
                        </div>
                        <!-- Button Sig In Admin -->
                        <div class="d-grid mb-10">
                            <button type="button" id="btn-login<?php echo $uniqid; ?>" class="btn btn-primary">Iniciar Sesion</button>
                        </div>
                        <div class="d-grid mb-10 text-center">
                            <a href="<?php echo base_url('/'); ?>" class="link-primary">Ir a Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-login<?php echo $uniqid; ?>').on('click', function() { // Submit
        let password = $('#txt-pass<?php echo $uniqid; ?>').val();
        if (password === "") {
            $('#txt-pass<?php echo $uniqid; ?>').addClass('is-invalid');
            simpleAlert("warning", "Contaseña Vacía");
        } else {
            $('#btn-login<?php echo $uniqid; ?>').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Authentication/signInProcess'); ?>",
                data: {
                    'password': password,
                    'user': 'Admin'
                },
                dataType: "json",
                success: function(response) {
                    if (response.error === 0) {
                        window.location.href = "<?php echo base_url('Admin/main'); ?>"
                    } else {
                        simpleAlert("error", response.msg);
                        $('#txt-pass<?php echo $uniqid; ?>').addClass('is-invalid');
                        $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                },
                error: function(error) {
                    globalError();
                    $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                }
            });
        }
    });

    $('#txt-pass<?php echo $uniqid; ?>').on('input', function() {
        let value = $(this).val();
        if (value === "")
            $(this).addClass('is-invalid');
        else
            $(this).removeClass('is-invalid');
    });

</script>