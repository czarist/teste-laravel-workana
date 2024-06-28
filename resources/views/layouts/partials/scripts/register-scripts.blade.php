<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cepInput = document.getElementById('cep');

        cepInput.addEventListener('input', function() {
            var value = cepInput.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
            if (value.length > 5) {
                value = value.slice(0, 5) + '-' + value.slice(5, 8);
            }
            cepInput.value = value;
        });
    });

    $(document).ready(function() {
        $('#cep').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico
            if (cep.length === 8) {
                $.ajax({
                    url: `https://viacep.com.br/ws/${cep}/json/`,
                    method: 'GET',
                    success: function(data) {
                        if (!("erro" in data)) {
                            $('#street').val(data.logradouro);
                            $('#city').val(data.localidade);
                            $('#state').val(data.uf);
                            $('#country').val('Brazil');
                            $('#countryHidden').val('Brazil');

                        } else {
                            alert('CEP not found.');
                        }
                    },
                    error: function() {
                        alert('Error retrieving address. Please try again.');
                    }
                });
            } else {
                alert('Please enter a valid CEP.');
            }
        });

        $('#registerForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: 'api/register',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Registration successful!');
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
