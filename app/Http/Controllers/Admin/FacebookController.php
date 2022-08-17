<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFacebookRequest;
use App\Http\Requests\StoreFacebookRequest;
use App\Http\Requests\UpdateFacebookRequest;
use App\Models\Facebook;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacebookController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facebook_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facebooks = Facebook::all();

        return view('admin.facebooks.index', compact('facebooks'));
    }

    public function create()
    {
        abort_if(Gate::denies('facebook_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.facebooks.create');
    }

    public function store(StoreFacebookRequest $request)
    {
        $facebook = Facebook::create($request->all());

        return redirect()->route('admin.facebooks.index');
    }

    public function edit(Facebook $facebook)
    {
        abort_if(Gate::denies('facebook_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.facebooks.edit', compact('facebook'));
    }

    public function update(UpdateFacebookRequest $request, Facebook $facebook)
    {
        $facebook->update($request->all());

        return redirect()->route('admin.facebooks.index');
    }

    public function show(Facebook $facebook)
    {
        abort_if(Gate::denies('facebook_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.facebooks.show', compact('facebook'));
    }

    public function destroy(Facebook $facebook)
    {
        abort_if(Gate::denies('facebook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facebook->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacebookRequest $request)
    {
        Facebook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
