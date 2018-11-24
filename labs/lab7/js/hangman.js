// variables
var selectedWord ="";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [{word: "snake", hint: "It's a reptile"},
             {word: "monkey", hint: "It's a mammal"},
             {word: "beetle", hint: "It's an insect"}];

var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
                'Y', 'Z'];

var guessedWords = "";

var displayHint = false;

// listeners
window.onload = startGame();

$(".letter").click(function(){
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

$(".replayBtn").on("click", function() {
    location.reload();
});

$(".hintBtn").on("click", function() {
    displayHint = true;
    remainingGuesses -= 1;
    updateMan();
    showHint();
    
});

//functions
function startGame(){
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    if(window.sessionStorage.getItem("previous") != null){
        guessedWords = window.sessionStorage.getItem("previous");
        displayPreviousWords();
    }
    else{
         $("#previous").hide();
    }
}

function initBoard() {
    for(var letter in selectedWord){
        board.push("_");
    }
}

function updateBoard(){
    $("#word").empty();
    
    for(var i = 0; i < board.length; i++){
        $("#word").append(board[i] + " ");
    }
    
    $("#word").append("<br />");
    $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
    
    if(displayHint == true){
        showHint();
    }
}

function pickWord(){
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function createLetters() {
    for(var letter of alphabet){
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>")
    }
}



//checks to see if the selected letter exists in the selectedWord
function checkLetter(letter) {
    var positions = new Array();
    
    // Put all the positions the letter exists in an array
    for(var i = 0; i < selectedWord.length; i++){
        console.log(selectedWord)
        if(letter == selectedWord[i]){
            positions.push(i);
        }
    }
    
    if(positions.length > 0){
        updateWord(positions, letter);
        
        // check to se eif this is a winning guess
        if(!board.includes('_')) {
            endGame(true);
        }
    }
    else{
        remainingGuesses -= 1;
        updateMan();
    }
    
    if(remainingGuesses <=0){
        endGame(false);
    }
    
}

function updateWord(positions, letter){
    for(var pos of positions){
        board[pos] = letter;
    }
    
    updateBoard();
}

// Calculates and updates the image for our stick man
function updateMan(){
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

// ends the game by hiding game divs and displaying the win or loss divs
function endGame(win){
    $("#letters").hide();
    
    if(win){
        $('#won').show();
        guessedWords += " " + selectedWord;
        window.sessionStorage.setItem("previous", guessedWords);
    }
    else{
        $('#lost').show();
    }
}

//disables the button and changes the style to tell the user it's disabled
function disableButton(btn){
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

function showHint(){
    $("#hint").hide();
    $(".hint").show();
}

function displayPreviousWords(){
     $("#previous").append("Previous words: " + guessedWords);
}