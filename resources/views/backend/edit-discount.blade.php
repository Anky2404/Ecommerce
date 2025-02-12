<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Edit Discount</h3>
            <div class="game-form">
                @if (session('error'))
                <div class="alert alert-danger" id="status-message">
                    <ul>
                        @foreach (session('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" action="{{ route('admin.update-discount') }}" >
                    @csrf
                    <div class="row">
                        <div class="input">
                            <label for="discount_code">Discount Code</label>
                            <input type="text" name="discount_code" id="discount_code" placeholder="Enter Discount Code..." value="{{ $discount->code }}" required>
                        </div>
                
                        <div class="input">
                            <label for="discount_type">Discount Type</label>
                            <select name="discount_type" id="discount_type" required>
                                <option value="" disabled >Select Discount Type</option>
                                <option value="percentage" @if ($discount->type == 'percentage') selected @endif>Percentage</option>
                                <option value="fixed" @if ($discount->type == 'fixed') selected @endif>Fixed</option>
                            </select>
                        </div>
                
                        <div class="input">
                            <label for="discount_value">Discount Value</label>
                            <input type="text" name="discount_value" id="discount_value" placeholder="Enter Discount Value..." value="{{ $discount->value }}" required>
                        </div>
                
                        <div class="input">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $discount->start_date->format('Y-m-d') }}" required>

                        </div>
                
                        <div class="input">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $discount->end_date->format('Y-m-d') }}" required>
                        </div>
                
                        <div class="input">
                            <label for="usage_limit">Usage Limit</label>
                            <input type="number" name="usage_limit" id="usage_limit" placeholder="Enter Usage Limit..." value="{{ $discount->usage_limit }}" required>
                        </div>
                
                        <div class="input">
                            <label for="status">Status</label>
                            <select name="status" id="status" required>
                                <option value="Active" @if ($discount->status == 'Active') selected @endif>Active</option>
                                <option value="Expired"  @if ($discount->status == 'Expired') selected @endif>Expired</option>
                                <option value="Inactive"  @if ($discount->status == 'Inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                
                        <div class="input">
                            <label for="min_orders">Minimum Orders</label>
                            <input type="text" name="min_orders" id="min_orders" placeholder="Enter Minimum Orders..." value="{{ $discount->min_order_value }}" required>
                        </div>
                    </div>
                
                    <input type="hidden" name="discount_id" value="{{ $discount->id }}">
                
                    <div class="input">
                        <label for="category_description">Description</label>
                        <textarea name="category_description" id="category_description" rows="7" style="width:100%;" placeholder="Enter Description..." required>{{ $discount->description }}</textarea>
                    </div>
                
                    <div class="signup">
                        <button type="submit">Submit</button>
                    </div>
                </form>
                

            </div>


        </div>

    </div>


</body>

</html>
