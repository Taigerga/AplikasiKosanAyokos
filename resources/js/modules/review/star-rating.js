export function initStarRating(containerId, inputName = 'rating') {
    const container = document.getElementById(containerId);
    if (!container) return;

    const stars = container.querySelectorAll('.star-rating-btn');
    const input = container.querySelector(`[name="${inputName}"]`);
    let currentRating = parseInt(input?.value) || 0;

    function highlight(rating) {
        stars.forEach((star, i) => {
            star.classList.toggle('text-yellow-400', i < rating);
            star.classList.toggle('text-gray-300', i >= rating);
        });
    }

    stars.forEach((star, i) => {
        star.addEventListener('mouseenter', () => highlight(i + 1));
        star.addEventListener('mouseleave', () => highlight(currentRating));
        star.addEventListener('click', () => {
            currentRating = i + 1;
            if (input) input.value = currentRating;
            highlight(currentRating);
        });
    });

    if (currentRating > 0) highlight(currentRating);

    return { getRating: () => currentRating, setRating: (r) => { currentRating = r; highlight(r); } };
}
