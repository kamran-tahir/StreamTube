<?php  

Route::get('member-live', 'UserController@members')->name('members'); //new_route

    

Route::group(['prefix' => 'channel/{channel}/member-section' , 'as' => 'channel.member-section.', 'middleware'=>[]], function() {


	Route::get('/', 'ChannelMemberSectionController@membersSection')->name('index')->middleware('ChannelMember'); 

	Route::get('member-community', 'ChannelMemberSectionController@community')->name('community')->middleware('ChannelMember');
	Route::get('{category}/member-community-posts', 'ChannelMemberSectionController@communityPosts')->name('community.posts')->middleware('ChannelMember');
	
 	Route::get('/member-section-enable','ChannelMemberSectionController@enableStatus')->name('enable');

 	Route::post('/become-member','ChannelMemberSectionController@becomeMember')->name('become-member');

	Route::post('/get-member-users', 'ChannelMemberSectionController@getMembersUsers')->name('member-users')->middleware('ChannelOwner'); 

	Route::group(['prefix' => 'post' , 'as' => 'post.', 'middleware'=>['ChannelMember']], function() {
		Route::get('/{post}/detail', 'ChannelMemberSectionController@detailPost')->name('detail'); 
		Route::get('/create', 'ChannelMemberSectionController@createPost')->name('create'); 
		Route::post('/store', 'ChannelMemberSectionController@storePost')->name('store'); 
		Route::post('/fetch-posts', 'ChannelMemberSectionController@fetchPosts')->name('fetch'); 
		Route::get('/my-posts', 'ChannelMemberSectionController@myPosts')->name('my-posts'); 

		Route::post('/{post}/comment', 'ChannelMemberSectionController@postComment')->name('comment'); 
		Route::get('/{post}/comment', 'ChannelMemberSectionController@postReaction')->name('reaction'); 

	});

	Route::group(['prefix' => 'category' , 'as' => 'category.', 'middleware'=>['ChannelMember']], function() {
		Route::get('/create', 'ChannelMemberSectionController@createCategory')->name('create'); 
		Route::post('/store', 'ChannelMemberSectionController@storeCategory')->name('store'); 
		Route::post('/delete', 'ChannelMemberSectionController@deleteCategory')->name('delete');
		
	});

	Route::group(['prefix' => 'forum_update' , 'as' => 'forum_update.', 'middleware'=>['ChannelOwner']], function() {
		Route::get('/create', 'ChannelMemberSectionController@createForumUpdate')->name('create'); 
		Route::post('/store', 'ChannelMemberSectionController@storeForumUpdate')->name('store'); 
		Route::post('/delete', 'ChannelMemberSectionController@deleteForumUpdate')->name('delete');
		
	});
});