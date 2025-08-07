function updateWeightSlider(el) {
    const min = document.getElementById('weight_min');
    const max = document.getElementById('weight_max');
    if (parseFloat(min.value) > parseFloat(max.value)) {
        if (el === min) {
            max.value = min.value;
        } else {
            min.value = max.value;
        }
    }
    const minOutput = document.getElementById('weight_min_output');
    const maxOutput = document.getElementById('weight_max_output');
    if (minOutput) minOutput.innerText = min.value;
    if (maxOutput) maxOutput.innerText = max.value;
}

// Expose the function globally so inline event handlers can access it
window.updateWeightSlider = updateWeightSlider;

document.addEventListener('DOMContentLoaded', function () {
    const min = document.getElementById('weight_min');
    if (min) {
        updateWeightSlider(min);
    }
});

function updateYearSlider(el) {
    const min = document.getElementById('year_min');
    const max = document.getElementById('year_max');
    if (parseFloat(min.value) > parseFloat(max.value)) {
        if (el === min) {
            max.value = min.value;
        } else {
            min.value = max.value;
        }
    }
    const minOutput = document.getElementById('year_min_output');
    const maxOutput = document.getElementById('year_max_output');
    if (minOutput) minOutput.innerText = min.value;
    if (maxOutput) maxOutput.innerText = max.value;
}

// Expose the function globally so inline event handlers can access it
window.updateYearSlider = updateYearSlider;

document.addEventListener('DOMContentLoaded', function () {
    const min = document.getElementById('year_min');
    if (min) {
        updateYearSlider(min);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const filters = document.getElementById('searchFilters');
    const toggle = document.querySelector('[data-bs-target="#searchFilters"]');
    if (filters && toggle && window.matchMedia('(min-width: 768px)').matches) {
        filters.classList.add('show');
        toggle.setAttribute('aria-expanded', 'true');
    }
});