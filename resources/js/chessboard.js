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
