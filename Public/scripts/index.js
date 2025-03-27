$(function() {
    function refreshItems() {
        const values = $('input[type="checkbox"]:checked[id*="Switch"]').map(function() {
            return $(this).val();
        }).get();

        const selectedStars = parseFloat($('#starSelect').val()) || 0;

        if (!values.length && !selectedStars) {
            $('[data-filter]').removeClass('d-none');
            return;
        }

        $('[data-filter]').each(function() {
            const filterData = $(this).data('filter');
            const matchesCheckbox = values.length ? values.some(value => filterData.includes(value)) : true; // If no checkboxes, consider all as matching
            const divStars = parseFloat(filterData.match(/[\d.]+/)) || 0;

            $(this).toggleClass('d-none', !(matchesCheckbox && divStars >= selectedStars));
        });
    }

    refreshItems();
    $('#starSelect').on('change', refreshItems);
    $('input[type="checkbox"][id*="Switch"]').on('change', refreshItems);
});