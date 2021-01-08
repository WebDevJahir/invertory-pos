<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Repositories\InvoiceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use DB;
use Auth;
use PDF;

use Flash;
use Response;

class InvoiceController extends AppBaseController
{
    /** @var  InvoiceRepository */
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepo)
    {
        $this->invoiceRepository = $invoiceRepo;
    }

    /**
     * Display a listing of the Invoice.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        //$invoices = $this->invoiceRepository->all();
        $invoices = Invoice::with('payment.customer')->get();
        //$invoices = DB::table('invoices')->get();
        //dd($invoices);die;
        return view('invoices.index')
            ->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new Invoice.
     *
     * @return Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        $data['customers'] = Customer::all();
        $invoice_no = Invoice::orderBy('id','desc')->first();
        if($invoice_no==null){
            $firstReg = 0;
            $invoice_no = $firstReg+1;
        }else{
            $invoice_data= Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }
        return view('invoices.create',compact('data','invoice_no'));
    }

    /**
     * Store a newly created Invoice in storage.
     *
     * @param CreateInvoiceRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoiceRequest $request)
    {
        $input = $request->all();
      // dd($input); die;
        

            if($request->paid_amount>$request->estimated_amount){
                return redirect()->back()->with('error','Sorry! paid amount is maximum than total price');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->maindate));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;
                DB::transaction(function() use($request,$invoice){
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                       // dd($invoice->id); die;
                       // dd($count_category); die;  
                        for($i=0; $i<$count_category; $i++){
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d',strtotime($request->date[$i]));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }
                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->phone = $request->phone;
                            $customer->address = $request->address;
                            $customer->email = $request->email;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status=='full_paid') {
                            $payment->paid_status = $request->paid_status;
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                            $payment_details->current_due_amount ='0';
                        }elseif($request->paid_status=='full_due'){
                            $payment->paid_status = $request->paid_status;
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                            $payment_details->current_due_amount = $request->estimated_amount;
                        }elseif($request->paid_status=='partial_paid'){
                            $payment->paid_status = 'partial_paid';
                            $payment->paid_amount = $request->patial_paid_amount;
                            $payment->due_amount = $request->estimated_amount-$request->patial_paid_amount;
                            $payment_details->current_paid_amount = $request->patial_paid_amount;
                            $payment_details->current_due_amount = $request->estimated_amount-$request->patial_paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d',strtotime($request->maindate));
                        $payment_details->save();
                    }
                });

            }

        Flash::success('Invoice saved successfully.');

        return redirect(route('invoices.index'));
    }

    /**
     * Display the specified Invoice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoice = $this->invoiceRepository->find($id);

        if (empty($invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('invoices.index'));
        }

        return view('invoices.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified Invoice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoice = Invoice::with('payment')->where('id',$id)->first();
        $invoiceDetails = InvoiceDetail::with('category','product')->where('invoice_id',$id)->get();
        //dd($invoiceDetails); die;

        // if (empty($invoice)) {
        //     Flash::error('Invoice not found');

        //     return redirect(route('invoices.index'));
        // }
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        $data['customers'] = Customer::all();
        $invoice_no = Invoice::orderBy('id','desc')->first();
        if($invoice_no==null){
            $firstReg = 0;
            $invoice_no = $firstReg+1;
        }else{
            $invoice_data= Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }

        return view('invoices.edit',compact('invoice_no','data','invoiceDetails'))->with('invoice', $invoice);
    }

    /**
     * Update the specified Invoice in storage.
     *
     * @param int $id
     * @param UpdateInvoiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoiceRequest $request)
    {
        

        // if (empty($invoice)) {
        //     Flash::error('Invoice not found');

        //     return redirect(route('invoices.index'));
        // }

        // $invoice = $this->invoiceRepository->update($request->all(), $id);
        //dd($id); die;
          $input = $request->all();
          //dd($input);die;

            if($request->paid_amount>$request->estimated_amount){
                return redirect()->back()->with('error','Sorry! paid amount is maximum than total price');
            }else{
                $invoice = Invoice::find($id);

                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->maindate));
                $invoice->description = $request->description;
                $invoice->status = '1';
                $invoice->created_by = Auth::user()->id;
                DB::transaction(function() use($request,$invoice){
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);  
                        for($i=0; $i<$count_category; $i++){
                            $invoice_details = InvoiceDetail::where('id',$request->invoice_id[$i])->where('invoice_id',$invoice->id)->first();
                            //dd($invoice_details); die;
                            if($invoice_details){
                            $invoice_details->date = date('Y-m-d',strtotime($request->date[$i]));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }else{
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d',strtotime($request->date[$i]));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }
                        
                        }
                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->phone = $request->phone;
                            $customer->address = $request->address;
                            $customer->email = $request->email;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = Payment::where('invoice_id',$invoice->id)->first();
                        $payment_details = PaymentDetail::where('invoice_id',$invoice->id)->first();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status=='full_paid') {
                            $payment->paid_status = $request->paid_status;
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                            $payment_details->current_due_amount ='0';
                        }elseif($request->paid_status=='full_due'){
                            $payment->paid_status = $request->paid_status;
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                            $payment_details->current_due_amount = $request->estimated_amount;
                        }elseif($request->paid_status=='partial_paid'){
                            $payment->paid_status = 'partial_paid';
                            $payment->paid_amount = $request->patial_paid_amount;
                            $payment->due_amount = $request->estimated_amount-$request->patial_paid_amount;
                            $payment_details->current_paid_amount = $request->patial_paid_amount;
                            $payment_details->current_due_amount = $request->estimated_amount-$request->patial_paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d',strtotime($request->maindate));
                        $payment_details->save();
                    }
                });

            }

        Flash::success('Invoice updated successfully.');

        return redirect(route('invoices.index'));
    }

    /**
     * Remove the specified Invoice from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoice = $this->invoiceRepository->find($id);

        if (empty($invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('invoices.index'));
        }

        $this->invoiceRepository->delete($id);

        Flash::success('Invoice deleted successfully.');

        return redirect(route('invoices.index'));
    }

    public function getStock(Request $request){
        $product_id = $request->product_id;
        $quantity = Product::where('id',$product_id)->first()->quantity;
        echo $quantity;
    }

    public function approved($id){
        $invoice = Invoice::with('invoice_details')->find($id);
       // dd($invoice);
        return view('invoices.invoice-approve',compact('invoice'));
        
    }

    public function comfirmApprove(Request $request,$id){
       // dd($request->selling_qty); die;
        foreach ($request->selling_qty as $key => $value) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product_name = Product::where('id',$invoice_details->product_id)->first();
            if($product_name->quantity < $request->selling_qty[$key]){
                Flash::error($product_name->product_name.' Quantity not enough');
                return redirect()->back();
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach ($request->selling_qty as $key => $value) {
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = $product->quantity - $request->selling_qty[$key];
                $product->save();
            }
            $invoice->save();
        });
        Flash::success('Invoice Approved Successfully');
        return redirect(route('invoices.index'));
    }

    public function printInvoice($id){
        $invoice = Invoice::with('invoice_details')->find($id);
        $pdf = PDF::loadView('invoices.print',compact('invoice'));
        return $pdf->stream('invoice.pdf');
    }

    public function dailyReport(Request $request){
        if($request->method('post')){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $reports = Invoice::with('invoice_details')->whereBetween('date',[$start_date,$end_date])->where('status','1')->get();
      }
        return view('invoices.daily-report',compact('start_date','end_date'))->with('reports',$reports);
    }

    public function removeProduct(Request $request){
        $product_id = $request->product_id;
        $delete_product = InvoiceDetail::where('id',$product_id)->delete();
        echo "Product Deleted successfully";
    }
}
