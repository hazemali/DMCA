<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\prepareNoticeRequest;
use App\provider;
use App\Notice;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Mail;

class noticesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $notices = \Auth::user()->notices()->latest()->get();
        

        return view('notices.index', ['notices' => $notices]);
    }

    /**
     * 
     * show a page to create a new notice
     * 
     * @return \Response
     */
    public function create(Request $request) {


        $providers = provider::get()->pluck('name', 'id')->all();

        return view('notices.create', ['providers' => $providers, 'request' => $request]);
    }


  /**
     * ask user to confirm the dmca that will be delivered
     * 
     * @param prepareNoticeRequest $request
     * @param Guard $auth
     * @return Response
     */
  public function confirm(prepareNoticeRequest $request, Guard $auth) {


    $template = $this->compileDmcaTemplate($auth, $data = $request->all());

    session()->flash('dmca', $data);

    return view('notices.confirm', ['template' => $template]);
}


    /**
     * sotre a new notice
     * 
     * @param Request $request
     * @return redirect to notices
     */
    public function store(Request $request) {


        $notice = $this->createNotice($request);


        Mail::queue('emails.dmca', ['notice' => $notice], function($message) use ($notice) {

            $message->from($notice->getOwnerEmail())
            ->to($notice->getRecipientEmail())
            ->subject('DMCA Notice');
        });



        flash('Your DMCA Notice has been deliverd!');
        
        return redirect('notices');
    }


/**
 * updating the notice to determine whether or not the conent is removed
 * 
 * @param  [int]  $noticeId 
 * @param  Request $request 
 * @return  redirect to notice
 */
    function update($noticeId , Request $request){

        $isRemoved = $request->has('content_removed');


        Notice::findOrFail($noticeId)->update(['content_removed' => $isRemoved]);


           return 'ok';


    }



    /**
     * Create And persist a new DMCA notice
     * 
     * @param Request $request
     * @return Notice Model
     */
    public function createNotice(Request $request) {

        $data = session()->get('dmca');

        $notice = Notice::open($data)
        ->useTemplate($request->input('template'));

        \Auth::user()->notices()->save($notice);

        return $notice;
    }

    /**
     * Compile the DMCA Template from the Form Data
     * 
     * @param Guard $auth
     * @param type $data
     * @return string
     */
    public function compileDmcaTemplate(Guard $auth, $data) {

        $data += [
        'name' => $auth->user()->name,
        'email' => $auth->user()->email,
        ];
        return view()->file(app_path('Http/Templates/Dmca.blade.php'), $data);
    }

}
