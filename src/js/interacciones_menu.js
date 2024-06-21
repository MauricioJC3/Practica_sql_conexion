document.addEventListener('DOMContentLoaded', () => {
    const menuCards = document.querySelectorAll('.contenedor .relative');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    menuCards.forEach(card => {
        card.classList.add('opacity-0');
        observer.observe(card);
    });
});
