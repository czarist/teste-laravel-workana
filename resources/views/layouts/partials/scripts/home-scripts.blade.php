<script>
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
    });
</script>
