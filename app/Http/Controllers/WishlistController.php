<?php

namespace App\Http\Controllers;

use App\DataTables\WishlistDataTable;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use App\Repositories\WishlistRepository;
use Flash;
use App\Models\Wishlist;
use App\Http\Controllers\AppBaseController;
use Response;

class WishlistController extends AppBaseController
{
    /** @var  WishlistRepository */
    private $wishlistRepository;

    public function __construct(WishlistRepository $wishlistRepo)
    {
        $this->wishlistRepository = $wishlistRepo;
    }

    /**
     * Display a listing of the Wishlist.
     *
     * @param WishlistDataTable $wishlistDataTable
     * @return Response
     */
    public function index(WishlistDataTable $wishlistDataTable)
    {
        return $wishlistDataTable->render('admin.wishlists.index');
    }

    public function campaignSave(CreateWishlistRequest $request)
    {
        try{
            $input = $request->all();
            $wishlist = Wishlist::updateOrCreate(['user_id' => $request->user_id,
                                                  'campaign_id' => $request->campaign_id
                                                 ],$input);

            return response()->json(array('message' => 'Campaign telah disimpan' ), 200);
        }catch(\Throwable $e){
            return response()->json(array('message' => $e->getMessage()), 200);
        }
    }

    /**
     * Show the form for creating a new Wishlist.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.wishlists.create');
    }

    /**
     * Store a newly created Wishlist in storage.
     *
     * @param CreateWishlistRequest $request
     *
     * @return Response
     */
    public function store(CreateWishlistRequest $request)
    {
        $input = $request->all();

        $wishlist = $this->wishlistRepository->create($input);

        Flash::success('Wishlist saved successfully.');

        return redirect(route('wishlists.index'));
    }

    /**
     * Display the specified Wishlist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $wishlist = $this->wishlistRepository->find($id);

        if (empty($wishlist)) {
            Flash::error('Wishlist not found');

            return redirect(route('wishlists.index'));
        }

        return view('admin.wishlists.show')->with('wishlist', $wishlist);
    }

    /**
     * Show the form for editing the specified Wishlist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $wishlist = $this->wishlistRepository->find($id);

        if (empty($wishlist)) {
            Flash::error('Wishlist not found');

            return redirect(route('wishlists.index'));
        }

        return view('admin.wishlists.edit')->with('wishlist', $wishlist);
    }

    /**
     * Update the specified Wishlist in storage.
     *
     * @param  int              $id
     * @param UpdateWishlistRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWishlistRequest $request)
    {
        $wishlist = $this->wishlistRepository->find($id);

        if (empty($wishlist)) {
            Flash::error('Wishlist not found');

            return redirect(route('wishlists.index'));
        }

        $wishlist = $this->wishlistRepository->update($request->all(), $id);

        Flash::success('Wishlist updated successfully.');

        return redirect(route('wishlists.index'));
    }

    /**
     * Remove the specified Wishlist from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $wishlist = $this->wishlistRepository->find($id);

        if (empty($wishlist)) {
            Flash::error('Wishlist not found');

            return redirect(route('wishlists.index'));
        }

        $this->wishlistRepository->delete($id);

        Flash::success('Wishlist deleted successfully.');

        return redirect(route('wishlists.index'));
    }
}
