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