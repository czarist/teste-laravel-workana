<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cepInput = document.getElementById('editCep');

        cepInput.addEventListener('input', function() {
            var value = cepInput.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
            if (value.length > 5) {
                value = value.slice(0, 5) + '-' + value.slice(5, 8);
            }
            cepInput.value = value;
        });
    });

    $(document).ready(function() {
        $('.view-details-btn').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: `/api/users/${userId}`,
                method: 'GET',
                success: function(data) {
                    $('#userDetails').html(`
                        <div class="mb-2">
                            <i class="fas fa-user mr-2"></i><strong>Name:</strong> ${data.user.name}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-envelope mr-2"></i><strong>Email:</strong> ${data.user.email}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i><strong>Street:</strong> ${data.address.street}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-home mr-2"></i><strong>Number:</strong> ${data.address.number}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-city mr-2"></i><strong>City:</strong> ${data.address.city}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-map mr-2"></i><strong>State:</strong> ${data.address.state}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-globe mr-2"></i><strong>Country:</strong> ${data.address.country}
                        </div>
                    `);
                    $('#editUser').data('id', userId);
                    $('#deleteUser').data('id', userId);
                    $('#userModal').removeClass('hidden');
                },
                error: function() {
                    alert('Error fetching user details. Please try again.');
                }
            });
        });

        $('#closeModal').on('click', function() {
            $('#userModal').addClass('hidden');
        });

        $('#editUser').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: `/api/users/${userId}`,
                method: 'GET',
                success: function(data) {
                    $('#editUserId').val(userId);
                    $('#editName').val(data.user.name);
                    $('#editEmail').val(data.user.email);
                    $('#editCep').val(data.address.cep);
                    $('#editStreet').val(data.address.street);
                    $('#editNumber').val(data.address.number);
                    $('#editCity').val(data.address.city);
                    $('#editState').val(data.address.state);
                    $('#editCountry').val(data.address.country);
                    $('#userModal').addClass('hidden');
                    $('#editUserModal').removeClass('hidden');
                },
                error: function() {
                    alert('Error fetching user details. Please try again.');
                }
            });
        });

        $('#editCep').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, ''); // Remove any non-numeric character
            if (cep.length === 8) {
                $.ajax({
                    url: `/api/validate-cep`,
                    method: 'POST',
                    data: {
                        cep: cep
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (!data.erro) {
                            $('#editStreet').val(data.logradouro);
                            $('#editCity').val(data.localidade);
                            $('#editState').val(data.uf);
                            $('#editCountry').val('Brazil');
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

        $('#closeEditModal, #closeEditUserModal').on('click', function() {
            $('#editUserModal').addClass('hidden');
        });

        $('#editUserForm').on('submit', function(event) {
            event.preventDefault();
            var userId = $('#editUserId').val();
            var formData = $(this).serialize();
            $.ajax({
                url: `/api/users/${userId}`,
                method: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    alert('User updated successfully!');
                    location.reload();
                },
                error: function() {
                    alert('Error updating user. Please try again.');
                }
            });
        });

        $('#deleteUser').on('click', function() {
            var userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: `/api/users/${userId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        alert('User deleted successfully!');
                        location.reload();
                    },
                    error: function() {
                        alert('Error deleting user. Please try again.');
                    }
                });
            }
        });
    });
</script>
