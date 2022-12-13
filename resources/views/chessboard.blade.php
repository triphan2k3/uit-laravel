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
                    <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around; height: 450px">
                        <div id="board" style="width: 400px"></div>
                        <div style="height: 100%; overflow-y: scroll; width: 200px">
                            <ul id="moveList"></ul>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2" id="startBtn">Start Position</button>
                    <button class="btn btn-danger mt-2" id="clearBtn">Clear Board</button>
                    <button class="btn btn-primary mt-2" id="showPositionBtn">Show position in console</button>
                    <script>
                        const chessPieces = {
                            bB: "♝",
                            bK: "♚",
                            bN: "♞",
                            bP: "♟",
                            bQ: "♛",
                            bR: "♜",
                            wB: "♗",
                            wK: "♔",
                            wN: "♘",
                            wP: "♙",
                            wQ: "♕",
                            wR: "♖", 
                        }

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
                            if (source === target || target === 'offboard') {
                                return
                            } else {
                                let data = chessPieces[piece] + " " + target
                                let ul = document.getElementById('moveList')
                                let li = document.createElement('li')
                                li.appendChild(document.createTextNode(data))
                                ul.appendChild(li)  
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>