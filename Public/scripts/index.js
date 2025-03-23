$(function() {
    function refreshItems() {
        // Get all checked checkboxes with "Switch" in their id and their values
        const values = $('input[type="checkbox"]:checked[id*="Switch"]').map(function() {
            return $(this).val();
        }).get();

        // Get the selected star rating value (default to 0 if none is selected)
        const selectedStars = parseInt($('#starSelect').val(), 10) || 0;

        // Show all filter elements if no checkboxes are checked and no star rating is selected
        if (!values.length && !selectedStars) {
            $('[data-filter]').removeClass('d-none');
            return;
        }

        // Filter and toggle visibility of elements with data-filter
        $('[data-filter]').each(function() {
            const filterData = $(this).data('filter'); // Get the data-filter attribute
            const matchesCheckbox = values.some(value => filterData.includes(value));
            const divStars = parseInt(filterData.match(/\d+/), 10) || 0; // Extract the first number in the data-filter

            // Toggle visibility based on conditions
            $(this).toggleClass('d-none', !(matchesCheckbox && divStars >= selectedStars));
        });
    }

    // Call refreshItems on page load and bind events
    refreshItems();
    $('#starSelect').on('change', refreshItems);
    $('input[type="checkbox"][id*="Switch"]').on('change', refreshItems);
});