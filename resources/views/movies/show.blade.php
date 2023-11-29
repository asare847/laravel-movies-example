@extends('layouts.main')
@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{$movie['poster_path']}}" class="w-64 md:w-96" style="width:24rem">
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
            <div class="flex items-center flex-wrap text-gray-400 text-sm mt-1">
                    <span><svg class="fill-current text-sky-300 w-4"xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg></span>
                        <span class="ml-1">{{$movie['vote_average']}}%</span>
                        <span class="mx-2">|</span>
                        <span class="">{{$movie['release_date']}}</span>
                        <span class="mx-2">|</span>
                        <span class="">
                        {{$movie['genres']}}
                        </span>
            </div>
            <p class="text-gray-300 mt-8">{{$movie['overview']}}</p> 
            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Cast</h4>
             <div class="flex mt-4">
                @foreach($movie['crew'] as $crew)
                  
                     <div class="ml-8">
                        <div>{{$crew['name']}}</div>
                        <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                     </div>
                    
                @endforeach
             </div>
            </div>     
            <div x-data="{ isOpen: false }">  
             <!--  Play Trailler Button-->
             @if(count($movie['videos']['results'])>0)
                    <div class="mt-12">
                        <button  @click="isOpen = true" class="flex items-center bg-sky-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                        <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg></span>
                        <span class="ml-6">Play Trailer</a></span>
                        </button >
                    </div>

                    <!-- modal to display video -->
                    <template x-if="isOpen">
                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- End of Modal -->
             @endif
            </div>

        </div>
    </div>

</div>

<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auo px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-8">
          @foreach($movie['cast'] as $cast)
            <div class="mt-8">
                
                 <a href="{{route('actors.show',$cast['id'])}}">
                    <img src="{{'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" alt="" class="hover:opacity-75 transition ease-in-out-150">
                 </a>
                <div class="mt-2">
                    <a  href="{{route('actors.show',$cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{$cast['name']}}</a>
                    <div class="flex items-center text-gray-400 text-sm mt-1">
                        <span class="">{{$cast['character']}}</span>
                    </div> 
                 </div>
            </div>
               
         @endforeach
    </div>

    <div class="movie-images"  x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['images'] as $image)
                    <div class="mt-8">
                    <a
                            @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                            href="#"
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
            
      

    <div
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end movie-images -->
@endsection