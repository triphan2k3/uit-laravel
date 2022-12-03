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
                    <div id="board" style="width: 400px"></div>
                    <button id="startBtn" style='color:red'>Start Position</button>
                    <button id="clearBtn" style='color:green' >Clear Board</button>
                    <button id="showPositionInConsoleBtn" style='color:aqua'>Show position in console</button>
                    <button id="showPositionBtn" style='color:aqua'>Show position</button>
                    <div id="positionStr" style="word-wrap: break-word"></div>
                    <script>
                        // Init a chessboard
                        let board = Chessboard('board', {
                            draggable: true,
                            dropOffBoard: 'snapback',
                            position: 'start'
                        })

                        let previousPosition = board.position()
                        function displayPlayerMove() {
                            let newPosition = board.position()
                            let currentPiece;

                            //find piece that moved
                            for (let i = 0; i < Object.keys(previousPosition).length; i++) {
                                const pos = Object.keys(previousPosition)[i]
                                if (newPosition[pos] == previousPosition[pos])
                                    continue
                                else if (newPosition[pos] == undefined && previousPosition[pos] != undefined) {
                                    currentPiece = previousPosition[pos]
                                    // console.log(currentPiece)
                                    break
                                }
                            }

                            //find position
                            for (let j = 0; j < Object.keys(newPosition).length; j++) {
                                const pos1 = (Object.keys(newPosition))[j]
                                if (newPosition[pos1] == currentPiece && previousPosition[pos1] == undefined) {
                                    console.log(currentPiece + "/" + pos1)
                                    break
                                }
                            }

                            previousPosition = newPosition
                        }


                        // Button event
                        $('#startBtn').on('click', board.start)
                        $('#clearBtn').on('click', board.clear)
                        $('#showPositionInConsoleBtn').on('click', displayPlayerMoveInConsole)
                        $('#showPositionBtn').on('click', displayPlayerMove)
                        // $('body > img').on('drag', displayPlayerMove)


                        function displayPlayerMoveInConsole() {
                            console.log(board.position())
                            console.log('Current position as a FEN string:')
                            console.log(board.fen())
                            console.log(Object.keys(board.position()))
                        }
                        
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>