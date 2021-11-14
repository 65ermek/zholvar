<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/admin/main') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         width="70%" height="70%" viewBox="0 0 512 512"
                         preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                           fill="#000000" stroke="none">
                            <path d="M800 5104 c-36 -7 -108 -34 -160 -60 -212 -105 -355 -318 -368 -549
-4 -82 -3 -92 17 -109 12 -11 35 -19 52 -19 49 0 68 28 79 119 25 222 159 389
370 460 40 14 83 19 160 18 90 0 115 -4 173 -27 175 -69 326 -218 464 -459 29
-51 53 -95 53 -98 0 -3 -42 -33 -92 -65 -51 -33 -134 -92 -185 -132 l-92 -71
-142 176 c-79 97 -150 182 -159 189 -43 35 -110 -3 -110 -62 0 -28 23 -61 149
-218 l149 -184 -146 -146 -147 -146 -50 40 c-141 114 -286 286 -339 406 -23
52 -62 71 -106 53 -34 -14 -46 -44 -36 -93 8 -38 73 -151 132 -227 44 -58 202
-215 267 -266 l39 -30 -86 -114 c-551 -740 -700 -1663 -377 -2335 81 -167 231
-374 285 -395 27 -9 74 7 86 30 20 37 10 68 -36 122 -415 483 -469 1246 -140
1975 90 202 206 391 363 594 109 141 402 438 543 549 133 106 299 215 365 239
112 42 356 81 598 97 l107 6 0 -125 0 -125 -72 -7 c-478 -43 -811 -184 -1106
-470 -148 -143 -165 -173 -117 -220 45 -45 72 -35 166 61 284 292 609 439
1057 479 l72 6 0 -125 0 -125 -47 -6 c-130 -15 -246 -36 -277 -49 -40 -17 -55
-52 -40 -95 17 -46 48 -53 155 -32 51 11 120 22 152 25 l57 6 0 -124 c0 -133
-1 -136 -54 -136 -37 0 -175 -38 -233 -64 -81 -38 -152 -89 -222 -159 -84 -85
-104 -119 -96 -156 8 -36 22 -49 62 -57 28 -6 38 1 125 89 79 81 107 102 180
137 193 93 443 93 636 0 73 -35 101 -56 180 -137 87 -88 97 -95 125 -89 40 8
54 21 62 57 9 40 -17 79 -113 171 -115 110 -235 171 -385 198 -34 6 -72 13
-84 16 -22 4 -23 8 -23 130 l0 126 38 -6 c20 -3 62 -8 92 -11 146 -17 339 -87
467 -171 32 -21 103 -83 159 -136 111 -108 135 -118 179 -73 44 43 32 72 -71
177 -195 201 -447 320 -759 357 -49 6 -93 11 -97 11 -5 0 -8 57 -8 126 l0 125
73 -6 c447 -40 772 -187 1056 -479 94 -96 121 -106 166 -61 48 47 31 78 -118
221 -295 284 -634 428 -1099 469 l-78 7 0 125 0 125 108 -6 c244 -16 485 -55
601 -98 136 -51 444 -291 667 -520 428 -439 689 -922 784 -1452 14 -78 23
-104 40 -118 31 -25 67 -22 97 8 23 24 25 30 19 82 -10 84 -54 273 -88 382
-93 293 -248 591 -439 846 -41 55 -75 102 -77 105 -1 3 25 27 59 54 172 135
309 308 380 477 46 113 62 204 57 336 -8 190 -63 316 -198 452 -122 123 -264
186 -440 196 -219 13 -417 -77 -599 -273 -82 -87 -175 -222 -232 -336 -30 -58
-44 -77 -55 -73 -32 12 -215 46 -339 62 -183 25 -667 25 -850 0 -124 -16 -307
-50 -339 -62 -11 -4 -25 15 -55 73 -57 114 -150 249 -232 336 -209 225 -456
316 -709 261z m3550 -166 c310 -113 437 -451 290 -774 -57 -126 -172 -267
-315 -385 l-70 -58 -146 146 -147 146 149 184 c126 157 149 190 149 218 0 59
-67 97 -110 62 -9 -7 -80 -92 -159 -189 l-143 -177 -76 61 c-43 34 -124 92
-182 131 -58 38 -107 70 -109 72 -5 6 75 150 120 217 130 191 286 318 449 363
78 21 216 14 300 -17z"/>
                            <path d="M1810 3514 c-148 -97 -290 -243 -290 -297 0 -27 45 -67 76 -67 21 0
51 23 128 98 56 53 127 115 159 136 69 45 85 72 68 114 -12 28 -46 52 -74 52
-7 0 -37 -16 -67 -36z"/>
                            <path d="M920 3147 c-54 -27 -193 -279 -258 -468 -65 -188 -77 -259 -77 -459
