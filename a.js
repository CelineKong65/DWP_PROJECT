const svgPaths = document.querySelectorAll('.path');

const svgText = anime({
    targets: svgPaths,
    loop: true,
    direction: 'alternate',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 700,
    delay: (el, i) => { return i * 500; }
});
