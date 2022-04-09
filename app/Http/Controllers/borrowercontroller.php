<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class borrowercontroller extends Controller
{
    public function create(Request $request) {
        try {
        $name = session('uniname');
        if(!$name == null){
            $this->validate($request, [
                'fullname' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);

            $fullname = $request->input('fullname');
            $gender = $request->input('gender');
            $address = $request->input('address');
            $now = \Carbon\Carbon::now();

            $data=array(
                "fullname"=>$fullname,
                "gender"=>$gender,
                "status"=> "Active",
                "address"=> $address,
                "vio_count"=> 0 ,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "resetmonth" => $now->month);

            DB::table('borrowers')->insert($data);
    
            return redirect()->route('borrower')->with('message', 'Successfully Created!');
            }
            else {
                return view('login',['message' => 'Error!']);
            } 
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }
    }

    public function edit(Request $request) {
        try {
        $name = session('uniname');

        if(!$name == null){
            $this->validate($request, [
                'fullname' => 'required',
                'vio' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);

            $Borrower_id = $request->input('Borrower_id');
            $fullname = $request->input('fullname');
            $vio = $request->input('vio');
            $gender = $request->input('gender');
            $address = $request->input('address');

            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['fullname' => $fullname ,'gender' => $gender,'address' => $address,'vio_count' => $vio,'updated_at' => \Carbon\Carbon::now()]);
            return redirect()->route('borrower')->with('message', 'Successfully Edited!');
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message', 'Error Occured.');
    }
    }

    public function delete($Borrower_id) {

        try {

        $name = session('uniname');

        if(!$name == null){

            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->delete();
            return redirect()->route('borrower')->with('message2', 'Successfully Deleted.')->with('page', 1);

        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message2', 'Error Occured.')->with('page', 1);
    }

    }


    public function borrowernotactive($Borrower_id) {

        try {

        $name = session('uniname');

        if(!$name == null){

            $transac = DB::table('transactions')->select('*')->where('Borrower_id', '=' , $Borrower_id)->get();
            $transaccount = $transac->count();

            $viocheck = DB::table('borrowers')->select('*')->where('Borrower_id', '=' , $Borrower_id)->where('vio_count','!=', '0')->where('Status','=','Active')->get();
            $viocheckcount = $viocheck->count();
            
            if ($transaccount == 0) {

                if( $viocheckcount == 0 ){

                    DB::table('transactions')->where('Borrower_id', $Borrower_id)->delete();
                    DB::table('historys')->where('Borrower_id', $Borrower_id)->delete();
                    DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['status' => 'NotActive']);
        
        
                    return redirect()->route('borrower')->with('message', 'Successfully Archived.');
                }
                else{
                    return redirect()->route('borrower')->with('message', 'This Still Have Violations!');
                }
            }
            else {
                return redirect()->route('borrower')->with('message', 'This User have not returned book!.');
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message', 'Error Occured.');
    }

    }



    public function createdisplay() {
        $name = session('uniname');
        if(!$name == null){
            return view('borrower.create',['name' => $name]);
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }


    public function editdisplay($Borrower_id) {

        $name = session('uniname');

        if(!$name == null){

            $fullname = DB::table('borrowers')->select('fullname')->where('Borrower_id', $Borrower_id)->pluck('fullname')->first();
            $gender = DB::table('borrowers')->select('gender')->where('Borrower_id', $Borrower_id)->pluck('gender')->first();
            $address = DB::table('borrowers')->select('address')->where('Borrower_id', $Borrower_id)->pluck('address')->first();
            $vio = DB::table('borrowers')->select('vio_count')->where('Borrower_id', $Borrower_id)->value('vio_count');
                
            return view('borrower.edit', ['name' => $name,'Borrower_id' => $Borrower_id,'fullname' => $fullname,'gender' => $gender,'address' => $address,'vio' => $vio]);
            
        }

        else {
            return view('login',['message' => 'Error!']);
        } 
    }

    public function searchborroweractive(Request $request){
        try {

            $this->validate($request, [
                'searchborroweractive' => 'required',
            ]);
    
            $searchborroweractive = $request->input('searchborroweractive');
    
            $name = session('uniname');
            $searchborrower = DB::table('borrowers')->select('*')->where('fullname','like', '%'.$searchborroweractive.'%')->where('Status', '=' , 'Active')->paginate(6);
            $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
            if(!$name == null){
                return view('borrower',['name' => $name, 'borroweractive' => $searchborrower,'borrowernotactive' => $borrowernotactive,'page' => 0]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }

    }

    public function searchborrowernotactive(Request $request){
        try {

            $this->validate($request, [
                'searchborrowernotactive' => 'required',
            ]);
    
            $searchborrowernotactive = $request->input('searchborrowernotactive');
    
            $name = session('uniname');
            $searchborrowernotactive = DB::table('borrowers')->select('*')->where('fullname','like', '%'.$searchborrowernotactive.'%')->where('Status', '=' , 'NotActive')->get();
            $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->paginate(6);
            if(!$name == null){
                return view('borrower',['name' => $name, 'borroweractive' => $borroweractive,'borrowernotactive' => $searchborrowernotactive, 'page' => 1]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }
    }

}


