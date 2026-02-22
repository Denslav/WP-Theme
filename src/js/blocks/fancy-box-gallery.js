Fancybox.bind("[data-fancybox]", {
    on: {
        ready: (fancyboxRef) => {
            let fancyBoxItems = document.querySelectorAll('[data-fancybox]');

            if ( fancyBoxItems.length ) {
                const hashUrl = window.location.hash;

                fancyBoxItems.forEach(link => {
                    let fancyAttribute = link.getAttribute('data-fancybox');

                    if (hashUrl && hashUrl.toLowerCase().includes(fancyAttribute)) {
                        let img = link.querySelector('img:not(.skip-lazy)');

                        if (!img || !img.dataset.src) return;

                        img.src = img.dataset.src;
                        if (img.dataset.srcset) img.srcset = img.dataset.srcset;
                        if (img.dataset.sizes) img.sizes = img.dataset.sizes;

                        img.classList.add('lazy-loaded');
                        img.classList.remove('thm-lazy-loading');
                        img.removeAttribute('data-src');
                    }
                })
            }
        },
    },
});