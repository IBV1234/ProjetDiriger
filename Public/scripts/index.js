$(function() {
    function refreshItems() {
        const values = $('input[type="checkbox"]:checked[id*="Switch"]').map(function() {
            return $(this).val();
        }).get();

        const selectedStars = parseFloat($('#starSelect').val()) || 0;

        if (!values.length && !selectedStars) {
            $('[data-filter]').removeClass('d-none');
            $('#noItems').addClass('d-none'); // Hide "noItems" since all items are shown
            return;
        }

        let visibleCount = 0;

        $('[data-filter]').each(function() {
            const filterData = $(this).data('filter');
            const matchesCheckbox = values.length ? values.some(value => filterData.includes(value)) : true; // If no checkboxes, consider all as matching
            const divStars = parseFloat(filterData.match(/[\d.]+/)) || 0;

            const isVisible = matchesCheckbox && divStars >= selectedStars;
            $(this).toggleClass('d-none', !isVisible);

            if (isVisible) visibleCount++; // Count visible items
        });

        // Show or hide the "noItems" element based on visible items
        $('#noItems').toggleClass('d-none', visibleCount > 0);
    }

    refreshItems();
    $('#starSelect').on('change', refreshItems);
    $('input[type="checkbox"][id*="Switch"]').on('change', refreshItems);
});