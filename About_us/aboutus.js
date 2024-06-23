document.addEventListener('DOMContentLoaded', () => {
    const slideElements = document.querySelectorAll('.history-slide-left, .history-slide-right');

    const checkVisibility = () => {
        const triggerBottom = window.innerHeight / 5 * 4;
        slideElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            if (elementTop < triggerBottom) {
                element.classList.add('active');
            }
        });
    };

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Initial check in case elements are already in view
});