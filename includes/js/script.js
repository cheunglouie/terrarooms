/*
$(function() {
    $("#alertMe").click(function(e) {
        e.preventDefault();
        $('#successAlert').fadeOut();
    });
    
    $('a.pop').click(function(e) {
        e.preventDefault();
    });
    
    $('a.pop').popover();
    
    $('[rel="tooltip"]').tooltip();
});
*/

$(function() {
    $('[rel="tooltip"]').tooltip();
});


$(function () {
    $('.btn-radio').click(function(e) {
        $('.btn-radio').not(this).removeClass('active')
    		.siblings('input').prop('checked',false)
            .siblings('.img-radio').css('opacity','0.5');
    	$(this).addClass('active')
            .siblings('input').prop('checked',true)
    		.siblings('.img-radio').css('opacity','1');
    });
});