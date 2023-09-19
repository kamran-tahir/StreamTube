<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\Helper;

use App\Settings;

use App\User;

use Auth;

use DB;

use Validator;

use View;

use Setting;

use Exception;

use Log;

use App\Channel;

use App\Country;

use App\States;

use App\City;

use Session;

use App\ChannelVerification;

use App\Attachment;

use App\VideoTape;

use App\ChannelPost;

use App\Comment;

use App\PostReaction;

use App\ForumCategory;

use App\ForumUpdate;

use App\Photo;

class ChannelMemberSectionController extends Controller {

	private $UserAPI;
	public function __construct(UserApiController $API)
    {
        $this->UserAPI = $API;
    }

    public function community(Request $request,Channel $channel){
        $posts = $this->UserAPI->channel_posts($channel->id,null,null,true,$request->search,$request->type)->groupBy('category_id');
        return view('user.channels.community.index')
        ->with('posts', $posts)
        ->with('channel', $channel);
            
    }

    public function communityPosts(Request $request,Channel $channel,ForumCategory $category){
        $posts = $this->UserAPI->channel_posts($channel->id,$category->id,null,null,$request->search,$request->type);

        return view('user.channels.community.posts')
        ->with('posts', $posts)
        ->with('category', $category)
        ->with('channel', $channel);
    }

    
	public function membersSection(Request $request,Channel $channel){

		$videos = $this->UserAPI->channel_videos($channel->id, 0 , $request,$is_member = 1)->getData();
        $user_photo = Photo::where('channel_id', $channel->id)->where('members_only',1)->get();
        $users = $this->UserAPI->channel_member_users($channel->id)->getData();
        $forum_updates = ForumUpdate::where('channel_id', $channel->id)->orderby('id','desc')->get();
        
        return view('user.channels.members_area')
            ->with('channel', $channel)
            ->with('photo',$user_photo)
            ->with('forum_updates', $forum_updates)
            ->with('videos', $videos);
	}

    public function myPosts(Request $request,Channel $channel){
        
        $myposts = $this->UserAPI->channel_posts($channel->id,null,Auth::id(),true,$request->search,$request->type)->groupBy('category_id');

        return view('user.channels.community.my-posts')
        ->with('posts', $myposts)
        ->with('channel', $channel);
        
    }
	public function enableStatus(Request $request,Channel $channel){
		if($channel->is_approved && $channel->getUser->is_verified){
			$channel->members_section_enabled = 1;
			$channel->save();
            $forumCategory = new ForumCategory();
            $forumCategory->name = "General";
            $forumCategory->channel_id = $channel->id;
            $forumCategory->save();
            
        	session()->flash('flash_success', 'Members area Enabled Successfully.');
		}else{
        	session()->flash('flash_error', ' First Verify Both Account And Channel');
		}
		return back();
	}

	public function becomeMember(Request $request,Channel $channel){
		
		if($request->has('user_id') && ! empty($request->user_id)){
			if($channel->members_section_enabled){
                $channel->channel_members()->attach($request->user_id);
        		session()->flash('flash_success', 'Successful: You are now member of:'.$channel->name);
			}
		}
		return back();
	}	

	public function getMembersUsers(Request $request,Channel $channel) {

        $users = $this->UserAPI->channel_member_users($channel->id, $request->skip)->getData();

        $view = View::make('user.account.partial_member_user')
                    ->with('users',$users)
                    ->render();

        return response()->json(['view'=>$view, 'length'=>count($videos)]);
    
    }



    /////////  post section ////////

    public function detailPost(Request $request,Channel $channel, ChannelPost $post){
        $user = Auth::user();
        $category = $post->category;
        return view('user.channels.community.detail')
            ->with('post', $post)
            ->with('user', $user)
            ->with('category', $category)
            ->with('channel', $channel);
    }

    public function createPost(Request $request,Channel $channel){
        $categories = ForumCategory::where('channel_id',$channel->id)->get();
            
    	return view('user.channels.post.create')
            ->with('categories', $categories)
            ->with('channel', $channel);

        
    }

