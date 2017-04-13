;(function() {
    // Initialize
    var bLazy = new Blazy({
        selector: 'img',
        breakpoints: [{
                width: 480, // max-width
                src: 'data-src-small'
            },
            {
                width: 768, // max-width
                src: 'data-src-medium'
            },
            {
                width: 1200, // max-width
                src: 'data-src'
            },
            {
                width: 2880, // max-width
                src: 'data-src'
            }
        ]
    });
})();