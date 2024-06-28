<script>
    $(document).ready(function() {
        $('#cep').on('blur', function() {
            const cep = $(this).val();
            $.ajax({
                url: '/api/validate-cep',
                type: 'POST',
                data: {
                    cep: cep,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#address').val(`${data.logradouro}, ${data.bairro}, ${data.localidade}, ${data.uf}`);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#registerForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '/api/register',
                type: 'POST',
                data: formData,
                success: function(data) {
                    alert('Registration successful!');
                    window.location.href = '/';
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
