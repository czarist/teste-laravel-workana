<script>
    $(document).ready(function() {
        $('#resetForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serializeArray();
            let email = formData.find(item => item.name === 'email').value;

            $('#loadingSpinner').removeClass('hidden'); // Mostrar o spinner

            $.ajax({
                url: '/api/password/email',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#loadingSpinner').addClass('hidden'); // Ocultar o spinner
                    if (response.message === 'User not found.') {
                        alert('User not found.');
                    } else {
                        alert('Password reset link has been sent to your email address.');
                        window.location.href = '/';
                    }
                },
                error: function(xhr) {
                    $('#loadingSpinner').addClass('hidden'); // Ocultar o spinner
                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    alert(errorMessage);
                    console.error('Error:', xhr);
                }
            });
        });
    });
</script>
