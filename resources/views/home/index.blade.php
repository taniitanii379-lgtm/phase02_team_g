<x-app-layout>
    <div class="relative min-h-screen bg-blue-600 overflow-hidden">
        <!-- Grid Background -->
        <div class="absolute inset-0" style="
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 40px 40px;
        "></div>
        
        <!-- Main Content -->
        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between px-4 sm:px-8 md:px-16 py-16 sm:py-24 lg:py-32 min-h-screen">
            <!-- Left Side Text -->
            <div class="text-white max-w-2xl text-center lg:text-left mb-12 lg:mb-0">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 sm:mb-8">
                    CREATIVE<br>
                    <span class="text-yellow-300">INNOVATOR</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl mb-8 sm:mb-12">世界基準の明日を創る</p>
                
                <!-- クイズスタートボタン -->
                <a href="{{ route('quizzes.index') }}" 
                   class="inline-block bg-yellow-300 hover:bg-yellow-400 text-blue-900 font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg transition duration-300 shadow-lg hover:shadow-xl">
                    クイズをはじめる
                </a>
            </div>

            <!-- Right Side Hexagon -->
            <div class="hidden lg:block relative">
                <div class="relative w-64 h-64 xl:w-80 xl:h-80">
                    <svg viewBox="0 0 200 200" class="w-full h-full">
                        <!-- Back face (yellow) -->
                        <polygon points="100,20 170,60 170,140 100,180 30,140 30,60" 
                                 fill="#FCD34D" 
                                 transform="translate(10, 10)"/>
                        
                        <!-- Top face (light blue) -->
                        <polygon points="100,20 170,60 160,55 90,15" 
                                 fill="#BFDBFE"/>
                        
                        <!-- Main front face (white/light gray) -->
                        <polygon points="100,20 170,60 170,140 100,180 30,140 30,60" 
                                 fill="#E5E7EB"/>
                        
                        <!-- Blue stripes on front face -->
                        <polygon points="100,50 160,85 160,95 100,60" 
                                 fill="#2563EB"/>
                        <polygon points="100,90 160,125 160,135 100,100" 
                                 fill="#2563EB"/>
                        <polygon points="45,105 100,135 100,145 45,115" 
                                 fill="#2563EB"/>
                        
                        <!-- Right side face (darker) -->
                        <polygon points="170,60 170,140 180,145 180,65" 
                                 fill="#93C5FD"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>