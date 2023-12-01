<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\User\Checkout\Store;
use App\Models\Checkout;
use App\Models\Camp;
use App\Models\User;
use Auth;
use Mail;

class CheckoutController extends Controller
{
    public function create(Camp $camp)
    {
        return view('checkout.create', [
            "camp"=>$camp
        ]);
    }

    public function store(Store $request, Camp $camp)
    {
        try{
            DB::beginTransaction();
            //mapping request data
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['camp_id'] = $camp->id;

            //update user data 
            $user = Auth::user();
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->occupation = $data['occupation'];
            $user->save();

            //create checkout
            $checkout = Checkout::create($data);

            Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        } catch (\Throwable $ex){
            DB::rollBack();
            return redirect()->back()->withErrors(['msg' => $ex->getMessage()]);
        }
        return redirect(route('checkout.success'));
    }

    public function success()
    {
        return view('checkout.success');
    }



}