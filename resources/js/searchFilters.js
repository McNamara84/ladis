function updateWeightSlider(el) {
    const min = document.getElementById('weight_min');
    const max = document.getElementById('weight_max');
    if (parseInt(min.value) > parseInt(max.value)) {
        if (el === min) {
            max.value = min.value;
        } else {
            min.value = max.value;
        }
    }
    document.getElementById('weight_min_output').innerText = min.value;
    document.getElementById('weight_max_output').innerText = max.value;
}

document.addEventListener('DOMContentLoaded', function () {
    const min = document.getElementById('weight_min');
    if (min) {
        updateWeightSlider(min);
    }
});