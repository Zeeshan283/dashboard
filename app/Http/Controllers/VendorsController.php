<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use App\Models\Product;
use App\Models\ProductConditions;
use App\Models\ProductContact;
use App\Models\ProductImages;
use App\Models\ProductLocations;
use App\Models\ProductShippment;
use App\Models\Stock;
use App\Models\User;
use App\Models\vendorProfile;
use App\Models\VendorBankDetail;
use App\Models\VendorDocument;
use App\Models\PaymentMethod;
use App\Models\VendorProfilePayMethod;
use App\Models\Cprofile;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class VendorsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendor = User::select('id', 'name', 'phone1', 'email', 'status', 'verified_status', 'trusted_status')->whereRole('vendor')->get();
        $totalSupplier = User::select('id', 'name', 'phone1', 'email', 'status', 'verified_status', 'trusted_status')->whereRole('vendor')->count();
        $totalActiveSupplier = User::whereRole('vendor')->where('status','1')->count();
        $totalInActiveSupplier = User::whereRole('vendor')->where('status','0')->count();
        $data = Order::orderBy('id', 'desc')->get();
        return view('sellers.vendorlist', compact('vendor', 'data','totalSupplier','totalActiveSupplier','totalInActiveSupplier'));
    }

    public function create()
    {
        $status = array('0' => 'Active', '1' => 'In Active');
        return view('sellers.addseller', compact('status'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required',
            'password.required' => 'The password field is required'
        ]);
        $user = new User;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'Vendor';
        $user->status = $request->input('radio');
        $user->save();

        Toastr::success('Vendor Added Successfully!', 'Success');

        return redirect()->route('vendors.index');
    }
    public function show($id)
    {
        $edit = vendorProfile::with('user')->where('vendor_id', '=', $id)->first();
        $bankDetail = VendorBankDetail::with('vendor_profile')->where('vendor_id', '=', $id)->get();
        $vendordocument = VendorDocument::with('vendor_profile')->where('vendor_id', '=', $id)->get();
        return view('sellers.vendorview', compact('edit', 'bankDetail', 'vendordocument'));
    }


    public function edit($id)
    {
        $vendors = user::find($id);
        $status = array('0' => 'Active', '1' => 'In Active');
        return view('sellers.editseller', compact('vendors', 'status'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());


        $seller = User::findOrFail($id);

        if ($request->input('radio') == '') {
            $seller->status = '0';
        } else {
            $seller->status = $request->input('radio');
        }

        if ($request->input('verified') == '') {
            $seller->verified_status = '0';
        } else {
            $seller->verified_status = $request->input('verified');
        }
        if ($request->input('trusted') == '') {
            $seller->trusted_status = '0';
        } else {
            $seller->trusted_status = $request->input('trusted');
        }
        $seller->update();

        Toastr::success('Vendor Updated Successfully!');

        return redirect()->route('vendors.index');
    }

    public function destroy($id)
    {
        $vendor = User::findOrFail($id);
        File::delete('root/upload/logo/' . $vendor->image);

        $order_details = OrderDetails::where('vendor_id', $vendor->id)->get();
        foreach ($order_details as $order_detail) {
            Order::find($order_detail->order_id)->delete();
            OrderTracker::where('order_id', $order_detail->order_id)->delete();
        }
        OrderDetails::where('vendor_id', $vendor->id)->delete();


        $products = Product::where('created_by', $id)->get();


        foreach ($products as $product) {
            File::delete('root/upload/products/attachments/' . $product->attachment);


            ProductConditions::where('pro_id', $product->id)->delete();
            ProductContact::where('pro_id', $product->id)->delete();
            $product_images = ProductImages::where('pro_id', $product->id)->get();
            foreach ($product_images as $pimage) {
                File::delete('root/upload/products/' . $pimage->image);
            }
            ProductImages::where('pro_id', $product->id)->delete();
            ProductLocations::where('pro_id', $product->id)->delete();
            ProductShippment::where('pro_id', $product->id)->delete();
            Stock::where('pro_id', $product->id)->delete();
        }

        $vendor->delete();

        Toastr::success('Vendor Deleted Successfully!');

        return redirect('vendors')->back();
    }
    public function dashboard()
    {
        $isVendor = auth()->user()->roles->contains('name', 'vendorOnly');
        $disableProductsLink = $isVendor ? '' : 'disabled';

        return view('vendor.dashboard', [
            'disableProductsLink' => $disableProductsLink,
        ]);
    }

    public function createProduct()
    {
        $isVendor = auth()->user()->roles->contains('name', 'vendorOnly');

        if (!$isVendor) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create products.');
        }
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    public function vendorProfile($id)
    {
        $edit = vendorProfile::with('paymethod', 'user')->where('vendor_id', '=', $id)->first();
        $accepted_payment_type = PaymentMethod::all();
        $accepted_payment_type1 = VendorProfilePayMethod::where('vendor_id', '=', $id)->first();
        // dd($edit);
        if (!$edit) {
            $edit = new VendorProfile();
            $edit->vendor_id = $id; // Set the vendor_id
            $edit->save(); // Save the new record to the databas
        }
        if (!$accepted_payment_type1) {
            for ($i = 0; $i < count($accepted_payment_type); $i++) {
                $accepted_payment_type1 = new VendorProfilePayMethod();
                $accepted_payment_type1->vendor_id = $id;
                $accepted_payment_type1->save();
            }
        }
        // dd($edit);
        if ($edit) {

            $pay = PaymentMethod::orderBy('id')->get(['name', 'id']);

            return view('sellers.vendorprofile', compact('edit', 'accepted_payment_type', 'pay'));
        }
    }


    public function verifiedSeller($id)
    {

        $edit = vendorProfile::with('user')->where('vendor_id', '=', $id)->first();
        $bankDetail = VendorBankDetail::with('vendor_profile')->where('vendor_id', '=', $id)->get();
        $vendordocument = VendorDocument::with('vendor_profile')->where('vendor_id', '=', $id)->get();
        // dd($edit);
        if (!$edit) {
            $edit = new VendorProfile();
            $edit->vendor_id = $id;
            $edit->save();
        }
        return view('sellers.verifiedseller', compact('edit', 'bankDetail', 'vendordocument'));
    }

    public function trustedSellerSave(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'vendor_profile_id' => 'required',
            'vendor_id' => 'required',
            'account_title' => 'required',
            'account_no' => 'required',
            'iban_no' => 'required',
            'bank_name' => 'required',
            'bank_address' => 'required',
            'branch_code' => 'required',
        ], []);
        $data = new VendorBankDetail;

        $data->vendor_profile_id = $request->vendor_profile_id;
        $data->vendor_id = $request->vendor_id;
        $data->account_title = $request->account_title;
        $data->account_no = $request->account_no;
        $data->iban_no = $request->iban_no;
        $data->bank_name = $request->bank_name;
        $data->bank_address = $request->bank_address;
        $data->branch_code = $request->branch_code;

        $data->save();
        Toastr::success('Bank Details Added Successfully!', 'Success');
        return redirect()->back();
    }
    public function show1($id)
    {
        $bankDetail = VendorBankDetail::with('vendor_profile')->find($id);

        if (!$bankDetail) {
            abort(404);
        }

        return view('sellers.show', compact('bankDetail'));
    }


    public function vendorProfileSave(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->accepted_payment_type);
        $this->validate($request, [
            'company_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone1' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'tax_reg_title' => 'required',
            'tax_reg_number' => 'required',
            'tagline' => 'required',
            'rating' => 'required',
            // 'slider_images' => 'required',
            // 'about' => 'required',
            // Add other fields here as needed
        ]);

        $user = User::findOrFail($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->phone2;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->tagline = $request->tagline;
        $user->tax_reg_title = $request->tax_reg_title;
        $user->tax_reg_number = $request->tax_reg_number;
        $user->total_employees = $request->total_employees;
        $user->established_in = $request->established_in;
        $user->deals_in = $request->deals_in;
        $user->main_market = $request->main_market;
        $user->member_since = $request->member_since;
        $user->certifications = $request->certifications;
        $user->website_link = $request->website_link;
        $user->accepted_payment_type = $request->accepted_payment_type;
        $user->major_clients = $request->major_clients;
        $user->annual_export = $request->annual_export;
        $user->annual_import = $request->annual_import;
        $user->annual_revenue = $request->annual_revenue;
        $user->rating = $request->rating;

        $user->update();

        $update = vendorProfile::findOrFail($id);

        $update->company_name = $request->company_name;
        $update->country = $request->country;
        $update->tagline = $request->tagline;
        $update->rating = $request->rating;
        // $update->slider_title = $request->slider_title;
        // $update->slider_title2 = $request->slider_title2;
        // $update->p_category1 = $request->p_category1;
        // $update->p_category2 = $request->p_category2;
        // $update->p_category3 = $request->p_category3;
        // $update->p_category4 = $request->p_category4;
        // $update->p_category5 = $request->p_category5;
        $update->about = $request->about;
        $update->disclaimer = $request->disclaimer;

        $update->update();
        $images = [];


        if (isset($request->accepted_payment_type)) {
            if (count($request->accepted_payment_type) > 0) {
                VendorProfilePayMethod::where('vendor_id', $request->user_id)->delete();

                for ($i = 0; $i < count($request->accepted_payment_type); $i++) {
                    $data = new VendorProfilePayMethod();
                    $data->vendor_id = $request->user_id;
                    $data->profile_id = $update->id;
                    $data->pay_id = $request->accepted_payment_type[$i];
                    $data->save();
                }
            }
        }


        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/sliderBanner', $fileName);

                    $images[] = $path->getPathname();
                }
            }
            $update->slider_images = json_encode($images);
            $update->save();
        }

        if ($request->hasFile('p_c1_images')) {
            foreach ($request->file('p_c1_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }

            // Merge the new images with the existing ones
            $existingImages = json_decode($update->p_c1_images, true);

            if (is_array($existingImages)) {
                $images = array_merge($existingImages, $images);
            } else {
                // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $update->p_c1_images = json_encode($images);
            $update->save();
        }

        if ($request->hasFile('p_c2_images')) {
            foreach ($request->file('p_c2_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }
            $existingImages = json_decode($update->p_c2_images, true);

            if (is_array($existingImages)) {
                $images = array_merge($existingImages, $images);
            } else {
                // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $update->p_c2_images = json_encode($images);
            $update->save();
        }

        if ($request->hasFile('p_c3_images')) {
            foreach ($request->file('p_c3_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }

            // Merge the new images with the existing ones
            $existingImages = json_decode($update->p_c3_images, true);

            if (is_array($existingImages)) {
                $images = array_merge($existingImages, $images);
            } else {
                // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $update->p_c3_images = json_encode($images);
            $update->save();
        }

        if ($request->hasFile('p_c4_images')) {
            foreach ($request->file('p_c4_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }

            // Merge the new images with the existing ones
            $existingImages = json_decode($update->p_c4_images, true);

            if (is_array($existingImages)) {
                $images = array_merge($existingImages, $images);
            } else {
                // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $update->p_c4_images = json_encode($images);
            $update->save();
        }

        if ($request->hasFile('p_c5_images')) {
            foreach ($request->file('p_c5_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }

            // Merge the new images with the existing ones
            $existingImages = json_decode($update->p_c5_images, true);

            if (is_array($existingImages)) {
                $images = array_merge($existingImages, $images);
            } else {
                // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $update->p_c5_images = json_encode($images);
            $update->save();
        }

        if (!is_null($request->file('logo'))) {
            File::delete($update->logo);
            $extension = $request->file('logo')->getClientOriginalName();
            $imageName = uniqid() . '.' .  $extension;
            $path = $request->file('logo')->move('upload/vendorProfile/logo/', $imageName);
            $update->update(['logo' => $path->getPathname()]);
        }

        Toastr::success('Data Added Successfully!', 'Success');
        return redirect()->back();
    }

    public function verifiedSellerSave(Request $request, $id)
    {

        // uniqid() . '.' .
        // dd($request->all());

        $update = vendorProfile::findOrFail($id);
        if (!is_null($request->file('id_front'))) {
            File::delete($update->id_front);
            $extension = $request->file('id_front')->getClientOriginalName();
            $imageName = uniqid() . '.' .  $extension;
            $path = $request->file('id_front')->move('upload/vendorProfile/id_card/', $imageName);
            $update->update(['id_front' => $path->getPathname()]);
        }

        if (!is_null($request->file('id_back'))) {
            File::delete($update->id_back);
            $extension = $request->file('id_back')->getClientOriginalName();
            $imageName = uniqid() . '.' .  $extension;
            $path = $request->file('id_back')->move('upload/vendorProfile/id_card/', $imageName);
            $update->update(['id_back' => $path->getPathname()]);
        }

        if (!is_null($request->file('trade_license'))) {
            File::delete($update->trade_license);
            $extension = $request->file('trade_license')->getClientOriginalName();
            $imageName = uniqid() . '.' .  $extension;
            $path = $request->file('trade_license')->move('upload/vendorProfile/trade_licence/', $imageName);
            $update->update(['trade_license' => $path->getPathname()]);
        }

        Toastr::success('ID Details Added Successfully!', 'Success');
        return redirect()->back();
    }

    public function SellerDocumentSave(Request $request, $id)
    {
        // dd($request->all());

        $this->validate($request, [
            'document_name' => 'required',
            // 'document_file' => 'required',
        ], [
            'document_name.required' => 'The Document Name field is required',
            // 'document_file.required' => 'The Document File field is required'
        ]);

        $data = new VendorDocument();

        $data->vendor_profile_id = $request->vendor_profile_id;
        $data->vendor_id = $request->vendor_id;
        $data->document_name = $request->document_name;

        $images = [];

        if ($request->hasFile('document_file')) {
            foreach ($request->file('document_file') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/documents', $fileName);

                    $images[] = $path->getPathname();
                }
            }
            $data->document_file = json_encode($images);
            $data->save();
        }
        $data->save();

        Toastr::success('Document Added Successfully!', 'Success');
        return redirect()->back();
    }



    public function delete_document($id)
    {


        $delete = VendorDocument::findOrFail($id);
        // dd($delete->document_file);
        File::delete($delete->document_file);
        $delete->delete();

        Toastr::success('Document Deleted Successfully!', 'Deleted');
        return redirect()->back();
    }

    public function delete_bank_details($id)
    {


        $delete = VendorBankDetail::findOrFail($id);

        $delete->delete();

        Toastr::success('Bank Details Deleted Successfully!', 'Deleted');
        return redirect()->back();
    }

    public function deleteImage(Request $request, $id)
    {
        // Get the vendor profile record
        $vendorProfile = VendorProfile::findOrFail($id);

        // Decode the JSON arrays
        $sliderImages = json_decode($vendorProfile->slider_images, true);
        $p_c1Images = json_decode($vendorProfile->p_c1_images, true);
        $p_c2Images = json_decode($vendorProfile->p_c2_images, true);
        $p_c3Images = json_decode($vendorProfile->p_c3_images, true);

        $imageToDelete = $request->input('image'); // The image filename to delete

        // Remove the image from the arrays
        if (($key = array_search($imageToDelete, $sliderImages)) !== false) {
            unset($sliderImages[$key]);
        }
        if (($key = array_search($imageToDelete, $p_c1Images)) !== false) {
            unset($p_c1Images[$key]);
        }
        if (($key = array_search($imageToDelete, $p_c2Images)) !== false) {
            unset($p_c2Images[$key]);
        }
        if (($key = array_search($imageToDelete, $p_c3Images)) !== false) {
            unset($p_c3Images[$key]);
        }

        // Encode the arrays back to JSON
        $vendorProfile->slider_images = json_encode(array_values($sliderImages)); // Re-index the array
        $vendorProfile->p_c1_images = json_encode(array_values($p_c1Images));
        $vendorProfile->p_c2_images = json_encode(array_values($p_c2Images));
        $vendorProfile->p_c3_images = json_encode(array_values($p_c3Images));

        // Save the updated record
        $vendorProfile->save();

        // Delete the image file from storage
        // Storage::delete($imageToDelete);

        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
