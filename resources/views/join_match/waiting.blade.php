<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Waiting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Waiting
                    <div id="countdownTimer"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let remaining = 6000

        let countdownFunc = setInterval(function() {
            remaining -= 1000

            let minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((remaining % (1000 * 60)) / 1000);

            document.getElementById("countdownTimer").innerHTML = minutes + "m " + seconds + "s";

            if (remaining < 0) {
                window.location = "http://homestead.test/chessboard";
                clearInterval(x)
            }
        }, 1000);
        window.onload = countdownFunc
    </script>
</x-app-layout>