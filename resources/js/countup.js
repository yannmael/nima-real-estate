import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// Formate un entier avec le séparateur millier d'origine ('  ' espace ou ',')
function formatAvecSeparateur(n, separateur) {
    if (!separateur) return String(n);
    return String(n).replace(/\B(?=(\d{3})+(?!\d))/g, separateur);
}

export function initCountUp() {
    const items = document.querySelectorAll('[data-countup]');
    if (!items.length) return;

    // Respect prefers-reduced-motion (WCAG 2.3.3)
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    items.forEach(el => {
        const raw = el.dataset.countup;

        // Détecte le séparateur millier utilisé dans la valeur source
        const separateur = raw.includes(' ') ? ' '  // espace fine
                         : raw.includes(' ')      ? ' '
                         : raw.includes(',')      ? ','
                         : '';

        const cible = parseInt(raw.replace(/\D/g, ''), 10);
        if (isNaN(cible) || cible === 0) return;

        // Si l'utilisateur préfère moins de mouvement, affiche directement la valeur finale
        if (reduceMotion) {
            el.textContent = formatAvecSeparateur(cible, separateur);
            return;
        }

        const obj = { val: 0 };
        el.textContent = '0';

        gsap.to(obj, {
            val: cible,
            duration: 2,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
            onUpdate() {
                el.textContent = formatAvecSeparateur(Math.round(obj.val), separateur);
            },
            onComplete() {
                // Garantit la valeur exacte en fin d'animation
                el.textContent = formatAvecSeparateur(cible, separateur);
            },
        });
    });
}
