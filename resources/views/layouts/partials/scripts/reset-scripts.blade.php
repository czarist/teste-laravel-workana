<script>
    $(document).ready(function() {
        $('#resetForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/password/email',
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
