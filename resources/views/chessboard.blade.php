<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chessboard') }}
        </h2>
    </x-slot>

    <!-- @vite('resources/js/chessboard.js') -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" id="div1">
                    <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around;">
                        <div id="board" style="width: 400px"></div>
                        <ul id="moveList"></ul>
                    </div>
                    <button class="btn btn-success mt-2" id="startBtn">Start Position</button>
                    <button class="btn btn-danger mt-2" id="clearBtn">Clear Board</button>
                    <button class="btn btn-primary mt-2" id="showPositionBtn">Show position in console</button>
                    <script>
                        // Init a chessboard
                        var config = {
                            draggable: true,
                            dropOffBoard: 'snapback',
                            position: 'start',
                            onDrop: onDrop,
                        }

                        var board = Chessboard('board', config)

                        // Button event
                        $('#startBtn').on('click', board.start)
                        $('#clearBtn').on('click', board.clear)
                        $('#showPositionBtn').on('click', clickShowPositionBtn)

                        function clickShowPositionBtn () {
                            console.log('Current position as an Object:')
                            console.log(board.position())

                            console.log('Current position as a FEN string:')
                            console.log(board.fen())
                        }

                        function onDrop (source, target, piece, newPos, oldPos, orientation) {
                            console.log('Source: ' + source)
                            console.log('Target: ' + target)
                            console.log('Piece: ' + piece)
                            console.log('Orientation: ' + orientation)
                            let data = '♟'+ " " + target
                            addListItem(data)
                        }

                        function addListItem(data) {
                            let ul = document.getElementById('moveList')
                            let li = document.createElement('li')
                            ul.appendChild(li)
                        
                            let list = document.querySelector('li')
                            list.innerHTML = data
                        }
                        
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>