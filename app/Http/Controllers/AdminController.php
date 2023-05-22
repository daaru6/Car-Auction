<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\CarBrands;
use App\Models\CarCategory;
use App\Models\UserRegistrationAmount;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    //
    public function adminDashboard(Request $request)
    {
        $title = "Dashboard";
        $agents = User::where('role', 'User')->get()->count();
        $car_brands = CarBrands::get()->count();
        $car_categories = CarCategory::get()->count();
        return view("admin.dashboard", compact('title', 'agents', 'car_brands', 'car_categories'));
    }

    public function user_registration_amount(Request $request){
        $title = "User Registration Amount";
        $amount = UserRegistrationAmount::first();
        if ($request->isMethod('POST')) {
            $request->validate([
                'amount' => "required"
            ]);
            $amount->update(['amount' => $request->amount]);    
            return redirect()->back()->with("success", "Success!");
        }  
        return view("admin.userregistration", compact('title', 'amount'));
    }

    public function user(Request $request)
    {
        $title = "Users";
        $agents = User::where('role', 'User')->get();
        return view("admin.agents", compact('title', 'agents'));
    }

    public function userNew(Request $request)
    {
        $title = "Add User";
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => "unique:users"
            ]);
            $data = $request->toArray();
            $data["role"] = "User";
            $agent = User::create($data);
            return redirect()->back()->with("success", "User Created Successfully!");
        }
        return view("admin.new", compact("title"));
    }

    public function userEdit(Request $request, $id)
    {
        $title = "Edit User";
        $agent = User::find($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => Rule::unique('users')->ignore($id)
            ]);
            $agent->fill($request->toArray());
            $agent->save();
            return redirect()->back()->with("success", "User Updated Successfully!");
        }
        return view("admin.edit", compact("title", "agent"));
    }

    public function userDelete(Request $request, $id)
    {
        $user =  User::find($id);
        $user->delete();
        return redirect()->back()->with("success", "User Deleted Successfully!");
    }

    public function active_user(Request $request){
        $user =  User::findOrFail($request->id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with("success", "User Status Updated Successfully!");
    }

    public function orders(Request $request){

        $title = "All Orders";

        $orders = Order::with('orderItems','user')->latest()->get();

        return view('admin.orders.all', compact('title', 'orders'));
    }

    public function order_detail(Request $request){
        $title = "View Order";
        $order = Order::with('orderItems','user','orderItems.product')->findOrFail($request->id);
        return view('admin.orders.detail', compact('title', 'order'));
    }

    public function update_order_status(Request $request)
    {
        $validated_data = $request->validate([
            'id' => 'required|exists:orders,id',
            'status' => 'required|in:Pending,Completed',
        ]);
    
        $status = $validated_data['status'] === 'Pending' ? 'Completed' : 'Pending';
    
        Order::where('id', $validated_data['id'])
            ->update(['status' => $status]);
    
        return redirect()->back()->with('success', 'Status Updated!');
    }

    
}
