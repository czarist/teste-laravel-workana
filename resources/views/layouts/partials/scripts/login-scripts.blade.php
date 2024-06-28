<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/login',
                type: 'POST',
                data: formData,
                success: function(data) {
                    // Handle success
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
