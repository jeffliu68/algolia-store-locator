algolia.registerHook('beforeAutocompleteSources', function(sources, algolia_client, algoliaBundle) {
    algoliaConfig.autocomplete.templates['store_locator'] = algoliaBundle.Hogan.compile(jQuery('#autocomplete_store_locator_template').html());

    sources.push({
        name: 'store-locator',
        displayKey: 'value',
        source: function(query, callback) {
            var index = algolia_client.initIndex('magento2_default_store_locator_tmp');
            index.search(query, { hitsPerPage: 10 }).then(function(answer) {
                callback(answer.hits);
            }, function() {
                callback([]);
            });
        },
        templates: {
            empty: '<div class="aa-no-results">' + algoliaConfig.translations.noResults + '</div>',
            suggestion: function (hit) {
                return algoliaConfig.autocomplete.templates['store_locator'].render(hit);
            }
        }
    });
    return sources;
});