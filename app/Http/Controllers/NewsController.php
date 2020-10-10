<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\News;
use App\Models\CampaignCategory;

class NewsController extends AppBaseController
{
    /** @var  NewsRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    public function front()
    {
        $news = News::all();
        $categories = CampaignCategory::all();
        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    public function read(Request $request)
    {
        $news = News::find($request->id);
        return view('news.show', ['news' => $news]);
    }

    /**
     * Display a listing of the News.
     *
     * @param NewsDataTable $newsDataTable
     * @return Response
     */
    public function index(NewsDataTable $newsDataTable)
    {
        return $newsDataTable->render('admin.news.index');
    }

    /**
     * Show the form for creating a new News.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created News in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {
        $input = $request->all();

        $news = $this->newsRepository->create($input);

        Flash::success('News saved successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Display the specified News.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('admin.news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified News.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('admin.news.edit')->with('news', $news);
    }

    /**
     * Update the specified News in storage.
     *
     * @param  int              $id
     * @param UpdateNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        $news = $this->newsRepository->update($request->all(), $id);

        Flash::success('News updated successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        $this->newsRepository->delete($id);

        Flash::success('News deleted successfully.');

        return redirect(route('news.index'));
    }
}
