<?php $__env->startSection('title', 'Eingabeformular Device'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Material hinzufügen</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('inputform_material.store')); ?>">
                            <?php echo csrf_field(); ?>

                            <?php if(session('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(session('error')); ?>

                                </div>
                            <?php endif; ?>

                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>

                            <div class="mb-5">
                                <label for="material_parent_id" class="form-label">Übergeordnetes Material</label>
                                <select class="form-select" id="material_parent_id" name="material_parent_id">
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($material->id); ?>"><?php echo e($material->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="form-text">
                                    Ohne Auswahl wird das neue Material als eigenständiges Material angelegt.
                                </div>
                                <?php $__errorArgs = ['material_parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-5">
                                <label for="material_name" class="form-label">Material <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="material_name" name="material_name"
                                    value="<?php echo e(old('material_name')); ?>" required placeholder="Materialname" />
                                <div class="form-text">
                                    Bitte wählen Sie ein Material aus der Liste.
                                </div>
                                <?php $__errorArgs = ['material_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Abbrechen</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Maya/GitHub/cleanup-laser-database/resources/views/inputform_material.blade.php ENDPATH**/ ?>