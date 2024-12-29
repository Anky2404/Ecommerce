<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Display the category list page
    public function categoryPage()
    {
        $categories = Category::all();
        return view('backend.categories', compact('categories'));
    }

    // Display the update category page
    public function updateCategoryPage($cat_id)
    {
        //Decode the category ID
        $category_id = base64_decode($cat_id);
        $category = Category::find($category_id);
        return view('backend.edit-category', compact('category'));
    }

    //Remove a category
    public function removeCategory($cat_id)
    {
        //Decode the category ID
        $category_id = base64_decode($cat_id);
        $category = Category::find($category_id);
        if (!$category) {
            return back()->with('error', 'Category not found.');
        }

        // Delete the category
        $category->delete();

        // Redirect with success message
        return redirect()->route('admin.categories')->with('error', 'Category removed successfully!');
    }

    // Add a new category
    public function addCategory(Request $request)
    {
        // Validate the request
        Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('image_url')) {
            // Get the image file
            $image = $request->file('image_url');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the folder
            $image->move(public_path('uploads/cat_img'), $imageName);
        }

        // Create a new category
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->category_img = $imageName;
        $category->is_active = 1;
        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category added successfully');
    }

    public function updateCategory(Request $request)
    {
        // Validate the basic fields
        Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'category_description' => 'required|string',
        ]);

        // Validate image if it exists
        if ($request->hasFile('image_url')) {
            $request->validate([
                'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Get the image file
            $image = $request->file('image_url');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the folder
            $image->move(public_path('uploads/cat_img'), $imageName);
        }

        // Find the category by ID
        $category = Category::find($request->category_id);
        if (!$category) {
            // If the category is not found, return an error
            return back()->with('status', 'Category not found.');
        }

        // Update category details
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;

        // If an image was uploaded, update the image_url
        if (isset($imageName)) {
            $category->category_img = $imageName;
        }

        // Save the updated category
        $category->save();

        // Redirect with success message
        return redirect()->route('admin.categories')->with('status', 'Category updated successfully!');
    }
}
