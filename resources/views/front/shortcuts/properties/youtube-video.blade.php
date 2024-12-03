<div class="w-full h-36 rounded-2xl position-relative"
     style="background: url(https://img.youtube.com/vi/{{ $youtube_video }}/0.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
    <div class="absolute inset-0 flex items-center justify-center">
        <a href="#!" 
           data-group="intro-about-us" 
           data-type="youtube" 
           data-id="{{ $youtube_video }}" 
           class="shadow-md lightbox bg-dark btn w-14 h-14 rounded-full text-light flex items-center justify-center" 
           aria-label="Play video">
            <i class="mdi mdi-play text-2xl"></i>
        </a>
    </div>
    <div class="absolute bottom-0 left-0 text-center mb-2 ml-2">
        <span class="text-black bg-white text-sm rounded-full px-2 py-0.5">Video</span>
    </div>
</div>
