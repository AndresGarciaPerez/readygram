<div>
    <div class="flex gap-2">
        <button wire:click="like">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  
                viewBox="0 0 24 24"  fill="{{$isLiked? "red" : "white"}}"  
                stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                stroke-linejoin="round"  
                class="icon icon-tabler icons-tabler-outline icon-tabler-heart-spark"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.537 19.542l-7.037 -6.97a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.212 5.693" /><path d="M19 22.5a4.75 4.75 0 0 1 3.5 -3.5a4.75 4.75 0 0 1 -3.5 -3.5a4.75 4.75 0 0 1 -3.5 3.5a4.75 4.75 0 0 1 3.5 3.5" />
            </svg>
        </button>
    
        <p class="font-bold">{{$likes}} <span class="font-normal"> Likes</span></p>
    
    </div>
    
</div>