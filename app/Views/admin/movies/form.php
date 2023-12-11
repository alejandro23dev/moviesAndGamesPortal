<?php echo view('admin/nav/navbar'); ?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_movie_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Imagen</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <style>
                            .image-input-placeholder {
                                background-image: url('svg/avatars/blank.svg');
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url('svg/avatars/blank-dark.svg');
                            }
                        </style>
                        <!-- Image Input -->
                        <div id="kt_image_input_profile" class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(http://barberapp/public/assets/media/svg/avatars/blank.svg)">
                            <!-- Image Preview -->
                            <?php if (empty($movie['image'])) { ?>
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo base_url('public/assets/media/svg/avatars/blank.svg'); ?>)"></div>
                            <?php } else { ?>
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(data:image/png;base64,<?php echo base64_encode($movie['image']); ?>)"></div>
                            <?php } ?>
                            <!-- Edit Button -->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cambiar Avatar">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                <!-- Inputs -->
                                <input id="avatar" type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove">

                            </label>
                            <!-- Cancel button -->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancelar Avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!-- Remove button -->
                            <?php if (!empty($movie['image'])) { ?>
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.prof_remove_avatar'); ?>">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                            <?php } ?>
                        </div>
                        <div class="text-muted fs-7 mt-2">Solo archivos .png, .jpg y .jpeg</div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Precios</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="col-12">
                            <label class="form-label">Precio</label>
                            <input type="text" id="moviePrice" class="form-control mb-2 required focus number" value="<?php echo @$movie['price']; ?>" />
                        </div>
                        <div class="col-12 mt-6">
                            <label class="form-label">Precio De Descuento</label>
                            <input type="text" id="movieDiscountPrice" class="form-control mb-2 focus number" value="<?php echo @$movie['discountPrice']; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_movie_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" id="movieName" class="form-control mb-2 required focus" value="<?php echo @$movie['name']; ?>" />
                                        <div class="text-muted fs-7">Se recomienda de que el nombre sea único.</div>
                                    </div>
                                    <div>
                                        <label class="form-label">Descripción</label>
                                        <textarea id="movieDescription" class="form-control required mb-2"><?php echo @$movie['description']; ?></textarea>
                                        <div class="text-muted fs-7">Realice una descripción de la pelicula para mejor visibilidad.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Detalles de la Pelicula</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 row">
                                        <div class="col-12 col-lg-3">
                                            <label class="form-label">Duración</label>
                                            <input type="time" id="sel-time" class="form-control mb-2 required focus" value="<?php echo @$movie['time']; ?>" />
                                            <div class="text-muted fs-7">Duración de la Pelicula.</div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <label class="form-label">Estado</label>
                                            <select id="sel-status" class="form-select  mb-2" data-control="select2" data-hide-search="true" data-placeholder="Seleccione una opción">
                                                <option value="" hidden></option>
                                                <option value="1" <?php if (@$movie['status'] == 1) echo "selected hidden"; ?>>Lista para la venta</option>
                                                <option value="0" <?php if (@$movie['status'] == 0) echo "selected hidden"; ?>>Pronto a la venta</option>
                                            </select>
                                            <div class="text-muted fs-7">Seleccione un estado.</div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label class="form-label">Categoría</label>
                                            <select id="sel-category" class="form-select  mb-2" data-control="select2" data-placeholder="Seleccione una opción">
                                                <option value="<?php echo @$movie['categoryID']; ?>" hidden><?php echo @$movie['categoryName']; ?></option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-muted fs-7 mb-7">Añada su pelicula a una categoría.</div>
                                            <a href="#" id="btn-createCategory" class="btn btn-light-primary btn-sm mb-10">
                                                <i class="ki-duotone ki-plus fs-2"></i>Crear nueva categoría</a>
                                        </div>
                                        <?php if (@$edit) { ?>
                                            <div class="col-12 col-lg-2 text-center">
                                                <label class="form-label">Descargas <i class="bi bi-cloud-arrow-down-fill text-primary fs-5"></i></label>
                                                <div class="text-center mt-2">
                                                    <span class="text-gray-500 fs-4"><?php
                                                                                        if (strlen($movie['downloads']) <= 3) echo $movie['downloads'];
                                                                                        elseif (strlen($movie['downloads']) > 3 && strlen($movie['downloads']) <= 4) echo $movie['downloads'][0] . '.' . $movie['downloads'][1], 'K';
                                                                                        elseif (strlen($movie['downloads']) > 4 && strlen($movie['downloads']) <= 5) echo $movie['downloads'][0] . '' . $movie['downloads'][1]  . '.' . $movie['downloads'][2], 'K';
                                                                                        elseif (strlen($movie['downloads']) > 5 && strlen($movie['downloads']) <= 6) echo $movie['downloads'][0] . '' . $movie['downloads'][1]  . '' . $movie['downloads'][2] . '.' . $movie['downloads'][3], 'K';
                                                                                        elseif (strlen($movie['downloads']) > 6 && strlen($movie['downloads']) <= 7) echo $movie['downloads'][0] . '.' . $movie['downloads'][1], 'M';
                                                                                        elseif (strlen($movie['downloads']) > 7 && strlen($movie['downloads']) <= 8) echo $movie['downloads'][0] . '' . $movie['downloads'][1]  . '.' . $movie['downloads'][2], 'M';
                                                                                        elseif (strlen($movie['downloads']) > 8 && strlen($movie['downloads']) <= 9) echo $movie['downloads'][0] . '' . $movie['downloads'][1]  . '' . $movie['downloads'][2] . '.' . $movie['downloads'][3], 'M';
                                                                                        elseif (strlen($movie['downloads']) > 9) echo '+', $movie['downloads'][0], 'MM';
                                                                                        ?></span>
                                                </div>
                                            </div>
                                        <?php }; ?>

                                    </div>
                                </div>
                                <div class="text-center justify-content-around row">
                                    <?php if (@$edit) : ?>
                                        <a href="<?php echo base_url('Admin/movies'); ?>" class="btn btn-dark-50  shadow rounded col-12 col-lg-3 m-3">Descartar</a>
                                        <button type="button" id="btn-update" data-id="<?php echo @$movie['id']; ?>" class="btn btn-primary shadow rounded col-12 col-lg-3 m-3">Actualizar Cambios</button>
                                    <?php else : ?>
                                        <a href="<?php echo base_url('Admin/movies'); ?>" class="btn btn-dark-50 shadow rounded col-12 col-lg-3 m-3">Descartar</a>
                                        <button type="button" id="btn-save" class="btn btn-primary shadow rounded col-12 col-lg-3 m-3">Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    // Photo Procedure
    var avatarProfile = new KTImageInput.createInstances();
    var imageInputElement = document.querySelector("#kt_image_input_profile");
    var imageInput = KTImageInput.getInstance(imageInputElement);

    imageInput.on("kt.imageinput.change", function() { // Upload On Change
        let formData = new FormData();
        formData.append('file', $("#avatar")[0].files[0]);
        formData.append('id', "<?php echo @$movie['id']; ?>");
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/uploadMoviePhoto'); ?>",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.error === 0) {

                } else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "<?php echo base_url('authentication/signInAdmin?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    });

    imageInput.on("kt.imageinput.remove", function() { // Remove On Delete
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/removeMoviePhoto'); ?>",
            data: {
                'id': "<?php echo @$movie['id']; ?>"
            },
            dataType: "json",
            success: function(response) {
                if (response.error === 0) {

                } else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "<?php echo base_url('authentication/signInAdmin?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    });

    // End Photo Procedure

    Inputmask("9999.99", {
        "numericInput": true
    }).mask("#moviePrice");

    Inputmask("9999.99", {
        "numericInput": true
    }).mask("#movieDiscountPrice");

    $('#btn-createCategory').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/showViewModalMovieCreateCategory'); ?>",
            dataType: "html",
            success: function(response) {
                $('#modal').html(response);
            }
        });
    });

    $('#btn-update').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/movieActions'); ?>",
                data: {
                    'id': $(this).attr('data-id'),
                    'action': 'update',
                    'name': $('#movieName').val(),
                    'description': $('#movieDescription').val(),
                    'price': $('#moviePrice').val(),
                    'discountPrice': $('#movieDiscountPrice').val(),
                    'time': $('#sel-time').val(),
                    'status': $('#sel-status').val(),
                    'category': $('#sel-category').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            Swal.fire({
                                title: 'Exito',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                window.location.href = "<?php echo base_url('Admin/movies'); ?>";
                            }, 2000);
                            break;
                        case 'INVALID_PRICE':
                            $('#moviePrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-update').removeAttr('disabled');
                            break;
                        case 'INVALID_DISCOUNT_PRICE':
                            $('#movieDiscountPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-update').removeAttr('disabled');
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-update').removeAttr('disabled');
                    Swal.fire({
                        title: 'Ha ocurrido un error',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#btn-update').removeAttr('disabled');
            Swal.fire({
                title: 'Complete la Información',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    $('#btn-save').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/createMovie'); ?>",
                data: {
                    'name': $('#movieName').val(),
                    'description': $('#movieDescription').val(),
                    'price': $('#moviePrice').val(),
                    'discountPrice': $('#movieDiscountPrice').val(),
                    'status': $('#sel-status').val(),
                    'time': $('#sel-time').val(),
                    'category': $('#sel-category').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            Swal.fire({
                                title: 'Exito',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('input').val('');
                            $('select').val('');
                            $('textarea').val('');
                            $('#btn-save').removeAttr('disabled');
                            break;
                        case 'INVALID_PRICE':
                            $('#moviePrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-save').removeAttr('disabled');
                            break;
                        case 'INVALID_DISCOUNT_PRICE':
                            $('#movieDiscountPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-save').removeAttr('disabled');
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-save').removeAttr('disabled');
                    Swal.fire({
                        title: 'Ha ocurrido un error',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#btn-save').removeAttr('disabled');
            Swal.fire({
                title: 'Complete la Información',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });


    $('.number').on('input', function() { // Input Only Number
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
</script>