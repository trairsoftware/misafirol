<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Need;
use App\Models\NeedRequest;
use App\Models\PetAdoption;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/ //TODO: login control

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($type = 'individual')
    {
        $allPosts = Post::all();

        $institutionalPosts = $allPosts->filter(function ($post) {
            return $post->is_institutional === true;
        });

        $individualPosts = $allPosts->filter(function ($post) {
            return $post->is_institutional === false;
        });

        $petAdoptionPosts = PetAdoption::where('is_active', true)->get();
        $needPoolPosts = Need::where('is_active', true)->get();

        $activePosts = $allPosts->filter(function ($post) {
            return $post->is_active;
        });

        $countMatches = Post::where('is_active', false)->sum('capacity');

        $requests = \App\Models\Request::all();
        $postsAllCapacity = Post::where('is_active', true)->sum('capacity');

        return view('home', [
            'type' => $type,
            'countInstitutionalPost' => count($institutionalPosts),
            'countIndividualPost' => count($individualPosts),
            'countPetAdoptionPost' => count($petAdoptionPosts),
            'countNeedPoolPosts' => count($needPoolPosts),
            'countActivePosts' => count($activePosts),
            'countPassivePosts' => $countMatches,
            'countRequests' => count($requests),
            'postsAllCapacity' => $postsAllCapacity

        ]);
    }

    public function needIndex($type = "all")
    {
        $food = Need::where('is_active', true)->where('need_type', "Gıda")->get();
        $clothes = Need::where('is_active', true)->where('need_type', "Giyim")->get();
        $baby = Need::where('is_active', true)->where('need_type', "Anne Bebek Ürünleri")->get();
        $shoe = Need::where('is_active', true)->where('need_type', "Ayakkabı")->get();
        $other = Need::where('is_active', true)->where('need_type', "Diğer")->get();

        $institutional = Post::where('is_institutional', 'false')->get();
        $individual = Post::where('is_institutional', 'true')->get();
        $pet_adoption = PetAdoption::where('is_active', 'true')->get();
        $need = Need::where('is_active', 'true')->get();

        if ($type == "foods") {
            $needs = Need::where('is_active', true)->where('need_type', "Gıda")->get();
        } else if ($type == "clothes") {
            $needs = Need::where('is_active', true)->where('need_type', "Giyim")->get();
        } else if ($type == "baby") {
            $needs = Need::where('is_active', true)->where('need_type', "Anne Bebek Ürünleri")->get();
        } else if ($type == "shoe") {
            $needs = Need::where('is_active', true)->where('need_type', "Ayakkabı")->get();
        } else if ($type == "other") {
            $needs = Need::where('is_active', true)->where('need_type', "Diğer")->get();
        } else {
            $needs = Need::where('is_active', true)->get();

        }
        return view('need.home', ['needs' => $needs, 'food' => $food, 'clothes' => $clothes, 'baby' => $baby, 'shoe' => $shoe, 'other' => $other, 'pet_adoption' => count($pet_adoption),
            'individual' => count($individual), 'institutional' => count($institutional), 'need' => count($need),]);
    }

    public function jobIndex()
    {
        $institutional = Post::where('is_institutional', 'false')->get();
        $individual = Post::where('is_institutional', 'true')->get();
        $pet_adoption = PetAdoption::where('is_active', 'true')->get();
        $need = Need::where('is_active', 'true')->get();

        $jobs = Job::where('is_active', true)->orderBy('id', 'ASC')->get();
        return view('jobs.home', ['jobs' => $jobs,  'pet_adoption' => count($pet_adoption),
            'individual' => count($individual), 'institutional' => count($institutional), 'need' => count($need),]);
    }

    public function needRequests()
    {
        $institutional = Post::where('is_institutional', 'false')->get();
        $individual = Post::where('is_institutional', 'true')->get();
        $pet_adoption = PetAdoption::where('is_active', 'true')->get();
        $need = Need::where('is_active', 'true')->get();

        $need_requests = NeedRequest::where('user_id', Auth::user()->id)->get();
        return view('need.need_requests_list', ['need_requets' => $need_requests,  'pet_adoption' => count($pet_adoption),
            'individual' => count($individual), 'institutional' => count($institutional), 'need' => count($need),]);
    }

    public function petAdoptionIndex()
    {
        $institutional = Post::where('is_institutional', 'false')->get();
        $individual = Post::where('is_institutional', 'true')->get();
        $pet_adoption = PetAdoption::where('is_active', 'true')->get();
        $need = Need::where('is_active', 'true')->get();

        $petadoption = PetAdoption::where('is_active', true)->get();
        return view('pet_adoption.home', ['petadoptions' => $petadoption,  'pet_adoption' => count($pet_adoption),
            'individual' => count($individual), 'institutional' => count($institutional), 'need' => count($need),]);
    }
}
