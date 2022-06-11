"use strict";

$(document).ready(function () {

    $('.btn_select_file').on('click', function(e){
        e.preventDefault();
        $("#contract_files:hidden").trigger('click');
    });

    $('input#contract_files').change(function(){
        var files = $(this)[0].files;

        $('.count-contract-file').text(`(${files.length} file select)`);
    });

    var initSortable = function () {
        let el = document.getElementById('list-files-items');
        Sortable.create(el, {
            group: 'contract_files', // or { name: "...", pull: [true, false, clone], put: [true, false, array] }
            sort: true, // sorting inside list
            delay: 0, // time in milliseconds to define when the sorting should start
            disabled: false, // Disables the sortable if set to true.
            store: null, // @see Store
            animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
            handle: '.file-contract-item',
            ghostClass: 'sortable-ghost', // Class name for the drop placeholder
            chosenClass: 'sortable-chosen', // Class name for the chosen item
            dataIdAttr: 'data-id',

            forceFallback: false, // ignore the HTML5 DnD behaviour and force the fallback to kick in
            fallbackClass: 'sortable-fallback', // Class name for the cloned DOM Element when using forceFallback
            fallbackOnBody: false,  // Appends the cloned DOM Element into the Document's Body

            scroll: true, // or HTMLElement
            scrollSensitivity: 30, // px, how near the mouse must be to an edge to start scrolling.
            scrollSpeed: 10, // px

            // dragging ended
            onEnd: () => {
                updateItems();
            }
        });
    };

    initSortable();

    var updateItems = function () {
        let items = [];
        $.each($('.file-contract-item'), (index, widget) => {
            //$(widget).data('id', index);
            items.push({
                id: $(widget).data('id'),
                name: $(widget).data('name'),
                folder: $(widget).data('folder'),
                mime_type: $(widget).data('mimetype'),
                url: $(widget).data('url'),
                options: $(widget).data('options')
            });
        });

        $('#lease_contract_file-data').val(JSON.stringify(items));
    };

    var list_file_contract = $('.list-files-contract');
    var edit_contract_modal = $('#edit-file-item');

    $('.reset-file').on('click', function (event) {
        event.preventDefault();
        $('.list-files-contract .file-contract-item').remove();
        updateItems();
        $(this).addClass('hidden');
    });

    list_file_contract.on('click', '.file-contract-item', function () {
        var id = $(this).data('id');
        var folder = $(this).data('folder');
        var url = $(this).data('url');
        $('#delete-file-item').data('id', id);
        $('#update-file-item').data('id', id);
        $('#file-item-description').val($(this).data('options'));
        $('#download-file-item').data('link', `${folder}/${url}`);
        edit_contract_modal.modal('show');
    });

    edit_contract_modal.on('click', '#delete-file-item', function (event) {
        event.preventDefault();
        edit_contract_modal.modal('hide');
        list_file_contract.find('.file-contract-item[data-id=' + $(this).data('id') + ']').remove();
        updateItems();
        if (list_file_contract.find('.file-contract-item').length === 0) {
            $('.reset-file').addClass('hidden');
        }
    });

    edit_contract_modal.on('click', '#update-file-item', function (event) {
        event.preventDefault();
        edit_contract_modal.modal('hide');
        list_file_contract.find('.file-contract-item[data-id=' + $(this).data('id') + ']').data('options', $('#file-item-description').val());
        updateItems();
    });

    edit_contract_modal.on('click', '#download-file-item', function(event)
    {
        event.preventDefault();
        var base = $(this).data('base');
        var link = $(this).data('link');
        var valFileDownloadPath = `${base}/storage/${link}`;
        window.open(valFileDownloadPath , '_blank');
    });
});
