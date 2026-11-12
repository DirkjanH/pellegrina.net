(() => {
    'use strict';

    const grid = document.querySelector('.landing-grid');
    if (grid) {
        const browserLanguage = (navigator.languages && navigator.languages[0]) || navigator.language || 'en';
        const language = /^nl(?:-|$)/i.test(browserLanguage) ? 'nl' : 'en';
        document.documentElement.lang = language;
        if (language === 'en') {
            const dutchCard = grid.querySelector('.course-card-nl');
            grid.prepend(grid.querySelector('.course-card-en'));
            grid.append(dutchCard);
        }
    }

    const carousel = document.getElementById('carroussel');
    if (!carousel) return;

    const slides = Array.from(carousel.querySelectorAll('.mySlides'));
    if (slides.length < 2) return;

    const controls = carousel.querySelector('.slideshow-controls');
    const toggle = carousel.querySelector('.slideshow-toggle');
    let current = 0;
    let paused = false;
    let hovered = false;
    let changing = false;
    let timer;

    slides.forEach((slide, index) => {
        slide.setAttribute('aria-hidden', index === current ? 'false' : 'true');
    });

    function schedule() {
        clearTimeout(timer);
        if (!paused && !hovered && !document.hidden && !changing) {
            timer = setTimeout(() => showSlide(1), 5000);
        }
    }

    function setPaused(value) {
        paused = value;
        const label = paused ? 'Afspelen / Play' : 'Pauze / Pause';
        toggle.setAttribute('aria-label', label);
        toggle.title = label;
        toggle.setAttribute('aria-pressed', String(paused));
        schedule();
    }

    function imageReady(image) {
        if (image.complete) return Promise.resolve(image.naturalWidth > 0);
        return new Promise(resolve => {
            const finish = () => {
                image.removeEventListener('load', finish);
                image.removeEventListener('error', finish);
                resolve(image.naturalWidth > 0);
            };
            image.addEventListener('load', finish);
            image.addEventListener('error', finish);
        });
    }

    async function showSlide(direction) {
        if (changing) return;
        changing = true;
        clearTimeout(timer);
        try {
            for (let offset = 1; offset < slides.length; offset++) {
                const next = (current + direction * offset + slides.length) % slides.length;
                if (!await imageReady(slides[next])) {
                    console.warn('Slideshow image could not be loaded:', slides[next].src);
                    continue;
                }
                slides[current].classList.remove('is-active');
                slides[current].setAttribute('aria-hidden', 'true');
                slides[next].classList.add('is-active');
                slides[next].setAttribute('aria-hidden', 'false');
                current = next;
                break;
            }
        } finally {
            changing = false;
            schedule();
        }
    }

    carousel.querySelector('.slideshow-previous').addEventListener('click', () => showSlide(-1));
    carousel.querySelector('.slideshow-next').addEventListener('click', () => showSlide(1));
    toggle.addEventListener('click', () => setPaused(!paused));
    carousel.addEventListener('mouseenter', () => {
        hovered = true;
        schedule();
    });
    carousel.addEventListener('mouseleave', () => {
        hovered = false;
        schedule();
    });
    carousel.addEventListener('focusin', event => {
        if (event.target !== toggle) setPaused(true);
    });
    document.addEventListener('visibilitychange', schedule);
    controls.hidden = false;
    setPaused(paused);
})();
