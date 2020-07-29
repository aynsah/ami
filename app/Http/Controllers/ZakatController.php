<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateZakatRequest;
use App\Http\Requests\UpdateZakatRequest;
use App\Repositories\ZakatRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ZakatController extends AppBaseController
{
    /** @var  ZakatRepository */
    private $zakatRepository;
    private $data = '';

    public function __construct(ZakatRepository $zakatRepo)
    {
        $this->zakatRepository = $zakatRepo;
    }

    /**
     * Display a listing of the Zakat.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function front(){

        return view('zakats.index');
    }

    public function payment(Request $request){
        $data = array();

        $data['qty'] = $request->input('qty-zakat');
        $data['amount'] = $request->input('kadar-zakat') * $data['qty'];
        $data['akad'] = $request->input('akad');
        $data['name'] = 'Natieq Sah Muhammad';
        $data['phone'] = '081221572240';
        $data['address'] = 'Jl. Babakan Ciparay';

        return view('zakats.payment', ['data' => $data]);
    }

    public function index(Request $request)
    {
        $zakats = $this->zakatRepository->all();

        return view('admin.zakats.index')
            ->with('zakats', $zakats);
    }

    /**
     * Show the form for creating a new Zakat.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.zakats.create');
    }

    /**
     * Store a newly created Zakat in storage.
     *
     * @param CreateZakatRequest $request
     *
     * @return Response
     */
    public function store(CreateZakatRequest $request)
    {
        $input = $request->all();

        $zakat = $this->zakatRepository->create($input);

        Flash::success('Zakat saved successfully.');

        return redirect(route('zakats.index'));
    }

    /**
     * Display the specified Zakat.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if($this->data_check($id)){
            return view('admin.zakats.show')->with('zakat', $this->data);
        }else{
            return redirect(route('zakats.index'));
        }
    }

    /**
     * Show the form for editing the specified Zakat.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if($this->data_check($id)){
            return view('admin.zakats.show')->with('zakat', $this->data);
        }else{
            return redirect(route('zakats.index'));
        }
    }

    /**
     * Update the specified Zakat in storage.
     *
     * @param int $id
     * @param UpdateZakatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateZakatRequest $request)
    {
        $this->data_check($id);

        $zakat = $this->zakatRepository->update($request->all(), $id);

        Flash::success('Zakat updated successfully.');

        return redirect(route('admin.zakats.index'));
    }

    /**
     * Remove the specified Zakat from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->data_check($id);

        $this->zakatRepository->delete($id);

        Flash::success('Zakat deleted successfully.');

        return redirect(route('zakats.index'));
    }

    protected function data_check($id){
        if ($this->zakatRepository->find($id)) {
            $this->data = $this->zakatRepository->find($id);
            return true;
        }else{
            Flash::error('Zakat not found');
            return false;
        }
    }
}
