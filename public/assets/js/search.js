//  need to find a way to put this in JS
var search = instantsearch({
    appId: '0BY817SZQX',
    apiKey: '16c0eef4cfeba1144107f8251d3d38e5',
    indexName: 'apps'
});

search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#q'
    })
);

// search.addWidget(
//     instantsearch.widgets.stats({
//         container: '#stats'
//     })
// );

var hitTemplate =
    '<div class="cols col-lg-3 col-md-4 col-sm-3 col-xs-4">' +
    '<a href="{{link}}">' +
    '<img src="{{image}}">' +
    '<h4>{{name}}</h4>' +
    '<span class="label label-primary">{{category}}</span>' +
    '</a>' +
    '</div>';
    // '<div class="hit media">' +
    // '<div class="media-left">' +
    // '<div class="media-object" style="background-image: url(\'{{image}}\');"></div>' +
    // '</div>' +
    // '<div class="media-body">' +
    // '<h4 class="media-heading">{{{_highlightResult.name.value}}} ({{category}})' +
    // '<p class="year">{{year}}</p><p class="genre">{{#genre}}<span class="badge">{{.}}</span> {{/genre}}</p>' +
    // '</div>' +
    // '</div>';

var noResultsTemplate =
    '<div class="text-center">No results found matching <strong>{{query}}</strong>.</div>';

search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        hitsPerPage: 16,
        templates: {
            empty: noResultsTemplate,
            item: hitTemplate
        }
    })
);

search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
        cssClasses: {
            root: 'pagination',
            active: 'active'
        }
    })
);

// search.addWidget(
//     instantsearch.widgets.refinementList({
//         container: '#genres',
//         attributeName: 'genre',
//         operator: 'and',
//         limit: 10,
//         cssClasses: {
//             list: 'nav nav-list',
//             count: 'badge pull-right',
//             active: 'active'
//         }
//     })
// );

search.start();