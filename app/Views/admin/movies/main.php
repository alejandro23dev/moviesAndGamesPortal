<?php echo view('admin/nav/navbar'); ?>
<div class="row m-5">
    <div class="col-12 col-lg-auto m-5">
        <a href="<?php echo base_url('Admin/main'); ?>" class="btn btn-primary"><i class="bi bi-house-fill mb-1 text-white"></i> Regresar</a>
    </div>
    <div class="col-12 col-lg-auto m-5">
        <a href="<?php echo base_url('Admin/showViewAddMovie'); ?>" class="btn btn-primary"><i class="bi bi-cloud-upload-fill text-white"></i> Subir Pelicula</a>
    </div>
</div>
<div class="card mb-5 mb-xl-10 shadow">
    <div class="card-body border-top p-9">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table id="dtMovies" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center">Vista Previa</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Duración</th>
                            <th class="text-center">Tamaño</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Descargas</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movies as $m) : ?>
                            <tr>
                                <td class="text-center">
                                    <?php if (empty($m['image'])) { ?>
                                        <i class="bi bi-card-image"></i>
                                    <?php } else { ?>
                                        <div class="symbol"><img src="data:image/png;base64,<?php echo base64_encode($m['image']); ?>" class="h-100px w-100px" alt="Imagen"> </div>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $m['name']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $m['description']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $m['time']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $m['weight']; ?>
                                </td>
                                <td class="text-center">
                                    $<?php echo $m['price']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $m['categoryName']; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($m['status'] == 1) echo "<i class='bi bi-broadcast text-success fs-2'></i>";
                                    else echo "<i class='bi bi-broadcast text-danger fs-2'></i>" ?>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-500"><?php
                                                                if (strlen($m['downloads']) <= 3) echo $m['downloads'];
                                                                elseif (strlen($m['downloads']) > 3 && strlen($m['downloads']) <= 4) echo $m['downloads'][0] . '.' . $m['downloads'][1], 'K';
                                                                elseif (strlen($m['downloads']) > 4 && strlen($m['downloads']) <= 5) echo $m['downloads'][0] . '' . $m['downloads'][1]  . '.' . $m['downloads'][2], 'K';
                                                                elseif (strlen($m['downloads']) > 5 && strlen($m['downloads']) <= 6) echo $m['downloads'][0] . '' . $m['downloads'][1]  . '' . $m['downloads'][2] . '.' . $m['downloads'][3], 'K';
                                                                elseif (strlen($m['downloads']) > 6 && strlen($m['downloads']) <= 7) echo $m['downloads'][0] . '.' . $m['downloads'][1], 'M';
                                                                elseif (strlen($m['downloads']) > 7 && strlen($m['downloads']) <= 8) echo $m['downloads'][0] . '' . $m['downloads'][1]  . '.' . $m['downloads'][2], 'M';
                                                                elseif (strlen($m['downloads']) > 8 && strlen($m['downloads']) <= 9) echo $m['downloads'][0] . '' . $m['downloads'][1]  . '' . $m['downloads'][2] . '.' . $m['downloads'][3], 'M';
                                                                elseif (strlen($m['downloads']) > 9) echo '+', $m['downloads'][0], 'MM';
                                                                ?></span> <i class="bi bi-cloud-arrow-down-fill text-primary fs-5"></i>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-secondary btn-download action" data-id="<?php echo $m['id']; ?>" title="Descargar"><i class="bi bi-cloud-download-fill text-primary fs-6"></i></button>
                                    <button type="button" class="btn btn-sm btn-secondary btn-edit action" data-id="<?php echo $m['id']; ?>" title="Editar Pelicula"><i class="fa fa-edit text-warning fs-6"></i></button>
                                    <button type="button" class="btn btn-sm btn-secondary btn-delete action" data-id="<?php echo $m['id']; ?>" title="Eliminar Pelicula"><i class="fa fa-trash text-danger fs-6"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var dtMovies = $('#dtMovies').DataTable({ // DATA TABLE
        dom: 'RfrtlpiB',
        processing: false,
        order: [
            [1, 'asc']
        ],
        language: {
            search: "",
            searchPlaceholder: 'Search'
        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
    });

    dtMovies.on('click', '.action', function() {
        if ($(this).hasClass('btn-edit')) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/movieActions'); ?>",
                data: {
                    'id': $(this).attr("data-id"),
                    'action': 'edit'
                },
                dataType: "html",
                success: function(response) {
                    $('#view').html(response);
                }
            });
        } else if ($(this).hasClass('btn-delete')) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove!',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Admin/movieActions'); ?>",
                        data: {
                            'id': $(this).attr("data-id"),
                            'action': 'delete'
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response) {
                                case true:
                                    Swal.fire({
                                        title: 'Exito',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);

                                    break;
                            }
                        }
                    });
                }
            });
        } else if ($(this).hasClass('btn-download')) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/movieActions'); ?>",
                data: {
                    'id': $(this).attr("data-id"),
                    'action': 'download'
                },
                dataType: "json",
                success: function(response) {
                   
                }
            });
        }
    });
</script>