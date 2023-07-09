let item = 0;
let cartprice = 0.00;
let counter = 1;
let sum = 0;


let notificationCount = 0;

$(document).ready(function() {
    $('.cartbutton').click(function() {

        let notification = $('<div class="notification">Added to Cart</div>');
        $('.notification-container').append(notification);

        notification.fadeIn().delay(2000).fadeOut(function() {
            $(this).remove();
        });

        notificationCount++;
        $('.notification').each(function(index) {
            $(this).css('bottom', (index * 60) + 'px');
        });
    });
    
});
                       

                        
