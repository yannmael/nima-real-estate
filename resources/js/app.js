import './bootstrap';

/* Import dynamique : GSAP n'est chargé que si des éléments countup existent sur la page */
document.addEventListener('DOMContentLoaded', async () => {
    if (document.querySelector('[data-countup]')) {
        const { initCountUp } = await import('./countup');
        initCountUp();
    }
});
