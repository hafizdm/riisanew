<?php

namespace App\Http\Controllers\PRF;

use \PDF;
use App\Role;
use App\Employee;
use Carbon\Carbon;
use App\PurchaseRequest;
use App\PurchaseRequestItem;
use Illuminate\Http\Request;
use App\PurchaseRequestCategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestFormController extends Controller
{
    public function index()
    {
        $purchaseRequest = PurchaseRequest::query()->where('employee_id', Auth::user()->user_login->id)->orderBy('id', 'desc')->get();
        return view('purchaserequest/index', compact('purchaseRequest'));
    }

    public function create()
    {
        $categories = PurchaseRequestCategory::all();
        $employee = Auth::user()->user_login;
        return view('purchaserequest/create', compact('categories','employee')); 
    }

    public function store(Request $request)
    {
        // dd(request()->input());
        try{
            $data = new PurchaseRequest();
            $category = PurchaseRequestCategory::find($request->get('purchase_request_category_id'));
            $data->employee_id = Auth::user()->user_login->id;
            $data->prf_number = "";
            $data->prepared_date = $request->get('prepared_date');
            $data->purchase_request_category_id = $category->id;
            $data->approver_employee_id = $category->approver_employee_id;
            $data->required_date = $request->get('required_date');
            $data->received_date = $request->get('received_date');
            $data->brand_preference = $request->get('brand_preference');
            $data->suggested_vendor = $request->get('suggested_vendor');
            $data->justification_attached = $request->get('justification_attached');
            $data->work_package = $request->get('work_package');
            $data->receipt_to = $request->get('receipt_to');
            $data->note_receiver = $request->get('note_receiver');
            $data->delivered_by = $request->get('delivered_by');
            $data->import = $request->get('import');
            $data->is_urgent = $request->get('is_urgent');
            $data->project_ref_number = $request->get('project_ref_number');
            $data->intended_use = $request->get('intended_use');
            $data->delivery_to = $request->get('delivery_to');
            $data->total_balance = $request->get('total_balance');
            if (request()->hasFile('attachment_file')) {
                $fileInput = request()->file('attachment_file');
                $fileName = str_replace('/', '-', $data->id) . '.' . $fileInput->getClientOriginalExtension();
                $fileInput->move('uploads/PurchaseRequest/attachmentFile', $fileName);
          
                $data->attachment_file = $fileName;
              }
            $data->status = 0; //waiting user approval
            

            $data->save();
    
            foreach ($request->get('items', []) as $item) {
                $purchaseRequestItem = new PurchaseRequestItem();
                $purchaseRequestItem->purchase_request_id = $data->id;
                $purchaseRequestItem->item_number = $item['item_number'];
                $purchaseRequestItem->item_class = $item['item_class'];
                $purchaseRequestItem->description = $item['description'];
                $purchaseRequestItem->budget_code = $item['budget_code'];
                $purchaseRequestItem->unit_price = $item['unit_price'];
                $purchaseRequestItem->unit = $item['unit'];
                $purchaseRequestItem->qty = $item['qty'];
                $purchaseRequestItem->subtotal = $item['subtotal'];
                $purchaseRequestItem->save();
            }         

            // Add 1 day to include start date                  

            $data->prf_number = implode('/', [
              'RII',
              'PRC-PRF',
              $data->created_at->format('m'),
              $data->created_at->format('y'),
              str_pad($data->id, 5, '0', STR_PAD_LEFT)
            ]);
            $data->save();

            // Dynamic receiver
            

            return redirect('pengajuan-prf')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
           return redirect('pengajuan-prf')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    public function edit($id)
    {
        $purchaseRequest = PurchaseRequest::with('purchaseRequestItems')->find($id);
        $categories = PurchaseRequestCategory::all();

        return view('purchaserequest/edit', compact('purchaseRequest', 'categories'));    

    }

    public function update(Request $request, $id)
    {
        // dd(request()->input());
        try{
            $data = PurchaseRequest::find($id);
            $category = PurchaseRequestCategory::find($request->get('purchase_request_category_id'));
            $data->employee_id = Auth::user()->user_login->id;
            $data->prepared_date = $request->get('prepared_date');
            $data->purchase_request_category_id = $category->id;
            $data->approver_employee_id = $category->approver_employee_id;
            $data->required_date = $request->get('required_date');
            $data->received_date = $request->get('received_date');
            $data->brand_preference = $request->get('brand_preference');
            $data->suggested_vendor = $request->get('suggested_vendor');
            $data->justification_attached = $request->get('justification_attached');
            $data->work_package = $request->get('work_package');
            $data->receipt_to = $request->get('receipt_to');
            $data->note_receiver = $request->get('note_receiver');
            $data->delivered_by = $request->get('delivered_by');
            $data->import = $request->get('import');
            $data->is_urgent = $request->get('is_urgent');
            $data->project_ref_number = $request->get('project_ref_number');
            $data->intended_use = $request->get('intended_use');
            $data->delivery_to = $request->get('delivery_to');
            $data->total_balance = (int)$request->get('total_balance');

            if (request()->hasFile('attachment_file')) {
                $fileInput = request()->file('attachment_file');
                $fileName = str_replace('/', '-', $data->id) . '.' . $fileInput->getClientOriginalExtension();
                $fileInput->move('uploads/PurchaseRequest/attachmentFile', $fileName);
          
                $data->attachment_file = $fileName;
              }
            $data->status = 0; //waiting user approval
            $data->save();
    
            $purchaseRequestItemIds = [];
            foreach ($request->get('items', []) as $item) {
                // Find or initialize new record
                $purchaseRequestItem = $data->purchaseRequestItems()
                    ->firstOrNew(['id' => $item['id']]);

                $purchaseRequestItem->item_number = $item['item_number'];
                $purchaseRequestItem->item_class = $item['item_class'];
                $purchaseRequestItem->description = $item['description'];
                $purchaseRequestItem->budget_code = $item['budget_code'];
                $purchaseRequestItem->unit_price = $item['unit_price'];
                $purchaseRequestItem->unit = $item['unit'];
                $purchaseRequestItem->qty = $item['qty'];
                $purchaseRequestItem->subtotal = $item['subtotal'];
                $purchaseRequestItem->save();

                $purchaseRequestItemIds[] = $purchaseRequestItem->id;
            }

            // Remove obsolete data
            $data->purchaseRequestItems()
                ->whereNotIn('id', $purchaseRequestItemIds)
                ->delete();                                       

            return redirect('pengajuan-prf')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
           return redirect('pengajuan-prf')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    public function destroy($id)
    {
        $purchaseRequest = PurchaseRequest::destroy($id);
            if($purchaseRequest){
                return response()->json([
                    'success' => 'Purchase Request berhasil dihapus'
                ]);
            }
            else{
                return response()->json([
                    'failes' => 'Purhcase Request gagal di hapus'
                ]);
            }
    }

    public function pdfPrf($id)
    {
        set_time_limit(300);
        $data = PurchaseRequest::find($id);
        
        $pdf = PDF::loadview('purchaserequest/cetak', compact('data'))->setPaper('a4','potrait');
        // dd($data);  
        $fileName = $data->prepared_date;
        return $pdf->stream("Purchase Requisition"." ".$fileName. '.pdf');
    }

    public function indexRequest()
    {
        $data = PurchaseRequest::query()
            ->where('approver_employee_id', Auth::user()->user_login->id)
            ->where('status', 0)
            ->get();

        return view('purchaserequest/approvalman/index', compact('data'));
    }

    public function editPrfRequest($id)
    {
        $data['purchaseRequest'] = PurchaseRequest::with('purchaseRequestItems')->find($id);
        $data['categories'] = PurchaseRequestCategory::all();

        return view('purchaserequest/approvalman/edit')->with($data);
    }

    public function userApprovedPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 2;
        if ($purchaseRequest->total_balance < 50_000_000) {
            $approverRole = Role::where('name', 'CO')->first();
        } else {
            $approverRole = Role::where('name', 'CEO')->first();
        }
        $approver = Employee::query()
            ->whereHas('user_login', function ($q) use($approverRole) {
                return $q->where('role_id', optional($approverRole)->id);
            })
            ->first();
        $purchaseRequest->approver_employee_id = $approver->id;
        $purchaseRequest->save();
    }

    public function userRejectPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 1;
        $purchaseRequest->save();
    }

    public function indexCo()
    {
        $purchaseRequest = PurchaseRequest::query()
        ->where('approver_employee_id', Auth::user()->user_login->id)
        ->where('status', 2)
        ->get();

        return view('purchaserequest/approvalco/index', compact('purchaseRequest'));
    }

    public function editPrfCo($id)
    {
        $data['purchaseRequest'] = PurchaseRequest::with('purchaseRequestItems')->find($id);
        $data['categories'] = PurchaseRequestCategory::all();

        return view('purchaserequest/approvalco/edit')->with($data);
    }

    public function coApprovedPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 4;
        $purchaseRequest->save();
    }

    public function coRejectPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 3;
        $purchaseRequest->save();
    }

    public function indexCeo()
    {
        $purchaseRequest = PurchaseRequest::query()
        ->where('approver_employee_id', Auth::user()->user_login->id)
        ->where('status', 2)
        ->get();
        return view('purchaserequest/approvalceo/index', compact('purchaseRequest'));
    }

    public function editPrfCeo($id)
    {
        $data['purchaseRequest'] = PurchaseRequest::with('purchaseRequestItems')->find($id);
        $data['categories'] = PurchaseRequestCategory::all();

        return view('purchaserequest/approvalceo/edit')->with($data);
    }

    public function ceoApprovedPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 4;
        $purchaseRequest->save();
    }

    public function ceoRejectPrf($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->status = 3;
        $purchaseRequest->save();
    }
}
