
document.getElementById('select-all').addEventListener('change', function () {
    const isChecked = this.checked;
    const checkboxes = document.querySelectorAll('.item-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.checked = isChecked;
    });
});

document.querySelectorAll('.item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const allChecked = Array.from(document.querySelectorAll('.item-checkbox'))
            .every(checkbox => checkbox.checked);
        document.getElementById('select-all').checked = allChecked;
    });
});

