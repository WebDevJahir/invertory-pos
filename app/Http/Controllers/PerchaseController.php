<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerchaseRequest;
use App\Http\Requests\UpdatePerchaseRequest;
use App\Repositories\PerchaseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Perchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Flash;
use Response;

class PerchaseController extends AppBaseController
{
    /** @var  PerchaseRepository */
    private $perchaseRepository;

    public function __construct(PerchaseRepository $perchaseRepo)
    {
        $this->perchaseRepository = $perchaseRepo;
    }

    /**
     * Display a listing of the Perchase.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
       // $perchases = $this->perchaseRepository->all();
         $perchases = Perchase::with('category','product','supplier')->get();
        //dd($perchase);
        return view('perchases.index')
            ->with('perchases', $perchases);
    }

    /**
     * Show the form for creating a new Perchase.
     *
     * @return Response
     */
    public function create()
    {
        $categories =  Category::get();
        $suppliers =  Supplier::get();
        $products =  Product::get();
        return view('perchases.create',compact('categories','suppliers','products'));
    }

    /**
     * Store a newly created Perchase in storage.
     *
     * @param CreatePerchaseRequest $request
     *
     * @return Response
     */
    public function store(CreatePerchaseRequest $request)
    {
        // $input = $request->all();

        // $perchase = $this->perchaseRepository->create($input);
        //dd($request->all()); die;
        $count_category = count($request->category_id);
        for($i=0;$i<$count_category; $i++){
            $purchase = new Perchase();
            $purchase->date = $request->date[$i];
            $purchase->purchase_no = $request->purchase_no[$i];
            $purchase->supplier_id = $request->supplier_id[$i];
            $purchase->category_id = $request->category_id[$i];
            $purchase->product_id = $request->product_id[$i];
            $purchase->buying_qty = $request->buying_qty[$i];
            $purchase->unit_price = $request->unit_price[$i];
            $purchase->description = $request->description[$i];
            $purchase->buying_price = $request->buying_price[$i];
            $purchase->created_by = $request->user()->id;
            $purchase->status='0';
            $purchase->save();
        }

        Flash::success('Perchase saved successfully.');

        return redirect(route('perchases.index'));
    }

    /**
     * Display the specified Perchase.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
       // $perchase = $this->perchaseRepository->find($id);

         $perchase = Perchase::with('category','product','supplier')->where('id',$id)->first();
         //dd($perchase->supplier);die; 
        if (empty($perchase)) {
            Flash::error('Perchase not found');

            return redirect(route('perchases.index'));
        }

        return view('perchases.show')->with('perchase', $perchase);
    }

    /**
     * Show the form for editing the specified Perchase.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $perchase = $this->perchaseRepository->find($id);

        if (empty($perchase)) {
            Flash::error('Perchase not found');

            return redirect(route('perchases.index'));
        }

        return view('perchases.edit')->with('perchase', $perchase);
    }

    /**
     * Update the specified Perchase in storage.
     *
     * @param int $id
     * @param UpdatePerchaseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePerchaseRequest $request)
    {
        $perchase = $this->perchaseRepository->find($id);

        if (empty($perchase)) {
            Flash::error('Perchase not found');

            return redirect(route('perchases.index'));
        }

        $perchase = $this->perchaseRepository->update($request->all(), $id);

        Flash::success('Perchase updated successfully.');

        return redirect(route('perchases.index'));
    }

    /**
     * Remove the specified Perchase from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $perchase = $this->perchaseRepository->find($id);

        if (empty($perchase)) {
            Flash::error('Perchase not found');

            return redirect(route('perchases.index'));
        }

        $this->perchaseRepository->delete($id);

        Flash::success('Perchase deleted successfully.');

        return redirect(route('perchases.index'));
    }

    public function approved($id){

        $purchase = Perchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = $purchase->buying_qty + $product->quantity;
        $product->quantity = $purchase_qty;
        if($product->save()){
            $updatePerchase = Perchase::where('id',$id)->update(['status'=>1]);
         Flash::success('Perchase Status updated successfully.');
         return redirect()->back();
        }

        
    }

    public function dailyReport(Request $request){
        if($request->method('post')){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $reports = Perchase::with('supplier','product')->whereBetween('date',[$start_date,$end_date])->where('status','1')->get();
       // dd($reports); die;
      }
        return view('perchases.daily-report',compact('start_date','end_date'))->with('reports',$reports);
    }
    
}