1 -215 19 -299 101 -468 45 -90 70 -128 131 -192 87 -93 188 -163 297 -209 77
-32 227 -70 277 -71 l27 0 -6 -128 c-7 -196 29 -327 126 -448 l40 -51 -151
-42 c-218 -59 -244 -64 -282 -58 -40 7 -154 63 -227 112 -59 39 -95 44 -129
17 -36 -30 -31 -79 13 -116 89 -77 282 -166 361 -166 48 0 189 33 388 90 75
22 142 40 147 40 5 0 28 -31 51 -70 135 -227 311 -366 540 -428 85 -22 116
-25 266 -26 203 0 297 18 440 89 150 73 274 194 376 365 23 39 46 70 51 70 5
0 72 -18 147 -40 199 -57 340 -90 388 -90 128 0 374 147 558 335 212 215 357
488 423 795 25 113 42 263 42 358 0 59 -3 72 -23 90 -33 31 -80 29 -106 -4
-16 -20 -21 -41 -21 -86 0 -94 -19 -245 -45 -353 -81 -343 -272 -639 -538
-836 -95 -71 -248 -149 -291 -149 -26 0 -133 26 -378 92 l-37 10 41 52 c97
121 133 252 126 448 l-6 128 27 0 c49 1 200 39 275 70 474 197 658 746 451
1339 -54 156 -182 398 -235 446 -26 23 -74 24 -100 0 -33 -30 -25 -72 30 -160
390 -617 294 -1288 -214 -1489 -74 -30 -182 -56 -232 -56 -31 0 -32 2 -49 73
-63 260 -242 686 -308 732 -29 20 -49 19 -81 -6 -38 -30 -33 -65 28 -187 90
-179 222 -540 204 -557 -3 -3 -57 8 -119 24 -63 16 -150 35 -194 42 -115 17
-359 13 -490 -7 -135 -22 -135 -22 -270 0 -224 35 -487 21 -700 -39 -106 -29
-105 -29 -105 -10 0 54 123 382 205 545 62 124 68 159 29 189 -60 47 -96 17
-178 -152 -79 -163 -154 -363 -197 -524 l-32 -123 -31 0 c-50 0 -159 26 -232
56 -289 115 -454 383 -454 738 0 238 88 513 239 751 34 52 51 90 51 111 0 51
-54 84 -100 61z m1304 -1864 c80 -78 156 -142 194 -163 l61 -35 1 -152 0 -153
-42 -27 c-61 -38 -196 -92 -275 -108 -286 -61 -535 76 -592 326 -12 51 -14
168 -4 259 6 62 7 63 47 81 103 45 324 96 425 98 l54 1 131 -127z m254 100
c74 -14 90 -14 165 0 45 9 102 18 127 21 l45 6 -62 -60 c-79 -75 -160 -130
-193 -130 -33 0 -114 55 -193 130 l-62 60 45 -6 c25 -3 82 -12 128 -21z m832
-11 c63 -16 142 -40 175 -53 l60 -24 7 -50 c10 -77 9 -225 -3 -274 -57 -250
-306 -387 -592 -326 -79 16 -214 70 -274 108 l-43 27 0 153 1 152 61 35 c39
22 111 83 193 163 l130 128 85 -5 c47 -3 137 -19 200 -34z m-666 -768 c164
-87 331 -130 484 -123 77 4 80 3 70 -16 -6 -11 -52 -61 -102 -110 -101 -100
-165 -138 -301 -177 -113 -32 -352 -32 -468 0 -133 37 -202 76 -303 177 -50
49 -96 99 -102 110 -10 19 -7 20 74 16 151 -6 316 36 471 120 49 26 89 48 89
48 1 1 41 -20 88 -45z"/>
                            <path d="M1232 2902 c-10 -10 -39 -58 -64 -107 -147 -287 -142 -544 14 -696
49 -47 133 -90 192 -96 36 -4 47 -1 65 18 26 28 27 70 4 96 -10 11 -40 28 -67
38 -191 69 -218 289 -71 579 30 59 55 114 55 121 0 7 -9 24 -21 39 -25 31 -79
36 -107 8z"/>
                            <path d="M3781 2894 c-12 -15 -21 -32 -21 -39 0 -7 25 -62 55 -121 147 -290
120 -510 -71 -579 -27 -10 -57 -27 -66 -38 -24 -26 -23 -72 3 -98 28 -28 87
-22 163 15 239 117 282 421 108 761 -25 49 -54 97 -64 107 -28 28 -82 23 -107
-8z"/>
                            <path d="M1590 2790 c-12 -12 -20 -33 -20 -53 0 -29 18 -50 158 -190 87 -86
166 -157 175 -157 54 0 96 54 78 101 -5 13 -76 90 -158 172 -129 127 -154 147
-181 147 -19 0 -40 -8 -52 -20z"/>
                            <path d="M3293 2658 c-84 -84 -156 -161 -159 -171 -15 -47 46 -108 93 -93 10
3 87 75 171 159 132 133 152 158 152 185 0 19 -8 40 -20 52 -12 12 -33 20 -52
20 -27 0 -52 -20 -185 -152z"/>
                        </g>
                    </svg>

                </div>
                <div class="ml-4 text-center text-sm text-black-600 sm:text-right sm:ml-0">
                    Проект Жолбарыс
                </div>
            </div>
        </div>
    </body>
</html>
