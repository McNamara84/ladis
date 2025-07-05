<?php $__env->startSection('title', $pageTitle); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-primary">Erweiterte Suche</h1>
                        <form>

                            <div class="mb-3">
                                <label for="federal_state_id" class="form-label">Bundesland</label>
                                <select class="form-control" id="federal_state_id" name="federal_state_id">
                                    <option disabled selected value="">Wählen Sie das Bundesland aus</option>
                                    <option>Berlin</option>
                                    <option>Brandenburg</option>
                                    <option>Hamburg</option>
                                    <option>Bremen</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="project_name" class="form-label"> Projektname</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    placeholder="Geben Sie den Namen des Projekts an">
                            </div>

                            <div class="mb-3">
                                <label for="person_name" class="form-label"> Projektleitung</label>
                                <input type="text" id="person_name" name="person_name" class="form-control"
                                    placeholder="Geben Sie die Projektleitung an">
                            </div>

                            <div class="mb-3">
                                <label for="institution_id" class="form-label">Institution</label>
                                <select class="form-control" id="institution_id" name="institution_id" size="3">
                                    <option disabled selected value="">Wählen Sie den Namen der Institution aus</option>
                                    <option>FH Potsdam</option>
                                    <option>Institution2</option>
                                    <option>Institution3</option>
                                    <option>Institution4</option>
                                    <option>Institution5</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="device_id" class="form-label">Gerätename
                                    <select class="form-control" id="device_id" name="device_id">
                                        <option disabled selected value="">Wählen Sie den Namen des Lasergeräts aus
                                        </option>
                                        <option>CL20</option>
                                        <option>CL50</option>
                                        <option>Infinito Laser p/n I054C1</option>
                                        <option>Thunder Compact</option>
                                        <option>Soliton LT300</option>
                                        <option>Smart 300</option>
                                        <option>Sonstiges</option>
                                    </select>
                            </div>

                            <div class="mb-3">
                                <label for="material_id" class="form-label">Material</label>
                                <select class="form-control" id="material_id" name="material_id" size="3">
                                    <option disabled selected value="">Wählen Sie das Material aus</option>
                                    <option>Holz</option>
                                    <option>Stein</option>
                                    <option>Material2</option>
                                    <option>Material3</option>
                                    <option>Material4</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg class="bi" width="16" height="16" aria-hidden="true">
                                        <use xlink:href="#bi-search"></use>
                                    </svg> Suchen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Maya/GitHub/cleanup-laser-database/resources/views/advanced_search.blade.php ENDPATH**/ ?>