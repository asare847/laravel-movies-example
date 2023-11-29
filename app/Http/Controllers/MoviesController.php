<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];
        $genres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
       
        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];
       // dump( $nowPlayingMovies);
       $viewModel = new MoviesViewModel(
        $popularMovies,
        $nowPlayingMovies,
        $genres
       );
       return view('movies.index',$viewModel);
      /*   return view('index',['popularMovies'=>$popularMovies,
                    'genres'=>$genres,
                    'nowPlayingMovies'=>$nowPlayingMovies
                    ]); */
    }

    /**
     * Show the form for creating a new resource.
     */
   
    
    public function show( $id)
    {
        $movie= Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json();
       /*  $genreArray = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
        $genres = collect( $genreArray)->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        }); */
        $viewModel = new MovieViewModel($movie);
       // dump($movie);
        return view('movies.show',$viewModel);/* ['movie'=>$movie,'genres'=>$genres] */
    }

   

    
}
