<?php echo view('admin/nav/navbar'); ?>
<!-- CARDS SECTION -->
<div class="row mt-6">
    <a href="<?php echo base_url('Admin/movies'); ?>" class="col-12 col-lg-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <i class="bi bi-film fs-1 text-primary"></i>
            <h4 class="text-black-50">Mis Peliculas</h4>
        </div>
    </a>
    <a href="<?php echo base_url('Admin/games'); ?>" class="col-12 col-lg-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <i class="bi bi-controller fs-1 text-primary"></i>
            <h4 class="text-muted">Mis Juegos</h4>
        </div>
    </a>
    <a href="<?php echo base_url('Admin/sales'); ?>" class="col-12 col-lg-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <i class="fa fa-money-bills fs-1 text-primary"></i>
            <h4 class="text-muted">Mis Ventas</h4>
        </div>
    </a>
</div>