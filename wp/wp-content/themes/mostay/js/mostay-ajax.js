jQuery(document).ready(function($) {
    var button = $('#load-more-button');
    var container = $('#posts-container');
    var preloader = $('#load-more-preloader');

    if (button.length === 0) {
        return;
    }

    var currentPage = parseInt(button.data('paged'));
    var maxPages = parseInt(button.data('max-pages'));
    var postType = button.data('post-type');
    var taxonomy = button.data('taxonomy');
    var taxonomyId = button.data('taxonomy-id');

    if (currentPage >= maxPages) {
        button.hide();
    }

    function loadMorePosts() {
        button.attr('disabled', true);
        preloader.show();
        currentPage++;

        $.ajax({
            url: mostay_ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'mostay_load_more',
                paged: currentPage,
                nonce: mostay_ajax_params.nonce,
                posts_per_page: mostay_ajax_params.posts_per_page,
                taxonomy: taxonomy ? taxonomy : '',
                taxonomy_id: taxonomyId ? taxonomyId : '',
                post_type: postType
            },
            success: function(response) {
                if (response) {
                    if (response.indexOf('') !== -1) {
                        button.hide();
                        response = response.replace('', '');
                    }
                    container.append(response);
                    if (currentPage >= maxPages) {
                        button.hide();
                    } else {
                        button.attr('disabled', false);
                    }
                } else {
                    button.hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error de AJAX: ', textStatus, errorThrown);
                button.attr('disabled', false);
                alert('Hubo un error al cargar más contenido. Inténtalo de nuevo.');
            },
            complete: function() {
                preloader.hide();
            }
        });
    }

    button.on('click', function() {
        loadMorePosts();
    });
});