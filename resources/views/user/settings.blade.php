@extends( 'layouts.user' )

@section('content')
	<style>
		.switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}

		.switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked + .slider {
			background-color: #2196F3;
		}

		input:focus + .slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}
	</style>
<div class="y-content">

	<div class="row content-row">

		@include('layouts.user.nav')

		<div class="page-inner col-sm-9 col-md-10">

			@include('notification.notify')

			<div class="new-history">

                <div><h4 class="settings">{{tr('settings')}}</h4></div>

                <div class="row">

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<div class="settings-card carg-lg">
                			<div class="text-center">
                				<img src="{{Auth::user()->picture}}" class="settings-card-img">
                				<h4 class="settings-head">{{Auth::user()->name}}</h4>
                				<p class="settings-subhead">{{Auth::user()->email}}</p>
                				<a href="{{route('user.profile')}}" class="settings-link">{{tr('view_profile')}}</a>
                			</div>
                		</div>

                		<a href="{{route('user.history')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/history1.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('history')}}</h4>
	                					<!-- <p class="settings-subhead">15 videos</p> -->
	                				</div>
	                			</div>
	                		</div>
                		</a>                	
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">

                		<a href="{{route('user.referrals')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/referrals.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">Referrals</h4>
	                					<?php /*<p class="settings-subhead">{{$subscriptions}} {{tr('plans')}}</p> */?>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                		
                		<a href="{{route('user.subscriptions')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/subscription.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('subscriptions')}}</h4>
	                					<?php /*<p class="settings-subhead">{{$subscriptions}} {{tr('plans')}}</p> */?>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                		<a href="{{route('user.subscription.history')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/subscription-history.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('my_plans')}}</h4>
	                					<?php /*<p class="settings-subhead">{{tr('valid_upto')}} <span>{{$plans_valid_upto['days']}} days</span></p>*/?>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.wishlist')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/heart.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('wishlists')}}</h4>
	                					<?php /*<p class="settings-subhead">{{$wishlist}} {{tr('videos')}}</p> */?>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                		<a href="{{route('user.spam-videos')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/spam.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('spam')}}</h4>
	                					<?php /*<p class="settings-subhead">10 videos</p>*/?>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.channels.subscribed')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/computer.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('subscribed_channels')}}</h4>
	                					<!-- <p class="settings-subhead">1 channel</p> -->
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>
                
                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.ppv.history')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/dollar.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('ppv_history')}}</h4>
	                					<!-- <p class="settings-subhead">15 videos</p> -->
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.card.card_details')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/card.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('cards')}}</h4>
	                					<!-- <p class="settings-subhead">2 cards added</p> -->
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.redeems')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/redeems.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head">{{tr('redeems')}}</h4>
	                					<!-- <p class="settings-subhead">total amount $120</p> -->
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.change.password')}}">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/change.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head settings-mt-1">{{tr('change_password')}}</h4>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>
                	
                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.delete.account')}}" @if(Auth::user()->login_by != 'manual') onclick="return confirm(&quot;{{tr('user_account_delete_confirm') }}&quot;)" @endif>
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/trash.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head settings-mt-1">{{tr('delete_account')}}</h4>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>

                	<div class="col-sm-6 col-md-4 col-lg-4">
                		<a href="{{route('user.logout')}}" onclick="return confirm('{{tr("logout_confirmation")}}')">
	                		<div class="settings-card">
	                			<div class="display-inline">
	                				<div class="settings-left">
	                					<img src="{{asset('images/logout.png')}}" class="settings-icon">
	                				</div>
	                				<div class="settings-right">
	                					<h4 class="settings-head settings-mt-1">{{tr('logout')}}</h4>
	                				</div>
	                			</div>
	                		</div>
                		</a>
                	</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a href="{{route('user.redeems')}}">
							<div class="settings-card">
								<div class="display-inline">
									<div class="settings-left">
										<label class="switch">
											<input type="checkbox" checked>
											<span class="slider round"></span>
										</label>
									</div>
									<div class="settings-right" >
										<h4 class="settings-head">Monetization</h4>

										<!-- <p class="settings-subhead">total amount $120</p> -->
									</div>

								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a href="{{route('user.memberships')}}">
							<div class="settings-card">
								<div class="display-inline">
									<div class="settings-left">
										<img src="{{asset('images/dollar.png')}}" class="settings-icon">
									</div>
									<div class="settings-right" >
										<h4 class="settings-head">Memberships</h4>

										<!-- <p class="settings-subhead">total amount $120</p> -->
									</div>

								</div>
							</div>
						</a>
					</div>

                </div>

            </div>

		</div>

	</div>

</div>

@endsection