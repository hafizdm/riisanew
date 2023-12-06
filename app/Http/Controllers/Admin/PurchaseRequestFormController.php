<?php

namespace App\Http\Controllers\Admin;
use App\Employee;
use App\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\PurchaseRequestCategory;
use App\Http\Controllers\Controller;

class PurchaseRequestFormController extends Controller
{
  public function index()
  {
    $categories = PurchaseRequestCategory::all();
    return view('admin/approvalprocurement/index', compact('categories'));
  }  

  public function create()
  {
      $employee = Employee::query()
          ->whereNotIn('nik', ['admin', 'finance', 'asset.management', 'HRD'])
          ->get();
  
      return view('admin/approvalprocurement/create', compact('employee'));
  }
  public function store(Request $request)
  {
   
      $categories = new PurchaseRequestCategory();
      $categories->approver_employee_id=$request->input('approver_employee_id');
      $categories->category_name = $request->input('category_name');
      $categories->budget_type = $request->input('budget_type');
      $categories->save();

      return redirect('scope-approval')->with('success', 'Data berhasil ditambahkan');
    
  }

  public function edit($id)
  {
    $purchase_request_category = PurchaseRequestCategory::find($id);
    $employee = Employee::query()
          ->whereNotIn('nik', ['admin', 'finance', 'asset.management', 'HRD'])
          ->get();
    return view('admin/approvalprocurement/edit', compact('purchase_request_category','employee'));
  }

  public function update(Request $request, $id)
  {
    try{
      $categories = PurchaseRequestCategory::find($id);
      $categories->approver_employee_id=$request->input('approver_employee_id');
      $categories->category_name = $request->input('category_name');
      $categories->budget_type = $request->input('budget_type');
      $categories->save();

      return redirect('/scope-approval')->with('success', 'Data  berhasil di Update');
    }
    catch(\Exception $e){
      return redirect('scope-approval')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
   }
  }

  public function destroy($id)
  {
    $categories = PurchaseRequestCategory::destroy($id);
        if($categories){
            return response()->json([
                'success'=> 'Categories berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Categories gagal dihapus'
            ]);
        }
  }

  public function indexPrf()
  {
    $purchaseRequest = PurchaseRequest::query()
    ->whereIn('status', [4, 5])
    ->orderBy('id', 'desc')
    ->get();
    return view('admin/purchaserequest/index', compact('purchaseRequest'));
  }

  public function editPrf($id)
  {
    $data['purchaseRequest'] = PurchaseRequest::with('purchaseRequestItems')->find($id);
    $data['categories'] = PurchaseRequestCategory::all();

    return view('admin/purchaserequest/edit')->with($data);
  }

  public function listApprovedPrf($id)
  {
    $purchaseRequest = PurchaseRequest::find($id);
    $purchaseRequest->status = 5;
    $purchaseRequest->save();
  }

  public function uploadFile($id)
  {
    $data['purchaseRequest']= PurchaseRequest::find($id);
    return view('admin/purchaserequest/uploadPo')->with($data);
  }

  public function updateUpload(Request $request,$id)
  {
         $data = PurchaseRequest::find($id);

        
        $files = $request->file('upload_file');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'PurchaseRequest'; // upload path
        $file = "PrfClear_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadPrf= $file;

        $data->upload_file = $uploadPrf;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('prf-list')->with('success', 'File successfully updated');
  }
}
