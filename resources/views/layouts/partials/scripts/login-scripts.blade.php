<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/api/login',
                type: 'POST',
                data: formData,
                success: function(data) {
                    alert('Login successful!');
                    window.location.href = '/';
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
