<script>
    $(document).ready(function() {
        $('#logoutLink').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/api/logout',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Logout successful!');
                    window.location.href = '/login';
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
