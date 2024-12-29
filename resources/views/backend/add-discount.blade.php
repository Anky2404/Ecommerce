<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Add Discount</h3>
            <div class="game-form">

                <form method="POST" action="{{ route('admin.store-discount') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="input">
                            <label for="category_name">Discount Code</label>
                            <input type="text" name="category_name" id="category_name" placeholder="Enter Discount Code..." required>
                        </div>
                
                        <div class="input">
                            <label for="discount_type">Discount Type</label>
                            <select name="discount_type" id="discount_type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Fixed">Fixed</option>
                            </select>
                        </div>
                
                        <div class="input">
                            <label for="value">Value</label>
                            <input type="text" name="value" id="value" placeholder="Enter Discount Value..." required>
                        </div>

                        <div class="input">
                            <label for="min_orders">Minimum Orders</label>
                            <input type="number" name="min_orders" id="min_orders" placeholder="Enter Minimum Orders..." required>
                        </div>
                
                        <div class="input">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required>
                        </div>
                
                        <div class="input">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" required>
                        </div>
                
                        <div class="input">
                            <label for="usage_limit">Usage Limit</label>
                            <input type="number" name="usage_limit" id="usage_limit" placeholder="Enter Usage Limit..." min="1" required>
                        </div>
                
                        <div class="input">
                            <label for="status">Status</label>
                            <select name="status" id="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                
                       
                    </div>
                
                    <div class="input">
                        <label for="category_description">Description</label>
                        <textarea name="category_description" id="category_description" rows="7" style="width:100%;" placeholder="Enter Description..." required></textarea>
                    </div>
                
                    <div class="signup">
                        <button type="submit">Submit</button>
                    </div>
                </form>
                
                

            </div>


        </div>

    </div>

<script>
    $(document).ready(function () {
    // Set the current date 
    var currentDate = new Date().toISOString().split('T')[0]; 
    // Set minimum start date
    $('#start_date').attr('min', currentDate); 

    // Validate end date to be at least 10 days after the start date
    $('#start_date').on('change', function () {
        var startDate = $(this).val();
        var endDate = $('#end_date').val();

        // If the start date is changed
        if (startDate) {
            var minEndDate = new Date(startDate);
            // Add 10 days to the start date
            minEndDate.setDate(minEndDate.getDate() + 10); 
            // Convert to YYYY-MM-DD format
            var minEndDateString = minEndDate.toISOString().split('T')[0];
             // Set the minimum end date 
            $('#end_date').attr('min', minEndDateString);
        }
    });

    // Validate when the form is submitted
    $('form').on('submit', function (e) {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();

        // Check if end date is at least 10 days after start date
        if (startDate && endDate) {
            var startDateObj = new Date(startDate);
            var endDateObj = new Date(endDate);

            if (endDateObj < startDateObj || (endDateObj.getTime() - startDateObj.getTime()) < (10 * 24 * 60 * 60 * 1000)) {
                alert("The end date must be at least 10 days after the start date.");
                e.preventDefault(); 
            }
        }
    });
});

</script>
</body>

</html>
