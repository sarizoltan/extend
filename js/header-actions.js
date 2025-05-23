/**
 * Header actions: User account & Cart functionality
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Toggle user account dropdown
        $('#user-account-toggle').on('click', function(e) {
            e.preventDefault();
            $('#user-account-dropdown').slideToggle(200);
            $('#cart-dropdown').slideUp(200);
        });
        
        // Toggle cart dropdown
        $('#cart-toggle').on('click', function(e) {
            e.preventDefault();
            $('#cart-dropdown').slideToggle(200);
            $('#user-account-dropdown').slideUp(200);
        });
        
        // Close dropdowns when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.user-account-wrapper, .cart-wrapper').length) {
                $('#user-account-dropdown, #cart-dropdown').slideUp(200);
            }
        });
        
        // Tab switching in login/register form
        $('.tab-button').on('click', function() {
            const tabId = $(this).data('tab');
            
            // Update active tab button
            $('.tab-button').removeClass('active');
            $(this).addClass('active');
            
            // Show selected tab content
            $('.tab-content').removeClass('active');
            $('#' + tabId + '-tab').addClass('active');
        });
        
        // AJAX login
        $('#ajax-login-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const statusBox = form.find('.status');
            
            statusBox.html('<p class="info">Bejelentkezés...</p>');
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: spfood_ajax.ajaxurl,
                data: {
                    action: 'spfood_ajax_login',
                    username: form.find('#username').val(),
                    password: form.find('#password').val(),
                    remember: form.find('#remember').is(':checked'),
                    security: form.find('[name="security"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        statusBox.html('<p class="success">' + response.data.message + '</p>');
                        location.reload();
                    } else {
                        statusBox.html('<p class="error">' + response.data.message + '</p>');
                    }
                },
                error: function() {
                    statusBox.html('<p class="error">Kapcsolati hiba. Kérjük, próbáld újra.</p>');
                }
            });
        });
        
        // AJAX register
        $('#ajax-register-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const statusBox = form.find('.status');
            
            statusBox.html('<p class="info">Regisztráció folyamatban...</p>');
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: spfood_ajax.ajaxurl,
                data: {
                    action: 'spfood_ajax_register',
                    username: form.find('#reg-username').val(),
                    email: form.find('#reg-email').val(),
                    password: form.find('#reg-password').val(),
                    security: form.find('[name="security"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        statusBox.html('<p class="success">' + response.data.message + '</p>');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        statusBox.html('<p class="error">' + response.data.message + '</p>');
                    }
                },
                error: function() {
                    statusBox.html('<p class="error">Kapcsolati hiba. Kérjük, próbáld újra.</p>');
                }
            });
        });
        
        // AJAX cart fragment refresh
        function refreshCartFragment() {
            $.ajax({
                url: spfood_ajax.ajaxurl,
                data: {
                    action: 'spfood_get_cart_count'
                },
                success: function(response) {
                    if (response.success) {
                        $('.cart-count').text(response.data.count);
                        
                        if (response.data.fragments) {
                            $.each(response.data.fragments, function(key, value) {
                                $(key).replaceWith(value);
                            });
                        }
                    }
                }
            });
        }
        
        // Refresh cart when product is added
        $(document.body).on('added_to_cart', function() {
            refreshCartFragment();
        });
        
        // Add to cart AJAX (optional, for products not using WooCommerce default)
        $(document.body).on('click', '.ajax-add-to-cart', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const productId = button.data('product_id');
            const quantity = button.closest('form').find('input[name="quantity"]').val() || 1;
            
            button.addClass('loading');
            
            $.ajax({
                type: 'POST',
                url: spfood_ajax.ajaxurl,
                data: {
                    action: 'spfood_add_to_cart',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    button.removeClass('loading');
                    
                    if (response.success) {
                        refreshCartFragment();
                        
                        // Optional: Show success message
                        $('<div class="cart-notification">' + response.data.message + '</div>')
                            .appendTo('body')
                            .fadeIn(300)
                            .delay(2000)
                            .fadeOut(300, function() {
                                $(this).remove();
                            });
                    }
                }
            });
        });
    });
})(jQuery);