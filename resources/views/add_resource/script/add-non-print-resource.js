$(document).ready(function () {
    const $searchInput = $('#search-nonprint');
    const $selectedIdInput = $('#selected-id-nonprint');
    const $suggestions = $('#suggestions-nonprint');
    const $nonPrintTypeSelect = $('#non-print_type');
    const $subjects = $('#subjects-nonprint');
    const $subjectList = $('#subjectListNonprint');
    const $subjectInput = $('#subjectInputNonprint');
    const $nonprintSource = $('#np_source');
    const $status = $('#status-nonprint');
    const $author = $('#author-nonprint');
    const $authSuggestions = $('#auth-suggestions-nonprint');
    const $authorList = $('#authorListNonprint');
    const $authorInput = $('#authorInputNonprint');
    const $authorIDs = $('#authorIDsNonprint');
    const $brand = $('#brand');
    const $brandSuggestions = $('#brand-suggestions');
    const $brandMessage = $('#brand-message');
    const tempStorageNonprint = [];
    const selectedAuthorsNonprint = [];
    const $message = $('#message');
    
       // Helper Functions
    const updateInput = (input, values) => input.val(values.join(','));
    const appendOptions = (selector, data, textKey, valueKey) => {
        if (data.length > 0) {
            data.forEach(item => {
                selector.append(new Option(item[textKey], item[valueKey]));
            });
        } else {
            selector.append(new Option('No data available', '', true, false)).prop('disabled', true);
        }
    };
    const fetchData = (url, selector, textKey, valueKey) => {
        $.getJSON(url, data => appendOptions(selector, data, textKey, valueKey)).fail(error => {
            console.error(`Error fetching data from ${url}:`, error);
            $statusMessage.text('An error occurred while fetching the options.').show();
        });
    };

    // Search Functionality
    $searchInput.on('input', function () {
        const query = $(this).val();
        if (query.length > 2) {
            $.get('add_resource/action/search-title.php', { term: query }, data => {
                const results = $(data);
                $suggestions.html(results.length > 0 ? results : '');
                $message.toggle(!results.length).text('Record not found');
            });
        } else {
            $suggestions.empty();
            $message.hide();
        }
    });

    $(document).on('click', '.suggestion-item', function () {
        $searchInput.val($(this).text());
        $('#selected-id-nonprint').val($(this).data('id'));
        $suggestions.empty();
        $message.hide();
    });

    // Fetch and Populate Subjects
    $.ajax({
        url: 'add_resource/action/fetch-subject-grade-level.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            $subjects.empty();
            $subjects.append('<option value="" selected disabled>Select Subject Grade Level</option>');
            response.forEach(function (item) {
                $subjects.append('<option value="' + item.id + '">' + item.title + ' ' + item.shortcode + '</option>');
            });
        },
        error: function () {
            alert('Error fetching subjects. Please try again.');
        }
    });

    // Subjects Selection Logic
    $subjects.on('change', function () {
        const value = $(this).val();
        const text = $(this).find('option:selected').text();

        if (value && !tempStorageNonprint.includes(value)) {
            tempStorageNonprint.push(value);
            $subjectList.append(`<li>${text} 
                <button type="button" class="btn btn-sm btn-danger removeSubject" data-value="${value}">Remove</button>
            </li>`);
            updateInput($subjectInput, tempStorageNonprint);
        } else {
            alert('This subject is either already added or not selected.');
        }
        $(this).val('');
    });

    $subjectList.on('click', '.removeSubject', function () {
        const value = $(this).data('value');
        tempStorageNonprint.splice(tempStorageNonprint.indexOf(value), 1);
        $(this).parent().remove();
        updateInput($subjectInput, tempStorageNonprint);
    });

    // Fetch Data for Dropdowns
    fetchData('add_resource/action/fetch-type-nonprint.php', $nonPrintTypeSelect, 'type_name', 'id');
    fetchData('add_resource/action/fetch-source.php', $nonprintSource, 'name', 'id');
    fetchData('add_resource/action/fetch-status.php', $status, 'name', 'id');

    // Author Selection
    $authSuggestions.on('click', '.auth-suggestion-item', function () {
        const id = $(this).data('id');
        const name = $(this).text();

        if (id && !selectedAuthorsNonprint.includes(id.toString())) {
            selectedAuthorsNonprint.push(id.toString());
            $authorList.append(`<li>${name} 
                <button type="button" class="btn btn-sm btn-danger removeAuthor" data-id="${id}">Remove</button>
            </li>`);
            updateInput($authorInput, selectedAuthorsNonprint);
            updateInput($authorIDs, selectedAuthorsNonprint);
            $author.val('');
            $authSuggestions.empty();
        } else {
            alert('This author is already selected or invalid.');
        }
    });

    $authorList.on('click', '.removeAuthor', function () {
        const id = $(this).data('id');
        selectedAuthorsNonprint.splice(selectedAuthorsNonprint.indexOf(id.toString()), 1);
        $(this).parent().remove();
        updateInput($authorInput, selectedAuthorsNonprint);
        updateInput($authorIDs, selectedAuthorsNonprint);
    });

    $author.on('input', function () {
        const term = $(this).val().trim();
        if (term.length > 2) {
            $.get('add_resource/action/search-auth.php', { term }, data => {
                const suggestions = $(data).filter(function () {
                    return !selectedAuthorsNonprint.includes($(this).data('id').toString());
                });
                $authSuggestions.html(suggestions);
            }).fail(() => {
                $authSuggestions.html('<p style="color:red;">Error fetching data.</p>');
            });
        } else {
            $authSuggestions.empty();
        }
    });

    //Brand Search
    $brand.on('input', function () {
        const query = $(this).val();
        if (query.length > 2) {
            $.get('add_resource/action/search-brand.php', { term: query }, data => {
                const results = $(data);
                $brandSuggestions.html(results.length > 0 ? results : '');
                $brandMessage.toggle(!results.length).text('Record not found');
            });
        } else {
            $brandSuggestions.empty();
        }
    });

    $(document).on('click', '.brand-suggestion-item', function () {
        $brand.val($(this).text());
        $('#brand-selected-id').val($(this).data('id'));
        $brandSuggestions.empty();
    });

    // Form Submission
    $('#add_nonprint').submit(function (e) {
        e.preventDefault();

        const invalidFields = $(this).find('input[required], select[required]').filter(function () {
            return !$(this).val().trim();
        }).addClass('is-invalid');

        if (invalidFields.length > 0) {
            $message.text('Please fill in all required fields.').show();
            return;
        } else {
            $message.hide();
        }

        const formData = $(this).serializeArray().filter(field => field.value !== 'all');
        //console.log(formData);

        $.post('add_resource/action/add-new-non-print.php', $.param(formData), response => {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                alert(`${result.message}\n\nSubmitted Inputs:\n${JSON.stringify(result.inputs, null, 2)}`);
            } else {
                alert(result.message);
            }
        }).fail(error => {
            console.error('AJAX error:', error);
            alert('An error occurred during registration. Please try again later.');
        });
    });

});
