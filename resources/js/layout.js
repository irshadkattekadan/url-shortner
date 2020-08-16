jQuery(".logout-btn").on("click",function(e) {

    var message = 'Logout?';
    
    if(confirm(message)) {
        e.preventDefault();
        myForm = jQuery('#logout-form');
        myForm.submit();
        }
    
    return false;
});