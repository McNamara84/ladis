<?php $__env->startSection('title', 'Eingabeformular Device'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Lasergerät hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        <form>

                            <!-- Ensures that the form text in small input fields is displayed in a single line -->
                            <style>
                                .form-text {
                                    white-space: nowrap;

                                }
                            </style>

                            <div class="mb-3">
                                <label for="device_name" class="form-label">Gerätename <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="device_name" name="device_name" required
                                    placeholder="Geben Sie den Namen des Lasergeräts an">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige Bezeichnung für das Lasergerät an, z.B. CL50.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="device_year" class="form-label">Gerätejahr <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="device_year" min="1900" max=""
                                    name="device_year">
                                <div class="form-text">
                                    Bitte geben Sie das Jahr des Lasergeräts vierstellig an.
                                </div>
                            </div>


                            <div class="col-md-5 mb-3">
                                <label for="device_build" class="form-label">Geräteart <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="device_build" name="device_build">
                                    <option disabled selected value="">Bitte wählen Sie die Art des Lasergeräts aus
                                    </option>
                                    <option>Glasfaser</option>
                                    <option>Spiegelarm</option>
                                </select>
                            </div>

                            <!-- Group for the size of the device -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label for="device_height" class="form-label">Höhe<span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="device_height" class="form-control" min="0" max="9999"
                                            name="device_height">
                                        <div class="form-text">
                                            Bitte geben Sie die Maße des Lasergeräts ohne Nachkommastellen in mm an.
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <label for="device_width" class="form-label">Breite <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="device_width" class="form-control" min="0" max="9999"
                                            name="device_width">
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <label for="device_depth" class="form-label">Tiefe <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="device_depth" class="form-control" min="0" max="9999"
                                            name="device_depth" required>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-2 mb-3">
                                <label for="device_weight" class="form-label">Gewicht <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="device_weight" min="0" max="99999.99"
                                    step="0.01" name="device_weight">
                                <div class="form-text">
                                    Bitte geben Sie das exakte Gewicht des Lasergeräts mit zwei Nachkommastellen in kg an.
                                </div>
                            </div>


                            <div class="col-md-2 mb-3">
                                <label for="device_fiber_length" class="form-label">Faserlänge <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="device_fiber_length" min="0" max="99999.99"
                                    step="0.01" name="device_fiber_length">
                                <div class="form-text">
                                    Bitte geben Sie die Faserlänge des Lasergeräts mit zwei Nachkommastellen in m an.
                                </div>
                            </div>


                            <div class="col-md-5 mb-3">
                                <label for="device_cooling" class="form-label">Kühlsystem <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="device_cooling" name="device_cooling">
                                    <option disabled selected value="">Bitte wählen Sie die Art des Kühlsystems aus
                                    </option>
                                    <option>Intern</option>
                                    <option>Extern</option>
                                </select>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="device_mounting" class="form-label">Tragesystem <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="device_mounting" name="device_mounting">
                                    <option disabled selected value="">Bitte wählen Sie aus
                                    </option>
                                    <option>Vorhanden</option>
                                    <option>Nicht vorhanden</option>
                                </select>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="device_automation" class="form-label">Automatisierungssystem <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="device_automation" name="device_automation">
                                    <option disabled selected value="">Bitte wählen Sie aus
                                    </option>
                                    <!-- TODO: the value options of automation is still unclear -->
                                    <option>Vorhanden</option>
                                    <option>Nicht vorhanden</option>
                                </select>
                            </div>

                            <!-- Group for the output of the device -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="device_max_output" class="form-label">Max. Stromleistung<span
                                                class="text-danger">*</span></label>
                                        <!-- TODO: The total number of digits and decimal places is unclear  -->
                                        <input type="number" id="device_max_output" class="form-control" min="0" max=""
                                            name="device_max_output">
                                        <div class="form-text">
                                            Bitte geben Sie die Stromleistung in W an.
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="device_mean_output" class="form-label">Mittelwert Stromleistung <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="device_mean_output" class="form-control" min="0" max=""
                                            name="device_mean_output">
                                    </div>



                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="device_max_wattage" class="form-label">Max. Stromverbrauch <span
                                            class="text-danger">*</span></label>
                                    <!-- TODO: The total number of digits and decimal places is unclear  -->
                                    <!-- TODO: Which Unit?  -->
                                    <input type="number" class="form-control" id="device_max_wattage" min="0" max=""
                                        name="device_max_wattage">
                                    <div class="form-text">
                                        Bitte geben Sie den Stromverbrauch des Lasergeräts in (?) an.
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label for="device_head" class="form-label">Bearbeitungskopfmodell <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="device_head" name="device_head" required
                                        placeholder="Geben Sie das Bearbeitungskopfmodell des Lasergeräts an">
                                    <div class="form-text">
                                        Bitte geben Sie eine eindeutige Bezeichnung an, z.B. Optik OS A20.
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="device_emission_source" class="form-label">Emissionsquelle <span
                                            class="text-danger">*</span></label>
                                    <!-- TODO: The values for emission_source are unclear -->
                                    <select class="form-control" id="device_emission_source" name="device_emission_source">
                                        <option disabled selected value="">Bitte wählen Sie aus
                                        </option>
                                        <option>??</option>
                                        <option>??</option>
                                    </select>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="device_beam_type" class="form-label">Laserart <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="device_beam_type" name="device_beam_type">
                                        <option disabled selected value="">Bitte wählen Sie die Laserart des Geräts aus
                                        </option>
                                        <option>Punktlaser</option>
                                        <option>Zeilenlaser</option>
                                        <option>Flächenlaser</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="device_beam_profile" class="form-label">Strahlprofil <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="device_beam_profile"
                                        name="device_beam_profile" required
                                        placeholder="Geben Sie das Strahlprofil des Lasergeräts an">
                                    <div class="form-text">
                                        Bitte geben Sie eine eindeutige Bezeichnung für das Strahlprofil an, z.B.
                                        Top-Hat-Strahlprofil.
                                    </div>
                                </div>


                                <div class="col-md-2 mb-3">
                                    <label for="device_wavelength" class="form-label">Wellenlänge <span
                                            class="text-danger">*</span></label>
                                    <!-- TODO: The total number of digits and decimal places is unclear  -->
                                    <!-- TODO: Which Unit?  -->
                                    <input type="number" class="form-control" id="device_wavelength" min="0" max=""
                                        name="device_wavelength">
                                    <div class="form-text">
                                        Bitte geben Sie die Wellenlänge des Lasergeräts in (?) an.
                                    </div>
                                </div>

                            </div>

                            <!-- Group for the spotsize of the device -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label for="device_min_spot_size" class="form-label">Min. Spotgröße<span
                                                class="text-danger">*</span></label>
                                        <!-- TODO: The total number of digits and decimal places is unclear  -->
                                        <input type="number" id="device_min_spot_size" class="form-control" min="0" max=""
                                            name="device_min_spot_size">
                                        <div class="form-text">
                                            Bitte geben Sie die Spotgrößen in mm an.
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="device_max_spot_size" class="form-label">Max. Spotgröße <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="device_max_spot_size" class="form-control" min="0" max=""
                                            name="device_max_spot_size">
                                    </div>


                                    <!-- Group for the pulse frequency of the device -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="device_min_pf" class="form-label">Min. Pulsfrequenz<span
                                                        class="text-danger">*</span></label>
                                                <!-- TODO: The total number of digits and decimal places is unclear  -->
                                                <input type="number" id="device_min_pf" class="form-control" min="0" max=""
                                                    name="device_min_pf">
                                                <div class="form-text">
                                                    Bitte geben Sie die Pulsfrequenzen in khZ an.
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="device_max_pf" class="form-label">Max. Pulsfrequenz <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="device_max_pf" class="form-control" min="0" max=""
                                                    name="device_max_pf">
                                            </div>


                                            <!-- Group for the pulse width (duration) of the device -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2 mb-3">
                                                        <label for="device_min_pw" class="form-label">Min. Pulsdauer<span
                                                                class="text-danger">*</span></label>
                                                        <!-- TODO: The total number of digits and decimal places is unclear  -->
                                                        <input type="number" id="device_min_pw" class="form-control" min="0"
                                                            max="" name="device_min_pw">
                                                        <div class="form-text">
                                                            Bitte geben Sie die Pulsdauer in ns an.
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 mb-3">
                                                        <label for="device_max_pw" class="form-label">Max. Pulsdauer <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" id="device_max_pw" class="form-control" min="0"
                                                            max="" name="device_max_pw">
                                                    </div>


                                                    <!-- Group for the scan width of the device -->
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-2 mb-3">
                                                                <label for="device_min_scan_width" class="form-label">Min.
                                                                    Scanbreite<span class="text-danger">*</span></label>
                                                                <!-- TODO: The total number of digits and decimal places is unclear  -->
                                                                <input type="number" id="device_min_scan_width"
                                                                    class="form-control" min="0" max=""
                                                                    name="device_min_scan_width">
                                                                <div class="form-text">
                                                                    Bitte geben Sie die Scanbreite in mm an.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 mb-3">
                                                                <label for="device_max_scan_width" class="form-label">Max.
                                                                    Scanbreite <span class="text-danger">*</span></label>
                                                                <input type="number" id="device_max_scan_width"
                                                                    class="form-control" min="0" max=""
                                                                    name="device_max_scan_width">
                                                            </div>


                                                            <!-- Group for the focal length of the device -->
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-2 mb-3">
                                                                        <label for="device_min_focal_length"
                                                                            class="form-label">Min. Brennweite<span
                                                                                class="text-danger">*</span></label>
                                                                        <!-- TODO: The total number of digits and decimal places is unclear  -->
                                                                        <!-- TODO: Which Unit?  -->
                                                                        <input type="number" id="device_min_focal_length"
                                                                            class="form-control" min="0" max=""
                                                                            name="device_min_focal_length">
                                                                        <div class="form-text">
                                                                            Bitte geben Sie die Brennweite in ?? an.
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 mb-3">
                                                                        <label for="device_max_focal_length"
                                                                            class="form-label">Max. Brennweite<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="number" id="device_max_focal_length"
                                                                            class="form-control" min="0" max=""
                                                                            name="device_max_focal_length">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5 mb-3">
                                                                <label for="device_has_lens" class="form-label">Linsenstärke
                                                                    <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="device_has_lens"
                                                                    name="device_has_lens">
                                                                    <option disabled selected value="">Bitte wählen
                                                                        Sie die Linsenstärke aus
                                                                    </option>
                                                                    <option>80</option>
                                                                    <option>150</option>
                                                                    <option>250</option>
                                                                    <option>380</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="device_description"
                                                                    class="form-label">Beschreibung</label>
                                                                <textarea class="form-control" id="device_description"
                                                                    name="device_description" required rows="3" required
                                                                    placeholder="Geben Sie weitere Beschreibungen des Lasergeräts an"></textarea>
                                                                <div class="form-text">
                                                                    Optional, falls weitere Beschreibungen des Lasergeräts
                                                                    vorliegen.
                                                                </div>
                                                            </div>



                                                        </div>








                                                    </div>

                                                    <!-- Group container for the two buttons -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="reset" class="btn btn-danger">
                                                            <i class="bi bi-plus-circle"></i> Werte zurücksetzen
                                                        </button>



                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-plus-circle"></i> Gerät hinzufügen
                                                        </button>


                                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Maya/GitHub/cleanup-laser-database/resources/views/inputform_device.blade.php ENDPATH**/ ?>