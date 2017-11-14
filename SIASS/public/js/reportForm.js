$(document).ready(function(){
    let form = $('#searchForm');
    let category = $('#category');
    let filters = $('#filters');

    category.change(function() {
        let categoryValue = category.val();

        switch (categoryValue) {
            case 'student':
                filters.load('../html/studentFilters.html');
                break;
            case 'partner':
                filters.load('../html/partnerFilters.html');
                break;
            case 'social_service':
                filters.load('../html/socialServiceFilters.html', function() {
                    var date = new Date();
                    var year = date.getFullYear();
                    var options = '';

                    for (i = year; i >= 1943; i--) {
                        options = options + '<option value="' + i + '">' + i + '</option>';
                    }
                    var select = $('#year');
                    select.append(options);
                });
                break;
        }
    });
});