<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        return view('backend.legacy.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.legacy.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->saveCustomer($request->all());

        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('backend.legacy.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.legacy.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->saveCustomer($request->all(), $customer);

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index');
    }

    protected function saveCustomer(array $data = [], $id = null)
    {
        // Image Handling
        if (isset($data['image'])) {
            $data['image'] = $this->buildImage(Str::slug($data['label']), $data['image']);
        }

        // We create the Customer
        if ($id === null) {
            return Customer::query()->create($data);
        }

        return Customer::query()->update($data, $id);
    }

    /**
     * Build the image.
     *
     * @param  string  $slug
     * @param  string  $image
     * @return string
     */
    protected function buildImage($slug, $file)
    {
        $filePath = 'uploads/customers/'.$slug.'.'.$file->getClientOriginalExtension();
        Image::read($file)->save(public_path($filePath));

        return '/'.$filePath;
    }
}