    public function storePost(Request $request,Channel $channel){
    	$rules = [
            'title' => 'required|string',
            'category_id' => 'required',
            'description' => 'required|string',     
        ];
        $this->validate($request, $rules);
        

    	$channelPost = new ChannelPost();

    	$channelPost->title = $request->title;
    	$channelPost->description = $request->description;
    	$channelPost->user_id = auth()->id();
    	$channelPost->channel_id = $channel->id;
        $channelPost->category_id = $request->category_id;
    	$channelPost->save();
        
        session()->flash('flash_success', 'Post Successfull created');

        return redirect()->route('user.channel',$channel);
    }

    public function fetchPosts(Request $request,Channel $channel){
    	$posts = $this->UserAPI->channel_posts($channel->id, $request->skip,$request->user_id ?? null ,$request->search??null)->getData();

        $view = View::make('user.channels.post.partial_post')
                    ->with('posts',$posts)
                    ->render();

        return response()->json(['view'=>$view, 'length'=>count($posts)]);
    	
    }

    public function postComment(Request $request,Channel $channel,ChannelPost $post){
    	if($request->comment != ''){
    		$comment = new Comment;	
    		$comment->comment = $request->comment;
        	$comment->parent_id = $request->comment_id;
        	$comment->user()->associate(Auth::user());
	        $post->comments()->save($comment);
    	}
        
         return back();
    }

    

    public function postReaction(Request $request,Channel $channel,ChannelPost $post){
    	$user = Auth::user();
    	if($request->reaction != ''){
    		PostReaction::updateOrCreate([
    			'post_id' =>$post->id,
    			'user_id' =>$user->id
    		],[
    			'like' => $request->reaction,
    		]);
    	}
        return response()->json();
    }

    // categories

    public function createCategory(Request $request,Channel $channel){
        return view('user.channels.category.create')
            ->with('channel', $channel);
        
    }

    public function storeCategory(Request $request,Channel $channel){
        $rules = [
            'name' => 'required|string|max:30',
        ];

        $this->validate($request, $rules);
        
        $forumCategory = new ForumCategory();

        $forumCategory->name = $request->name;
        $forumCategory->channel_id = $channel->id;
        $forumCategory->save();
        
        session()->flash('flash_success', 'Category Successfully created');

        return redirect()->route('user.members', ['id'=>$channel->id]);
    }

    public function deleteCategory(Request $request,Channel $channel){
        if($request->has('id') && $request->id != ''){
            $forumCategory = ForumCategory::where('id',$request->id)->where('channel_id',$channel->id)->get()->first();
            $firstCategory = ForumCategory::where('channel_id',$channel->id)->get()->first();
            if($forumCategory->id != $firstCategory->id){
                ChannelPost::where('category_id',$forumCategory->id)->where('channel_id',$channel->id)->update(['category_id'=>$firstCategory->id]);
                $forumCategory->delete();
                session()->flash('flash_success', 'Category Successfully deleted and all post of this category assigned to General Category');
            
            }else{
                session()->flash('flash_error', 'Default Category cannot be deleted.');            
            }

            return redirect()->route('user.members', ['id'=>$channel->id]); 
        }
    }



    // Forum Update

    public function createForumUpdate(Request $request,Channel $channel){
        return view('user.channels.forum_update.create')
            ->with('channel', $channel);   
    }

    public function editForumUpdate(Request $request,Channel $channel){
        return view('user.channels.forum_update.create')
            ->with('channel', $channel);   
    }

    public function storeForumUpdate(Request $request,Channel $channel){
        $rules = [
            'description' => 'required|string',
        ];

        $this->validate($request, $rules);
        
        $forumCategory = new ForumUpdate();

        $forumCategory->description = $request->description;
        $forumCategory->channel_id = $channel->id;
        $forumCategory->save();
        
        session()->flash('flash_success', 'Forum Update Successfully created');

        return redirect()->route('user.members', ['id'=>$channel->id]);
    }

    public function deleteForumUpdate(Request $request,Channel $channel){
        
        if($request->has('id') && $request->id != ''){
            $forumUpdate = ForumUpdate::where('channel_id',$channel->id)->where('id',$request->id)->get()->first();
            $forumUpdate->delete();
            session()->flash('flash_success', 'Forum Update Successfully deleted');
            
            return redirect()->route('user.members', ['id'=>$channel->id]); 
        }
    }


}

