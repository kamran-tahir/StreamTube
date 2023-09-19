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

class ChannelVerificationController extends Controller {

    public function __construct()
    {
    }

    public function channel_verification_form(Request $request ,Channel $channel){

        if (auth()->id() != $channel->user_id) {
            return redirect()->to('/')->with('flash_error', tr('channel_not_found')); 
        }
        $countries = Country::orderBy('id')->get();
        $channel_verification_settings = Settings::where('key','like','channel_verification%')->get();
        
        $verification_record = $channel->verification;
        
        if($verification_record && $verification_record->is_verified == null ){
            Session::flash('flash_error', 'Request already submitted.');
             return redirect(route('user.channel',$channel->id));           
        }
        
        if($verification_record && intval($verification_record->is_verified) == 1){
             Session::flash('flash_error', 'Already verified!.');
             return redirect(route('user.channel',$channel->id));
        }
        
        if($verification_record && intval($verification_record->is_verified) == 0 ){
            Session::flash('flash_error', $verification_record->decline_reasons); 
        }

        return view('user.channels.verification')
                    ->with('channel', $channel)
                    ->with('countries', $countries)
                    ->with('channel_verification_settings', $channel_verification_settings)
                    ->with('verification_record', $verification_record);
    }

    public function channel_verification(Request $request , Channel $channel){
        
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|string',
            'ssn' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'required|integer',
            'state_issued_id_front'  =>'mimes:jpeg,bmp,png',
            'state_issued_id_back'    =>'mimes:jpeg,bmp,png',
            'image_doc' =>'mimes:jpeg,bmp,png'
                
        ];
        $this->validate($request, $rules);
        
        if (auth()->id() != $channel->user_id) {
            return redirect()->to('/')->with('flash_error', tr('channel_not_found'));  
        }

        if ($request->hasFile('state_issued_id_front') != "") {
          $id_front=  Helper::normal_upload_picture($request->file('state_issued_id_front'), "/uploads/verification/");
        }
        if ($request->hasFile('state_issued_id_back') != "") {
           $id_back = Helper::normal_upload_picture($request->file('state_issued_id_back'), "/uploads/verification/");
        }
         if ($request->hasFile('image_doc') != "") {
          $self =  Helper::normal_upload_picture($request->file('image_doc'), "/uploads/channels/verification/");
        }

        $details = array(
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'dob'           => $request->dob,
            'ssn'           => $request->ssn,
            'address1'      => $request->address1,
            'address2'      => $request->address2,
            'state_id'      => $request->state_id,
            'zip_code'      => $request->zip_code,
            'country_id'    => $request->country_id,
            'city_id'       => $request->city_id,
            'terms_and_conditions' => json_encode($request->terms_and_conditions),
            'attempts'      => 1,

        );
        $channelVerification = ChannelVerification::updateOrCreate(['user_id' => auth()->id(),'channel_id'=> $channel->id],$details);
        
        $attachments = [
            'id_front' => $id_front ?? null,
            'id_back' => $id_back ?? null,
            'self' => $self ?? null,
        ];

        foreach($attachments as $type => $url){
            if($url){
                $file = new Attachment();
                $file->url = $url;
                $file->type = $type;
                $file->status = 0;
                $channelVerification->attachments()->save($file);
                
            }
        }

