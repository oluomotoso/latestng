<?php

namespace newsbook\Http\Controllers;

use newsbook\facebook_account;
use newsbook\facebook_edge;
use newsbook\Http\Requests;
use newsbook\news_feed;
use newsbook\pending_feed;
use yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function GetIndex()
    {
        $pending = pending_feed::where('publish_status', 0)->orderBy('created_at', 'desc')->limit(100)->get();
        return view('admin.manage_pending_post', ['pending' => $pending]);
    }

    public function GetPublishedIndex()
    {

        return view('admin.manage_published_post', ['published' => news_feed::all()]);
    }

    public function GetResponseInfo()
    {
        return view('admin.edge_response', ['facebook_accounts' => facebook_account::all()]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function PendingData1()
    {
        $pending = pending_feed::where('publish_status', 0)->select('id', 'feed_title', 'feed_category', 'feed_description', 'created_at');
        return Datatables::of($pending)->addColumn('select', function (pending_feed $feed) {
            return '<input class="selectRow" type="checkbox"  id="bulkSelect" name="bulkSelect"  value="' . $feed->id . '"/>' . $feed->id;
        })->addColumn('edit', function (pending_feed $feed) {
                return '<a href="/admin/edit_pending_post/' . $feed->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
    }

    public function PendingData()
    {
        $pending = pending_feed::where('publish_status', 0)->get();
        return view('');

    }



    public function PublishedData()
    {
        $pending = news_feed::select('id', 'feed_title', 'feed_category', 'feed_description', 'created_at');
        return Datatables::of($pending)->addColumn('select', function (news_feed $feed) {
            return ($feed->id);
        })->addColumn('edit', function (news_feed $feed) {
                return '<a data-toggle="modal" href="/admin/edit_published_post/' . $feed->id . '" class="btn btn-xs btn-primary" data-target="#myModal"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
    }


}
