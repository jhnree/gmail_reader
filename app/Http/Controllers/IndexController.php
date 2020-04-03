<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use Socialite;

class IndexController extends Controller
{
    //
    public function index(){
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'aktus.dev@gmail.com',
            'password'      => 'agm-1234',
            'protocol'      => 'imap'
        ]);
        /* Alternative by using the Facade
        $oClient = Webklex\IMAP\Facades\Client::account('default');
        */

        //Connect to the IMAP Server
        $oClient->connect();

        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders();
        return view('components.inbox',['aFolder'=>$aFolder,'count'=>'1']);
    }

    public function gmailLogin(){
        return view('components.login');
    }

    public function home(){
        return view('components.home');
    }

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        try{
            $googleUser = Socialite::driver('google')->user();
            setcookie("id", $googleUser->id);
            return redirect()->to('/home');
            // return view('components.home', 'googleUser');
        }
        catch(Exception $e){
            return 'error';
        }
    }
}
