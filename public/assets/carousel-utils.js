/**
 * Carousel Utilities
 * Centralized functions for carousel initialization and management
 * 
 * Requirements:
 * - Swiper JS library
 * - Include this file before initializing carousels
 */

const CarouselUtils = {
    
    /**
     * Initialize a standard carousel with Swiper
     * @param {string} containerClass - CSS class of the swiper container
     * @param {object} options - Custom Swiper options
     * @returns {object} Swiper instance
     */
    initCarousel: function(containerClass = '.carousel-swiper', options = {}) {
        const defaultOptions = {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + ' w-3 h-3 bg-white/60 hover:bg-white rounded-full cursor-pointer transition"></span>';
                },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            }
        };

        const mergedOptions = { ...defaultOptions, ...options };
        return new Swiper(containerClass, mergedOptions);
    },

    /**
     * Initialize carousel with counter
     * @param {string} containerClass - CSS class of the swiper container
     * @param {string} counterClass - CSS class for counter element
     * @param {object} options - Custom Swiper options
     * @returns {object} Swiper instance
     */
    initCarouselWithCounter: function(containerClass = '.carousel-swiper', counterClass = '.carousel-counter', options = {}) {
        const swiper = this.initCarousel(containerClass, {
            ...options,
            on: {
                slideChange: function() {
                    const counter = document.querySelector(counterClass);
                    if (counter) {
                        counter.textContent = swiper.realIndex + 1;
                    }
                }
            }
        });
        return swiper;
    },

    /**
     * Initialize carousel with thumbnail navigation
     * @param {string} containerClass - CSS class of the swiper container
     * @param {string} thumbnailClass - CSS class for thumbnail elements
     * @param {object} options - Custom Swiper options
     * @returns {object} Swiper instance
     */
    initCarouselWithThumbnails: function(containerClass = '.carousel-swiper', thumbnailClass = '.carousel-thumbnail', options = {}) {
        const swiper = this.initCarousel(containerClass, options);
        
        document.querySelectorAll(thumbnailClass).forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                swiper.slideTo(index);
            });
        });
        
        return swiper;
    },

    /**
     * Initialize carousel with full features (counter + thumbnails)
     * @param {string} containerClass - CSS class of the swiper container
     * @param {string} counterClass - CSS class for counter element
     * @param {string} thumbnailClass - CSS class for thumbnail elements
     * @param {object} options - Custom Swiper options
     * @returns {object} Swiper instance
     */
    initFullCarousel: function(containerClass = '.carousel-swiper', counterClass = '.carousel-counter', thumbnailClass = '.carousel-thumbnail', options = {}) {
        const swiper = this.initCarouselWithCounter(containerClass, counterClass, options);
        this.addThumbnailNavigation(swiper, thumbnailClass);
        return swiper;
    },

    /**
     * Add thumbnail navigation to existing carousel
     * @param {object} swiper - Swiper instance
     * @param {string} thumbnailClass - CSS class for thumbnail elements
     */
    addThumbnailNavigation: function(swiper, thumbnailClass = '.carousel-thumbnail') {
        document.querySelectorAll(thumbnailClass).forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                swiper.slideTo(index);
            });
        });
    },

    /**
     * Pause carousel autoplay
     * @param {object} swiper - Swiper instance
     */
    pauseAutoplay: function(swiper) {
        if (swiper && swiper.autoplay) {
            swiper.autoplay.pause();
        }
    },

    /**
     * Resume carousel autoplay
     * @param {object} swiper - Swiper instance
     */
    resumeAutoplay: function(swiper) {
        if (swiper && swiper.autoplay) {
            swiper.autoplay.start();
        }
    },

    /**
     * Add keyboard navigation to carousel
     * @param {object} swiper - Swiper instance
     */
    enableKeyboardNavigation: function(swiper) {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') swiper.slidePrev();
            if (e.key === 'ArrowRight') swiper.slideNext();
        });
    },

    /**
     * Get current slide index
     * @param {object} swiper - Swiper instance
     * @returns {number} Current slide index
     */
    getCurrentSlideIndex: function(swiper) {
        return swiper ? swiper.realIndex + 1 : 0;
    },

    /**
     * Get total slides count
     * @param {object} swiper - Swiper instance
     * @returns {number} Total slides count
     */
    getTotalSlides: function(swiper) {
        return swiper ? swiper.slides.length : 0;
    },

    /**
     * Go to specific slide
     * @param {object} swiper - Swiper instance
     * @param {number} index - Slide index (0-based)
     */
    goToSlide: function(swiper, index) {
        if (swiper) {
            swiper.slideTo(index);
        }
    },

    /**
     * Destroy carousel
     * @param {object} swiper - Swiper instance
     */
    destroyCarousel: function(swiper) {
        if (swiper) {
            swiper.destroy();
        }
    }
};

// Export for use in other modules (if using module system)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CarouselUtils;
}

/**
 * USAGE EXAMPLES:
 * 
 * // Basic initialization
 * const swiper = CarouselUtils.initCarousel();
 * 
 * // With counter
 * const swiper = CarouselUtils.initCarouselWithCounter();
 * 
 * // With thumbnails
 * const swiper = CarouselUtils.initCarouselWithThumbnails();
 * 
 * // Full featured (counter + thumbnails)
 * const swiper = CarouselUtils.initFullCarousel();
 * 
 * // Custom options
 * const swiper = CarouselUtils.initCarousel('.my-carousel', {
 *     autoplay: { delay: 3000 },
 *     effect: 'slide'
 * });
 * 
 * // Pause autoplay
 * CarouselUtils.pauseAutoplay(swiper);
 * 
 * // Resume autoplay
 * CarouselUtils.resumeAutoplay(swiper);
 * 
 * // Enable keyboard navigation
 * CarouselUtils.enableKeyboardNavigation(swiper);
 * 
 * // Get info
 * console.log(CarouselUtils.getCurrentSlideIndex(swiper)); // 1
 * console.log(CarouselUtils.getTotalSlides(swiper)); // 5
 * 
 * // Go to specific slide
 * CarouselUtils.goToSlide(swiper, 2); // Go to 3rd slide (0-indexed)
 * 
 * // Destroy carousel
 * CarouselUtils.destroyCarousel(swiper);
 */