        return redirect(route('user.channel',$channel->id))->with('flash_success', tr('channel_verification_submit'));

    } 

    public function channel_verification_update(Request $request , Channel $channel){
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|string',
            'ssn' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'required|integer',
            'state_issued_id_front'  =>'mimes:jpeg,bmp,png',
            'state_issued_id_back'    =>'mimes:jpeg,bmp,png',
            'image_doc' =>'mimes:jpeg,bmp,png'
                
        ];
        $this->validate($request, $rules);
        
        if (auth()->id() != $channel->user_id) {
            return redirect()->to('/')->with('flash_error', tr('channel_not_found'));  
        }

        if ($request->hasFile('state_issued_id_front') != "") {
          $id_front=  Helper::normal_upload_picture($request->file('state_issued_id_front'), "/uploads/channels/verification/");
        }
        if ($request->hasFile('state_issued_id_back') != "") {
           $id_back = Helper::normal_upload_picture($request->file('state_issued_id_back'), "/uploads/channels/verification/");
        }
         if ($request->hasFile('image_doc') != "") {
          $self =  Helper::normal_upload_picture($request->file('image_doc'), "/uploads/channels/verification/");
        }
        $details = array(
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'dob'           => $request->dob,
            'ssn'           => $request->ssn,
            'address1'      => $request->address1,
            'address2'      => $request->address2,
            'state_id'      => $request->state_id,
            'zip_code'      => $request->zip_code,
            'country_id'    => $request->country_id,
            'city_id'       => $request->city_id,
            'is_verified'   => null,
            'terms_and_conditions' => json_encode($request->terms_and_conditions),
        );

        $channelVerification = ChannelVerification::updateOrCreate(['user_id' => auth()->id(),'channel_id'=> $channel->id],$details);
        $channelVerification->attempts = intval($channelVerification->attempts) + 1;
        $channelVerification->save();
        
        $attachments = [
            'id_front' => $id_front ?? null,
            'id_back' => $id_back ?? null,
            'self' => $self ?? null,
        ];

        foreach($attachments as $type => $url){
            if($url){
                $file = new Attachment();
                $file->url = $url;
                $file->type = $type;
                $file->status = 0;
                $oldAttachments = $channelVerification->attachments()->where('type',$type)->get();
                
                foreach($oldAttachments as $oldAttachment ){
                    $check = Helper::delete_picture($oldAttachment->url,'/uploads/channels/verification/');
                    
                }
                $channelVerification->attachments()->where('type',$type)->delete();
                $channelVerification->attachments()->save($file);
            }
        }

        return redirect(route('user.channel',$channel->id))->with('flash_success', tr('channel_verification_submit'));
    }


    ////////////////////// Admin Panel methods/////////////////////

    public function verificationRequestListAdmin(Request $request){
        try {


            $requests = ChannelVerification::orderBy('created_at', 'desc')
                        ->distinct('id')
                        ->with(['channel' => function ($query) {
                            $query->withCount('getChannelSubscribers')
                                ->withCount('getVideoTape');
                        }])
                        ->get()->groupBy('is_verified');
                        // dd($requests[0]);
        return view('new_admin.channels.verification_request_list')
                    ->with('sub_page','channels-view')
                    ->with('channel_requests' , $requests);
                        
        } catch (Exception $e) {
            
            $error = $e->getMessage();

            return back()->with('flash_error',$error);
        }
    }


    public function verificationRequestAdmin(Request $request){
        try {

            $channel_details = Channel::where('id',$request->channel_id)->withCount('getVideoTape')
                            ->withCount('getChannelSubscribers')->first();
                            
            $verification_request = $channel_details->verification;

            if(!$channel_details) {

                throw new Exception(tr('admin_channel_not_found'), 101);
            }

            
            return view('new_admin.channels.verification_request')
                        ->with('channel_details' , $channel_details)
                        ->with('verification_request' , $verification_request);

                        
        } catch (Exception $e) {
            
            $error = $e->getMessage();

            return back()->with('flash_error',$error);
        }
    }

    public function verificationRequestUpdateAdmin(Request $request){
        try {
            $channel_details = Channel::find($request->channel_id);
            $verification_request = ChannelVerification::find($request->request_id);
            $user = User::find($channel_details->user_id);
            if(!$channel_details) {

                throw new Exception(tr('admin_channel_not_found'), 101);
            }

            if( (!$verification_request) || $verification_request->channel_id != $channel_details->id ) {

                throw new Exception(tr('channel_verification_request_not_found'), 101);
            }
            $msg = '';
            try {

                DB::beginTransaction();
                        
                switch ($request->action) {
                    case 'decline':
                         if($request->decline_reason != ''){
                            $verification_request->is_verified = 0;
                            $verification_request->decline_reasons = $request->decline_reason;
                            $verification_request->save();
                            $channel_details->is_approved = DECLINED;
                            if ($channel_details->save() ) {

                                if ( $channel_details->is_approved == ADMIN_CHANNEL_DECLINED) {

                                    VideoTape::where('channel_id', $channel_details->id)
                                                ->update(['is_approved' => ADMIN_CHANNEL_DECLINED]);                
                                }
                                DB::commit();
                            }
                            $msg = 'Request Decline Successfully.';
                                
                            if($verification_request->attempts < 2){
                                $body = "Channel Document Verification Request has been declined. <br>";
                                $body .= "<b>Reasons:</b> <br>";
                                $body .= $verification_request->decline_reasons."<br>";
                                $body .= "Visit link below to resubmit verification request <br>".'<a href="'.route('user.channel.verification.form',$channel_details->id).'"> Re-Submit Request </a>';    
                            }else{
                                $body = "Channel Document Verification Request has been declined twice. Contact Admin for futher action.\n";
                            }
                            
                            Helper::sendChannelDocumentVerificationEmail($user->email,$user->name,$body);
                            $msg .= " Email has been sent to ( $user->email )";
                         }else{
                            return back()->with('flash_error','Decline reason required when declining verification request');
                         }

                        break;
                    case 'approve':
                        $verification_request->is_verified = 1;
                        $verification_request->save();
                        $channel_details->is_approved = APPROVED;
                        $channel_details->save(); 
                        DB::commit();  
                        $msg = 'Request Approved Successfully.';
                        $body = "Channel Document Verification Request has been approved. Visit channel by clicking link below.";
                        $body .= '<a href="'.route('user.channel',$channel->id).'">Visit Channel </a>';
                        Helper::sendChannelDocumentVerificationEmail($user->email,$user->name,$body);
                        break;
                    default:
                        $msg = 'No Action Performed.';
                        break;
                }
            } catch (Exception $e) {
                            
                DB::rollback();

                $error = $e->getMessage();

                return back()->with('flash_error',$error);
            }

            return back()->with('flash_success',$msg);

                        
        } catch (Exception $e) {
            
            $error = $e->getMessage();

            return back()->with('flash_error',$error);
        }
    }

    
}
