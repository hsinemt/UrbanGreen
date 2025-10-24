<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gestion des Espaces Verts</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('back.home')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Espaces Verts</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Liste des Espaces Verts</h5>
                                <a href="<?php echo e(route('admin.green-spaces.create')); ?>" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i> Ajouter un Espace Vert
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Localisation</th>
                                            <th>Surface</th>
                                            <th>Type</th>
                                            <th>Disponibilité</th>
                                            <th>Nombre de Plantes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $greenSpaces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $greenSpace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($greenSpace->id); ?></td>
                                                <td><?php echo e($greenSpace->name); ?></td>
                                                <td><?php echo e($greenSpace->location); ?></td>
                                                <td><?php echo e($greenSpace->surface); ?> m²</td>
                                                <td><?php echo e($greenSpace->type ?? 'N/A'); ?></td>
                                                <td>
                                                    <?php if($greenSpace->availability): ?>
                                                        <span class="badge bg-success">Disponible</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Occupé</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo e($greenSpace->plants_count); ?> plantes</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?php echo e(route('admin.green-spaces.show', $greenSpace)); ?>" class="btn btn-sm btn-info">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('admin.green-spaces.edit', $greenSpace)); ?>" class="btn btn-sm btn-warning">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="<?php echo e(route('admin.green-spaces.destroy', $greenSpace)); ?>" method="POST" 
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet espace vert ?')" 
                                                              style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Aucun espace vert trouvé</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                <?php echo e($greenSpaces->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/dashboard/components/green-spaces/index.blade.php ENDPATH**/ ?>