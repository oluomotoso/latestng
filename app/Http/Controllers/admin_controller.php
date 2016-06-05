<?php

namespace newsbook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;
use newsbook\content_categories;
use newsbook\content_source;
use newsbook\facebook_account;
use newsbook\facebook_edge;
use newsbook\facebook_link;
use newsbook\Http\Requests;
use newsbook\latestng\fetch;
use newsbook\latestng\latestng;
use newsbook\news_feed;
use newsbook\pending_feed;
use newsbook\region;
use newsbook\User;
use newsbook\user_role;
use SimpleXMLElement;

class admin_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    function alphanumericAndSpace($string)
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    }


    public function CreateUserRole(Request $request)
    {
        user_role::create(['role' => $request->input('role')]);
        return Redirect('admin/add_user_role')->with(['message' => 'Role added successfully']);

    }

    public function AddRole()
    {
        return view('admin.user_role');
    }

    public function GetCreateUser()
    {
        $roles = user_role::all();
        return view('auth.register', ['role' => $roles]);
    }

    public function PostCreateUser(Request $request)
    {
        User::create(['email' => $request['email'],
            'username' => $request['username'],
            'role' => $request['role'],
            'password' => Hash::make($request->password)

        ]);
        return Redirect('admin/add_user')->with(['message' => 'User created successfully']);

    }

    public function GetCreateChannel()
    {
        $roles = user_role::all();
        return view('admin.create_channel', ['role' => $roles]);

    }

    public function GetFacebookLink()
    {

        return view('admin.add_facebook_link');

    }

    public function PostCreateChannel(Request $request)
    {
        content_source::create(['title' => $request['title'],
            'url' => $request['url'],
            'created_by' => $request->user()->id
        ]);
        return Redirect('admin/create_channel')->with(['message' => 'Channel created successfully']);

    }


    public function ContentSource()
    {
        $source = content_source::all();
        return view('admin/content_source', ['sources' => $source]);
    }

    public function PostContentSources(Request $request)
    {
        $source = content_source::find($request->source);
        return view('admin/content_source', ['source' => $source]);
    }

    public function PostContentSource(Request $request)
    {
        content_source::where('id', $request->source_id)->update([
            'title' => $request->title,
            'title_param' => $request->title_param,
            'categories_param' => $request->categories_param,
            'status'=>$request->value
        ]);

        return redirect('admin/manage-sources')->with('message', 'content source updated successfully');
    }

    public function PostFacebookLink(Request $request)
    {
        facebook_link::create(['link' => $request['link'], 'title' => $request['title']
        ]);
        return Redirect('admin/add_facebook_link')->with(['message' => 'Link Added successfully']);

    }

    public function GetCreatePost()
    {
        $categories = content_categories::all();

        return view('admin.create_post', ['category' => $categories]);

    }

    public function PostCreatePost(Request $request)
    {

        /*$this->validate($request, [
            'feed_title' => 'required|unique:posts|max:255',
            'feed_content' => 'required',
        ]);*/
        $post_control = new latestng();

        $image = $post_control->GetImageUrl($request->feed_content);
        $category = $request->category;
        $category_list = '';
        foreach ($category as $category) {
            $category_list .= $category . ',';
        }
        $title_me = $this->alphanumericAndSpace($request->feed_title);
        $title_me = strtolower($title_me);
        $perm = explode(' ', $title_me);
        $perms = '';
        $count = count($perm);
        for ($i = 0; $i < $count - 1; $i++) {
            $perms .= $perm[$i] . '-';
        }
        end($perm);
        $key = key($perm);
        $permas = $perms . $perm[$key];

        news_feed::create([
            'feed_title' => $request->feed_title,
            'feed_content' => $request->feed_content,
            'feed_category' => $category_list,
            'image_url' => $image,
            'approved_by' => $request->user()->id,
            'content_source' => 9,
            'publish_status' => 1,
            'perm_url' => $permas
        ]);
        return Redirect('admin/create_post')->with(['message' => 'Post created successfully']);

    }

    public function GetCreateCategory()
    {

        return view('admin.create_category');

    }

    public function PostCreateCategory(Request $request)
    {
        $categories = explode(',', $request->input('category'));
        foreach ($categories as $category) {
            content_categories::create(['category' => $category]);
        }
        return Redirect('admin/create_category')->with(['message' => 'Role added successfully']);

    }

    public function CreateNewPostEdge()
    {

    }

    public function GetManagePendingPost()
    {

        return view('admin.manage_pending_post');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function GetEditPendingPost($id)
    {
        return view('admin.edit_pending_post', ['data' => pending_feed::find($id), 'category' => content_categories::all(), 'region' => region::all()]);
    }

    public function GetEditPublishedPost($id)
    {
        return view('admin.edit_published_post', ['data' => news_feed::find($id), 'category' => content_categories::all()]);
    }

    public function GetEditFacebookEdge($id)
    {
        return view('admin.edit_facebook_edge', ['edge' => facebook_edge::find($id), 'facebook_accounts' => facebook_account::all()]);
    }

    public function UpdateEditedPost(Request $request)
    {
        $fetch = new fetch();

        $feed = pending_feed::find($request->feed_id);
        /*if ($feed->image_url !== null) {
            $image_parameters = $this->GetUploadImageFromUploadIm($feed->image_url);
            if ($image_parameters->status_code == 200) {
                $thumb = $image_parameters->data->thumb_url;
                $image = $image_parameters->data->img_url;
            } else {
                $thumb = null;
                $image = null;
            }
        } else {
            $thumb = null;
            $image = null;
        }*/
        $title_me = $this->alphanumericAndSpace($feed->feed_title);
        $title_me = strtolower($title_me);
        $perm = explode(' ', $title_me);
        $perms = '';
        $count = count($perm);
        for ($i = 0; $i < $count - 1; $i++) {
            $perms .= $perm[$i] . '-';
        }
        end($perm);
        $key = key($perm);
        $permas = $perms . $perm[$key];
        $contents = $feed->feed_content;
        $latestng = new latestng();
        $images = $latestng->GetMultipleImageUrl($contents);
        if (!empty($images)) {
            $content = $fetch->MyContents2($contents, $images);
            $newImage = $latestng->GetMultipleImageUrl($content);
            $newImage = $newImage[0];
        } else {
            $content = $contents;
            $newImage = null;
        }
        $new = news_feed::create([
            'feed_title' => $feed->feed_title,
            'feed_url' => $feed->feed_url,
            'feed_description' => $feed->feed_description,
            'feed_content' => $content,
            'feed_source_date' => $feed->feed_source_date,
            'content_source' => $feed->content_source,
            'image_url' => $newImage,
            'music_url' => $feed->music_url,
            'video_url' => $feed->video_url,
            'site_url' => $feed->site_url,
            'approved_by' => $request->user()->id,
            'perm_url' => $permas

        ]);
        $category = $request->category;

        $fetch->UpdateCategory($category, $new->id, $feed->feed_title);


        pending_feed::where('id', $request->feed_id)->update([
            'publish_status' => 1
        ]);
        return Redirect('admin/manage_pending_post')->with(['message' => 'Published']);

    }


    public function UpdatePublishedPost(Request $request)
    {
        $categorie = '';
        foreach ($request->category as $categpries) {

            $categorie .= $categpries . ',';
        }
        news_feed::where('id', $request->feed_id)->update([
            'feed_title' => $request->feed_title,
            'feed_category' => $categorie,
            'feed_content' => $request->feed_content,
        ]);

        return Redirect('admin/manage_published_post')->with(['message' => 'updated']);

    }

    public function GetUploadImageFromUploadIm($url)
    {
        try {
            $ch = curl_init();
            curl_setopt_array(
                $ch, array(
                CURLOPT_URL => 'http://uploads.im/api?upload=' . $url . '&format=xml',
                CURLOPT_RETURNTRANSFER => true
            ));
            $return = curl_exec($ch);
            $xml = new SimpleXMLElement($return);
            return $xml;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function ApproveFacebookUser(Request $request)
    {
        $id = $request->account;
        $account = facebook_account::find($id);
        if ($account->availability == 0) {
            facebook_account::where('id', $id)->update([
                'availability' => 1
            ]);
            return redirect('admin/check_edge_response')->with('message', 'User is approved for group publishing');
        } else {
            facebook_account::where('id', $id)->update([
                'availability' => 0
            ]);
            return redirect('admin/check_edge_response')->with('message', 'User have been disapproved for group publishing');

        }
    }

    public function PublishPendingPost(Request $request)

    {
        try {
            $data_ids = $request->publish_ids;
            $dataArray = explode(',', $data_ids);
            foreach ($dataArray as $id) {
                $feed = pending_feed::find($id);
                $fetch = new fetch();
                /*if ($feed->image_url !== null) {
                    $image_parameters = $this->GetUploadImageFromUploadIm($feed->image_url);
                    if ($image_parameters->status_code == 200) {
                        $thumb = $image_parameters->data->thumb_url;
                        $image = $image_parameters->data->img_url;
                    } else {
                        $thumb = null;
                        $image = null;
                    }
                } else {
                    $thumb = null;
                    $image = null;
                }*/
                $title_me = $this->alphanumericAndSpace($feed->feed_title);
                $title_me = strtolower($title_me);
                $perm = explode(' ', $title_me);
                $perms = '';
                $count = count($perm);
                for ($i = 0; $i < $count - 1; $i++) {
                    $perms .= $perm[$i] . '-';
                }
                end($perm);
                $key = key($perm);
                $permas = $perms . $perm[$key];
                $contents = $feed->feed_content;
                $latestng = new latestng();
                $images = $latestng->GetMultipleImageUrl($contents);
                if (!empty($images)) {
                    $content = $fetch->MyContents2($contents, $images);
                    $newImage = $images[0];
                } else {
                    $content = $contents;
                    $newImage = null;
                }
                $new = news_feed::create([
                    'feed_title' => $feed->feed_title,
                    'feed_url' => $feed->feed_url,
                    'feed_description' => $feed->feed_description,
                    'feed_content' => $content,
                    'feed_source_date' => $feed->feed_source_date,
                    'content_source' => $feed->content_source,
                    'image_url' => $newImage,
                    'music_url' => $feed->music_url,
                    'video_url' => $feed->video_url,
                    'site_url' => $feed->site_url,
                    'approved_by' => $request->user()->id,
                    'perm_url' => $permas

                ]);
                $category = $feed->feed_category;
                $category_arr = explode(',', $category);
                $fetch->UpdateCategory($category_arr, $new->id, $feed->feed_title);


                pending_feed::where('id', $id)->update([
                    'publish_status' => 1
                ]);


            }
            return Redirect('admin/manage_pending_post')->with(['message' => 'All Published']);
        } catch (\Exception $e) {
            return Redirect('admin/manage_pending_post')->withErrors($e->getMessage());
        }
    }

    public function PostEditFacebookEdge(Request $request)
    {
        facebook_edge::where('id', $request->edge_id)->update([
            'name' => $request->edge_name,
            'facebook_id' => $request->facebook_id,
            'facebook_account_owner' => $request->edge_account,
            'edge_type' => $request->edge_type
        ]);
        return Redirect('admin/check_edge_response')->with(['message' => 'Edited Successfully']);

    }

    public function PostFacebookEdge(Request $request)
    {
        try {
            facebook_edge::create([
                'name' => $request->edge_name,
                'facebook_id' => $request->facebook_id,
                'facebook_account_owner' => $request->edge_account,
                'edge_type' => $request->edge_type
            ]);

            return Redirect('admin/check_edge_response')->with(['message' => 'Created Successfully']);

        } catch (\Exception $e) {
            return redirect('admin/check_edge_response')->with(['message' => $e->getMessage()]);
        }

    }

    public function GetHtmlContentsFromUrl(Request $request)
    {

        $data = $this->FetchUrl($request->url);
        return Redirect('admin/edit_html')->with(['data' => $data]);
    }

    public function FetchUrl($url)
    {
        return file_get_contents($url);
    }

    public function HtmlContentsFromUrl()
    {
        return view('admin.html', ['category' => content_categories::all()]);
    }
}
