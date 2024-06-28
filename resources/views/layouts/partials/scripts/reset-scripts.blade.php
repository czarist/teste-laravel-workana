<script>
    $(document).ready(function() {
        $('#resetForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/api/password/email',
                type: 'POST',
                data: formData,
                success: function(data) {
                    alert('Password reset link sent!');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
