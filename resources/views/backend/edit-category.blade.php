<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Edit Category</h3>
            <div class="game-form">

                <form method="POST" action="{{ route('admin.update-category') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="input">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="category_name" id="category_name"
                                placeholder="Enter Category Name..." value="{{$category->category_name}}" required>
                        </div>

                        <div class="input">
                            <label for="image_url">Image Upload (Max : 2mb)</label>
                            <input type="file" name="image_url" id="image_url" >
                        </div>
                    </div>

                    <input type="hidden" name="category_id" value="{{$category->id}}">
                    <div class="input">
                        <label for="category_description">Category Description</label>
                        <textarea name="category_description" id="category_description" rows="7" style="width:100%;"
                            placeholder="Enter Category Description..." required>{{$category->category_description}}</textarea>
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
