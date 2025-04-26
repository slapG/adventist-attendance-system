$(document).ready(function() {
    console.log('Login script loaded'); 
    $('form').submit(function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize(); 

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), 
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success' && response.redirect) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Login Success",
                        showConfirmButton: false,
                        timer: 5000
                    });
                    window.location.href = '/adventist-attendance-system/'; 
                } else if (response.status === 'error') {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Login Failed",
                        text: response.message || 'Invalid credentials',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#password').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Login request failed: ', status, error);
            }
        });
    });
});
