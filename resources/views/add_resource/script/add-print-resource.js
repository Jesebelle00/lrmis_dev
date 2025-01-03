$(document).ready(function () {
    // Variables
    const $search = $('#search');
    const $suggestions = $('#suggestions');
    const $message = $('#message');
    const $subjects = $('#subjects');
    const $subjectList = $('#subjectList');
    const $subjectInput = $('#subjectInput');
    const $author = $('#author');
    const $authSuggestions = $('#auth-suggestions');
    const $authorList = $('#authorList');
    const $authorInput = $('#authorInput');
    const $authorIDs = $('#authorIDs');
    const $publisher = $('#publisher');
    const $pubSuggestions = $('#pub-suggestions');
    const $pubMessage = $('#pub-message');
    const $printType = $('#print_type');
    const $printSource = $('#print_source');
    // const $library_id = $('#library_id');
    // const $profile_id = $('#profile_id');
    const $status = $('#status');
    const $statusMessage = $('#status-message'); // Optional status error message
    const tempStorage = [];
    const selectedAuthors = [];

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
    $search.on('input', function () {
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
        $search.val($(this).text());
        $('#selected-id').val($(this).data('id'));
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

        if (value && !tempStorage.includes(value)) {
            tempStorage.push(value);
            $subjectList.append(`<li>${text} 
                <button type="button" class="btn btn-sm btn-danger removeSubject" data-value="${value}">Remove</button>
            </li>`);
            updateInput($subjectInput, tempStorage);
        } else {
            alert('This subject is either already added or not selected.');
        }
        $(this).val('');
    });

    $subjectList.on('click', '.removeSubject', function () {
        const value = $(this).data('value');
        tempStorage.splice(tempStorage.indexOf(value), 1);
        $(this).parent().remove();
        updateInput($subjectInput, tempStorage);
    });

    // Fetch Data for Dropdowns
    fetchData('add_resource/action/fetch-type-print.php', $printType, 'type_name', 'id');
    fetchData('add_resource/action/fetch-source.php', $printSource, 'name', 'id');
    fetchData('add_resource/action/fetch-status.php', $status, 'name', 'id');

    // Author Selection
    $authSuggestions.on('click', '.auth-suggestion-item', function () {
        const id = $(this).data('id');
        const name = $(this).text();

        if (id && !selectedAuthors.includes(id.toString())) {
            selectedAuthors.push(id.toString());
            $authorList.append(`<li>${name} 
                <button type="button" class="btn btn-sm btn-danger removeAuthor" data-id="${id}">Remove</button>
            </li>`);
            updateInput($authorInput, selectedAuthors);
            updateInput($authorIDs, selectedAuthors);
            $author.val('');
            $authSuggestions.empty();
        } else {
            alert('This author is already selected or invalid.');
        }
    });

    $authorList.on('click', '.removeAuthor', function () {
        const id = $(this).data('id');
        selectedAuthors.splice(selectedAuthors.indexOf(id.toString()), 1);
        $(this).parent().remove();
        updateInput($authorInput, selectedAuthors);
        updateInput($authorIDs, selectedAuthors);
    });

    $author.on('input', function () {
        const term = $(this).val().trim();
        if (term.length > 2) {
            $.get('add_resource/action/search-auth.php', { term }, data => {
                const suggestions = $(data).filter(function () {
                    return !selectedAuthors.includes($(this).data('id').toString());
                });
                $authSuggestions.html(suggestions);
            }).fail(() => {
                $authSuggestions.html('<p style="color:red;">Error fetching data.</p>');
            });
        } else {
            $authSuggestions.empty();
        }
    });

    // Publisher Search
    $publisher.on('input', function () {
        const query = $(this).val();
        if (query.length > 2) {
            $.get('add_resource/action/search-pub.php', { term: query }, data => {
                const results = $(data);
                $pubSuggestions.html(results.length > 0 ? results : '');
                $pubMessage.toggle(!results.length).text('Record not found');
            });
        } else {
            $pubSuggestions.empty();
        }
    });

    $(document).on('click', '.pub-suggestion-item', function () {
        $publisher.val($(this).text());
        $('#pub-selected-id').val($(this).data('id'));
        $pubSuggestions.empty();
    });

    // Form Submission
    $('#add_print').submit(function (e) {
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
        console.log(formData);

        $.post('add_resource/action/add-new-print.php', $.param(formData), response => {
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
