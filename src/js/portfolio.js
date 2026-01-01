/** Global parameters */
const params = {
    "currentActiveSlide": -99,
    "slideHeight": 400,
    "headerHeight": 280
}

const portfolioPage = document.querySelector('html')
const slides = document.querySelectorAll('.slide')

/**
 * Ensures only 1 slide on the page has the class 'active'
 *
 * @param {number} activeSlide The number slide that should have active class
 */
function setActiveSlide(activeSlide) {
    params.currentActiveSlide = activeSlide
    slides.forEach((slide, i) => {
        if (i === activeSlide) {
            slide.className += ' active'
        } else {
            slide.className = slide.className.replace('active', '').trim()
        }
    })
}

function updateScrollPos() {
    const scrollPosition = portfolioPage.scrollTop - params.headerHeight
    const activeSlide = Math.round(scrollPosition / params.slideHeight)

    if (activeSlide !== params.currentActiveSlide) {
        setActiveSlide(activeSlide)
    }
}

if (slides.length) {
    document.addEventListener('scroll', () => updateScrollPos())

    /** Initialise the page */
    updateScrollPos()
}
