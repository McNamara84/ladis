<div class="border p-3 bg-body-secondary rounded">
    <h2 class="h5">{{ __("Filter") }}</h2>
    <form method="GET" action="{{ route('search_results') }}">
        <input type="hidden" name="advanced" value="{{ request('advanced') }}">
        <input type="hidden" name="q" value="{{ request('q') }}">
        <input type="hidden" name="institution_id" value="{{ request('institution_id') }}">

        <div class="mb-3">
            <label for="filter_institution_id" class="form-label">{{ __("Institution") }}</label>
            <select name="filter_institution_id" id="filter_institution_id" class="form-select">
                <option value="">{{ __("All Institutions") }}</option>
                @foreach($institutions as $inst)
                    <option value="{{ $inst->id }}" @selected(request('filter_institution_id') == $inst->id)>
                        {{ $inst->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __("Weight (in kg)") }}</label>
            <div class="range-slider">
                <input type="range" id="weight_min" name="weight_min" min="{{ $minWeight }}" max="{{ $maxWeight }}" value="{{ request('weight_min', $minWeight) }}" oninput="updateWeightSlider(this)">
                <input type="range" id="weight_max" name="weight_max" min="{{ $minWeight }}" max="{{ $maxWeight }}" value="{{ request('weight_max', $maxWeight) }}" oninput="updateWeightSlider(this)">
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span><span id="weight_min_output">{{ request('weight_min', $minWeight) }}</span> kg</span>
                <span><span id="weight_max_output">{{ request('weight_max', $maxWeight) }}</span> kg</span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __("Build Year") }}</label>
            <div class="range-slider">
                <input type="range" id="year_min" name="year_min" min="{{ $minYear }}" max="{{ $maxYear }}" value="{{ request('year_min', $minYear) }}" oninput="updateWeightSlider(this)">
                <input type="range" id="year_max" name="year_max" min="{{ $minYear }}" max="{{ $maxYear }}" value="{{ request('year_max', $maxYear) }}" oninput="updateWeightSlider(this)">
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span id="year_min_output">{{ request('year_min', $minYear) }}</span>
                <span id="year_max_output">{{ request('year_max', $maxYear) }}</span>
            </div>
        </div>

        <div class="mb-3">
        <label class="form-label">{{ __("Cooling") }}:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cooling" id="cooling_yes" value="1" {{ request('cooling') === '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="cooling_yes">
                {{ __("Yes") }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cooling" id="cooling_no" value="0" {{ request('cooling') === '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="cooling_no">
                {{ __("No") }}
            </label>
        </div>

        <button type="submit" class="btn btn-outline-secondary">{{ __("Apply") }}</button>
    </form>
</div>