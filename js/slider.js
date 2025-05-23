/**
 * Header slider functionality
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        const $slider = $('.header-slider');
        const $slides = $('.slide');
        const $dots = $('.slider-dot');
        let currentSlide = 0;
        let slideCount = $slides.length;
        let slideInterval;
        
        // Function to set the active slide
        function setActiveSlide(index) {
            $slides.removeClass('active');
            $dots.removeClass('active');
            
            $($slides[index]).addClass('active');
            $($dots[index]).addClass('active');
            currentSlide = index;
        }
        
        // Function to go to the next slide
        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= slideCount) {
                next = 0;
            }
            setActiveSlide(next);
        }
        
        // Start auto slideshow
        function startSlideshow() {
            slideInterval = setInterval(nextSlide, 5000);
        }
        
        // Stop auto slideshow
        function stopSlideshow() {
            clearInterval(slideInterval);
        }
        
        // Click on dots
        $dots.click(function() {
            stopSlideshow();
            let slideIndex = $(this).data('slide') - 1;
            setActiveSlide(slideIndex);
            startSlideshow();
        });
        
        // Pause on hover
        $slider.hover(
            function() { stopSlideshow(); },
            function() { startSlideshow(); }
        );
        
        // Initialize slideshow
        if ($slides.length > 1) {
            startSlideshow();
        }
    });
    
})(jQuery);