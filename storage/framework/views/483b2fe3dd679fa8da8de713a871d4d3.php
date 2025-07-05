<?php $__env->startSection('title', 'Benutzerverwaltung'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col">
                <h1 class="h3 mb-0">Benutzerverwaltung</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Erstellt am</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->created_at->format('d.m.Y H:i')); ?></td>
                        <td>
                            <?php if($user->id !== 1): ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser<?php echo e($user->id); ?>">
                                    Löschen
                                </button>
                                <div class="modal fade" id="deleteUser<?php echo e($user->id); ?>" tabindex="-1" aria-labelledby="deleteUser<?php echo e($user->id); ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteUser<?php echo e($user->id); ?>Label">Account löschen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                            </div>
                                            <div class="modal-body">
                                                Soll der Account <strong><?php echo e($user->name); ?></strong> wirklich gelöscht werden?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                <form method="POST" action="<?php echo e(route('user-management.destroy', $user->id)); ?>" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Löschen</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="col-auto text-center">
            <a href="<?php echo e(route('user-management.create')); ?>" class="btn btn-primary">Neuen Account erstellen</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Maya/GitHub/cleanup-laser-database/resources/views/user_management.blade.php ENDPATH**/ ?>