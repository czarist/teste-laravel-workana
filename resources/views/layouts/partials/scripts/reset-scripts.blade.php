<script>
    $(document).ready(function() {
        $('#resetPasswordForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serializeArray();
            let token = formData.find(item => item.name === 'token').value;
            let email = formData.find(item => item.name === 'email').value;
            let password = formData.find(item => item.name === 'password').value;
            let password_confirmation = formData.find(item => item.name === 'password_confirmation')
                .value;

            // Validar se as senhas são iguais
            if (password !== password_confirmation) {
                alert('Passwords do not match.');
                return;
            }

            $.ajax({
                url: `/api/password/reset/${token}/${email}`,
                type: 'POST',
                data: {
                    password: password,
                    password_confirmation: password_confirmation
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '/login';
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    alert(errorMessage);
                }
            });
        });
    });
</script>
