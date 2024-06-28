<script>
    $(document).ready(function() {
        $('#resetForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '/api/password/email',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    window.location.href = '/password/reset/' + response.token;
                },
                error: function(xhr) {
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
