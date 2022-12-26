<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chessboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" id="div1">
                    <div id="board1" style="width: 400px"></div>
                    <button id="startBtn">Start position</button>
                    <button id="clearBtn">Clear board</button>
                    <button id="showPositionBtn">Show position</button>
                    <div id="positionStr" style="word-wrap: break-word">
                    </div>
                    <script>
                        var board1 = Chessboard('board1', {
                            draggable: true,
                            dropOffBoard: 'trash',
                            position: 'start'
                        })

                        function clickShowPositionBtn () {
                            console.log('Current position as an Object:')
                            console.log(board1.position())

                            // console.log('Current position as a FEN string:')
                            // console.log(board1.fen())

                            //sau khi click thi hien thi vi tri
                            //neu vi tri thay doi -> noi dung trong object thay doi -> noi dung text cua newContent thay doi
                            //==> sau khi bam vao Show Position button thi noi dung text cua newContent thay doi

                            const diff = (after, before) => after.split(before).join('')
                            const newPosition = JSON.stringify(board1.position());

                            const newMove = diff(newPosition, positionCurrent);

                            const positionAfter = document.getElementById("positionStr");
                            positionAfter.innerText = newMove;
                        }

                        $('#showPositionBtn').on('click', clickShowPositionBtn)
                        $('#startBtn').on('click', board1.start)
                        $('#clearBtn').on('click', board1.clear)

                        // selecy element by id
                        const positionCurrent = document.getElementById("positionStr");
                        
                        //paste content into element
                        positionCurrent.innerText = JSON.stringify(board1.position());
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>