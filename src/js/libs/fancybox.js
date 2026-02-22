import { Fancybox } from "@fancyapps/ui/dist/fancybox/";

window.addEventListener('DOMContentLoaded', () => {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.id  = 'thm-fancybox';
    link.href = thmLocalize.themeUrl + '/dist/css/libs/fancybox.css';
    document.head.appendChild(link);
});

window.Fancybox = Fancybox;